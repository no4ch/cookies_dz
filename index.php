<?php
  require_once __DIR__ . "/vendor/autoload.php";

  use Academy\Cookies;

  $c = new Cookies();

  isset($_COOKIE['counter']) ? $c->editValue('counter', ++$_COOKIE['counter']) : $c->addValue('counter', 1);

  //$c->deleteValue('counter');
  if (!empty($_REQUEST['banner']) && empty($_COOKIE['second'])) {
    $c->addValue('second', "false", time() + 600 * 24 * 60);  //3600 * 24 *
    //второе задание
  }
  if (!empty($_COOKIE['time'])) {
    $day = time() - $_COOKIE['time'];
    $c->editValue('time', time());
    //третье задание
  }
  if (empty($_COOKIE['time'])) {
    $c->addValue('time', time());
  }
  if (!empty($_REQUEST['date'])) {
    $c->addValue('date', $_REQUEST['date']);
    //var_dump($_REQUEST);
  }
  if (empty($_COOKIE['color'])) {

    $c->addValue('color', "white");
    //var_dump($_COOKIE);
    //echo "<br>";
  }
  if (!empty($_REQUEST)) {
    $c->editValue('color', $_REQUEST['color']);
  }
  //  $c->deleteValue('counter');
  //  $c->deleteValue('second');
  //  $c->deleteValue('time');
  //  $c->deleteValue('date');
  //  $c->deleteValue('color');
?>
<!doctype html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    body {
      background-color: <?php echo empty($_COOKIE['color'])?"white":$_COOKIE['color']; ?>;
      /*color: #f5f5f5;*/
    }
  </style>
</head>
<body>
<?php
  $times = empty($_COOKIE['counter']) ? 1 : $_COOKIE['counter'];
  echo "1) Вы посетили наш сайт " . $times . " раз !";
  //if (!empty($_COOKIE['second'])) var_dump($_COOKIE);
  echo "<br>";
?>


<?php if (!isset($_COOKIE['second'])): ?>
  2) Купи слона епта
  <form action="index.php" method="post">
    <input type="submit" value="Не показывать больше!" name="banner">
  </form>
<?php else: ?>
  <p>2) Будешь без рекламы)0))</p>
<?php endif; ?>

<?php
//  var_dump($_REQUEST);
//  echo "<br>";
//  var_dump($_COOKIE);
  if (!empty($_COOKIE['time'])) {
    //$day+=3600*24*10;
    if ($day < 3600 * 24) {
      echo "3) Вы не были на нашем сайте менее дня, кол-во секунд отсутствия $day";
    } else {
      $day = floor($day /= 3600 * 24);
      echo "3) Вы не были на нашем сайте более $day дней";
    }
  }

?>
<br>
<br>
4)
<?php
  if (empty($_COOKIE['date'])):?>

    Введите дату дня вашего рождения
    <form action="" method="post">
      <input type="date" id="date" name="date">
      <input type="submit" name="submit" value="Указать">
    </form>
  <?php
  endif;
  //var_dump($_COOKIE);
  echo "<br>";
  //var_dump($_REQUEST);
  echo "<br>";
  if (!empty($_COOKIE['date'])) {
    $currentDate = date("Y") . date("-m-d", strtotime($_COOKIE['date']));
    //echo "<br> Сейчас ". $currentDate."<br>";

    function third($firstDate, $secondDate) {
      return floor(abs(strtotime($secondDate) - strtotime($firstDate)) / (60 * 60 * 24));
    }

    if (strtotime($currentDate) > strtotime(date("Y-m-d"))) {
      echo "День рождения будет через ";
      echo third($currentDate, date("Y-m-d")) . " дня";
    } else {
      $futureDate = (date("Y") + 1) . date("-m-d", strtotime($currentDate));
      //echo "<br>$futureDate<br>";
      $currentDate = date("Y-m-d");
      //echo "<br>$currentDate<br>";
      if (third($currentDate, $futureDate) == 365) {
        echo "С днем рождения !";
      } else {
        echo "День рождения будет через ";
        echo third($currentDate, $futureDate) . " дня<br>";
      }
    }
  }
?>
<br>
<br>
6) Цвет
<br>
<form action="" method="post">
  <button type="submit" name="color" value="white">Обычный</button>
  <button type="submit" name="color" value="#A9A9A9">Серый</button>
</form>
<br>

</body>
</html>
