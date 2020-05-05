<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>
        Свичник Валентина Алексеевна, 191-321. Лабораторная работа № А-4. 
        Пользовательские функции. Вывод таблиц.  
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
			<p>Свичник Валентина Алексеевна, 191-321 <br> Лабораторная работа № А-4</p>
		</div>
	</header>

	<main>
		<div class="container">
			<p>Данная лабораторная работа выполнена ученицей 1 курса Московского Политехнического университета в 2020 году, 
					обучающейся по программе факультета информационных технологий на направлении "Веб-технологии"
					в группе 191-321, Свичник Валентиной Алексеевной</p>
			<?php
				$structure = array(' ', 'Столбец1*Столбец2*Столбец3#100*200*300', 'Столбец1*Столбец2*Столбец3#100*200#1000*2000*3000', 
				'***#**', 'Столбец1*Столбец2#100*200#100');  //ввод данных
				
				// если нет пустых ячеек, то таблица существует
				function Ocell($trs){
					$k = 0;
					for ($i = 0; $i < count(explode( '*' , $trs[1] )); $i++){
						if (explode( '*' , $trs[1] )[$i] == '')
							$k++ ;
					}
					if ($k == count(explode( '*' , $trs[1] )))
					return false;          //строка с пустыми ячейками
				    else return true;		 
				}
				
				function OorEmpty($str)   
				{ return (!isset($str) || trim($str) === ''); }

				
				function Tr($str, $maxRowLength)           //заполнение строки
				{
					$tds = explode('*', $str);

					$outStr = "<tr>";
						for ($i = 0; $i < count($tds); $i++)        //оборачиваем каждую ячейку в тег td
						{
							$outStr .= '<td>'.$tds[$i].'</td>';
						}

						if (count(explode('*', $str)) < $maxRowLength)  //если сумма ячеек в строке меньше максимальной длины строки
						{
							$diff = $maxRowLength - count(explode('*', $str));  

							for ($i = 0; $i < $diff; $i++)
							{
								$outStr .= '<td></td>';     // создаем пустые ячейке, если в строке введены не все ячейки
							}
						}

					$outStr .= "</tr>";

					return $outStr;
				}

				function outTable($str)
				{
					$trs = explode('#', $str);  //разбиваем на строки

					$maxLength = 0;

					//изначально таблица считается пустой, но если в ней обнаруживается существующая строка и её длина не равна 0, то значит таблица есть
					if (!Ocell($trs))
					{
						$outStr = 'В таблице нет строк<br>';
					}
					else
					{
						//если строк больше 0 и первая не пуста значит можно взять её длину за мaксимум
						if (count($trs) > 0 && !OorEmpty($trs[0]))
						{
							$maxLength = count(explode('*', $trs[0]));
						}

						//поиск длины самой длинной строки
						for ($i = 0; $i < count($trs); $i++)
						{
							if (!OorEmpty($trs[$i]) && count(explode('*', $trs[$i])) > $maxLength)
							{
								$maxLength = count(explode('*', $trs[$i]));
							}
						}

						//если длина так и осталась 0 значит в таблице нет ячеек
						if ($maxLength == 0)
						{
							$outStr = 'В таблице нет строк с ячейками<br>';
						}
						//проверка на наличие пустых ячеек (ячеек без содержимого интрепретированных как ячейки)
						else if ($trs==0)
						{
							$outStr = 'В таблице нет строк с ячейками<br>';
						}
						else
						{
							$outStr = '<table>';

								for ($i = 0; $i < count($trs); $i++)
								{
									//если длина строки 0 или строка пустая значит не выводим её так как как в ней нет ячеек
									if (strlen($trs[$i]) == 0 || OorEmpty($trs[$i]))
									{ continue; }

									$outStr .= Tr($trs[$i], $maxLength);
								}

							$outStr .= '</table>';
						}
					}
					return $outStr;
				}


				for ($i = 0; $i < count($structure); $i++)
				{
					echo '<h2>Таблица №'.($i + 1).'</h2><br>';
					echo outTable($structure[$i]).'<br>';
				}
			?>
						
</main>


<footer>
    <p>2020, Svichnik Valentina</p>		
</footer>

</body>
</html>