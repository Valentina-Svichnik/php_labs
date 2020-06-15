<?php
    $mysqli = new mysqli ("std-mysql", "std_938", "qazwsxedc", "std_938");
    // $mysqli = mysqli_connect('std-mysql', 'std_938', 'qazwsxedc', 'std_938');
// if( mysqli_connect_errno() ) // проверяем корректность подключения
// return 'Ошибка подключения к БД: '.mysqli_connect_error();
    $mysqli->query ("SET NAMES 'utf8'");


    $success = $mysqli->query ("INSERT INTO 'users' ('surname', 'name', 'patname', 'gender', 'birthday', 'phone', 'adress', 'e-mail') VALUES ('Козодаев', 'Виктор', 'Сергеевич', 'male', '2020-01-01', '89999999399', 'г.Москва', 'victor@gmail.com' ");
    echo $success




    $mysqli->close ();
?>