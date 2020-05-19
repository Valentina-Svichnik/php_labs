<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>
        Свичник Валентина Алексеевна, 191-321. Лабораторная работа №А-7. 
        Основы использования массивов в программировании. Ввод данных и сортировка массивов.  
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
       <p>Свичник Валентина Алексеевна, 191-321. <br> Лабораторная работа №А-7. </p>
      </div>
    </div>
	</header>

<main>
  <div class="container">
    <p>Введите элементы массива: </p>
  <script>
    function addElement(table_name) {                               // функция добавляет еще один элемент
      var t = document.getElementById(table_name);                          // объект таблицы
      for(var i=0; i<1; i++)
    {
      var index=t.rows.length;                                              // индекс новой строки
      var row=t.insertRow(index);                                           // добавляем новую строку
      var num = row.insertCell(0);
      var cel = row.insertCell(1);                                          // добавляем в строку ячейку
      cel.className='element_row';                                          // определяем css-класс ячейки
      var celcontent = '<input type="text" name="element'+index+'">'        // определяем контент ячейки
      var number = index + 1;
      var numcontent = '#'+ number;
      setHTML(cel, celcontent);                                             // добавляем контент в ячеку таблицы
      setHTML(num, numcontent);

    function setHTML(element, txt)
      {
      if(element.innerHTML)
      element.innerHTML = txt;
      else
      {
      var range = document.createRange();
      range.selectNodeContents(element);
      range.deleteContents();
      var fragment = range.createContextualFragment(txt);
      element.appendChild(fragment);
      }
      } 
    }
    // в скрытом поле записываем количество полей (строк таблицы)
    document.getElementById('arrLength').value=t.rows.length;
    }
    </script>
    
<form action="check.php" method="POST">
  <table id="elements">
    <tr><td>#1</td><td class="element_row"><input type="text" name="element0"></td></tr>
    </table>
    <br>
    <input type="hidden" id="arrLength" name="arrLength" value="1">
    <input type="button" value="Добавить еще один элемент"
    onClick="addElement('elements');" style="width: 200px;"> 
    <br>
    <div class="box">
    <p>Выберете способ сортировки:  </p>
    <select name="algoritm" id="sort" style="width: 200px; height: 20px; margin-left: 5px;">
      <option value="0">сортировка выбором</option>
      <option value="1">пузырьковый алгоритм</option>
      <option value="2">алгоритм Шелла</option>
      <option value="3">алгоритм садового гнома</option>
      <option value="4">быстрая сортировка</option>
      <option value="5">встроенная функция РНР для сортировки списков по значению</option>
    </select>
    </div>
    <br>
    <input type="submit" value="Сортировать" style="width: 200px;">
  </div>
</form>
</main>


<footer>
<p> Лабораторная работа №А-7. </p>
</footer>

</body>
</html>