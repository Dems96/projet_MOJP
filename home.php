<?php include 'header.php';

$client = selectClient();
$infoPresta = selectInfoFromPresta();

foreach ($infoPresta as $element) {
  $reference = $element->reference;
  $idOrder = $element->id_order;
  $idCustomer = $element->id_customer;
}


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
        $order = $_GET['edit'];
        $verifId = selectId($order);
        $infoMojp = selectInfoFromMojpById_Order($order);
         ?>
        <table border=1 class="table">
           <thead class="thead-dark">

             <th>Note</th>
             <th>Ajouter une note</th>
             <th>Modifier</th>


           </thead>
           <?php foreach ($infoMojp as $bop): ?>
           <form method="get" action="home.php" class="form-group">
             <input type="hidden" name="id" value="<?php echo $order; ?>"/>
           <tr>

             <td><?php echo $bop->notes; ?></td>
             <td> <input type="text" name="edit" value="editer"> </td>
             <td><button type="submit" name="noteEdit"> modifier </button></td>

             </tr>
             </form>
           <?php endforeach; ?>
           <?php } elseif (isset($_GET['item'])) {
             $reference = $_GET['item'];
             $selectOrderItem = selectOrderItem($reference); ?>
             <table border=1 class="table">
                <thead class="thead-dark">
                  <th>Item</th>
                </thead>
                <?php foreach ($selectOrderItem as $item): ?>
                <tr>

                  <td><?php echo $item->product_quantity."x ". $item->product_name ." [". $item->reference."]";?></td>

                </tr>
              <?php endforeach; ?>


            <?php }elseif (isset($_GET['ajout'])) {
              $idd = selectId($_GET['ajout']);
              foreach ($idd as $value) {
                $id = $value->id_orders;
              }
              if ($id != $_GET["ajout"]) {
                $addOrder = AjoutOrder($_GET['ajout']);
              }
              header("location:home.php");

             ?>

            <?php } elseif (isset($_GET['customer'])) {
              $infoByCustomer = selectInfoFromPrestaById($_GET['customer']); ?>
              <h1> Les 100 dernières commandes </h1>
                <table border=1 class="table">
                   <thead class="thead-dark">


                     <th>reference</th>
                     <th>date_commande</th>
                     <th>Item</th>
                     <th>Transport</th>
                     <th>RR JP</th>
                     <th>prix</th>
                     <th>mode de paiement</th>
                     <th>note</th>
                     <th>Ajouter une note</th>
                     <th>action</th>

                   </thead>

                <?php foreach ($infoByCustomer as $infocusto): ?>
                <tr>


                  <td><?php echo $infocusto->reference ; ?></td>
                  <td><?php echo $infocusto->date_add; ?></td>
                 <td> <button type="button"><a href="?item=<?php echo $infocusto->reference; ?>"> Voir Item </a></button></td>
                  <td><?php echo $infocusto->name; ?></td>
                  <td><?php echo ""; ?></td>
                  <td><?php echo $infocusto->total_paid ; ?></td>
                  <td><?php echo $infocusto->payment ; ?></td>
                  <td>
                  <button type="submit"><a href="?edit=<?php echo $infocusto->id_order;?>"> Voir/Modifier Notes </a></button>
                  </td>
                  <td>
                  <button type="submit"><a href="?ajout=<?php echo $infocusto->id_order;?>">  Ajouter Notes </a></button>
                  </td>
                  <td>
                  <button type="submit"><a href="?action=<?php echo $infocusto->id_customer; ?>"> edit </a></button>
                  </td>

                </tr>
              <?php endforeach; ?>

            <?php } else { ?>

              <table border=1 class="table">
                 <thead class="thead-dark">

                   <th>Nom du Client</th>
                   <th>Prénom du Client</th>
                   <th>Voir</th>

                 </thead>

              <?php foreach ($client as $infoClient): ?>
              <tr>


                <td><?php echo $infoClient->firstname; ?></td>
                <td><?php echo $infoClient->lastname; ?></td>
                <td>
                <button type="submit"><a href="?customer=<?php echo $infoClient->id_customer; ?>"> voir </a></button>
                </td>

              </tr>
            <?php endforeach; ?>
            </table>
     <?php } if (isset($_GET['noteEdit'])) {
       $majNote = majNote($_GET['id'], $_GET['edit']);
       header("location:home.php");
     }  ?>
   </div>
</main>
</html>
