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
    </style>

    <!-- <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href=""> -->

    <meta charset="utf-8" name="viewpoint" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.0-beta2-dist/css\bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Library Management System(LMS)</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="./Admin/admin.php">Admin Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="User/user_login.php">User Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">Register</a>
                </li>
            </ul>
        </div>
    </nav><br>

    <span>
        <marquee> This is Library Management System. </marquee>
    </span><br>

    <div class="row">

        <div class="col-md-4" id="side_bar">
            <h5>Library Timing</h5>
            <ul>

                <li>Opening Timing:8:00 AM</li>
                <li>Closing Timing:8:00 PM</li>
                <li>(Sunday Off)</li>
            </ul>
            <h5>What we Provide</h5>
            <ul>

                <li>Full Ferniture</li>
                <li>Free Wi-Fi</li>
                <li>News Paper</li>
                <li>Discussion Room</li>
                <li>RO Water</li>
                <li>Peacefull Environment</li>
            </ul>
        </div>



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
                }
                
                else {
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
                    window.location.href = "./signup.php";
                </script>

        <?php }
        }
        ?>


        <div class="col-md-8" id="main_content">
            <center>
                <h3>User Registration</h3>
            </center>

            <form action="" method="post">
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
            </form>
        </div>
    </div>



    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>


</body>

</html>