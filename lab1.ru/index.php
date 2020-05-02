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
              $current_page=true; 
              echo $link
              ?>" class="<?php 
              if ($current_page) 
                echo 'active'; 
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

    <aside role="complementary" class="first">
        <div class="container-preview" tabindex="4">
            <div class="sport">
                <h1>LET'S FLY! <br> к Вашим услугам</h1>
                <p>Спорт - наше все!</p>
            </div>
        </div>
    </aside>

    <main role="main" tabindex="5">
        <div class="container-about">
		<?php echo '<img src="img/'.(date('s') % 2 + 1).'.jpg" alt="Меняющаяся фотография">'; ?>
            <div class="block">
                <article>В свое время в г. Москва не так легко было найти спорткомплекс, 
                    где можно прыгнуть с парашютом, а перед этим позаниматься, поплавать, сходить на 
                    групповые занятия. Наш собственный центр возник благодаря совместным усилиям и общей мечте. 
                    Мы стремимся сделать комплекс «Let's fly!» любимым объектом спортсменов и поклонников 
                    здорового образа жизни.</article>
            </div>
        </div>
    </main>

    <main role="main"  tabindex="6">
        <div class="container-three">
            <h1>СПОРТИВНЫЕ ОБЪЕКТЫ</h1>
            <p>Подготовься к прыжку в наших спортиных объектах!</p>
            <div class="cards">
                <div class="card one" tabindex="7">
				<img src="img/yoga.jpg" alt="yoga">
                    <div class="text">
                        <h2>СТУДИЯ ЙОГИ</h2>
                        <h2>ПН-ПТ: 9:00 - 20:00</h2>
                        <article>
                            Студия йоги — отличное место, чтобы размяться и восстановить свои силы после напряженного 
                            рабочего дня. Студия йоги подарит гостям спорткомплекса заряд бодрости и поможет отвлечься 
                            от всех забот. Кроме того, Студия йоги в центре «Let's fly!» может дополнить целый ряд других 
                            тренировок. Хотите узнать, как сохранить бодрость и поддерживать себя в отличной форме? 
                            Свяжитесь с нами. При первой же возможности мы обязательно Вам ответим!
                        </article>
                        <button type="button" class="one">Узнать подробнее</button>
                    </div>
                </div>

                <div class="card two" tabindex="8">
				<img src="img/fitness.jpg" alt="fitnes">
                    <div class="text">
                        <h2>СПОРТИВНЫЙ ЗАЛ</h2>
                        <h2>ПН-ПТ: 9:00 - 20:00</h2>
                        <article>
                            Зона свободных весов — отличное место, чтобы размять мышцы и получить заряд бодрости. 
                            Помещение только что отремонтировано и оснащено самым современным оборудованием и аксессуарами. 
                            Спорткомплекс «Let's fly!» может похвастаться общей площадью более 700 000 кв. м. Нам есть что 
                            предложить. Но Зона свободных весов — предмет нашей особой гордости. Посетите наш центр и узнайте, 
                            чем еще мы можем вас заинтересовать.
                        </article>
                        <button type="button" class="two">Узнать подробнее</button>
                    </div>
                </div>

                <div class="card three" tabindex="9"> 
				<img src="img/swimming.jpg" alt="swimming">
                    <div class="text">
                        <h2>БАССЕЙН</h2>
                        <h2>ПН-ПТ: 9:00 - 20:00</h2>
                        <article>
                            Бассейн олимпийского размера — это место, где вы можете дать своему телу умеренную или более 
                            интенсивную физическую нагрузку. Приходите к нам, и мы гарантируем, что вы будете чувствовать себя 
                            просто замечательно. В этом вам поможет Бассейн олимпийского размера, но главный ингредиент успеха — 
                            ваше участие. Мы всего лишь создали комфортные условия. Приходите к нам и откройте для себя радость движения.
                        </article>
                        <button type="button" class="three">Узнать подробнее</button>
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

    <aside tabindex="10" >
        <div class="contacts">
            <h1>СВЯЖИТЕСЬ С НАМИ</h1>
            <div class="form">
                <p>Имя</p>
                <input type="text" class="small" placeholder="Имя" tabindex="11">
                <p>Почта</p>
                <input type="email" class="small" placeholder="Почта" tabindex="12">
                <p>Тема вопроса</p>
                <input type="text" class="big" placeholder="Тема" tabindex="13"> <br>
                <input type="text" class="large" placeholder="Добавьте сообщение..."> <br>
                <input type="submit" value="Отправить" class="btn">
            </div>
        </div>
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