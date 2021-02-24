<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">

    <meta charset="utf-8" name="viewpoint" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap-5.0.0-beta2-dist/css\bootstrap.min.css">
    <script type="text/javascript" src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
    <style type="text/css">
        #side_bar {
            background-color: whitesmoke;
            padding: 50px;
            width: 300px;
            height: 450 px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="admin_dashboard">Library Management System(LMS)</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Admin Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../User/user_login.php">User Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../signup.php">Register</a>
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

        <div class="col-md-8" id="main_content">
            <center>
                <h3>Admin Login Form</h3>
            </center>
            <form action="" method="post">
                <div class="form-group">

                    <label for="name">Email ID:</label>
                    <input type="text" name="email" class="form-control" required>
                </div><br>
                <div class="form-group">
                    <label for="name">Password:</label>
                    <input type="password" name="password" class="form-control" required>

                </div><br>
                <button type="submit" name="login" class="btn btn-primary">Login</button>
            </form>

            <?php
            session_start();
            if (isset($_POST['login'])) {
                $connection = mysqli_connect("localhost", "root", "");
                $db = mysqli_select_db($connection, "lms");
                $query = "select * from admins where email = '$_POST[email]'";
                $query_run = mysqli_query($connection, $query);
                $cnt = 0;
                while ($row = mysqli_fetch_assoc($query_run)) {
                    if ($row['email'] == $_POST['email']) {
                        if ($row['password'] == $_POST['password']) {
                            $_SESSION['name'] = $row['name'];
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['id'] = $row['id'];
                            header("Location: admin_dashboard.php");
                        } else {
                        ?>
                            <br><br>
                            <center><span class="alert-danger">Wrong Password</span></center>

                    <?php
                        }
                        $cnt = 1;
                    }
                }
                if ($cnt === 0) {
                    ?>
                    <br><br>
                    <center><span class="alert-danger">Wrong Email</span></center>
            <?php
                }
            }
            ?>

        </div>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</body>

</html>