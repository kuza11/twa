<?php
include_once 'adresa.class.php';
$adresa = new adresa();
$obce = $adresa->vratObceOkresu($_POST["okres"]);
?>


<!DOCTYPE html>
<html lang="cs">
  <head>
    <title>Krok 3: výběr obce</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <h1>Krok 3: výběr obce</h1>
    <form action="obec.php" method="post">
      <label for="okres">obec:</label>
      <select name="okres" id="okres">
        <?php
        foreach ($obce as $obec){
          echo '<option value="' . $obec->obec_kod . '">' . $obec->nazev . '</option>';
        }
        ?>
      </select>
      <button type="submit">Potvrďte obec</button>
    </form>
  </body>
</html>