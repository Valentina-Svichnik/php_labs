<?php
session_start(); // подключаем механизм сессий

// обрабатываем выход
if( isset($_GET['logout']) ) // если был переход по ссылке Выход
{
    unset( $_SESSION['user'] ); // удаляем информацию о пользователе
    header('Location: /'); // переадресация на главную страницу
    exit(); // дальнейшая работа скрипта излишняя
}


// если аутентификации нет, но переданы данные для ее проведения
if( !isset($_SESSION['user']) && isset($_POST['login']) && isset($_POST['password']) && $f=fopen('users.csv', 'rt'))
{
    while( !feof($f) ) // пока не найден конец файла
    {
        // разбиваем текущую строку файла в массив
        $test_user = explode(';', fgets($f) );
        if( trim($test_user[0])==$_POST['login'] ) // если найден логин
        {
            if( isset($test_user[1]) && // если пароли совпали
            trim($test_user[1])==$_POST['password'] ) // сохраняем
            {
                $_SESSION['user'] = $test_user;
                setcookie("login", $test_user[0], time()+60*60*24*365*10);
                setcookie("password", $test_user[1], time()+60*60*24*365*10); // в сессию
                header('Location: /');
                // редирект на главную
                exit(); // дальнейшая работа скрипта излишняя
            }
            else // если пароль не совпал
            break; // прекращаем итерации
        }
    }
    echo '<div class="alert alert-danger" role="alert">
            <strong>Ошибка!</strong> Введен неправильный логин или пароль!
        </div>';
    fclose($f); // закрываем файл
}


// если аутентификации все еще нет
if( !isset($_SESSION['user']) )
{
// выводим форму для аутентификации
    echo '<!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Авторизация</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
      
        <!-- Подключаем Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </head>
    <body>

    <div class="container d-flex justify-content-center mt-5">
    <form name="auth" method="post" action="" class="w-50 p-5 mt-5 border border-dark rounded">
    <div class="form-group">
    <h1>Авторизация</h1>
    <label for="login" class="col-sm-2 col-form-label">Логин</label>
    <div class="col-sm-10 mb-3">
        <input class="form-control" type="text" name="login" id="login" placeholder="Логин"';
    //если логин уже вводился ранее и был передан в программу
    if( isset($_POST['login']) )
    echo ' value="'.$_POST['login'].'"'; // заполняем значение поля
    echo 'placeholder="Логин"></div>
    <label for="password" class="col-sm-2 col-form-label">Пароль</label>
    <div class="col-sm-10">
        <input class="form-control" type="password" name="password" id="password" placeholder="Пароль">
    </div>
    <input type="submit" class="btn btn-primary m-3" value="Войти">
    </div></form></div>
    <div class="container d-flex">
        <p><b>Подсказка: </b><br>
        Логин: admin </br>
        Пароль: 123</p>
        <p class="ml-5"><br>
        Логин: valya </br>
        Пароль: 123</p>
    </div>
    </body>
    </html>';
}
else

// если аутентификация успешно произведена
{

    echo ' <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Авторизация</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
      
        <!-- Подключаем Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </head>
    <body>
    <main><div class="container"><h1>Добро пожаловать, '.$_SESSION['user'][0].'!</h1>';
    include 'tree.php'; // выводим содержимое дерева файлов
    echo '<form method="get">
            <button type="submit" id="logout" name="logout" class="btn btn-outline-primary">Выйти</button>
          </form>
          </div>
          </main>
          </body>
    </html>';
}
?>





    

