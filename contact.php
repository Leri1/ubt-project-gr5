<?php
require_once "database/Connection.php";

$errors = '';
$success = '';

if (isset($_POST['contactUs'])) {

    $securePost = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    if (empty($securePost['firstname'])) {
        $errors = 'Firstname is empty';
    } elseif ($securePost['lastname']) {
        $errors = 'Lastname is empty';
    } elseif ($securePost['email']) {
        $errors = 'Email is empty';
    } elseif (empty($securePost['message'])) {
        $errors = 'Message is empty';
    } elseif (!filter_var($securePost['email'], FILTER_VALIDATE_EMAIL)) {
        $errors = 'Invalid Email';
    }

    if (!empty($errors)) {

        $sql = "INSERT INTO contacts (firstname,lastname,email,message) VALUES (?,?,?,?)";
        Connection::getConnection()->prepare($sql)->execute([
            $securePost['firstname'],
            $securePost['lastname'],
            $securePost['email'],
            $securePost['message']
        ]);

        $success = 'Message sent successfully!';

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/images/UBTBank1.png">
    <title>UBT Bank Contact</title>
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
    <a href="contact.php" class="active">Contact</a>
    <a href="register.php">Register</a>
    <a href="login.php">Login</a>
</div>
<div class="container">
    <?php
    echo $success;
    echo $errors;
    ?>
    <form id="contactForm" action="" onsubmit="validateForm()" method="POST">
        <div class="row">
            <div class="col-25">
                <label for="fname">First Name</label>
            </div>
            <div class="col-75">
                <input type="text" id="fname" name="firstname" placeholder="Your name..">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="lname">Last Name</label>
            </div>
            <div class="col-75">
                <input type="text" id="lname" name="lastname" placeholder="Your last name..">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="lname">Email</label>
            </div>
            <div class="col-75">
                <input type="text" id="email" name="email" placeholder="Your email..">
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="subject">Message</label>
            </div>
            <div class="col-75">
                <textarea id="subject" name="message" placeholder="Write something.." style="height:200px"></textarea>
            </div>
        </div>
        <div class="row">
            <input type="submit" name="contactUs" value="Submit">
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
    function validateForm() {
        let firstName = document.forms["contactForm"]["firstname"].value;
        let lastName = document.forms["contactForm"]["lastname"].value;
        let email = document.forms["contactForm"]["email"].value;
        let message = document.forms["contactForm"]["message"].value;

        let mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

        if (firstName == "") {
            alert("Firstname must be filled out");
            return false;
        }
        if (lastName == "") {
            alert("Lastname must be filled out");
            return false;
        }
        if (email == "") {
            alert("Email must be filled out");
            return false;
        }
        if (!email.match(mailformat)) {
            alert("Not a valid email");
            return false;
        }
        if (message == "") {
            alert("Message must be filled out");
            return false;
        }
        if (message.length > 150) {
            alert("Message should have a maximum of 150 characters");
            return false;
        }

    }

</script>
<!-- END OF FOOTER -->
</html>