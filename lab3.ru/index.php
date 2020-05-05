<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>
        Свичник Валентина Алексеевна, 191-321. Лабораторная работа № А-3. 
        Использование GET‐параметров в ссылках.Виртуальная клавиатура.
    </title>
    <link rel="stylesheet" href="style.css">
    

</head>
<body>
	<header>
		<div class="header-wrapper">
			<div class="logo">
                <img src="img/logo.png" alt="logo" width="100" height="100">
                <p>МОСКОВСКИЙ ПОЛИТЕХ</p>
            </div>
			<p>Свичник Валентина Алексеевна, 191-321 <br> Лабораторная работа № А-3</p>
		</div>
	</header>

	<main>
	<p>Данная лабораторная работа выполнена ученицей 1 курса Московского Политехнического университета в 2020 году, 
                обучающейся по программе факультета информационных технологий на направлении "Веб-технологии"
                в группе 191-321, Свичник Валентиной Алексеевной</p>
    <div class="main">
        <?php
        if( !isset($_GET['sum']) ){
            $_GET['sum']='';
        }
        else // иначе
        if( isset($_GET['sum']) ){
            $_GET['sum']++;
		}
        if( !isset($_GET['store']) ){               //если не передано предыдущее значение
            $_GET['store'] = '';                    //создаем пустое хранилище
        }
        else                                        // иначе
        if( isset($_GET['key']) ){                  //если кнопка была нажата
            $_GET['store'].= $_GET['key'];          //сохранить цифру в хранилише
}
        echo '<div class="result">'.$_GET['store'].'</div>';
    ?>
    <div class="cont">
        <a class="num" href="?key=1&sum=<?php echo $_GET['sum']; ?>&store=<?php echo $_GET['store']; ?>">1</a>
        <a class="num" href="?key=2&sum=<?php echo $_GET['sum']; ?>&store=<?php echo $_GET['store'];?>">2</a>
        <a class="num" href="?key=3&sum=<?php echo $_GET['sum']; ?>&store=<?php echo $_GET['store'];?>">3</a>
        <a class="num" href="?key=4&sum=<?php echo $_GET['sum']; ?>&store=<?php echo $_GET['store'];?>">4</a>
        <a class="num" href="?key=5&sum=<?php echo $_GET['sum']; ?>&store=<?php echo $_GET['store'];?>">5</a>
    
        <a class="num" href="?key=6&sum=<?php echo $_GET['sum']; ?>&store=<?php echo $_GET['store'];?>">6</a>
        <a class="num" href="?key=7&sum=<?php echo $_GET['sum']; ?>&store=<?php echo $_GET['store'];?>">7</a>
        <a class="num" href="?key=8&sum=<?php echo $_GET['sum']; ?>&store=<?php echo $_GET['store'];?>">8</a>
        <a class="num" href="?key=9&sum=<?php echo $_GET['sum']; ?>&store=<?php echo $_GET['store'];?>">9</a>
        <a class="num" href="?key=0&sum=<?php echo $_GET['sum']; ?>&store=<?php echo $_GET['store'];?>">0</a>
    </div>
    <div class="res">
        <a class="reset" href="index.php?sum=<?php echo $_GET['sum']; ?>">СБРОС</a>
    </div>
    </div>
    <div class="footer"></div>
</main>

	<div class="footer-blog">


<footer>
    <p>2020, Svichnik Valentina, общее число нажатых кнопок: <?php echo $_GET['sum']++; ?></p>		
</footer>

</body>
</html>