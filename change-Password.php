<?php
session_start();
if (isset($_SESSION['Email_Session'])) {
    header("Location: welcome.php");
    die();
}
include('config.php');
$msg = "";
$error = "";
if (isset($_GET['Reset'])) {
    if (mysqli_num_rows(mysqli_query($conx, "SELECT * FROM register WHERE CodeV='{$_GET['Reset']}'")) > 0) {
        if (isset($_POST['submit'])) {
            $Pass = mysqli_real_escape_string($conx, $_POST['Password']);
            $Confirme_Pass = mysqli_real_escape_string($conx, $_POST['Conf-Password']);
            if ($Pass === $Confirme_Pass) {
                $sql = "UPDATE register SET Password ='" . md5($Pass) . "' WHERE CodeV='{$_GET['Reset']}'";
                $result = mysqli_query($conx, $sql);
                if ($result) {
                    header("Location: welcome.php");
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password is not match</div>";
                $error = 'style="border:1px Solid red;box-shadow:0px 1px 11px 0px red"';
            }
        }
    }
} else {
    header("Location: Forget.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Form</title>
    <style>
        .alert {
            padding: 1rem;
            border-radius: 5px;
            color: white;
            margin: 1rem 0;
            font-weight: 500;
            width: 65%;
        }

        .alert-success {
            background-color: #42ba96;
        }

        .alert-danger {
            background-color: #fc5555;
        }

        .alert-info {
            background-color: #2E9AFE;
        }

        .alert-warning {
            background-color: #ff9966;
        }
    </style>
</head>

<body>
    <div class="container sign-up-mode">
        <div class="forms-container">
            <div class="signin-signup" style="left: 50%;z-index:99;">
                <form method="POST" class="sign-up-form">
                    <h2 class="title">Sign up</h2>
                    <?php echo $msg ?>

                    <div class="input-field" <?php echo $error ?>>
                        <i class="fas fa-lock"></i>
                        <input type="password" name="Password" placeholder="Password" />
                    </div>
                    <div class="input-field" <?php echo $error ?>>
                        <i class="fas fa-lock"></i>
                        <input type="password" name="Conf-Password" placeholder="Confirm Password" />
                    </div>
                    <input type="submit" name="submit" class="btn" value="Save" />
                    <p class="social-text">Or Sign up with social platforms</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>