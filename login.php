<?php
session_start();

if (isset($_SESSION['USER'])){
    header('Location: index.php');
    exit;
}
define("DBHOST", "データベースの場所");
define("DBUSER", "データベースのユーザー名");
define("DBPASS", "データベースのパスワード");
define("DBNAME", "データベース名");
$db = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
if(!empty($_POST["username"])&&!empty($_POST["password"])){
    $username = $_POST["username"];
    $pass = $_POST["password"];
    $select = 'SELECT * From login where user = \''.$username.'\'';
    $sql_result = mysqli_query($db, $select);
    $result = mysqli_fetch_array($sql_result, MYSQLI_NUM);
    if(password_verify($pass, $result[2])){
        $_SESSION['USER'] = $username;
        header('Location: index.php');
        exit();
    } else {
        $error = 'ユーザー名かパスワードが違います。';
    }
    mysqli_close($db);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <?php include 'head.php';?>
</head>
<body>
    <?php
        if(!empty($error)){
            ?>
            <p>
                <?=$error?>
            </p>
            <?php
        }
    ?>
    <div class="page-section">
        <div class="w-50 mr-auto ml-auto">
            <h1 class="page-section-heading text-center text-uppercase text-secondary mb-0">Login</h1>
            <?php
                if($_GET["status"]){
                    echo "<p>新規登録が完了しました。ログインしてください</p>";
                }
            ?>
            <form action="" method="post" class="form-horizontal mt-5">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="text" name="username" required><br>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="password" name="password" required><br>
                    </div>
                    <a href="registration.php">
                        <p class="text-right btn btn-primary btn-sm float-right">
                            新規登録
                        </p>
                    </a>
                <input class="btn btn-primary btn-sm" type="submit" value="Login">
            </form>
        </div>
    </div>
<?php include 'footer.php'; ?>
</body>
</html>
