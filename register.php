<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student register</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

div {
    max-width: 400px;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 8px;
}

input, select {
    padding: 10px;
    margin-bottom: 15px;
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

a {
    text-decoration: none;
    color: #800000;
    margin-left: 36%;
    margin-top: -4.5%
}

a:hover {
    text-decoration: underline;
}
</style>
</head>

<body>
    <div>
        <form action="" method="post">
            <H1>REGISTRATION</H1>
             <label>Name</label>
            <input type="text" placeholder="Enter your Name" name="name">
            <label>USN</label>
            <input type="text" placeholder="Enter your USN" name="usn">
            <label>Email</label>
            <input type="email" placeholder="Enter your sode email-id" name="email">
            <label>Department</label>
            <select name='dept'>
                <option value='cse'>CSE</option>
                <option value='ece'>ECE</option>
                <option value='civil'>Civil</option>
                <option value='mechanical'>Mechanical</option>
                <option value='aiml'>AIML</option>
                <option value='aids'>AIDS</option>
            </select>
            <label>Event</label>
            <select name="event">
                <option value="gaming">Gaming</option>
                <option value="coding">Coding</option>
                <option value="treasure_hunt">Treasure hunt</option>
                <option value="robo_soccer">Robo Soccer</option>
            </select>
            <button type="submit" name="register_button">Register</button>
            Already registered? <a href="cancel_registration.php">Cancel</a>
        </form>
    </div>
</body>

</html>
<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'varanothsava');
if (isset($_POST['register_button'])) {
    $usn = $_POST['usn'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dept = $_POST['dept'];
    $event = $_POST['event'];
    $_SESSION['usn'] = $usn;
    $reg_query = "INSERT INTO registered VALUES('$usn','$name','$email','$dept','$event',0)";
    if ($conn->query($reg_query)) {
        echo '<script>alert("registered successfully");
        window.location.href="qrcode.php";
        </script>';
    }
}

mysqli_close($conn);
?> 
            
       
