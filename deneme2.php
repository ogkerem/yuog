<?php

if ($_POST) {
    $key = $_POST['key'];
    // print_r($_POST);
    // die;
    require_once "vendor/autoload.php";
    $x = count($_POST['key']);
    for ($i = 0; $i < $x; $i++) {
        echo $key[$i];
        $request = new YurticiKargo\Request();
        $request->setUser("1005N222915087G", "51ANJ9V2z0hC50H8")->init("");

        $queryShipment = $request->queryShipment($key[$i]);
        echo '<pre>';
        //print_r($queryShipment->getResultData()->ShippingDeliveryVO->shippingDeliveryDetailVO->shippingDeliveryItemDetailVO->invDocCargoVOArray);
        print_r($queryShipment->getResultData());
        echo '</pre>';
        echo '<hr style="margin:100px 0">';
    }
    // print_r($queryShipment->getResultData()->operationMessage->shippingDeliveryDetailVO->errMessage);
} else {
?>

    <form action="" method="POST">
        <input type="text" name="key[]">
        <input type="text" name="key[]">
        <input type="text" name="key[]">
       
        <button type="submit">Gönder</button>
    </form>

<?php } ?>