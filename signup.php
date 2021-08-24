<?php
session_start();

    include("db.php");
    include("function.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //SOMETHING WAS POSTED 
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];

        if(!empty($user_name) && !empty($user_password) && !is_numeric($user_name))
        {
            //save to data base
            $query = "insert into clients (nom,mot_de_passe) values ('$user_name', '$user_password')";
            mysqli_query($con,$query);

            header("Location: login.php");
            die;

        }else{
            echo "please valid some valid information";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <div id=box>
        <form method="post">
            <div>Signup</div>

            <input type="text" name="user_name"><br><br>
            <input type="password" name="user_password"><br><br>

            <input type="submit" value="Signup"><br><br>

            <a href="login.php">Click to login</a><br><br>
        </form>
 
    </div>
</body>
</html>