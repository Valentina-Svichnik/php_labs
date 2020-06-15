<div id="menu">
<?php
// если нет параметра меню – добавляем его
echo '<div class="main_menu">';
if( !isset($_GET['p']) ) $_GET['p']='viewer';
echo '<a href="/?p=viewer"'; // первый пункт меню
if( $_GET['p'] == 'viewer' ) // если он выбран
echo ' class="selected"'; // выделяем его
echo ' >Просмотр</a>';

echo '<a href="/?p=add"'; // второй пункт меню
if( $_GET['p'] == 'add' ) echo ' class="selected"';
echo '>Добавление записи</a>';

echo '<a href="/?p=edit"'; // второй пункт меню
if( $_GET['p'] == 'edit' ) echo ' class="selected"';
echo '>Редактирование записи</a>';

echo '<a href="/?p=delete"'; // второй пункт меню
if( $_GET['p'] == 'delete' ) echo ' class="selected"';
echo '>Удаление записи</a>';
echo '</div>';

if( $_GET['p'] == 'viewer' ) //если был выбран первый пунт меню
{
    if( !isset($_GET['sort'])){
        $_GET['sort'] = 'byid';
        echo '<a href="/?p=viewer&sort= byid class="selected"">По-умолчанию</a>';
    }
    if (isset($_GET['sort'])){
        echo '<div id="submenu">'; // выводим подменю
        echo '<a href="/?p=viewer&sort= byid "'; // первый пункт подменю
        if( $_GET['sort'] == 'byid' )
        echo ' class="selected"';
        echo '>По-умолчанию</a>';

        echo '<a href="/?p=viewer&sort=fam"'; // второй пункт подменю
        if( isset($_GET['sort']) && $_GET['sort'] == 'fam' )
        echo ' class="selected"';
        echo '>По фамилии</a>';
        echo '</div>'; // конец подменю
    }
    
    
}



?>
</div> 