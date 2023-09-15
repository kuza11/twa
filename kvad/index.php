<?php
$a = intval(htmlspecialchars($_GET["coeff_a"]));
$b = intval(htmlspecialchars($_GET["coeff_b"]));
$c = intval(htmlspecialchars($_GET["coeff_c"]));
$res1;
$res2;


if(!empty($a) || !empty($b) || !empty($c) || $c == 0){
  if($a == 0 && $b != 0){
    $res1 = -$c / $b;
  }
  else if($a == 0 && $b == 0){
    $res1 = "infinite amount";
  }
  else{
    $res1 = (-$b+sqrt($b*$b-4*$a*$c))/(2*$a);
    $res2 = (-$b-sqrt($b*$b-4*$a*$c))/(2*$a);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <div>
      <form method="get">
        <input type="number" name="coeff_a" required>x^2 +
        <input type="number" name="coeff_b" required>x +
        <input type="number" name="coeff_c" required>
        <button type="submit">=</button>
      </form>
    </div>
    <br>
    <?php
      echo $a . "x^2 " . ($b < 0 ? "- " . abs($b) : "+ " . $b) . "x " . ($c < 0 ? "- " . abs($c) : "+ " . $c) . " = 0";
    ?>
    <br>
    <p>x1: <?=is_string($res1) ? "infinite amount" : (is_nan($res1) ? "no result" : $res1)?><br>x2: <?=empty($res2) || is_nan($res2) ? "no result" : $res2?></p>
  </body>
</html>