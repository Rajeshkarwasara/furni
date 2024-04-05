<?php

$savername = "localhost";
$username = "root";
$password = "";
$dbname = "rajtrt";
$conn = new mysqli($savername, $username, $password, $dbname);

// if (!$conn->connect_errno) {
//     echo "TRUE";
// } else {
//     echo "Fales";
// }

$name_err = "";
$email_err = "";
$phone_err = "";

$password_err = "";

$name_reg = "";

echo $name_err;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $name_err = "please enter your name *";
    } else {
        $name_r = "/^[a-zA-Z]+/";
        if (!preg_match($name_r, $_POST["name"])) {
            $name_err = " enter a valid name";
        }
    }

    if (empty($_POST["email"])) {
        $email_err = "please enter your email *";
    } else {
        $email_r = "/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/";
        if (!preg_match($email_r, $_POST["email"])) {
            $email_err = " enter a valid email";
        }
    }
    if (empty($_POST["phone"])) {
        $phone_err = "please enter your phone *";
    } else {
        $phone_r = "/^[0-9]{10}$/";
        if (!preg_match($phone_r, $_POST["phone"])) {
            $phone_err = " enter a valid number";
        }
    }

    if (empty($_POST["password"])) {
        $password_err = "please enter your password *";
    }





    // echo $_POST["name"] . "" . "<br>";
    // echo $_POST["email"] . "" . "<br>";
    // echo $_POST["phone"] . "" . "<br>";
    // echo $_POST["password"] . "" . "<br>";
    // echo "<pre>";
    // echo print_r($_FILES["file"]);
    // echo "<pre>";






    $folder = "imagess/";
    $path = $folder . $_FILES["file"]["name"];
    $temp = $_FILES["file"]["tmp_name"];



    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $imgUrl = $path;


    $sql = "INSERT INTO users(name, email, phone, password, img_url) VALUES ('$name','$email','$phone','$pass','$imgUrl')";

    if (empty($name_err) && empty($email_err) && empty($phone_err) && empty($password_err)) {
        if ($_FILES["file"]["size"] < 1024000) {
            move_uploaded_file($temp, $path);
            if ($conn->query($sql)) {
                echo "user created";
                header("location: index.php");
            }

        } else {
            echo "<h2 style='color:red;'>img size should bee leas than 1mb</h2>";
        }


    } else {
        echo "something went wrong";
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

        .password-container {
            position: relative;
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


    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col text-end">
                <a href="index.php"><i class=" fs-2 fa-regular fa-circle-left"></i></a>
            </div>

        </div>
        <div class="container">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="name">
            </div>
            <p class=text-danger>
                <?php
                echo $name_err;
                echo $name_reg;
                ?>
            </p>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                    aria-describedby="emailHelp">
            </div>
            <p class=text-danger>
                <?php
                echo $email_err;
                ?>
            </p>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Phone</label>
                <input type="number" class="form-control" id="exampleInputEmail1" name="phone"
                    aria-describedby="emailHelp">
            </div>
            <p class=text-danger>
                <?php
                echo $phone_err;
                ?>
            </p>


            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">profile picture</picture></label>
                <input type="file" class="form-control" id="exampleInputEmail1" name="file"
                    aria-describedby="emailHelp">
            </div>

            <div class="password-container mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" class="form-control" id="password" placeholder="enter your password" name="password">
                <span class="password-toggle" onclick="togglePassword()"><i class="fa-solid fa-eye"></i></span>
            </div>
            <p class=text-danger>
                <?php
                echo $password_err;
                ?>
            </p>

            <a href="index.php"><button type="submit" class="btn btn-primary">Submit</button></a>
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