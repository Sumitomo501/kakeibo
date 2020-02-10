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
    <title>家計簿</title>
    <?php include 'head.php';?>
</head>
<body>
<div class="page-section">
    <div class="container">
        <div class="row mb-3">
            <div class="col-sm-3">
                <a href="enter.php">
                    <p class="btn btn-primary btn-sm">
                        追加
                    </p>
                </a>
            </div>
            <div class="col-sm-6">
                <h1 class="page-section-heading text-center text-uppercase text-secondary"><?= $user ?>の家計簿</h1>
            </div>
            <div class="col-sm-3 clearfix">
                <a href="logout.php">
                    <p class="btn btn-primary btn-sm text-right float-right">
                        ログアウト
                    </p>
                </a>
            </div>
        </div>
<div class="table-responsive">
<table class="table table-bordered table-striped">
<tbody>
<tr>
    <th>日付</th>
    <th>名前</th>
    <th>値段</th>
    <th></th>
    <th></th>
</tr>
<?php
$result = mysqli_query($db, 'SELECT * From expenses WHERE user = \''.$user.'\';');
    foreach ($result as $row) {
        ?>
        <tr>
            <td><?=$row["date"]?></td>
            <td><?=$row["name"]?></td>
            <td><?=$row["price"]?>円</td>
            <td>
                <form action="edit.php" method="post">
                    <input type="hidden" name="id" value="<?=$row["id"]?>">
                    <input type="hidden" name="date" value="<?=$row["date"]?>">
                    <input type="hidden" name="name" value="<?=$row["name"]?>">
                    <input type="hidden" name="price" value="<?=$row["price"]?>">
                    <input type="submit" value="編集">
                </form>
            </td>
            <td>
                <form action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?=$row["id"]?>">
                    <input type="submit" value="削除">
                </form>
            </td>
        </tr>
        <?php
    }
mysqli_close($db);
?>
</tbody>
</table>
</div>
</div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>