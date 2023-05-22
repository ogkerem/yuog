<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/head.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/header.php");
require_once $_SERVER['DOCUMENT_ROOT'] . "vendor/autoload.php";

if ($_SESSION['user']['login'] == false) {
    header("Location: /home");
    die;
}

$yurtici_info = $mysqli->query("SELECT * FROM yurtici_dataset WHERE userID = $userID")->fetch_assoc();

?>

<?php

if ($_POST) {
    $request = new YurticiKargo\Request();
    $request->setUser($yurtici_info['keyNumber'], $yurtici_info['keyPassword'])->init("");

    $key = $_POST['key'];
    $queryShipment = $request->queryShipment($key);


    print_r($queryShipment->getResultData()->ShippingDeliveryVO->shippingDeliveryDetailVO->shippingDeliveryItemDetailVO->invDocCargoVOArray);

    foreach ($queryShipment  as $shipment) {
    }
} else {
?>
    <form action="" method="POST" role="form">
        <div class="row align-items-center g-3 g-sm-4 pb-3">
            <div class="col-sm-6">
                <label class="form-label" for="new-pass">KEY</label>
                <div class="password-toggle">
                    <input class="form-control" type="text" id="new-pass" name="key">
                </div>
            </div>

            <div class="d-flex justify-content-end pt-3">
                <button class="btn btn-primary ms-3" type="submit">Sorgula</button>
            </div>
        </div>
    </form>
<?php } ?>


<script>
    $('#yurticiApi').submit(function(event) {
        event.preventDefault();
        // var form = new FormData(this);
        var form = $(this).serializeArray();
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: form
        }).done(function(cevap) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Bilgilerin Kaydedildi...',
                showConfirmButton: false,
                timer: 1500
            })
        })
    })


    // $("#yurticiApi").submit(function(event) {
    //     event.preventDefault();
    //     var form = $(this).serializeArray();
    //     $.ajax({
    //         method: "POST",
    //         url: "ajax.php",
    //         data: form
    //     }).done(function(sonuc) {
    //         $("textaarea").val("");
    //         $("tbody").html(sonuc);
    //     });
    // });
</script>


<?php
require_once 'sections/footer.php';
?>