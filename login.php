<?php
require_once "database/Connection.php";

$errors = '';
$success = '';

if (isset($_POST['loginUser'])) {

    $securePost = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    if (empty($securePost['email'])) {
        $errors = 'Email is empty';
    } elseif (empty($securePost['password'])) {
        $errors = 'Password is empty';
    } elseif (!checkIfUserIsReadyToLogIN($securePost['email'], $securePost['password'])) {
        $errors = 'Invalid credentials';
    }

    if (empty($errors)) {

        $success = 'Successfully logged in!';

    }

}

function checkIfUserIsReadyToLogIN($email, $password)
{

    $sql = "SELECT password AS userPassword FROM users WHERE email = ?";
    $stmt = Connection::getConnection()->prepare($sql)->execute([$email]);
    $result = $stmt->fetch();

    if (!$result) {
        return false;
    }

    if ($password === $result['userPassword']) {
        return true;
    }

    return false;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/images/UBTBank1.png">
    <title>UBT Bank Login</title>
    <link href="assets/css/main.css" rel="stylesheet" type="text/css">
    <link href="assets/css/footer.css" rel="stylesheet" type="text/css">
    <link href="assets/css/form.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="index.html">Home</a>
    <a href="products.php">Offers</a>
    <a href="contact.php">Contact</a>
    <a href="register.php">Register</a>
    <a href="login.php" class="active">Login</a>
</div>
<div class="container">
    <?php
    echo $success;
    echo $errors;
    ?>
    <form id="loginForm" action="" method="POST" onsubmit="ValidateForm()">
        <div class="row">
            <div class="col-25">
                <label for="femail">Email</label>
            </div>
            <div class="col-75">
                <input type="email" id="femail" name="email" placeholder="Your Email.." required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="lpassword">Password</label>
            </div>
            <div class="col-75">
                <input type="password" id="lpassword" name="password" placeholder="Your Password.." required>
            </div>
        </div>

        <div class="col-2">
        </div>
        <div class="row">
            <input type="Submit" name="loginUser" value="Login">
        </div>
    </form>
</div>
</body>
<!-- FOOTER START -->
<div class="footer">
    <div class="contain">
        <div class="col">
            <h1>Company</h1>
            <ul>
                <li>About</li>
                <li>Mission</li>
                <li>Services</li>
                <li>Social</li>
                <li>Get in touch</li>
            </ul>
        </div>

        <div class="col">

        </div>

        <div class="col">
            <h1>Accounts</h1>
            <ul>
                <li>About</li>
                <li>Mission</li>
                <li>Services</li>
                <li>Social</li>
                <li>Get in touch</li>
            </ul>
        </div>
        <div class="col">

        </div>

        <div class="col">
            <h1>Support</h1>
            <ul>
                <li>Contact us</li>
                <li>Web chat</li>
                <li>Open ticket</li>
            </ul>
        </div>
        <div class="col social">
            <h1>Social</h1>
            <ul style="margin-left: 30px">
                <li><a href="https://www.facebook.com/"><img src="assets/images/facebook.png" width="64" style="width: 64px;"></a></li>

                <li><a href="https://www.instagram.com"><img src="assets/images/instagram.png" width="64" style="width: 64px;"></a></li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    function ValidateForm() {
        let email = document.forms["loginForm"]["email"].value;
        let password = document.forms["loginForm"]["password"].value;

        let mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        if (email == ""){
            alert("Email should not be empty");
            return false;
        }
        if(password == "") {
            alert("Password should not be empty");
            return false;
        }
        if (!email.match(mailformat)) {
            alert("Invalid email format");
            return false;
        }
    }
</script>
<!-- END OF FOOTER -->
</html>