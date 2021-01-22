<!-- 1. При попытке выполнения без аутентификации выводится сообщение о прекращении работы и
дальнейшее выполнение программы приостанавливается.
2. При открытии страницы в браузере отображается содержание текущего каталога (дерево файлов).
3. Каждый элемент дерева выводится в отдельном блоке (тег <div>), которые за счет отступов слева
формируют легко читаемую структуру дерева каталогов.
4. Элементы типа "каталог" и "файл" должны отличаться друг от друга внешне.
5. Любой элемент "каталог" должен содержать все содержащиеся в нем элементы.
6. Элементы "файл" должны представлять собой ссылки, передающие третьему документу в качестве
GET-параметра его полное имя. Ссылка должна открываться в другом окне или вкладке браузера.
7. Внизу дерева выводится форма, позволяющая загружать файлы с локального компьютера на сайт.
Каталог, в который будет загружен файл указывается пользователем в специальном поле. Если
каталог не существует – он должен быть создан. Если указан существующий каталог, но не выбран
файл для загрузки – каталог вместе со всеми файлами должен быть удален.
8. Попытки удаления системных файлов и каталогов должны блокироваться.
9. Информация о принадлежности успешно загруженных файлов сохраняется в специальный файл
users.csv. Имя файла на сервере генерируются как последовательность чисел от 1 с шагом 1;
расширение загруженного файла сохраняется. В каждом каталоге последовательность чисел
начинается заново. -->


<?php
$name = 'server';
$dir = '.';

function outdirInfo($name, $path)
{
    echo '<div class="p-3"><b>Каталог</b> ' . $name . '<br>';  // выводим имя каталога 
    $dir = opendir($path);                         // открываем каталог

    // перебираем элементы каталога пока они не закончатся
    $stop = 0;
    while (($file = readdir($dir)) !== false && $stop < 100) {
        $stop++;
        if (is_dir($path . '/' . $file) && $file != "." && $file != "..") {    // если элемент каталог
            outdirInfo($file, $path . '/' . $file); // выводим его содержимое 
        } else 
        if (is_file($path . '/' . $file))    // если элемент файл 
            // echo "$file<br>";
            echo makeLink($file, $path . '/' . $file);  // выводим его имя
    }
    closedir($dir);    // закрываем каталог 
    echo '</div>';     // конец блока с содержимым каталога
}


/// ВЫВОД ДЕРЕВА ФАЙЛОВ
function makeLink($name, $path)
{
    echo '<a class="ml-3" href="viewer.php?filename=' . UrlEncode($path) . 
        '"  target="_blank">Файл <b>' . $name . '</b></a><br>'; // выводим ссылку в HTML-код страницы
}

// записываем принадлежность файла определённому пользователю
function updateFileList($filename)
{
    $info = file('users.csv');        // читаем все строки файла в массив 
    $f = fopen('users.csv', 'wt');    // открываем файл для записи 
    flock($f, LOCK_EX);               // блокируем файл исключительно
    foreach ($info as $k => $user)    // для всех строк массива 
    {
        $data = str_getcsv($user, ';');  // декодируем данные 
        if ($data[0] == $_SESSION['user'][0]) // если найден пользователь
            $user .= ';' . $filename;  // добавляем к его файлам новый 
        fputs($f, $user);    // сохраняем данные в файл
    }
    flock($f, LOCK_UN);  // разблокируем файл
    fclose($f);    // закрываем файл
}


error_reporting(~E_WARNING);

function deleteCatalog($dirname, $path)
{
    if (is_dir($path . '/' . $dirname) && $dirname != "/" && $dirname != "//" && $dirname != "." && $dirname != ".." && $dirname != "..." && $dirname != "") { 
        if (!rmdir($path . '/' . $dirname)) { // если не получилось удалить подкаталог
            $path_dirname = $path . '/' . $dirname;
            $dir = opendir($path_dirname);    // открываем каталог
            // перебираем элементы каталога пока они не закончатся
            $stop = 0;
            while (($file = readdir($dir)) !== false && $stop < 50) {
                $stop++;
                if (is_dir($path_dirname . '/' . $file) && $file != "." && $file != ".." && $file != "/") {    // если элемент каталог 
                    if (!rmdir($path_dirname . '/' . $file)) // если не получилось удалить подкаталог
                        deleteCatalog($file, $path_dirname); // проходим по подкатологу и удаляем его содержимое
                } else if (
                    is_file($path_dirname . '/' . $file) && $file != 'index.php' && $file != 'tree.php'
                    && $file != 'viewer.php' && $file != 'users.csv' && $file != 'style123.css'
                ) {   // если элемент файл, но не системный
                    unlink($path_dirname . '/' . $file);  // удаляем его
                    deleteFileList($dirname . '/' . $file); // и информацию о нём из users.csv
                }
            }
            closedir($dir);    // закрываем каталог
            rmdir($path . '/' . $dirname); // наконец удаляем пустой каталог
            echo '<p class="green">Каталог ' . $path . '/' . $dirname . ' успешно удалён</p>';
        }
    } else echo '<p class="error">Каталог ' . $path . '/' . $dirname . ' не существует</p>';
}

// функция удаления информации принадлежности файла пользователю
function deleteFileList($filename)
{
    $info = file('users.csv');  // читаем все строки файла в массив 
    $f = fopen('users.csv', 'wt');  // открываем файл для записи 
    flock($f, LOCK_EX);  // блокируем файл исключительно
    foreach ($info as $user) // для всех строк массива 
    {
        $data = str_getcsv($user, ';');  // декодируем данные 
        foreach ($data as $key => $val) {
            if ($val == $filename) // если найдена запись об удаляемом файле
            {
                unset($data[$key]);  // удаляем её 
            }
            unset($value); // уничтожаем переменную value, иначе она так и продолжит ссылаться на последний элемент 
        }
        fputs($f, implode(";", $data));    // сохраняем данные в файл
    }
    flock($f, LOCK_UN);  // разблокируем файл
    fclose($f);    // закрываем файл
}

/// ЗАГРУЗКА И ОБРАБОТКА ФАЙЛОВ
function makeName($filename)
{
    if (!file_exists($_POST['dir-name']))          // если каталога не существует 
    {
        umask(0);                                  // сбрасываем значение umask 
        mkdir($_POST['dir-name'], 0777, true); 
    }
    $ex = explode(';', $filename);
    $ext = end($ex);
    $n = 1;   // начиная с 1 цикл пока существует файл
    while (file_exists($_POST['dir-name'] . '/' . $n . '.' . $ext)) // с текущем номером
        $n++;       // - увеличиваем номер
    return ($_POST['dir-name'] . '/' . $n . '.' . $ext);  // возвращаем свободное имя 
}


if (isset($_FILES['myfilename']))                 // были отправлены данные формы 
{
    if (isset($_FILES['myfilename']['tmp_name'])) // если файл загружен 
    {
        if ($_FILES['myfilename']['tmp_name'])    // если файл существует 
        {
            $servername = makeName($_FILES['myfilename']['name']);
            // копируем его и выводим сообщение об успешной загрузке
            move_uploaded_file(
                $_FILES['myfilename']['tmp_name'],
                $servername
            );
            updateFileList($servername);
            echo '<p class="alert alert-success">Файл ' . $_FILES['myfilename']['name'] . ' успешно загружен на сервер</p>';
        } 
        else 
            deleteCatalog($_POST['dir-name'], getcwd()); // удаляем каталог (getcwd() возвращает абсолютный путь текущего каталога) 
    }
}



echo '<div id="dir_tree">';        // выводит начало тега блока дерева каталогов 
outdirInfo('сервер', getcwd()) ;   // выводит дерево каталогов
echo '</div>';                     // конец блока дерева каталогов
?>
<br>
<form method="post" enctype="multipart/form-data" action="" class="form-group w-50">
    <label for="dir-name" class="col-form-label">Каталог на сервере</label>
    <input type="text" name="dir-name" id="dir-name" class="form-control"><br>
    <label for="myfilename" class="col-form-label">Локальный файл</label> <br>
    <input type="file" name="myfilename" id ="myfilename"><br>
    <input type="submit" class="btn btn-primary mt-3" value="Отправить файл на сервер">
</form>
