<?php

session_start();
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "lms");
$book_name = "";
$author = "";
$book_no = "";
$query = "select  (select book_name from books where book_no IN (select books.book_no from books left join issued_books using(book_no) where issued_books.book_no is NULL)) as book_name,
(select book_no from books where book_no IN (select books.book_no from books left join issued_books using(book_no) where issued_books.book_no is NULL)) as book_no,
(select author_name from authors where author_id IN (select author_id from books where book_no IN (select books.book_no from books left join issued_books using(book_no) where issued_books.book_no is NULL)) as author_name";



// $query1 = "select author_name from authors where author_id IN (select author_id from books where book_no IN (select books.book_no from books left join issued_books using(book_no) where issued_books.book_no is NULL))";
// $query = "select book_name,book_author,book_no from issued_books where student_id = $_SESSION[id] and status= 1;";


?>

<!DOCTYPE htm>

<html>

<head>


    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" href="bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        #side_bar {
            background-color: whitesmoke;
            padding: 50px;
            width: 300px;
            height: 450 px;
        }

        body {
            background-image: url("./images/xyz3.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #cccccc;
        }

        table {
            width: 100%;
            border: #000000;
            background-color: white;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <img src="./images/abc1.jpeg" width="100" height="60"> &nbsp &nbsp
                <a class="navbar-brand" href="./user_dashboard.php">Library Management System(LMS)</a>
            </div>
            <font style="color: white">
                <span>
                    <strong>
                        WELCOME : <?php echo $_SESSION['name']; ?></strong>
                </span>
            </font>
            <font style="color: white">
                <span>
                    <strong>
                        EMAIL : <?php echo $_SESSION['email']; ?></strong>
                </span>
            </font>

            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown">
                        My Profile
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="./view_profile.php">
                            <img src="./images/view.png" width="30" height="30">
                            View Profile

                        </a>
                        <a class="dropdown-item" href="./edit_profile.php">
                            <img src="./images/edit.png" width="30" height="30">
                            Edit Profile

                        </a>
                        <a class="dropdown-item" href="./change_password.php">
                            <img src="./images/cpass.png" width="30" height="30">
                            Change Password

                        </a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="../../logout.php">
                        Logout
                    </a></li>
            </ul>
        </div>
    </nav>



    <br>
    <span>
        <marquee> This is Library Management System. </marquee>
    </span><br><br><br>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form>
                <table class="table-bordered" width="900px" style="text-align:center">
                    <tr>
                        <th>Book Name:</th>
                        <th>Book Number:</th>
                        <th>Book Author:</th>

                    </tr>

                    <?php
                    $query_run = mysqli_query($connection, $query);
                    // $query_run1 = mysqli_query($connection, $query1);
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        $book_name = $row['book_name'];
                        $book_no = $row['book_no'];
                        $author = $row['author_name'];

                    ?>
                        <tr>
                            <td><?php echo $book_name; ?></td>
                            <td><?php echo $book_no; ?></td>
                            <td><?php echo $author; ?></td>

                        </tr>

                    <?php
                    }

                    ?>
                </table>
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>





</body>

</html>