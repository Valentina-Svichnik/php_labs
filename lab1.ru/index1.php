<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <?php 
		$title='Свичник Валентина Алексеевна 191-321, лабораторная №1, Простейшая программа на PHP.  
		Конвертация статического контента в динамический.'; 
		echo '<title>'.$title.'</title>'; 
	?> 
</head>
<body>
    <header role="banner">
        <nav role="navigation">
            <div class="logo"><img src="img/logo_parashut.png" alt="logo" width="50" height="50"></div>
            <div class="menu">
			<a href="<?php 
              $name='ГЛАВНАЯ'; 
              $link='index.php'; 
              $current_page=false; 
              echo $link
              ?>" class="<?php 
              if ($current_page) 
                echo ' active'; 
              ?>">
              <?php
              echo $name; 
				?></a>

				<a href="<?php 
					$name='О НАС'; 
					$link='index1.php'; 
					$current_page=true; 
					echo $link
					?>" class="<?php 
					if ($current_page) 
						echo ' active'; 
					?>">
					<?php
					echo $name; 
				?></a>

				<a href="<?php 
					$name='ТАРИФЫ'; 
					$link='index2.php'; 
					$current_page=false; 
					echo $link
					?>" class="<?php 
					if ($current_page) 
						echo ' active'; 
					?>">
					<?php
					echo $name; 
				?></a>
            </div>
        </nav>
    </header>

    <main>
        <div class="about">
            <div class="whowe">
                <h1>КТО МЫ?</h1>
                <article>
                    <h2>Let's fly!</h2>
                    Удобно расположенный в г. Москва, центр «Let's fly!» 
                    предлагает стандартные корты и поля для более десяти видов спорта. 
                    Круглый год наши клиенты могут тренироваться в крытых спортивных и фитнес-залах, 
                    оборудованных климат-контролем, а также на открытых полях с естественным и 
                    искусственным покрытием. Загляните к нам, и мы проведем для вас бесплатную 
                    экскурсию по комплексу и познакомим с нашими доброжелательными профессиональными тренерами.
                </article>
            </div>
            <img src="img/foto2.jpg" alt="beautiful view" width="40%" height="450">
        </div>
    </main>

    <main>
        <div class="about grey">
		<img src="img/foto1.jpg" alt="beautiful view" width="40%" height="450">
            <div class="whowe">
                <h1>ЧТО МЫ ДЕЛАЕМ?</h1>
                <article>
                    Ежегодно здесь проводятся российские и международные соревнования в области парашютного спорта. 
                    В 2010 и 2013 годах в «Аэрограде Коломна» были проведены международные соревнования первого уровня 
                    по самому зрелищному виду парашютного спорта - скоростному пилотированию куполов («swoop») - 
                    Чемпионат мира и Кубок мира соответственно. Наш аэроклуб является основной базой для проведения 
                    спортивных сборов ведущих парашютных команд, в том числе и сборных страны. Также регулярно в течении 
                    сезона проходят сборы по построению больших формаций с перестроениями и без - от 100 до 200+ человек.
                    <h2>БУДЬ ВМЕСТЕ С НАМИ!</h2>
                </article>
            </div>
            
        </div>
    </main>

    <aside class='tab'>
        <h1>НАША СТАТИСТИКА</h1>
        <table>

		<?php
			echo '<tr>
				<td>Количество полетов</td>
				<td>Количество удовлетворенных клиентов</td>
				<td>Количество падений</td>
			</tr>'
		?>
            <tr>
                <td><?php echo '2190' ?></td>
                <td><?php echo '2180' ?></td>
                <td><?php echo '0!' ?></td>
            </tr>
        </table>
    </aside>s

    <footer>
			<div>
				<p>2020, Let's fly!</p>
				<p>Copyright © 2019 All Rights Reserved.</p>
			</div>
			<div> 
				<?php 
					echo 'Сформировано '.(date("d.m.Y")).' в '.(date("H-i:s")) 
				?>
			</div>
    </footer>
</body>
</html>