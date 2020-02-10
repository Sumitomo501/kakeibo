<?php
define("DBHOST", "データベースの場所");
define("DBUSER", "データベースのユーザー名");
define("DBPASS", "データベースのパスワード");
define("DBNAME", "データベース名");

$db = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
if (mysqli_connect_errno()) {
    die("データベースに接続できません:" . mysqli_connect_error() . "\n");
}

$dId = $_POST['id'];
$update = 'DELETE FROM expenses WHERE id = \''.$dId.'\';';
$result = mysqli_query($db, $update);
mysqli_close($db);
header("Location: index.php");