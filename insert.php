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

$user = $_SESSION['USER'];

$db = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
if (mysqli_connect_errno()) {
    die("データベースに接続できません:" . mysqli_connect_error() . "\n");
}

if(isset($_POST['date'])&&isset($_POST['name'])&&isset($_POST['price'])) {
    $eDate = $_POST['date'];
    $eName = $_POST['name'];
    $ePrice = $_POST['price'];
    $insert = 'INSERT INTO expenses (date, name, price, user) VALUES (\''.$eDate.'\', \''.$eName.'\', '.$ePrice.', \''.$user.'\')';
    $result = mysqli_query($db, $insert);
    mysqli_close($db);
    header("Location: index.php");
} else {
    echo "データベースの処理に失敗しました。";
}
