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
              ?>" 
              class="<?php 
              if ($current_page) 
                echo ' active'; 
              ?>">
              <?php
              echo $name; 
				?></a>

				<a href="<?php 
					$name='О НАС'; 
					$link='index1.php'; 
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
					$name='ТАРИФЫ'; 
					$link='index2.php'; 
					$current_page=true; 
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
        <div class="tarif">
                <h1>НАШИ ТАРИФЫ</h1>
                <article>
                    В нашем комплексе вы можете прыгнуть с парашютом при любом уровне подготовки. 
                    Ознакомьтесь с доступными вариантами ниже и свяжитесь с нами, чтобы задать вопрос.
                </article>
                <div class="box">
                    <div class="tar">
                        <img src="img/group.jpg" alt="group jumping" width="100%">
                        <div class="block">
                            <h2>Групповой прыжок</h2>
                            <p>Позови всех своих друзей и получи скидку!</p>
                            <br>
                            <p>14.000 рублей</p>
                            <input type="button" value="Узнать больше">
                        </div>
                    </div>
                
                    <div class="tar">
                        <img src="img/foto1.jpg" alt="alone jumping" width="100%">
                        <div class="block">
                            <h2>Одиночный прыжок</h2>
                            <p>Ответственность только на Вас! Максимальный экстрим для продвинутых и профи</p>
                            <br>
                            <p>11.000 рублей</p>
                            <input type="button" value="Узнать больше">
                        </div>
                    </div>
               
                    <div class="tar">
                        <img src="img/foto2.jpg" alt="jumping with an instructor" width="100%">
                        <div class="block">
                            <h2>Прыжок в тандеме с инструктором</h2>
                            <p>Выбери наиболее подходящий вариант для новичков</p>
                            <br>
                            <p>18.000 рублей</p>
                            <input type="button" value="Узнать больше">
                        </div>
                    </div>
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
    </aside>

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