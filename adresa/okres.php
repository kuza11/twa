<?php
include_once 'adresa.class.php';
$adresa = new adresa();
$okresy = $adresa->vratOkresyKraje($_POST["kraj"]);
?>


<!DOCTYPE html>
<html lang="cs">
  <head>
    <title>Krok 2: výběr okresu</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <h1>Krok 2: výběr okresu</h1>
    <form action="obec.php" method="post">
      <label for="okres">okres:</label>
      <select name="okres" id="okres">
        <?php
        foreach ($okresy as $okres){
          echo '<option value="' . $okres->okres_kod . '">' . $okres->nazev . '</option>';
        }
        ?>
      </select>
      <button type="submit">Potvrďte okres</button>
    </form>
  </body>
</html>