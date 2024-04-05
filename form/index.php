<?php
$name_err = "";
$email_err = "";
$phone_err = "";
$message_err = "";

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
    }
    else {
        $email_r =  "/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/";
        if (!preg_match($email_r, $_POST["email"])) {
            $email_err = " enter a valid email";
        }
    }
    if (empty($_POST["phone"])) {
        $phone_err = "please enter your phone *";
    }
    else {
        $phone_r =  "^[0-9]{10}^";
        if (!preg_match($phone_r, $_POST["phone"])) {
            $_err = " enter a valid number";
        }
    }
    if (empty($_POST["message"])) {
        $message_err = "please enter your message *";
    }





    echo $_POST["name"] . "" . "<br>";
    echo $_POST["email"] . "" . "<br>";
    echo $_POST["phone"] . "" . "<br>";
    echo $_POST["message"] . "" . "<br>";
    // echo "<pre>";
    // echo print_r($_FILES["file"]);
    // echo "<pre>";

    $folder = "images/";
    $path = $folder . $_FILES["file"]["name"];
    $temp = $_FILES["file"]["tmp_name"];


    if ($_FILES["file"]["size"] < 1024000) {
        move_uploaded_file($temp, $path);
    } else {
        echo "img size should bee leas than 1mb";

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
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <div class="container">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1"  name="name">
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
                <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
            </div>
            <p class=text-danger>
                <?php
                echo $message_err;
                ?>
            </p>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">File </label>
                <input type="file" class="form-control" id="exampleInputEmail1" name="file"
                    aria-describedby="emailHelp">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>