<?php
require_once "database/Connection.php";

if (isset($_GET['delete_product'])) {
    Connection::getConnection()->query('DELETE FROM services WHERE id = '. $_GET['delete_product'])->execute();
    header('Location: products.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>UBT Bank Offers</title>
    <link rel="icon" type="image/png" href="assets/images/UBTBank1.png">
    <link href="assets/css/main.css" rel="stylesheet" type="text/css">
    <link href="assets/css/slider.css" rel="stylesheet" type="text/css">
    <link href="assets/css/footer.css" rel="stylesheet" type="text/css">
    <link href="assets/css/cards.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="topnav" id="myTopnav">
    <a href="index.html">Home</a>
    <a href="products.php" class="active">Offers</a>
    <a href="contact.php">Contact</a>
    <a href="register.php">Register</a>
    <a href="login.php">Login</a>
</div>
<div class="container">
    <h1 style="color: black">Offers</h1>
    <div id="slider">
        <a href="#" class="control_next">>></a>
        <a href="#" class="control_prev"><</a>
        <ul>
            <li style="background: #aaa;"><img src="assets/images/credit.jpg">Loans : Up to 20.000$</li>
            <li style="background: #aaa;"><img src="assets/images/stonks.jpg"style="width: 500px;height: 300px">Investments : Invest to Profit</li>
        </ul>
    </div>
    <a href="create_product.php">Create Product</a>
    <div class="cardContainer">
        <div class="card" style="background-color:rgb(153, 29, 224);">
            <h2>E-Banking</h2>
            <p>UBT Bank Internet Branch is a 24/7 service. You can perform all your banking transactions anywhere, you just need a PC.</p>
        </div>
        <div class="card" style="background-color:rgb(12, 126, 120);">
            <h2>Currency Exchange</h2>
            <p>You can buy/sell with foreign currencies in Ubt Bank including : Dollar,LEK, Yen</p>
        </div>
        <div class="card" style="background-color:rgb(207, 41, 91);">
            <h2>Invest to Profit</h2>
            <p>We guarantee you a stable income with a net profit of up to 6.5% per day.</p>
        </div>
        <?php
        $query = "SELECT * FROM services";
        $services =Connection::getConnection()->query($query)->fetchAll();
        foreach ($services as $service) {
        ?>
            <div class="card" style="background-color:rgb(207, 41, 91);">
                <h2><?= $service['service_title'] ?></h2>
                <p><?= $service['service_description'] ?></p>
                <p><a href="products.php?delete_product=<?php echo $service['id']; ?>">Delete Service</a></p>
            </div>
        <?php
        }
        ?>
    </div>
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
<script src="assets/js/slider.js"></script>

<!-- END OF FOOTER -->
</html>