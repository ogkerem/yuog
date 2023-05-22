<?php
require_once("inc/config.php");


if ($_SESSION['user']['login'] == false) {
    if ($_SESSION['user']['login'] == false) {
        header("Location: /home");
        die;
    }
} else {
    if ($_POST['konu'] == 'yurticiKey') {
        // echo $keyNumber = strip_tags(addslashes($_POST['values']['keyNumber']));
        // echo $_POST['values']['keyNumber'];

        echo '<pre>';
        print_r($_POST);

        $keyNumber = strip_tags(addslashes($_POST['keyNumber']));
        $keyPassword = strip_tags(addslashes($_POST['keyPassword']));

        $userID = $_SESSION['user']['user_id'];
        $userCheck = $mysqli->query("SELECT * FROM yurtici_dataset WHERE userID = $userID")->num_rows;
        if ($userCheck < 1) {
            $yurticiInfoAdd = $mysqli->query("INSERT INTO yurtici_dataset SET keyNumber = '$keyNumber', keyPassword = '$keyPassword', userID = $userID");
        } else if ($userCheck > 0) {
            $yurticiInfoAdd = $mysqli->query("UPDATE yurtici_dataset SET keyNumber = '$keyNumber', keyPassword = '$keyPassword' WHERE userID = $userID");
        }

        if ($yurticiInfoAdd) {
            echo 'basarili';
        }

        // $getUser = $mysqli->query("SELECT * FROM users WHERE id = $userID")->fetch_assoc();

        // echo $getUser['email'];
    }
}
