<?php
require_once 'connect-db.php';
function selectInfoFromPresta() {
    global $pdo;
    //global $pdoMojp;
   $result = $pdo->prepare("SELECT * FROM ps_orders, ps_customer, ps_carrier LIMIT 0,100;");
    $result->execute();
    return $result->fetchAll();
}

function selectInfoFromMojpById_Order($order) {
    global $pdoMojp;
    $result = $pdoMojp->prepare("SELECT * FROM ldb_orders WHERE id_orders = :order");
    $result->bindValue(':order', $order);
    $result->execute();
    return $result->fetchAll();
}

function selectInfoFromPrestaById($idCustomer) {
    global $pdo;
    $result = $pdo->prepare("SELECT * FROM ps_orders, ps_carrier WHERE id_customer = :idCustomer");
    $result->bindValue(':idCustomer', $idCustomer);
    $result->execute();
    return $result->fetchALl();
}

function selectCustomer($idCustomer) {
    global $pdo;
    $result = $pdo->prepare("SELECT * FROM ps_customer WHERE id_customer = :id_customer");
    $result->bindValue(':id_customer', $idCustomer, PDO::PARAM_STR);
    $result->execute();
    return $result->fetch();
}
function selectClient() {
    global $pdo;
    $result = $pdo->prepare("SELECT * FROM ps_customer");
    $result->execute();
    return $result->fetchAll();
}

function selectCustomerAdress($idCustomer) {
    global $pdo;
    $result = $pdo->prepare("SELECT `address1`, `city` FROM ps_address WHERE id_customer = :id_customer");
    $result->bindValue(':id_customer', $idCustomer, PDO::PARAM_STR);
    $result->execute();
    return $result->fetch();
}

function endsWith($haystack, $needle) {
    $needle === '' ? TRUE : FALSE;
    $diff = strlen($haystack) - strlen($needle);
    return $diff >= 0 && strpos($haystack, $needle, $diff) !== FALSE;
}

function selectId($order) {
    global $pdoMojp;
    $result = $pdoMojp->prepare("SELECT `id_orders` FROM ldb_orders WHERE id_orders = :order");
    $result->bindValue(':order', $order);
    $result->execute();
    return $result->fetchAll();
}

function majNote($idorder, $note){
  global $pdoMojp;
    $result = $pdoMojp->prepare("UPDATE ldb_orders SET notes = :note WHERE id_orders = :id; ");
    $result->bindValue(':id', $idorder, PDO::PARAM_STR);
    $result->bindValue(':note', $note, PDO::PARAM_STR);
    $result->execute();
    return $result;
}

function AjoutOrder($order) {
    global $pdoMojp;
    $result = $pdoMojp->prepare("INSERT INTO ldb_orders VALUES ($order, '', '', '', '', '')");
        $result->bindValue(":id_orders", $order);
        $result->execute();
        return $result;
}

// TODO: trouver la jointure pour selectionne les elements du panier du client
function selectOrderItem($reference) {
    global $pdo;
    $result = $pdo->prepare("SELECT * FROM ps_orders, ps_order_detail WHERE ps_orders.reference = :reference");
    $result->bindValue(':reference', $reference, PDO::PARAM_STR);
    $result->execute();
    return $result->fetchAll();
}

function selectCarrier($idCarrier) {
    global $pdo;
    $result = $pdo->prepare("SELECT reference, ps_carrier.name FROM ps_orders, ps_carrier WHERE ps_carrier.id_carrier = :id_carrier");
    $result->bindValue(":id_carrier", $idCarrier, PDO::PARAM_STR);
    $result->execute();
    return $result->fetch();
}

function quiPrendTout() {
    global $pdoMojp;
    global $pdo;

    $result = $pdo->prepare("SELECT * FROM ps_orders ORDER BY id_order DESC LIMIT 0,1");
    $result->execute();
    $orders = $result->fetch();
    $toAddList = array();
    $nb = $orders->id_order;

    $verifTable = $pdoMojp->prepare("SELECT * FROM ldb_orders");
    $verifTable->bindValue(":idOrder", $nb, PDO::PARAM_STR);
    $verifTable->execute();
    $countTable = $verifTable->rowCount();
    $counter = 0;
    $isAllTable = false;
    if ($countTable != 0) {
        while ($counter == 0 && $nb != 0) {
            $result = $pdoMojp->prepare("SELECT * FROM ldb_orders WHERE idOrder = :idOrder");
            $result->bindValue(":idOrder", $nb, PDO::PARAM_STR);
            $result->execute();
            $counter = $result->rowCount();
            if ($counter == 0) {
                $toAddList[] = $nb;
            }
            $nb--;
        };

    }else {
        $AllOrders = $pdo->prepare("SELECT id_order FROM ps_orders ORDER BY id_order");
        $AllOrders->execute();
        $AllOrderss = $AllOrders->fetchAll();
        foreach ($AllOrderss as $list => $key) {
            $toAddList[] = $key;
        }
        $isAllTable = true;
    }

    if ($toAddList != null) {
        if ($isAllTable == false) {
            krsort($toAddList);
        }

        foreach ($toAddList as $idOrd) {
            if ($isAllTable) {
                $selectInfoFromPresta = selectInfoFromPrestaById($idOrd->id_order);
                $id = $idOrd->id_order;
            }else {
                $selectInfoFromPresta = selectInfoFromPrestaById($idOrd);
                $id = $idOrd;
            }
            $date = $selectInfoFromPresta->date_add;
            $shipping = $selectInfoFromPresta->shipping_number;

            $idCustomer = $selectInfoFromPresta->id_customer;
            $selectCustomer = selectCustomer($idCustomer);

            $email = $selectCustomer->email;
            $prenom = $selectCustomer->firstname;
            $nom = $selectCustomer->lastname;

            $selectCustomerAdress = selectCustomerAdress($idCustomer);

            $adresse1 = $selectCustomerAdress->address1;
            $city = $selectCustomerAdress->city;
            $reference = $selectInfoFromPresta->reference;

            $selectOrderItem = selectOrderItem($id, $reference);

            $items = array();

            foreach ($selectOrderItem as $item) {
                array_push($items, $item->product_quantity . "x " . $item->product_name . " (" . $item->reference . ")<br>");
            }
            $idCarrier = $selectInfoFromPresta->id_carrier;

            $selectCarrier = selectCarrier($idCarrier);
            $carrier = $selectCarrier->name;
            AjoutOrder($id, $email, $nom . " " . $prenom, $adresse1 . " " . $city, $date, $items, $carrier, $shipping, $reference);
        }
    }
    return false;
}
function countId($idOrder){
  global $pdoMojp;
  $verifOrderExist = $pdoMojp->prepare("SELECT COUNT(*) as commandExist FROM ldb_orders");
    $verifOrderExist->execute();
    $countOrderExists = $verifOrderExist->fetch();
    $nb_ligne=$countOrderExists->commandExist;
    return $nb_ligne;
}
