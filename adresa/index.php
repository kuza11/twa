<!DOCTYPE html>
<html lang="cs">
  <head>
    <title>Krok 1: výběr kraje</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>
    <h1>Krok 1: výběr kraje</h1>
    <form action="okres.php" method="post">
      <label for="kraj">Kraj:</label>
      <select name="kraj" id="kraj">
        <option value="19">Hlavní město Praha</option>
        <option value="27">Středoceský kraj</option>
      </select>
      <button type="submit">Potvrďte kraj</button>
    </form>
  </body>
</html>