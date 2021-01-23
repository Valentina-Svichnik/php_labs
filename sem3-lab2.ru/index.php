<?php

$url = 'https://rasp.dmami.ru/session';

function getHTMLcode( $url )
{
    try
    {
        // пытаемся инициировать сеанс с помощью cURL
        if( !$ch = curl_init( $url ) )       // инициализируем сеанс, если невозможно
        throw new Exception();               // то генерируем исключительную ситуацию
        curl_setopt($ch, CURLOPT_HEADER, 0); // устанавливаем параметры
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $ret = curl_exec( $ch ); // выполненияем запрос
        curl_close($ch);         // завершаем сеанс
        return $ret;             // возвращам результат
    }
    catch(Exception $e) // если не удалось использовать cURL
    {
        return @file_get_contents( $url ); // используем стандартную
    }
}

function getALLtag( $text, $tag )
{
    // формируем шаблон для тега
    $pattern='#<'.$tag.'([\s]+[^>]*|)>(.*?)<\/'.$tag.'>#i';
    // получаем массив со строками соответствующими второму этапу задачи
    preg_match_all( $pattern, $text, $ret, PREG_SET_ORDER );
    foreach( $ret as $k=>$v ) // для всех найденых тегов
    {
        if( $tag == 'a' ) // если мы искали входдения тега <a>
        {
            $href = ''; // определяем адрес ссылки
            preg_match( '#(.*)href="(.*?)"#i', $v[1], $arr);
            if( $arr ) // если успешно
                $href = $arr[2]; // сохраняем адрес в переменной
            // возвращаем адрес и текст ссылки
            $ret[$k] = array( 'href'=>$href, 'text'=>$v[2]);
        }
        else // иначе
        $ret[$k] = array( 'text' => $v[2] ); // возвращаем текст тега
    }
    return $ret; // возвращаем массив с текстами тегов
}

function getLINKtype($href, $url)
{
    if ((@strpos($href, '#') !== 0) && ($href !== '') && ($href !== '/') && (@strpos($href, '?') !== 0)) 
    { 
        // если в адресе ссылки нет протокола – ссылка локальная
        if (@strpos($href, '://') === false) {
            return 3;
        };
        // выделяем в ссылке имя сервера
        $domen = parse_url($href, PHP_URL_HOST); // если  имя сервера в ссылке равно текущему имени сервера 
        if ($domen == parse_url($url, PHP_URL_HOST))
            return 2;    // глобальная ссылка на этот же сайт 
        return 1;     // иначе ссылку считаем глобальной
    } else return 0;
}


function getINFO( $url, $deep )
{
    // echo '<hr>';
    global $MAX_DEEP;  // читаем максимальную глубину из внешней переменной 

        global $urlsArray; // читаем массив, ответственный за запись всех ссылок, выведенных на экран

        if ($deep > $MAX_DEEP) return; // если превышен максимальный уровень вложенности 

        $urlsArray[] = $url; // Добавляем ссылку на текущую страницу в массив, где хранятся все проанализированные страницы 

        if ($url == $_POST['url'])
            echo '<p><b>URI страницы: </b> <a href="' . $url . '">' . $url . '</a> </p>';
        else echo '<p><b>URI производной страницы: </b><a href="' . $url . '">' . $url . '</a><p>';

        $code = getHTMLcode($url);  // определяем html-код страницы
        $titles = getALLtag($code, 'title');   // получаем массив с заголовком
        echo '<p><b>Заголовок страницы: </b>';
        if (isset($titles[0]['text'])) echo $titles[0]['text']; // Если он существует, выводим
        echo '</p>';

        $descriptions = getALLtag($code, 'description'); // получаем массив с информацией 
        echo '<p><b>Описание страницы: </b>';
        foreach ($descriptions as $des) {
            echo $descriptions[$des]['text']; // Если он существует, выводим
        }
        echo '</p>';

        $keywords = getALLtag($code, 'keywords'); // получаем массив с ключевыми словами 
        echo '<p><b>Ключевые слова: </b>';
        foreach ($keywords as $key) {
            echo $keywords[$key]['text']; // Если он существует, выводим
        }
        echo '</p>';

        $h1 = getALLtag($code, 'h1');
        $h2 = getALLtag($code, 'h2');
        $a = getALLtag($code, 'a');

        echo '<h4 class="mt-5">Все ссылки на странице:</h4>';

        echo '<b>Глобальные ссылки на этот же сайт:</b><br><ul>';
        foreach ($a as $link) {   // выводим все найденные глобальные ссылки, ведущие на этот же сайт
            if (getLINKtype($link['href'], $url) == 2) {
                echo '<li><a href="' . $link['href'] . '">' . $link['href'] . '</a></li>';
            }
        }
        echo '</ul>';

        echo '<b>Глобальные ссылки на другие сайты:</b><br><ul>';
        foreach ($a as $link) {   // выводим все найденные глобальные ссылки
            if (getLINKtype($link['href'], $url) == 1) {
                echo '<li><a href="' . $link['href'] . '">' . $link['href'] . '</a></li>';
            }
        }
        echo '</ul>';

        echo '<b>Локальные ссылки:</b><br><ul>';
        foreach ($a as &$link) {   // выводим все найденные локальные ссылки (АМПЕРСАНД нужен, чтобы мы могли изменять элементы массива по ходу)
            if (getLINKtype($link['href'], $url) == 3) {
                echo '<li><a href="' . parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST) . $link['href'] . '">' . $link['href'] . '</a></li>';
                // Преобразуем их в глобальные ссылки и сохраняем, чтобы в дальнейшем перейти на них
                $link['href'] = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST) . $link['href'];
            }
        }
        echo '</ul>';

        foreach ($a as $link) {   // для всех страниц по ссылкам
            // при условии, что ссылки на них не выходят за пределы сайта и не повторяют уже показанных ранее страниц
            if (((getLINKtype($link['href'], $url) == 2) || (getLINKtype($link['href'], $url) == 1)) && !in_array($link['href'], $urlsArray)) {
                getINFO($link['href'], $deep + 1); // выводим информацию о них 
            }
        }
}
$MAX_DEEP = 8; // инициируем максимальную глубину обхода 
$urlsArray = array();

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Лабораторная раюота В-5</title>
</head>
<body>';


if (!$_POST['url'])
{
    echo '<div class="container m-5">
    <h1 class="mb-3">Введите ссылку на сайт</h1>
    <form method="post">
        <input type="text" class="form-control w-50" placeholder="Введите ссылку" name="url">
        <input type="submit" value="Анализировать" class="btn btn-outline-info mt-3">
    </form>
</div>';
} else 
    {
        echo '<a href="index.php?logout" class="btn btn-outline-dark btn-sm m-3">Назад</a>'; // Кнопка ВЫХОД

        if (!@strpos($_POST['url'], '://')) { // проверяем, что ссылка указана с http или https. Если нет, добавляем один из них
            if (@file_get_contents('https://' . $_POST['url'])) // функция file_get_contents возвращает содержимое файла в виде строки, если оно есть, иначе false
                $_POST['url'] = 'https://' . $_POST['url'];
            else if (@file_get_contents('http://' . $_POST['url']))
                $_POST['url'] = 'http://' . $_POST['url'];
        }
        echo '<div class="container">';
        getINFO($_POST['url'], 1); // запускаем обход сайта с исходного URL
        echo '</div>';
    }




echo '</body>
</html>';
?>


