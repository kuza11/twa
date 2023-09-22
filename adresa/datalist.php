<?php
include_once 'adresa.class.php';
$adresa = new adresa();
$data = $adresa->vratIndexovane();
?>


<!DOCTYPE html>
<html lang="cs">
  <head>
    <title>Výběr ulice</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
  <main>
    <form action="finished.php" method="post">
      <label for="adresa">Adresa:</label>
      <input list="adresy_vyber" name="adresa" />
      <datalist id="adresy_vyber">
        <?php
        for ($i = 0; $i < count($data); $i++) {
          $d = $data[$i];
          echo "<option value='$d->ulice_nazev, $d->obec_nazev, $d->okres_nazev, $d->kraj_nazev'>";
        }
        ?>
      </datalist>
    </form>
  </main>
</body>
</html>