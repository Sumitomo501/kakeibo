<?php
session_start();

if (!isset($_SESSION['USER'])){
    header('Location: login.php');
    exit;
}
define("DBHOST", "データベースの場所");
define("DBUSER", "データベースのユーザー名");
define("DBPASS", "データベースのパスワード");
define("DBNAME", "データベース名");

$db = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
if (mysqli_connect_errno()) {
    die("データベースに接続できません:" . mysqli_connect_error() . "\n");
}

if(isset($_POST['date'])&&isset($_POST['name'])&&isset($_POST['price'])) {
    $eDate = $_POST['date'];
    $eName = $_POST['name'];
    $ePrice = $_POST['price'];
    $uId = $_POST['id'];
    $update = 'UPDATE expenses set date =\''.$eDate.'\', name = \''.$eName.'\', price = \''.$ePrice.'\' WHERE id = '.$uId.';  ';
    $result = mysqli_query($db, $update);
    mysqli_close($db);
    header("Location: index.php");
} else {
    echo "データベースの処理に失敗しました。";
}
