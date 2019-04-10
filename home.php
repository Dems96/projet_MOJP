<?php include 'header.php';

$infoPresta = selectInfoFromPresta();
foreach ($infoPresta as $element) {
  $reference = $element->reference;
  $idOrder = $element->id_order;
}


$selectOrderItem = selectOrderItem($idOrder,$reference);
//$infoMojp = quiPrendTout();

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  </head>

  <h1> Les 100 dernières commandes </h1>
  <main role="main" class="flex-shrink-0">
    <div class="container" style="text-align :center;top: 3rem;position: relative;">


    <?php  if (isset($_GET['edit'])) {
        $id = $_GET['edit']; ?>
        <table border=1 class="table">
           <thead class="thead-dark">

             <th>Mail</th>
             <th>reference</th>
             <th>date_commande</th>
             <th>Item</th>
             <th>Transport</th>
             <th>RR JP</th>
             <th>prix</th>
             <th>mode de paiement</th>
             <th>nom</th>
             <th>prénom</th>
             <th>note</th>
             <th>action</th>

           </thead>
           <?php foreach ($infoPresta as $info): ?>
           <form method="get" action="home.php" class="form-group">
           <input type="hidden" name="id" value="<?php echo $id; ?>"/>
           <tr>
             <td><?php echo $info->email; ?></td>
             <td><?php echo $info->reference ; ?></td>
             <td><?php echo ""; ?></td>
             <td><?php echo ""; ?></td>
             <td><?php echo ""; ?></td>
             <td><?php echo ""; ?></td>
             <td><?php echo $info->total_paid ; ?></td>
             <td><?php echo $info->payment  ?></td>
             <td><?php echo $info->firstname; ?></td>
             <td><?php $info->lastname; ?></td>
             <td> <input type="text" name="edit" value="edit"> edit </td>
             <td><button type="submit" name="userEdit" class="btn btn-outline-primary"> modifier </button></td>
             </tr>
             </form>
           <?php endforeach; ?>
           <?php } elseif (isset($_GET['item'])) { ?>
             <table border=1 class="table">
                <thead class="thead-dark">
                  <th>Item</th>
                </thead>
                <?php foreach ($selectOrderItem as $item): ?>
                <tr>

                  <td><?php echo $item->product_quantity."x ". $item->product_name ." [". $item->reference."]";?></td>

                </tr>
              <?php endforeach; ?>

              <?php } else { ?>

                <table border=1 class="table">
                   <thead class="thead-dark">

                     <th>Mail</th>
                     <th>reference</th>
                     <th>date_commande</th>
                     <th>Item</th>
                     <th>Transport</th>
                     <th>RR JP</th>
                     <th>prix</th>
                     <th>mode de paiement</th>
                     <th>nom</th>
                     <th>prénom</th>
                     <th>note</th>
                     <th>action</th>

                   </thead>

                <?php foreach ($infoPresta as $info): ?>
                <tr>

                  <td><?php echo $info->email; ?></td>
                  <td><?php echo $info->reference ; ?></td>
                  <td><?php echo $info->date_add; ?></td>
                 <td><a href="?item=<?php echo $info->id_order; ?>"> Item </a></td>
                  <td><?php echo $info->name; ?></td>
                  <td><?php echo ""; ?></td>
                  <td><?php echo $info->total_paid ; ?></td>
                  <td><?php echo $info->payment ; ?></td>
                  <td><?php echo $info->firstname; ?></td>
                  <td><?php echo $info->lastname; ?></td>
                  <td>
                  </button><a href="?edit=<?php echo $info->id_order;?>"> edit </a></button>
                  </td>
                  <td>
                  </button><a href="?action=<?php echo $info->id_customer; ?>"> action </a></button>
                  </td>

                </tr>
              <?php endforeach; ?>
            </table>
     <?php }  ?>
   </div>
</main>
</html>
