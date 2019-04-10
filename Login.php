<!DOCTYPE html>
<?php include "header.php";
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <title></title>
  </head>

  <body>
    <h1 align="center">Bienvenue</h1>
    <div class="container" align="center" style="width:400px">
      <div class="box shadow p-4" >
      <form action="inc/connect-db.php" method="post" >
    <div class="form-group">
      <label for="exampleInputEmail1" style="text-align:center;">Nom Base de donnée</label>
      <input type="text" class="form-control" name="dbname" aria-describedby="emailHelp" placeholder="">

    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Identifiant</label>
      <input type="text" class="form-control" name="id" placeholder="Votre identifant ">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Mot de passe</label>
      <input type="password" class="form-control" name="password" placeholder="Votre mot de passe ">
    </div>
    <button type="submit" class="btn btn-primary" name="connexion">Se connecter</button>
  </form>
  </div>
</div>
  </body>
</html>
<?php
//require_once 'javascripts.php';
//require_once 'footer.php';
?>
