<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Свичник Валентина Алексеевна, 191-321. Лабораторная работа № В‐1. 
    Основы баз данных и использования программных модулей. Записная книжка</title>
</head>
<body>
    <?php
        require 'menu.php'; // главное меню
        if( $_GET['p'] == 'viewer' ) {                                 // если выбран пункт меню "Просмотр"
            include 'viewer.php';                                      // подключаем модуль с библиотекой функций

            // если в параметрах не указана текущая страница – выводим самую первую
            if( !isset($_GET['pg']) || $_GET['pg']<0 ) $_GET['pg']=0;

            // если в параметрах не указан тип сортировки или он недопустим
            if(!isset($_GET['sort']) || ($_GET['sort']!='byid' && $_GET['sort']!='fam' && $_GET['sort']!='birth'))
            $_GET['sort']='byid'; // устанавливаем сортировку по умолчанию

            echo getFriendsList($_GET['sort'], $_GET['pg']);             // формируем контент страницы с помощью функции и выводим его
        }
        else                                                             // подключаем другие модули с контентом страницы
        if( file_exists($_GET['p'].'.php') ) { include $_GET['p'].'.php'; } 
        print_r($_GET)
    ?>
</body>
</html>