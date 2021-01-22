<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>savlas</title>
</head>
<body>
    

<?php
    function printResult($result_set) {
        while (($row  =  $result_set->fetch_assoc()) !=false) {
            // print_r($row);
            // echo($row['name']);
            echo("<br>");

            echo('<div class="card" style="background-color: yellow; padding: 10px;">
                    <img  src="img/blue_bomb.jpg" width="200"><br>'.$row['name'].'
                </div>; ');
            
        }
        echo("Количество записей ".$result_set->num_rows."<br>--------------------");
    }


    // $mysqli = new mysqli ("std-mysql", "std_938", "qazwsxedc", "std_938");
    $mysqli = mysqli_connect('std-mysql', 'std_938', 'qazwsxedc', 'std_938');
    if( mysqli_connect_errno() ) // проверяем корректность подключения
    return 'Ошибка подключения к БД: '.mysqli_connect_error();

    $mysqli->query ("SET NAMES 'utf8'");

    // $success = $mysqli->query ("INSERT INTO `friends` (`id`, `surname`, `name`, `patname`, `gender`, `birthday`, `phone`, `adress`, `e-mail`, `comment`) VALUES (NULL, 'Кудряшова', 'Анастасия', 'Владимировна', 'female', '2000-06-06', '89999998999', 'г.Москва', 'nastya@gmail.com', '--no comment--');");
    // echo $success;
    // $mysqli->query("UPDATE `friends` SET `phone` = '89999999967' WHERE `friends`.`id` = 5");
    // $mysqli->query("DELETE FROM `friends` WHERE `friends`.`id` = 15");

    $result_set = $mysqli->query("SELECT * FROM `friends`");
    printResult($result_set);

    $mysqli->close ();
    echo("<br>");
    echo("Hello world");
    
?>



</body>
</html>