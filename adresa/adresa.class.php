
<?php
require_once("db.php");

class adresa
{
    public $conn;
    /**
     * Konstruktor se připojí k DB
     */
    public function __construct()
    {
        include_once "db_asw.php";
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
            echo "Nelze se připojit k MySQL: ";
            echo $e->getMessage();  //smazat
        }
    }

    /** Metoda vrací kraje z DB
     * @param int řazení krajů: 1 = dle kódku; 2 = dle názvu - výchozí
     * @return pole objektů kraj
     * @array
     */
    public function vratKraje ($serad = 2)  //chybí-li parametr, dosadí 2
    {
        try {
            $stmt = $this->conn->prepare("SELECT kraj_kod, nazev FROM `kraj` ORDER BY :serad ASC;");
            $stmt->bindParam(':serad', $serad, PDO::PARAM_INT);  //filtruje a pustí jen číslo
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chyba čtení tabulky kraje: ";
            echo $e->getMessage();  //zakomentovat
            return false;
        }
    }
    /** Metoda vrací Okresy konkrétního kraje z DB
     * @param int kraj_kod
     * @param int řazení okresů: 1 = dle kódku; 2 = dle názvu - výchozí
     * @return pole objektů okresů kraje
     * @array
     */
    public function vratOkresyKraje ($kraj_kod, $serad = 2)  //chybí-li parametr, dosadí 2
    {
        try {
            $stmt = $this->conn->prepare("SELECT `okres_kod`, `nazev` FROM `okres` WHERE `kraj_kod` = :kraj_kod ORDER BY :serad ASC");
            $stmt->bindParam(':kraj_kod', $kraj_kod, PDO::PARAM_INT);  //filtruje na čísla
            $stmt->bindParam(':serad', $serad, PDO::PARAM_INT);  //filtruje a pustí jen číslo
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Chyba čtení tabulky okres: ";
            echo $e->getMessage();  //zakomentovat
            return false;
        }
    }

}