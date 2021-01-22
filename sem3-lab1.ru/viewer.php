<!-- Модуль viewer.php при передаче ему в качестве параметра имени файла должен удовлетворять
следующим требованиям.
1. если пользователь не аутентифицирован – выводится ссылка: "Необходима аутентификация!"
ведущая на главную страницу сайта, дальнейшее выполнение программы прекращается;
2. если в специальном файле users.csv присутствует информация об принадлежности файла не
аутентифицированному в настоящее время пользователю – выводится надпись: "Нет прав доступа!";
3. при попытке отображения данных из специального файла users.csv выводится надпись: "Секретная
информация!";
4. если параметр не передан – выводится надпись: "Имя файла не указано!";
5. если параметр передан, но файл не найден – выводится надпись: "Файл не найден!";
6. если параметр передан и файл существует – выводится содержимое этого файла в браузере, включая
HTML-теги (если файл содержит тег <br>, то в браузере должен быть выведен текст "<br>", а не
осуществлен перевод строки);
7. работа с файлами не должна приводить к потенциальным конфликтам доступа между различными
пользователями сайта.
8. Если информации о файле в users.csv нет – выводится сообщение об этом -->



<?php
    session_start(); 
    echo'<!DOCTYPE html>
        <html lang="en">
        
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Просмотр текстового файла</title>
            <link rel="stylesheet" href="style123.css">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
      
            <!-- Подключаем Bootstrap JS -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
   
        </head>
        
        <body>
            <div class="content">';
        if (!isset($_SESSION['user'])) {
            echo '<div class="error">Необходима авторизация</div>';
            exit();
        }
        if (!isset($_GET['filename'])) {
            echo '<div class="error">Файл не передан</div>';
            exit();
        }
        
        if (preg_match('/users\.csv/', $_GET['filename'])) {
            echo '<div class="error">Вы не можете смотреть файл user.csv в целях безопасности. Секретная информация!</div>';
            exit();
        }
        
        $is_owner = false;
        $file_has_note = false; 
        $info = file('users.csv');  
        $f = fopen('users.csv', 'rt');  
        foreach ($info as $user) 
        {
            
            $data = str_getcsv($user, ';');  
            if ($data[0] == $_SESSION['user'][0]) 
            {
                foreach ($data as $key => $val) {
                    $regular = str_replace(".", "\.", $val); 
                    $regular = '/' . str_replace("/", "\/", $regular) . '/'; 
                    if (preg_match($regular, $_GET['filename'])) 
                    {
                        $is_owner = true;
                        $file_has_note = true;
                    }
                    unset($value);  
                }
            } else 
            {
                foreach ($data as $key => $val) {
                    $regular = str_replace(".", "\.", $val);
                    $regular = '/' . str_replace("/", "\/", $regular) . '/';
                    if (preg_match($regular, $_GET['filename'])) {
                        $file_has_note = true;
                    }
                    unset($value); 
                }
            }
        }
        fclose($f);  

        if (!$file_has_note) {
            echo '<b>В файле users.csv отсутствует информация о принадлежности файла ' . $_GET['filename'] . '</b><br>';
        }
        if (!$file_has_note || $is_owner) { 
            $f = fopen($_GET['filename'], 'rt');  
            if ($f)     
            {
                $content = '';     
                while (!feof($f))    
                    $content .= fgets($f);  
                echo '<pre>' . htmlspecialchars($content) . '<pre>';   
                fclose($f);   
            } else echo '<div class="error">Ошибка открытия файла ' . $_GET['filename'] . '</div>';
        } else {
            echo 'Нет прав доступа к файлу ' . $_GET['filename'];
        }

        echo '</div>
        </body>
        
        </html>';
        ?>
    