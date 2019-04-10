<?php include 'header.php';
//$item = $_GET['item'];
?>

  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  </head>
  <body>
    <main role="main" class="flex-shrink-0">
      <div class="container" style="text-align :center;top: 3rem;position: relative;">
      <table border=1 class="table">
         <thead class="thead-dark">

           <th>Les Items</th>

         </thead>
         </table>
         <?php print_r($_GET['item']); ?>

  </body>
</html>
