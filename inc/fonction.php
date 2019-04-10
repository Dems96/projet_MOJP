<?php
require_once 'connect-db.php';

function addUser(){
    global $pdo;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $adresse = $_POST['adresse'];
    $code_postale = $_POST['code_postale'];
    $ville = $_POST['ville'];
    $pays = $_POST['pays'];
    $query = "INSERT INTO user VALUES ('', '$email', '$password', '$adresse', '$code_postale', '$ville', '$pays')";
    $sql = $pdo->exec($query);
    return $sql;
}
?>