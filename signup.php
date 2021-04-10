<!DOCTYPE html>
<?php
require('./Admin/function.php');
?>
<html>

<head>

    <style>
        .error {
            color: #FF0000;
        }

        body {
            background-image: url("./images/bpic1.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #cccccc;
        }
    </style>



    <meta charset="utf-8" name="viewpoint" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.0-beta2-dist/css\bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="signup.css">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <img src="./user/images/abc1.jpeg" width="100" height="60"> &nbsp &nbsp
                <a class="navbar-brand" href="index.php">Library Management System(LMS)</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="./Admin/admin.php">Admin Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="User/user_login.php">User Login</a>
                </li>

            </ul>
        </div>
    </nav><br>

    <?php include 'header.php'; ?>


    <?php

    session_start();
    $name = $email = $password = $mobile = $add = "";
    $nameErr = $emailErr = $passwordErr = $mobileErr = $addErr = "";

    if (isset($_POST['signup'])) {
        $connection = mysqli_connect("localhost", "root", "", "lms");
        $db = mysqli_select_db($connection, "lms");


        $cnt = 0;

        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);

            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            } else {
                $cnt++;
            }
        }
        if (empty($_POST["mobile"])) {
            $mobileErr = "Mobile no. is required";
        } else {
            $mobile = test_input($_POST["mobile"]);
            if (!preg_match("/^[1-9][0-9]{9}$/", $mobile)) {
                $mobileErr = "10 numbers are required and number should not start with 0";
            } else {
                $cnt++;
            }
        }

        if (empty($_POST["password"])) {
            $passwordErr = "Mobile no. is required";
        } else {
            $password = test_input($_POST["password"]);
            if (strlen($_POST["password"]) <= '8') {
                $passwordErr = "Your Password Must Contain At Least 8 Characters!";
            } elseif (!preg_match("#[0-9]+#", $password)) {
                $passwordErr = "Your Password Must Contain At Least 1 Number!";
            } elseif (!preg_match("#[A-Z]+#", $password)) {
                $passwordErr = "Your Password Must Contain At Least 1 Capital Letter!";
            } elseif (!preg_match("#[a-z]+#", $password)) {
                $passwordErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
            } else {
                $cnt++;
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            } else {
                $cnt++;
            }
        }

        if (empty($_POST["add"])) {
            $addErr = "Address is required";
        } else {
            $add = test_input($_POST["add"]);
            $cnt++;
        }

        if ($cnt == 5) {
            $query = "insert into users values(null,'$name','$email','$password',$mobile,'$add')";
            $mysql_run = mysqli_query($connection, $query);
        }
    ?>

        <?php if ($cnt == 5) { ?>
            <script type="text/javascript">
                alert("Registration is successfull ... You may login now.")
                window.location.href = "./User/user_login.php";
            </script>

    <?php }
    }
    ?>


    <div class="registration-form">
        <form action="" method="post">
            <center>
                <h3>User Registration</h3>
            </center>
            <br><br>
            <div class="form-group">
                <p><span class="error">*Required field</span></p>
                &emsp;<span class="error">*</span>
                <input type="text" name="name" placeholder="Full Name" class="form-control item" required>
                <span class="error">&emsp;<?php echo $nameErr; ?></span>

            </div>
            <div class="form-group">
                &emsp;<span class="error">*</span>
                <input type="text" name="email" placeholder="Email" class="form-control item" required>
                <span class="error">&emsp;<?php echo $emailErr; ?></span>
            </div>
            <div class="form-group">
                &emsp;<span class="error">*</span>
                <input type="password" name="password" placeholder="Password" class="form-control item" required>
                <span class="error">&emsp;<?php echo $passwordErr; ?></span>
            </div>
            <div class="form-group">
                &emsp;<span class="error">*</span>
                <input type="text" name="mobile" placeholder="Mobile Number" class="form-control item" maxlength="10" required>
                <span class="error">&emsp;<?php echo $mobileErr; ?></span>
            </div>
            <div class="form-group">
                &emsp;<span class="error">*</span>
                <textarea rows="3" cols="40" placeholder="Address" class="form-control item" name="add"></textarea>
                <span class="error">&emsp;<?php echo $addErr; ?></span>
            </div>
            <div class="form-group">
                <!-- <button type="button" class="btn btn-block create-account">Create Account</button> -->
                <button type="submit" name="signup" class="btn btn-block create-account">Register</button>
            </div>
        </form>

    </div>
    <!-- <form action="" method="post">
                <div class="form-group">
                    <p><span class="error">* required field</span></p>
                    <label for="name">Full Name:</label><br>
                    <input type="text" name="name" class="form-control" required>
                    <span class="error">* <?php echo $nameErr; ?></span>
                    <br><br>

                    <label for="name">Email ID:</label>
                    <input type="text" name="email" class="form-control" required>
                    <span class="error">* <?php echo $emailErr; ?></span>
                    <br><br>

                    <label for="name">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                    <span class="error">* <?php echo $passwordErr; ?></span>
                    <br><br>

                    <label for="name">Mobile Number:</label>
                    <input type="text" name="mobile" class="form-control" maxlength="10" required>
                    <span class="error">* <?php echo $mobileErr; ?></span>
                    <br><br>

                    <label for="name">Address:</label>
                    <textarea rows="3" cols="40" class="form-control" name="add"></textarea>
                    <span class="error">* <?php echo $addErr; ?></span>
                    <br><br>

                </div>
                <button type="submit" name="signup" class="btn btn-primary">Register</button>
            </form> -->





    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>


</body>

</html>