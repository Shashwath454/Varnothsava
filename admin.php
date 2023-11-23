<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'varanothsava');
$reg_query = "SELECT count(*) from registered";
$reg_query_run = mysqli_query($conn, $reg_query);
$res1 = mysqli_fetch_array($reg_query_run);
$cncld_query = "SELECT count(*) from registration_canceled";
$cncld_query_run = mysqli_query($conn, $cncld_query);
$res2 = mysqli_fetch_array($cncld_query_run);

if (isset($_POST["save"])) {
    $filename = "registered_data_export_" . date('Ymd') . ".xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $show_coloumn = false;
    if (!empty($stu_rec)) {
        foreach ($stu_rec as $record) {
            if (!$show_coloumn) {
                // display field/column names in first row
                echo implode("\t", array_keys($record)) . "\n";
                $show_coloumn = true;
            }
            echo implode("\t", array_values($record)) . "\n";
        }
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    text-align: center;
    margin: 50px;
}

form {
    max-width: 400px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

button.view {
    background-color: #4caf50;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button.view:hover {
    background-color: #45a049;
}

h4 {
    color: #800000;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #800000;
    color: #fff;
}

input[type="text"] {
    width: 70%;
    padding: 8px;
    margin-right: 5px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button[name="update_payment"], button[name="update"], button[name="save"] {
    background-color: #800000;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
}

button[name="update_payment"]:hover, button[name="update"]:hover, button[name="save"]:hover {
    background-color: #2980b9;
}
</style>
</head>

<body>
    Total Registerations:
    <form method="post" action="">
        <button name="reg" style="color:green" class="view" type="submit"><?php echo $res1[0]; ?></button>
    </form>
    Canceled registrations:
    <h4 style="color:red"><?php echo $res2[0]; ?></h4>
    <?php
    if (isset($_POST['reg'])) {
        $viewquery = "SELECT * from registered";
        $viewquery_run = mysqli_query($conn, $viewquery);
        $stu_rec = array();
    ?>
        <div>
            <table>
                <tr>
                    <th>USN</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Dept</th>
                    <th>Event</th>
                    <th>Payment status</th>
                </tr>
                <?php
                while ($res = mysqli_fetch_assoc($viewquery_run)) {
                    $stu_rec[] = $res; ?>
                    <tr>
                        <td><?php echo $res['usn']; ?></td>
                        <td><?php echo $res['name']; ?></td>
                        <td><?php echo $res['email']; ?></td>
                        <td><?php echo $res['dept']; ?></td>
                        <td><?php echo $res['event']; ?></td>
                        <td><?php echo $res['payment']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <form action="" method="post">
            <button type="submit" name="save">Save as Excel</button>
        </form>
    <?php
    }
    ?>
    Update payment section
    <form action="" method="post">
        <input type="text" name="usn" placeholder="Enter student USN">
        <button name="update_payment" type="submit">Find</button>
    </form>
    <?php
    if (isset($_POST['update_payment'])) {
        $usn = $_POST['usn'];
        $query = "SELECT * from registered where usn='$usn'";
        $query_run = mysqli_query($conn, $query);
    ?>
        <div>
            <table>
                <tr>
                    <th>USN</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Dept</th>
                    <th>Event</th>
                    <th>Payment status</th>
                </tr>
                <?php
                while ($res = mysqli_fetch_array($query_run)) { ?>

                    <tr>
                        <td><?php echo $res['usn']; ?></td>
                        <td><?php echo $res['name']; ?></td>
                        <td><?php echo $res['email']; ?></td>
                        <td><?php echo $res['dept']; ?></td>
                        <td><?php echo $res['event']; ?></td>
                        <form action="" method="post">
                            <td><input type="checkbox" name="payment"></td>
                            <td>
                                <button type="submit" name="update">Save</button>
                            </td>
                        </form>
                    </tr>

                <?php
                } ?>
            </table>
        </div>
    <?php   }
    if (isset($_POST['update'])) {
        if (!empty($_POST['payment'])) {
            $pay_query = "UPDATE registered SET payment=1 WHERE usn='" . $_SESSION['usn'] . "'";
            if ($conn->query($pay_query)) {
                echo "<script>
                alert('payment status updated');</script>
                ";
            }
        }
    }
    ?>
</body>

</html>