<?php

require_once "database/Connection.php";

$errors = '';
$success = '';

if (isset($_POST['registerUser'])) {

    $securePost = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    if (empty($securePost['firstname'])) {
        $errors = 'Firstname is empty';
    } elseif (empty($securePost['lastname'])) {
        $errors = 'Lastname is empty';
    } elseif (empty($securePost['email'])) {
        $errors = 'Email is empty';
    } elseif (empty($securePost['user_password'])) {
        $errors = 'Password is empty';
    } elseif (empty($securePost['confirm_password'])) {
        $errors = 'Repeat password is empty';
    } elseif (empty($securePost['gender'])) {
        $errors = 'Gender is empty';
    } elseif (empty($securePost['birthday'])) {
        $errors = 'Birthday is empty';
    } elseif (!filter_var($securePost['email'], FILTER_VALIDATE_EMAIL)) {
        $errors = 'Invalid Email';
    } elseif ($securePost['user_password'] !== $securePost['confirm_password']) {
        $errors = 'Passwords are not the same';
    }

    if (empty($errors)) {

        $sql = "INSERT INTO users (firstname,lastname,email,password,gender,birthday) VALUES (?,?,?,?,?,?)";
        $stmt = Connection::getConnection()->prepare($sql)->execute([
            $securePost['firstname'],
            $securePost['lastname'],
            $securePost['email'],
            $securePost['user_password'],
            $securePost['gender'],
            $securePost['birthday']
        ]);

        $success = 'Account Created Successfully!';

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/images/UBTBank1.png">
    <title>UBT Bank Register</title>
    <link href="assets/css/main.css" rel="stylesheet" type="text/css">
    <link href="assets/css/footer.css" rel="stylesheet" type="text/css">
    <link href="assets/css/form.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="index.html">Home</a>
    <a href="products.html">Offers</a>
    <a href="contact.php">Contact</a>
    <a href="register.php" class="active">Register</a>
    <a href="login.php">Login</a>
</div>
<div class="container">
    <?php
    echo $errors;
    echo $success;
    ?>
    <form id="registerForm" action="" method="POST" onsubmit="ValidateForm()">
        <div class="row">
            <div class="col-25">
                <label for="fname">First Name</label>
            </div>
            <div class="col-75">
                <input type="text" id="fname" name="firstname" placeholder="Your name.." required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="lname">Last Name</label>
            </div>
            <div class="col-75">
                <input type="text" id="lname" name="lastname" placeholder="Your last name.." required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="lemail">Email</label>
            </div>
            <div class="col-75">
                <input type="email" id="lemail" name="email" placeholder="Your email.." required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="lpassword">Password</label>
            </div>
            <div class="col-75">
                <input type="password" id="lpassword" name="user_password" placeholder="Your password.." required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="password">Confirm Password</label>
            </div>
            <div class="col-75">
                <input type="password" id="password" name="confirm_password" placeholder="Confirm password.." required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label>Confirm your gender</label>
            </div>
            <div class="col-75">
                <select name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label>Confirm your birthday</label>
            </div>
            <div class="col-75">
                <input type="date" id="birthday" name="birthday" required>
            </div>
        </div>
        <div class="row">
            <input type="submit" name="registerUser" value="Register">
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
<script>
    function ValidateForm() {
        let firstname = document.forms["registerForm"]["firstname"].value;
        let lastname = document.forms["registerForm"]["lastname"].value;
        let email = document.forms["registerForm"]["email"].value;
        let password = document.forms["registerForm"]["user_password"].value;
        let confirmPassword = document.forms["registerForm"]["confirm_password"].value;
        let gender = document.forms["registerForm"]["gender"].value;
        let birthday = document.forms["registerForm"]["birthday"].value;

        let mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        let birthdayValidation = /^([0-9]{2})-([0-9]{2})-([0-9]{4})$/;
        let dateNow = new Date();

        if (firstname == "") {
            alert("Firstname is required");
            return false;
        }
        if (lastname == "") {
            alert("Lastname is required");
            return false;
        }
        if (email == "") {
            alert("Email is required");
            return false;
        }

        if (!email.match(mailformat)) {
            alert("Please use valid email format");
            return false;
        }

        if (password == "") {
            alert("Password is required");
            return false;
        }
        if (confirmPassword == "") {
            alert("Confirm Password is required");
            return false;
        }

        if (password !== confirmPassword) {
            alert("Password is not the same as confirm password");
            return false;
        }

        if (password.length < 12) {
            alert("Password should have at least 12 characters");
            return false;
        }

        if (gender == "") {
            alert("Gender is required");
            return false;
        }
        if (birthday == "") {
            alert("Birthday is required");
            return false;
        }

        if (!birthday.match(birthdayValidation)) {
            alert('You should be at least 18 years old to register');
            return false;
        }

    }
</script>
<!-- END OF FOOTER -->
</html>