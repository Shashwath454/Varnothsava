<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Paste the CSS code here */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 50px;
        }

        h3 {
            color: #333;
            margin-bottom: 20px;
        }

        img {
            margin-top: 20px;
            max-width: 100%;
            height: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <h3>Save Your QR Code!</h3>
</body>

</html>
<?php
require_once 'phpqrcode/qrlib.php';
session_start();
$path = 'qrimages/';
$qr_id = $_SESSION['usn'];
$qrtext = $_SESSION['usn'];
$qrcode = $path . time() . ".png";
$qrimage = time() . ".png";
$conn = mysqli_connect('localhost', 'root', '', 'varanothsava');
$query = "INSERT INTO qrcode VALUES('$qr_id','$qrtext','$qrimage')";
$query_run = mysqli_query($conn, $query);
QRcode::png($qrtext, $qrcode, 'H', 8, 8);
echo "<img src='" . $qrcode . "'>";
?>