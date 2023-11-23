<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Register</title>
    <style>body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    text-align: center;
    margin: 50px;
}

form {
    max-width: 400px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

input,
textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button{
  display: inline-block;
  padding: 1px 20px;
  font-size: 20px;
  text-align: center;
  text-decoration: none;
  cursor: pointer;
  border: 2px solid #800000;
  border-radius: 5px;
  color: #800000;
  background-color: #fff;
  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
  transition: background-color 0.3s, color 0.3s;
  margin-top: 4%;
  margin-bottom: 4%;
  margin-left: 0%;
}

button:hover {
  background-color: #800000;
  color: #fff;
  animation: motionGlow 1.5s infinite;
  box-shadow: 0 0 5px #800000;
}
</style>
</head>
<body>
    <form action="" method="post">
        <h1>Cancelation Form</h1>
        <label>
            USN
        </label><br>
        <input type="text" name="usn" placeholder="Enter your USN"><br>
        <label>Reason for cancelation</label><br>
        <textarea name="reason" id="" cols="30" rows="10" placeholder="Enter text here.."></textarea><br>
        <button type="submit" name="cancel_register">Cancel</button>
    </form>


</body>
</html>
<?php
$conn=mysqli_connect('localhost','root','','varanothsava');
if(isset($_POST['cancel_register'])){
    $usn=$_POST['usn'];
    $reason=$_POST['reason'];
    $checkquery="SELECT * FROM registered WHERE usn='$usn'";
    $checkquery_run=mysqli_query($conn,$checkquery);
    if(mysqli_num_rows($checkquery_run)==1){
        $delete_query="DELETE FROM registered WHERE usn='$usn'";
        $delete_query_run=mysqli_query($conn,$delete_query);
        $insert_query="INSERT INTO registration_canceled VALUES('$usn')";
        $insert_query_run=mysqli_query($conn,$insert_query);
        echo "<script>alert('registration canceled successfully');
    window.location.href='register.php';
    </script>";
    }
    echo "<script>alert('Invalid USN or Not registered');
    window.location.href='register.php';
    </script>";
    
}

?>