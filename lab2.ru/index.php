<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>
        Свичник Валентина Алексеевна, 191-321. Лабораторная работа № А-2. 
        Циклические алгоритмы. Условия в алгоритмах. Табулирование функций. Вариант №7.
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
			<p>Свичник Валентина Алексеевна, 191-321 <br> Лабораторная работа № А-2, Вариант №7</p>
		</div>
	</header>

	<main>
		<div class="container">
        <p>Данная лабораторная работа выполнена ученицей 1 курса Московского Политехнического университета в 2020 году, 
                обучающейся по программе факультета информационных технологий на направлении "Веб-технологии"
                в группе 191-321, Свичник Валентиной Алексеевной</p>
		<?php
		$x = 1;							//нач значение аргумента
		$encounting = 10;					//кол-во вычисляемых значений
		$step = 2;							//шаг изменения аргумента
		$type = 'A';						//тип верстки
		$min_value = -20000;				//мин знач при котором алгоритм завершает работу
		$max_value = 50000;				//макс знас при котором алг завершает работу
		$min_f= 'error';
		$max_f= 'error';
		$sum = 0;							//сумма значений функции
		$j = 0;
		if((is_int($x) || is_float($x)) && (is_int($step) || is_float($step)) && is_int($encounting) && is_string($type)){  //проверяем является ли х числом, иначе выводит ошибку    

		switch ($type) {
				case 'B':
					echo '<ul>';			//открываем маркированный список
					break;

				case 'C':
					echo '<ol>';			//открываем нумерованный список
					break;

				case 'D':
					echo '<table>';			//открываем таблицу
                    break;
                    
                case 'E':
                    echo '<div class="box">';			//открываем главный контейнер
                    break;
				
				default:
					break;
			}	

		
		for ($i=1; $i <= ($encounting); $i++, $x+=$step) { 
			if ($x <= 10) {
				if ($x == 5) {
					$f = 'Error';
					$j = $j-1;
				}
				else
					$f = (6 / ($x - 5)) * $x - 5;
			}
			else{
				if ($x < 20) 
					$f = ($x*$x - 1)* $x + 7;
		    	else
		    		$f = 4* $x + 5;
			}
			$j++;
		
		switch ($type) {
			case 'A':
				echo 'f('.$x.')= ';
				if (is_string($f))
					echo $f; 
				else echo round($f,3);
				if ($i < ($encounting))
					echo '<br>';

				break;
			case 'B':
			case 'C':
				echo '<li>f('.$x.')= ';
				if (is_string($f))
					echo $f;
				else echo round ($f, 3);
				echo '</li>';
				break;

			case 'D':
				echo '<tr>
                        <td>'.$i.'</td>
                        <td>'.$x.'</td>
						<td>';
							if (is_string($f))
								echo $f;
							else 
								echo round($f, 3);
								echo '</td>
									</tr>';
				break;

            case 'E':
                if ($i==1)
                 echo '<div class="first">f('.$x.') = ';
                else if ($i==$encounting)
                 echo '<div class="last">f('.$x.') = ';
                else  echo '<div class="middle">f('.$x.') = ';
				    if (is_string($f))
				     	echo $f;
                    else
                        echo round($f, 3);
                    echo '</div>';

		}



		if ($j ==1 && !is_string($f)){
			$min_f = $f;
			$max_f = $f;
		}
		if ($min_f > $f && !is_string($f) && $j!= 1){
			$min_f = $f;
		}
		if ($max_f < $f && !is_string($f) && $j!= 1)
			$max_f = $f;
		if (!is_string($f))
			$sum+=$f;
		if ($f >= $max_value || $f < $min_value)
			break;
	}

		switch ($type){
			case 'B':
				echo '</ul>';
				break;
			case 'C':
				echo '</ol>';
				break;
			case 'D':
				echo '</table>';
                break;
            case 'E':
                echo '</div>';
                break;

			default:
				break;
		}
		if ($j == 0){
			$j = 'error';
			echo '<p>Максимальное значение = '.$j.'<br>Минимальное значение = '.$j.'<br>Среднее значение = '.$j.'<br>Сумма = '.$j.'</p>';
		}
		else{
			$j = $sum / $j;
			echo '<p>Максимальное значение = '.round($max_f, 3).'<br>Минимальное значение = '.round($min_f, 3).'<br>Среднее значение = '.round($j, 3).'<br>Сумма = '.round($sum, 3).'</p>';
		}


		}
	else
		echo 'error';
	?>
	
</div>
</main>


<footer>
    <p>2020, Svichnik Valentina<?php echo ", тип верстки: $type" ?></p>		
</footer>

</body>
</html>