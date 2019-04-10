<?php include 'inc/manager-db.php';
// on teste si nos variables sont définies et remplies

 if (isset($_POST['dbname']) && isset($_POST['id']) && isset($_POST['password']) && !empty($_POST['dbname'])&& !
empty($_POST['dbname'])) {
 // on appele la fonction getAuthentification en lui passant en paramètre le login et password
 //la fonction retourne les caractéristiques du salaries si il est connu sinon elle retourne false
 //$verify = password_verify($_POST['password'], $hashed_password);
 //$result = getAuthentification($_POST['email'],$_POST['password']);

 print_r($result);
 // si le résulat n'est pas false
 if($result ){
    // on la démarre la session
    session_start ();
    // on enregistre les paramètres de notre visiteur comme variables de session
    $_SESSION['nom'] = $result->email;
    $_SESSION['identifiant'] = $result->idUser;
    $_SESSION['role'] = $result->statut;

    // on redirige notre visiteur vers une page de notre section membre
    header ('location: home.php');

     }
 //si le résultat est false on redirige vers la page d'authentification
 else{
   header ('location: Login.php');
   }
   }

   //si nos variables ne sont pas renseignées on redirige vers la page d'authentification
 else {
   header ('location: Login.php');
 }  ?>
