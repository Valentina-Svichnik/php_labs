<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>
        Свичник Валентина Алексеевна, 191-321. Лабораторная работа №А-5. 
        Динамическое формирование контента и меню. Таблица умножения.  
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
      <div class="main-menu">
        <?php
            	echo '<a href="?html_type=TABLE';
            	if (isset($_GET['content']))
             		echo '&content='.$_GET['content'];
            	echo '"';
            	if (array_key_exists('html_type', $_GET) && $_GET['html_type'] == 'TABLE')
              		echo ' class="selected"';
            	echo '>Табличная вёрстка</a>';

            	echo '<a href="?html_type=DIV';
            	if (isset($_GET['content']))
              		echo '&content='.$_GET['content'];
            	echo '"';
            	if (array_key_exists('html_type', $_GET) && $_GET['html_type'] == 'DIV')
              		echo ' class="selected"';
            	echo '>Блочная вёрстка</a>';
        ?>
      </div>
    </div>
	</header>

  <main>
    <div class="container">
      <div class="box1">
        <?php
          echo '<a href="';
          if (isset($_GET['html_type']))
            echo '?html_type='.$_GET['html_type'];
          else echo '?html_type=TABLE';
          echo '"';
          if (!isset($_GET['content'])) echo ' class="selected"';
           echo '>Вся таблица умножения</a>';

          for ($i = 2; $i < 10; $i++) {
            echo '<a href="?';
            if (isset($_GET['html_type']))
              echo 'html_type='.$_GET['html_type'].'&';
            else echo 'html_type=TABLE&';
            echo 'content='.$i.'"';
            if (isset($_GET['content']) && $_GET['content'] == $i)
              echo ' class="selected"';
            echo '>Таблица умножения на '.$i.'</a>';
          }
         ?>
      </div>

      <div class="box2">
          <?php
            function outNum($p) {				//ввывод числа
              if ($p < 10)
                if (array_key_exists('html_type', $_GET))
                  return '<a href="?html_type='.$_GET['html_type'].'&content='.$p.'">'.$p.'</a>';
                else
                  return '<a href="?html_type=TABLE&content='.$p.'">'.$p.'</a>';
              else return $p;
            }

            function outData($n) {					//счет без типа верстки
              if (array_key_exists('html_type', $_GET) && $_GET['html_type'] == 'DIV')
                for ($i = 2; $i < 10; $i++)
                  echo outNum($n).'x'.outNum($i).'='.outNum($n*$i).'<br>';
              else
                for ($i = 2; $i < 10; $i++)
                  if ($i != 9) echo outNum($n).'x'.outNum($i).'='.outNum($n*$i).'<br>';
                  else echo outNum($n).'x'.outNum($i).'='.outNum($n*$i);
            }

            function outTable() {				//вывод в табличной верстке
              echo '<table>';
              if (!isset($_GET['content']))
                for ($i = 2; $i < 10; $i++) {
                  if (($i == 2) || ($i == 6)) 
                  	echo '<tr>';
                  echo '<td>';
                  outData($i);
                  echo '</td>';
                  if (($i == 5) || ($i == 9)) echo '</tr>';
                }
              else {
                echo '<tr class="outOneTd"><td>';
                outData($_GET['content']);
                echo '</td></tr>';
              }
              echo '</table>';
            }

            function outDiv() {					//вывод в блочной верстке
              if (!isset($_GET['content']))
                for ($i = 2; $i < 10; $i++) {
                  echo '<div class="divRow">';
                  outData($i);
                  echo '</div>';
                }
              else {
                echo '<div class="divOneRow">';
                outData($_GET['content']);
                echo '</div>';
              }
            }

            if (!array_key_exists('html_type', $_GET)) 
            	outTable();
            if (isset($_GET['html_type']) && $_GET['html_type'] == 'TABLE')
            	outTable();
            if (isset($_GET['html_type']) && $_GET['html_type'] == 'DIV')
            	outDiv();
          ?>
        </div>
      </div>
    </div>


</main>


<footer>
<p>Тип вёрстки: <?php
            if (!isset($_GET['html_type']) || $_GET['html_type'] == 'TABLE') echo 'табличная';
            else echo 'блочная';
          ?></p>
          <p>Таблица умножения <?php
            if (!isset($_GET['content'])) echo '(полная)';
            else echo 'на '.$_GET['content'];
          ?></p>
          <p>Дата и время: <?php echo date('d M Y h:i:s'); ?></p>
</footer>

</body>
</html>