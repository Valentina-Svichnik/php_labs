<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
        Свичник Валентина Алексеевна, 191-321. Лабораторная работа №А-6. 
        Использование форм для передачи данных в программу РНР.  Тест математических знаний.  
    </title>
  <link rel="stylesheet" href="style.css">
  <script>
    var inp = document.getElementById('inp');
    var object=document.getElementById('object');
    inp.addEventListener("check", function() {
      object.style.display="block";
    })
    
  </script>
</head>
<body>
<header>
		<div class="header-wrapper" id="head">
			<div class="logo">
        		<img src="img/logo.png" alt="logo" width="100" height="100">
       			<p>МОСКОВСКИЙ ПОЛИТЕХ</p>
     		</div>
     	<div class="main-menu">
			<p>Свичник Валентина Алексеевна, 191-321 <br> Лабораторная работа № А-6</p>
     	</div>
    	</div>
	</header>
<main id="base">
    <div class="container">
      <!-- выводим форму -->
          <?php
          $val_A = mt_rand(5,100); 
          $val_B = mt_rand(5,100); 
          $val_C = mt_rand(5,100); 
          echo '
            <form class="hidden" name="form" method="POST" id="form">
			  <label for="name">ФИО: </label>
			  <input style="margin: 5px 0 5px 137px;" name="name" method="post" action="/" placeholder="Иванов Иван Иванович" value="'.$_GET['name'].'"><br>
			  <label for="group">Номер группы: </label>
			  <input style="margin: 5px 0 5px 68px;" type="text" name="group" placeholder="111-111" value="'.$_GET['group'].'"><br>
			  <label for="A">Значение А: </label>
			  <input style="margin: 5px 0 5px 87px;" type="text" name="A" placeholder="11" value="'.$val_A.'"><br>
			  <label for="B">Значение B: </label>
			  <input style="margin: 5px 0 5px 87px;" type="text" name="B" placeholder="11" value="'.$val_B.'"><br>
			  <label for="C">Значение C: </label>
			  <input style="margin: 5px 0 5px 87px;" type="text" name="C" placeholder="11" value="'.$val_C.'"><br>
			  <label for="about">Расскажите о себе: </label> 
			  <textarea style="margin: 5px 35px" name="about" cols="20" rows="2"></textarea><br>
                Выберите тип задания:<select style="margin-left: 10px;" name="TASK">
                    <option selected value="mean">Среднее арифметическое</option>
                    <option value="perimetr">Периметр треугольника</option>
                    <option value="square">Площадь треугольника</option>
                    <option value="volume">Обьём параллелипипеда</option>
                    <option value="max">Наибольшее значение</option>
                    <option value="min">Наименьшее значение</option><br>
                </select><br>
				<label for="result">Ваш ответ: </label>
				<input style="margin:10px 0 5px 97px;" name="result" id="result"><br>
        <input type="checkbox" name="send_mail" id="inp" onClick="check">
        <span> Отправить результат по e-mail </span> <br>
              <div id="object" class="mail_hidden">Введите Ваш e-mail:<input style="margin:5px 0 10px 30px;" type="email" name="MAIL"></div> <br>
                Выберите тип страницы:<select name="view" method="post">
                    <option selected value="brause">Для просмотра в браузере</option>
                    <option value="print">Для печати</option>
                </select><br>
                <input class="button" style="margin-top:10px" type="submit" name="button" placeholder="Отправить результаты"><br>
			</form> ';
			// вычисляем результат согласно выбранной формуле
            if (isset($_POST['A']) ) {
              if ( $_POST['TASK'] == 'mean')                                              // если вычисляется среднее арифметическое
              {
                $result = round( ($_POST['A']+$_POST['B']+$_POST['C'])/3, 2 );
              }
              else
              if ( $_POST['TASK'] == 'perimetr')                                          // если вычисляется периметр треугольника
              {
                $result = $_POST['A']+$_POST['B']+$_POST['C'];
              }
              else
              if ( $_POST['TASK'] == 'square')                                            // если вычисляется площадь треугольника
              {
                $p = ($_POST['A']+$_POST['B']+$_POST['C'])/2;
                $result = sqrt($p*($p-$_POST['A'])*($p-$_POST['B'])*($p-$_POST['C']));
              }
              else
              if ( $_POST['TASK'] == 'volume')                                            // если вычисляется объем параллелипипеда
              {
                $result = $_POST['A']*$_POST['B']*$_POST['C'];
              }
              else 
              if ( $_POST['TASK'] == 'max')                                               // если вычисляется максимальное значение
              {
                if(($_POST['A'] > $_POST['B']) && ($_POST['A'] > $_POST['C']))
                            $result = $_POST['A']; 
                        else
                        if($_POST['B'] > $_POST['C'])
                            $result = $_POST['B'];
                        else $result = $_POST['C'];
              }
              else 
              if ($_POST['TASK'] == 'min')                                                // если вычисляется минимальное значение
              {
                if(($_POST['A'] < $_POST['B']) && ($_POST['A'] < $_POST['C']))
                        $result = $_POST['A']; 
                        else
                        if($_POST['B'] < $_POST['C'])
                        $result = $_POST['B'];
                        else $result = $_POST['C'];	
              }
            }
            
            
            if( isset( $_POST['button'] ) ) {                              // ЕСЛИ НАЖАТА КНОПКА ПРОВЕРИТЬ
              if(  $_POST['result'] !='')                                   // Если пользователь ввел результат
              { echo '<script>main=document.getElementById(\'base\');form=document.getElementById(\'form\');main.classList.add("'.$_POST['view'].'"); 
                form.style.display=\'none\'</script>';                      
                $out_text = '<div class="box">';
                if (preg_match("/,/", $_POST['result']))
                $_POST['result'] = str_replace(',', ".", $_POST['result']);
                $out_text.='ФИО: '.$_POST['name']; 
                $out_text.='<br>Группа: '.$_POST['group'];
                if($_POST['about']) $out_text.='<br>О себе: '.$_POST['about'].'<br>';
                $out_text.='<br>Решаемая задача: '; 
                if( $_POST['TASK'] == 'mean' ) $out_text.='поиск среднего арифметического'; else
                if( $_POST['TASK'] == 'perimetr' ) $out_text.='поиск периметра треугольника'; else
                if( $_POST['TASK'] == 'square' ) $out_text.='поиск площади треугольника'; else
                if( $_POST['TASK'] == 'volume' ) $out_text.='поиск объема параллелипипеда'; else
                if( $_POST['TASK'] == 'max' ) $out_text.='поиск наибольшего значения'; else
                if( $_POST['TASK'] == 'min' ) $out_text.='поиск наименьшего значения';
                if($result == $_POST['result']) $out_text.='<br><b>ТЕСТ ПРОЙДЕН</b><br>'; else
                $out_text.='<br><b>ОШИБКА: ТЕСТ НЕ ПРОЙДЕН!</b><br>Ваш ответ: '.$_POST['result'].'<br> Правильный ответ:'.$result.'<br>';
                $out_text .= '<br><a href="?F='.$_POST['group'].'&G='.$_POST['group'].'" id="back_button">Повторить тест</a>'; 
                $out_text.='</div>';
                echo $out_text;
                

                if( array_key_exists('send_mail', $_POST) and $_POST['MAIL']!='')
                {
                   mail( $_POST['MAIL'], 'Результат тестирования', 
                   str_replace('<br>', "\r\n", $out_text), 
                   "From: svichinkvalentina@gmail.com\n"."Content-Type: text/plain; charset=utf-8\n" ); 
                   echo '<br>Результаты теста были автоматически отправлены на e-mail '.$_POST['MAIL'];
                }
              } else echo '<div class="box">Задача самостоятельно решена не была.
              <a href="?F='.$_POST['group'].'&G='.$_POST['group'].'" id="back_button">Повторить тест</a></div>';
               
              
                echo '<script>
                main=document.getElementById(\'base\');
                form=document.getElementById(\'form\');
                head=document.getElementById(\'head\');
                main.classList.add("'.$_POST['view'].'"); 
                form.style.display=\'none\';
                head.classList.add("'.$_POST['view'].'")
                 </script>';
                
              
            }
          ?>
    </div>
</main>
<footer>
<div class="foot">
			<p> Лабораторная работа № А-6</p>
    	</div>
</footer>
	
<script>
        var e =document.getElementById('inp');
        var p =document.getElementById('object');

            e.addEventListener("click", function() {
                p.style.display = (p.style.display == "block") ? 'none' : 'block'
            });
</script>

</body>
</html>