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
        //read to data base
        $query = "SELECT * FROM clients WHERE nom = '$user_name' limit 1";
        $result = mysqli_query($con,$query);

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                if($user_data["mot_de_passe"] === $user_password){

                    $id = $_SESSION['user_id'] = $user_data['id'];
                    header("Location: index.php");
                    die;
                }
            }
        }
        echo "please valid some valid information";
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
    <title>Login</title>
</head>
<body>
    <div id=box>
        <form method="post">
            <div>Login</div>

            <input type="text" name="user_name"><br><br>
            <input type="password" name="user_password"><br><br>

            <input type="submit" value="Login"><br><br>

            <a href="signup.php">Click to Signup</a><br><br>
        </form>
 
    </div>
</body>
</html>