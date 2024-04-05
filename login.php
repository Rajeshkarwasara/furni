<?php
include "connect.php";
session_start();
$email_err = "";
$password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];


    if (empty($email)) {
        $email_err = "please enter your user email *";
    }

    if (empty($password)) {
        $password_err = "please enter your password *";
    }
    if (!($email_err) && !($password_err)) {
        $sql = "SELECT * FROM `users` WHERE email='$email' ";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['user_email'] = $row['email'];
                $_SESSION['user_phone'] = $row['phone'];
                $_SESSION['user_img'] = $row['file'];
                header("location: index.php");
            } 
        }
        else {
            echo "password is wrong";
        }

    }


}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4383e559ec.js" crossorigin="anonymous"></script>
    <style>
        form {
            width: 50%;
            margin: auto;
            padding: 30px;
            border: 4px solid #161313;
            margin-top: 20px;
        }

        span.password-toggle {
            justify-content: end;
            display: flex;
            margin-top: -26px;
            margin-bottom: 31px;
            padding-right: 10px;
            cursor: pointer;
            width: 6%;
            float: inline-end;
        }
    </style>
</head>

<body>



    <form method="post">
        <div class="row">
            <div class="col text-end">
                <a href="index.php"><i class=" fs-2 fa-regular fa-circle-left"></i></a>
            </div>

        </div>

        <div class="container">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">enter your email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="enter your user name"
                    name="email">
            </div>
            <p class=text-danger>
                <?php
                echo $email_err;

                ?>
            </p>
            <div class="password-container mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" class="form-control" id="password" placeholder="enter your password"
                    name="password">
                <span class="password-toggle" onclick="togglePassword()"><i class="fa-solid fa-eye"></i></span>
            </div>
            <p class=text-danger>
                <?php
                echo $password_err;
                ?>
            </p>



            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var passwordToggle = document.querySelector('.password-toggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';

            } else {
                passwordInput.type = 'password';

            }
        }
    </script>
</body>

</html>