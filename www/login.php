<?php
require_once '../controllers/userController.php';

session_start();
if(isset($_SESSION['user'])){
header("Location: index.php"); exit();

}
$error = '';
if(isset($_POST['submit'])){
    UserController::Login($_POST['email'], $_POST['password']);
    if(isset($_SESSION['user'])){
        header("Location: index.php"); exit();
    }else{
        $error = 'Wrong email or password!';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        
    </head>
    <body>
        <!-- Navbar content -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="menu">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <img src="images/theschool.jpg" class="img-fluid img-thumbnail"  width="170" height="170" alt="Responsive image">
                    </div>
                </div>
            </div>
        </nav>

        <span style="color:red;">
        <?php
            echo $error;
        ?>
        </span>

        <div class="fullscreen_bg">

            <div class="container">

                <form method="POST" class="form-signin">
                    <h1 class="form-signin-heading text-muted">Login</h1>
                    <input type="text" class="form-control" name="email" placeholder="Email address" required="" autofocus="">
                    <input type="password" class="form-control" name="password" placeholder="Password" required="">
                    <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">
                        Sign In
                    </button>
                </form>

            </div>
        </div>
    </body>
</html>