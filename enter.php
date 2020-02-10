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
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>入力</title>
    <?php include 'head.php';?>
</head>
<body>
<div class="page-section">
    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-3">
                <a href="index.php">
                    <p class="btn btn-primary btn-sm">
                        戻る
                    </p>
                </a>
            </div>
            <div class="col-sm-6">
                <h1 class="page-section-heading text-center text-uppercase text-secondary">新規追加</h1>
            </div>
            <div class="col-sm-3 clearfix">
            <a href="logout.php">
                <p class="btn btn-primary btn-sm text-right float-right">
                    ログアウト
                </p>
            </a>
            </div>
        </div>
            <form action="insert.php" method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-sm-2">日付</label>
                    <input class="form-control" type="date" name="date" size="255" required>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">名前</label>
                    <input class="form-control" type="text" name="name" size="255" required>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">値段</label>
                    <input class="form-control" type="number" name="price" size="255" required>
                </div>
                <input type="hidden" name="user" value="<?= $user ?>">
                <input type="submit" value="追加" class="btn btn-primary">
            </form>
    </div>
</div>
    <?php include 'footer.php'; ?>
</body>
</html>