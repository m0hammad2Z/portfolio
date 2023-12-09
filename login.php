<?php
session_start();

include('user.php');

if(isset($_SESSION['user'])){
    header("Location: dashboard.php");
}

$user = User::getUser();

if($user === null){
    $user = new User("Mohammad Al-Zaro", "imhame33@gmail.com", "12345678", "FULL STACK DEVELOPER", "0796940497");
    $user->add();

    echo '<script>location.reload();</script>';
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    if($pass == "" || $email == ""){
        echo "Please fill in all fields";
        return;
    }

    try{
        if($user->pass == $pass){
            $_SESSION['user'] = [
                'name' => $user->name,
                'email' => $user->email,
                'pos' => $user->pos,
                'mobile' => $user->mobile
            ];
            header("Location: dashboard.php");
        } else {
            echo "Wrong password";
        }
    } catch(Exception $e){
        echo "User not found";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
    <body>
        <div class="container">
            <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-md-6">

                    <h2 class="text-center">Login</h2>
                    <p class="text-center">Enter your credentials below</p>
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter your email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter your password" name="pass">
                        </div>
                        <button type="submit" class="btn btn-primary col-12">Login</button>
                    </form>

                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>