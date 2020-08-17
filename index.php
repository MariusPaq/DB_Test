<!DOCTYPE html>
<html lang="" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    include 'connexion.php';


    echo "<table style='border: solid 1px black;'>";
    echo "<tr><th>Id</th><th>Firstname</th><th>Lastname</th></tr>";

    class TableRows extends RecursiveIteratorIterator {
      function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
      }

      function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
      }

      function beginChildren() {
        echo "<tr>";
      }

      function endChildren() {
        echo "</tr>" . "\n";
      }
    }

    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      /*$stmt = $conn->prepare("SELECT * FROM `datas` WHERE `last_name` = 'Palmer'"); //Ex1*/
      /*$stmt = $conn->prepare("SELECT * FROM `datas` WHERE `gender` = 'Female'"); //Ex2*/
      /*$stmt = $conn->prepare("SELECT * FROM `datas` WHERE `last_name` LIKE 'N%'");//Ex3*/
      /*$stmt = $conn->prepare("SELECT * FROM `datas` WHERE `email` LIKE '%google%'");//Ex4*/
      /*$stmt = $conn->prepare("INSERT INTO `datas` (`first_name`,`last_name`) VALUES ('Jean','Clenche')");//Ex5*/
      /*$stmt = $conn->prepare("UPDATE `datas` SET `email` = 'Jean.Clenche@gmail.com' WHERE `first_name` = 'Jean' AND `last_name` = 'Clenche' ");//Ex6*/
      /*$stmt = $conn->prepare("DELETE FROM `datas` WHERE `first_name` = 'Jean' AND `last_name` = 'Clenche'");//Ex7*/
      /*$stmt = $conn->prepare("SELECT COUNT(*), `gender` FROM `datas` GROUP BY `gender`");//Ex8*/
      /*$stmt = $conn->prepare("SELECT *, 2020-RIGHT(`birth_date`, 4) AS Age FROM `datas` ORDER BY Age;");//Ex9.1*/
      /*$stmt = $conn->prepare("SELECT AVG(2020-RIGHT(`birth_date`, 4)) AS mAgeF FROM `datas` WHERE `gender` = 'Female' ORDER BY mAgeF;");//Ex9.2*/
      /*$stmt = $conn->prepare("SELECT AVG(2020-RIGHT(`birth_date`, 4)) AS mAgeH FROM `datas` WHERE `gender` = 'Male' ORDER BY mAgeH;");//Ex9.3*/
      $stmt->execute();

      // set the resulting array to associative
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
      foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
      }
      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
      $conn = null;
      echo "</table>";


     ?>

  </body>
</html>
