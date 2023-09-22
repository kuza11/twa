
<?php

class adresa
{
    public $conn;
    /**
     * Konstruktor se připojí k DB
     */
    public function __construct()
    {
        include "db.php";
        $dsn = "mysql:host=localhost;dbname=$dbname;port=3336";
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try
        {
            $this->conn = new PDO($dsn, $user, $pass, $options);
        }
        catch(PDOException $e)
        {
            $file = fopen("err.log", "w");
            fprintf($file, "Connection failed: %s\n", $e->getMessage());
        }
    }

    /** Metoda vrací kraje z DB
     * @param int řazení krajů: 1 = dle kódku; 2 = dle názvu - výchozí
     * @return pole objektů kraj
     * @array
     */
    public function vratKraje ($serad = 2): bool | array  //chybí-li parametr, dosadí 2
    {
        try {
            $stmt = $this->conn->prepare("SELECT kraj_kod, nazev FROM `kraj` ORDER BY :serad ASC;");
            $stmt->bindParam(':serad', $serad, PDO::PARAM_INT);  //filtruje a pustí jen číslo
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $file = fopen("err.log", "w");
            fprintf($file, "Connection failed table kraj: %s\n", $e->getMessage());
            return false;
        }
    }
    /** Metoda vrací Okresy konkrétního kraje z DB
     * @param int kraj_kod
     * @param int řazení okresů: 1 = dle kódku; 2 = dle názvu - výchozí
     * @return pole objektů okresů kraje
     * @array
     */
    public function vratOkresyKraje ($kraj_kod, $serad = 2): bool | array  //chybí-li parametr, dosadí 2
    {
        try {
            $stmt = $this->conn->prepare("SELECT `okres_kod`, `nazev` FROM `okres` WHERE `kraj_kod` = :kraj_kod ORDER BY :serad ASC");
            $stmt->bindParam(':kraj_kod', $kraj_kod, PDO::PARAM_INT);  //filtruje na čísla
            $stmt->bindParam(':serad', $serad, PDO::PARAM_INT);  //filtruje a pustí jen číslo
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $file = fopen("err.log", "w");
            fprintf($file, "Connection failed table okres: %s\n", $e->getMessage());
            return false;
        }
    }
    public function vratObceOkresu ($okres_kod, $serad = 2): bool | array{
        try {
            $stmt = $this->conn->prepare("SELECT `obec_kod`, `nazev` FROM `obec` WHERE `okres_kod` = :okres_kod ORDER BY :serad ASC");
            $stmt->bindParam(':okres_kod', $okres_kod, PDO::PARAM_INT);  //filtruje na čísla
            $stmt->bindParam(':serad', $serad, PDO::PARAM_INT);  //filtruje a pustí jen číslo
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            $file = fopen("err.log", "w");
            fprintf($file, "Connection failed table okres: %s\n", $e->getMessage());
            return false;
        }
    }

    public function vratIndexovane(int $serad = 2): bool | array
  {
    try {
      $stmt = $this->conn->prepare("SELECT kraj.kraj_kod, kraj.nazev AS kraj_nazev, okres.okres_kod, okres.nazev AS okres_nazev, obec.obec_kod, obec.nazev AS obec_nazev, ulice.ulice_kod, ulice.nazev AS ulice_nazev FROM ((ulice INNER JOIN obec ON ulice.obec_kod=obec.obec_kod) INNER JOIN okres ON obec.okres_kod=okres.okres_kod) INNER JOIN kraj ON okres.kraj_kod=kraj.kraj_kod;");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
      $file = fopen("err.log", "a");
      fprintf($file, "Chyba čtení více tabulkek: %s\n", $e->getMessage());
      return false;
    }
  }

}