<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="img/favicon.png" sizes="80x80">
    

    <title>savlas</title>
  </head>
  <body>
  <header>
  <nav class="navbar navbar-expand-lg navbar-light bg-dark ">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <img src="img/savlas_logo.png" alt="logo_savlas" id="logo">

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-md-0">
      <li class="nav-item d-flex flex-column flex-lg-row flex-xl-row">
        <a class="nav-link text-light" href="http://php.std-938.ist.mospolytech.ru/php_labs/savlas.ru/">Главная</a>
        <a class="nav-link text-light" href="http://php.std-938.ist.mospolytech.ru/php_labs/savlas.ru/index2.php">Наша продукция</a>
        <a class="nav-link text-light" href="http://php.std-938.ist.mospolytech.ru/php_labs/savlas.ru/index3.php">Продукция других брендов</a>
        <a class="nav-link text-light" href="http://php.std-938.ist.mospolytech.ru/php_labs/savlas.ru/index4.php">Личный кабинет</a>
      </li>
    </ul>
  </div>
</nav>

</header>

<main>
<div class="main_cont">
    <div class="container-fluid">
        <div class="row mt-3 print-none">
            <div class="col-0 col-md-3 col-lg-3 col-xl-3"></div>
            <div class="col-12 col-md-9 col-lg-9 col-xl-9">
            <nav class="card card-body d-flex flex-row">
                <a href="http://php.std-938.ist.mospolytech.ru/php_labs/savlas.ru/" class="text-muted mr-1">Главная</a></li>/
                <a href="#" class="text-dark ml-2">Продукция от других производителей</a>
            </nav>
            </div>
        </div>

        <div class="row mt-3">
        <div class="col-12 col-sm-3 print-none">

        <table class="table table-hover">
        <tbody>
            <tr><td>
                <a class="text-dark"  href="#letique">LETIQUE</a>
            </td></tr>

            <tr><td>
                <a class="text-dark"href="#leosilver">LEOSILVER</a>
            </td></tr>

            <tr><td>
                <a class="text-dark" href="#bb">BUBBLE BAR</a>
            </td></tr>

            <tr><td>
                <a class="text-dark" href="#freshbar">FRESHBAR</a>
            </td></tr>

            <tr><td>
                <a class="text-dark"href="#ok">ORGANIC KITCHEN</a>
            </td></tr>
        </tbody>
        </table>

        </div>

        <div class="col-12 col-sm-9">
            <h2 class="mb-5">Каталог товаров</h2>
            <form action="index3.php" method="post">
            <div class="form-group row">
              <label for="search" class="col-12"><strong>Поиск по каталогу</strong></label>
              <div class="row d-flex flex-wrap col-12">
                <input type="text" class="form-control col-12 col-sm-8" id="search" placeholder="Введите название товара" name="search">
                <input type="submit" type="Начать поиск" class="btn btn-outline-secondary col-12 col-sm-1" value="Найти" name="srcBtn">
              </div>
            </div>
            </form>

            <?php
              function printResult($result_set) {
                while (($row  =  $result_set->fetch_assoc()) !=false) {
      
                    echo("<div class='w-25 mx-1 mx-sm-2 mx-md-3 mb-3 border-dark p-1 p-md-3 rounded shadow d-flex align-items-normal justify-content-between flex-column bg-white card-small'>
                    <img class='img-fluid card-img' src='img/".$row['img']."'>
                    <h6 class='mt-2'>".$row['name_product']."</h6>
                    <p class='text-muted'>".$row['name_brand']."</p>
                    <a tabindex='0' class='btn btn-dark text-white' role='button'
                      data-toggle='popover' data-trigger='focus' title='".$row['name_product']."'
                      data-content='".$row['description']."'>
                      Подробнее
                    </a>
                    </div>"); 
                    
                }
              }

              $mysqli = mysqli_connect('std-mysql', 'std_938', 'qazwsxedc', 'std_938');
              if( mysqli_connect_errno() ) // проверяем корректность подключения
              return 'Ошибка подключения к БД: '.mysqli_connect_error();

              $mysqli->query ("SET NAMES 'utf8'");


              // поиск
              if( isset($_POST['srcBtn']) && $_POST['srcBtn']== 'Найти')
              {
                echo("<div class='d-flex flex-wrap'>");
                $result_set = $mysqli->query("SELECT * FROM `product` WHERE `name_product` LIKE '%".$_POST['search']."%'");
                printResult($result_set);
                echo("</div>");
      
                  if( mysqli_errno($mysqli) )
                  echo '<div class="alert alert-danger mt-5">Произошла ошибка</div>';
              }



              echo("<h5 id='letique' class='mt-5'>LETIQUE</h5>");
              echo("<div class='d-flex flex-wrap'>");
              $result_set = $mysqli->query("SELECT `product`.`name_product`, `brand`.`name_brand`, `model`.`id_model`, `product`.`img`, `product`.`description` FROM `product` JOIN `brand` ON (`product`.`id_brand` = `brand`.`id_brand`) JOIN `model` ON (`product`.`id_model` = `model`.`id_model`) WHERE `product`.`id_brand` = 2");
              printResult($result_set);
              echo("</div>");

              echo("<h5 id='leosilver' class='mt-5'>LEOSILVER</h5>");
              echo("<div class='d-flex flex-wrap'>");
              $result_set = $mysqli->query("SELECT `product`.`name_product`, `brand`.`name_brand`, `model`.`id_model`, `product`.`img`, `product`.`description` FROM `product` JOIN `brand` ON (`product`.`id_brand` = `brand`.`id_brand`) JOIN `model` ON (`product`.`id_model` = `model`.`id_model`) WHERE `product`.`id_brand` = 3");
              printResult($result_set);
              echo("</div>");

              echo("<h5 id='bb' class='mt-5'>BUBBLE BAR</h5>");
              echo("<div class='d-flex flex-wrap'>");
              $result_set = $mysqli->query("SELECT `product`.`name_product`, `brand`.`name_brand`, `model`.`id_model`, `product`.`img`, `product`.`description` FROM `product` JOIN `brand` ON (`product`.`id_brand` = `brand`.`id_brand`) JOIN `model` ON (`product`.`id_model` = `model`.`id_model`) WHERE `product`.`id_brand` = 4");
              printResult($result_set);
              echo("</div>");

              echo("<h5 id='freshbar' class='mt-5'>FRESHBAR</h5>");
              echo("<div class='d-flex flex-wrap'>");
              $result_set = $mysqli->query("SELECT `product`.`name_product`, `brand`.`name_brand`, `model`.`id_model`, `product`.`img`, `product`.`description` FROM `product` JOIN `brand` ON (`product`.`id_brand` = `brand`.`id_brand`) JOIN `model` ON (`product`.`id_model` = `model`.`id_model`) WHERE `product`.`id_brand` = 5");
              printResult($result_set);
              echo("</div>");

              echo("<h5 id='ok' class='mt-5'>ORGANIC KITCHEN</h5>");
              echo("<div class='d-flex flex-wrap'>");
              $result_set = $mysqli->query("SELECT `product`.`name_product`, `brand`.`name_brand`, `model`.`id_model`, `product`.`img`, `product`.`description` FROM `product` JOIN `brand` ON (`product`.`id_brand` = `brand`.`id_brand`) JOIN `model` ON (`product`.`id_model` = `model`.`id_model`) WHERE `product`.`id_brand` = 6");
              printResult($result_set);
              echo("</div>");



              $mysqli->close ();
            ?>

        </div> 

        </div>

    </div>


</div>

</div>
</main>


<footer>
    <div class="container-fluid">
        <div class="row bg-dark d-flex flex-column">
        <div class="d-flex  my-2">
            <img src="img/inst.svg" alt="icon instagram">
            <a href="https://www.instagram.com/savlas_24/" class="text-light ml-1">Instagram</a>
        </div>
        <div class="d-flex">
          <img src="img/facebook.svg" alt="icon facebook">
          <a href="#" class="text-light align-self-center ml-1">Facebook</a>
        </div>
        <div class="align-self-end d-flex">
          <img src="img/copyright.svg" alt="icon copyright">
          <a href="#" class="text-light ml-1">2020 savlas</a>
        </div>
        </div>
    </div>
</footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src = 'main.js'></script>
  </body>
</html>