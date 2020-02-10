<?php
define("DBHOST", "データベースの場所");
define("DBUSER", "データベースのユーザー名");
define("DBPASS", "データベースのパスワード");
define("DBNAME", "データベース名");
$db = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
$error = null;
if(!empty($_POST["username"])&&!empty($_POST["password"])){
    $username = $_POST["username"];
    $pass = $_POST["password"];
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $select = 'SELECT * From login WHERE user =\''.$username.'\';';
    $sql_result = mysqli_query($db, $select);
    $result = mysqli_fetch_array($sql_result, MYSQLI_NUM);
    if($result == null){
        $insert = 'INSERT INTO login (user, pass) VALUES (\''.$username.'\', \''.$hash.'\')';
        $result = mysqli_query($db, $insert);
        header('Location: login.php?status=registration');
    } else {
        $error = 'このユーザー名はすでに使われています。';
    }
}
$_POST["username"] = null;
$_POST["password"] = null;
mysqli_close($db);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
    <?php include 'head.php';?>
</head>
<body>
<?=$error?>
<div class="page-section">
    <div class="w-50 mr-auto ml-auto">
        <h1 class="page-section-heading text-center text-uppercase text-secondary mb-0">Registration</h1>
        <form action="" method="post" class="form-horizontal mt-5">
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" name="username"><br>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password"><br>
        </div>
        <a href="login.php">
            <p class="text-right btn btn-primary btn-sm float-right">
                戻る
            </p>
        </a>
            <input class="btn btn-primary btn-sm" type="submit" value="新規登録">
        </form>
    </div>
</div>
    <?php include 'footer.php'; ?>
</body>
</html>