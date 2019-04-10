<?php
$dbnamePresta = "prestashop";
$passPresta = "";
$idPresta = "root";
$dbnameMojp = "mojp";
$passMojp = "";
$idMojp = "root";


    function connect($dbnamePresta, $idPresta, $passPresta) //connection a la base de donnée prestashop
{
      global $dbError;
      $opt = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false
      );
      try {
        return new PDO('mysql:host=localhost;dbname='.$dbnamePresta.';charset=utf8', $idPresta, $passPresta, $opt);
      } catch (PDOException $e) {
        $dbError = 'Oups ! Connexion SGBD impossible !';
        if (DEBUG) :
          $dbError .= "<br/>" . $e->getMessage();
        endif;
      }
    }

    function connect2($dbnameMojp, $idMojp, $passMojp) // connection à la base de donnée MOJP
{
      global $dbError;
      $opt = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, //ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false
      );
      try {
        return new PDO('mysql:host=localhost;dbname='.$dbnameMojp.';charset=utf8', $idMojp, $passMojp, $opt);
      } catch (PDOException $e) {
        $dbError = 'Oups ! Connexion SGBD impossible !';
        if (DEBUG) :
          $dbError .= "<br/>" . $e->getMessage();
        endif;
      }
    }
    $pdo = connect($dbnamePresta, $idPresta, $passPresta);
    $pdoMojp = connect2($dbnameMojp, $idMojp, $passMojp);
