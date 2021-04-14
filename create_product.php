<?php

require_once "database/Connection.php";

$errors = '';
$success = '';

if (isset($_POST['createService'])) {

    $securePost = filter_var_array($_POST, FILTER_SANITIZE_STRING);

    if (empty($securePost['service_title'])) {
        $errors = 'Service Title is empty';
    } elseif (empty($securePost['service_description'])) {
        $errors = 'Service Description is empty';
    }

    if (empty($errors)) {

        $sql = "INSERT INTO services (service_title,service_description) VALUES (?,?)";
        $stmt = Connection::getConnection()->prepare($sql)->execute([
            $securePost['service_title'],
            $securePost['service_description']
        ]);

        $success = 'Service Created Successfully!';

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets/images/UBTBank1.png">
    <title>UBT Bank Add Service</title>
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
    <a href="register.php" class="active">Register</a>
    <a href="login.php">Login</a>
</div>
<div class="container">
    <?php
    echo $errors;
    echo $success;
    ?>
    <form id="createServiceForm" action="" method="POST" onsubmit="ValidateForm()">
        <div class="row">
            <div class="col-25">
                <label for="service_title">Service Title</label>
            </div>
            <div class="col-75">
                <input type="text" id="service_title" name="service_title" placeholder="Service Title" required>
            </div>
        </div>
        <div class="row">
            <div class="col-25">
                <label for="service_description">Service Description</label>
            </div>
            <div class="col-75">
                <textarea id="service_description" name="service_description" placeholder="Service Description.." style="height:200px"></textarea>
            </div>
        </div>
        <div class="row">
            <input type="submit" name="createService" value="Create">
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
        let serviceTitle = document.forms["createServiceForm"]["service_title"].value;
        let serviceDescription = document.forms["createServiceForm"]["service_description"].value;

        if (serviceTitle == "") {
            alert("Service Title is required");
            return false;
        }
        if (serviceDescription == "") {
            alert("Service Description is required");
            return false;
        }

    }
</script>
<!-- END OF FOOTER -->
</html>