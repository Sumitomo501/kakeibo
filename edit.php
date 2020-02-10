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

$id = $_POST["id"];
$date = $_POST["date"];
$name = $_POST["name"];
$price = $_POST["price"];

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>編集ページ</title>
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
                <h1 class="page-section-heading text-center text-uppercase text-secondary">編集</h1>
            </div>
            <div class="col-sm-3 clearfix">
            <a href="logout.php">
                <p class="btn btn-primary btn-sm text-right float-right">
                    ログアウト
                </p>
            </a>
            </div>
        </div>
    <form action="update.php" method="post" class="form-horizontal">
        <input type="hidden" name="id" value="<?=$id?>">
        <div class="form-group">
            <label class="control-label col-sm-2">日付</label>
            <input class="form-control" id="date" type="date" name="date" size="255" value="<?=$date?>" onInput="Enterdate(this)" required>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">名前</label>
            <input class="form-control" id="name" type="text" name="name" size="255" value="<?=$name?>" onInput="Entername(this)" required>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">値段</label>
            <input class="form-control" id="price" type="number" name="price" size="255" value="<?=$price?>" onInput="Enterprice(this)" required>
        </div>
        <input type="hidden" name="user" value="<?=$user?>">
        <input type="submit" value="編集" class="btn btn-primary">
    </form>
    </div>
</div>
    <?php include 'footer.php'; ?>
<script type="text/javascript">
    edate = document.getElementById('date');
    ename = document.getElementById('name');
    eprice = document.getElementById('price');

    function Enterdate($this) {
        console.log($this);
        edate.innerText = edate.value;
    }
    function Entername($this) {
        console.log($this);
        ename.innerText = ename.value;
    }
    function Enterprice($this) {
        console.log($this);
        eprice.innerText = eprice.value;
    }
</script>
</body>
</html>


