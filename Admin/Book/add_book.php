<?php
require('../function.php');
session_start();

?>
<!DOCTYPE html>

<html>

<head>


    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" href="bootstrap-5.0.0-beta2-dist/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script type="text/javascript" src="../../bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="../../bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../bootstrap-5.0.0-beta2-dist/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
                <a class="navbar-brand" href="../admin_dashboard.php">Library Management System(LMS)</a>
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
                        <a class="dropdown-item" href="../view_profile.php">
                            View Profile
                        </a>
                        <a class="dropdown-item" href="../edit_profile.php">
                            Edit Profile
                        </a>
                        <a class="dropdown-item" href="../change_password.php">
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

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd">
        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-center">
                <li class="nav-item">
                    <a href="../admin_dashboard.php" class="nav-link">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"> Book </a>
                    <div class="dropdown-menu">
                        <a href="../Book/add_book.php" class="dropdown-item">Add New Book</a>
                        <a href="../Book/manage_book.php" class="dropdown-item">Manage Book</a>
                    </div>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"> Category </a>
                    <div class="dropdown-menu">
                        <a href="../Category/add_cat.php" class="dropdown-item">Add New Category</a>
                        <a href="../Category/manage_cat.php" class="dropdown-item">Manage Category</a>
                    </div>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"> Author</a>
                    <div class="dropdown-menu">
                        <a href="../Author/add_author.php" class="dropdown-item">Add New Author</a>
                        <a href="../Author/manage_author.php" class="dropdown-item">Manage Author</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="../Book/issue_book.php" class="nav-link">
                        Issue Book</a>
                </li>
            </ul>
        </div>
    </nav>



    <span>
        <marquee>This is library Management System. </marquee>
    </span><br><br>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <div class="form-group">
                    <label>Book Name:</label>
                    <input type="text" name="book_name" class="form-control" required="">

                </div>
                <div class="form-group">
                    <label>Book Author:</label>
                    <!-- <input type="text" name="book_author" class="form-control" required=""> -->
                    <select class="form-control" name="book_author">
                        <option>-Select Author-</option>
                        <?php
                        $connection = mysqli_connect("localhost", "root", "");
                        $db = mysqli_select_db($connection, "lms");
                        $query = "select author_name from authors";
                        $query_run = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                            <option><?php echo $row['author_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Category Name:</label>
                    <!-- <input type="text" name="book_cat" class="form-control" required=""> -->
                    <select class="form-control" name="book_cat">
                        <option>-----------Select Category-------------</option>
                        <?php
                        $connection = mysqli_connect("localhost", "root", "");
                        $db = mysqli_select_db($connection, "lms");
                        $query = "select cat_name from category";
                        $query_run = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>
                            <option><?php echo $row['cat_name']; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Book No:</label>
                    <input type="text" name="book_no" class="form-control" required="">
                </div>

                <div class="form-group">
                    <label>Book Price:</label>
                    <input type="text" name="book_price" class="form-control" required="">
                </div>
                <button class="btn btn-primary" name="add_book">Add Book</button>

            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>

</html>

<?php
if (isset($_POST['add_book'])) {
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "lms");
    // For Author
    $author_id = 0;
    $query1 = "select author_id from authors where author_name='$_POST[book_author]'";
    $query_run1 = mysqli_query($connection, $query1);
    while ($row = mysqli_fetch_assoc($query_run1)) {
        $author_id = $row['author_id'];
    }

    //For category
    $cat_id = 0;
    $query2 = "select cat_id from category where cat_name='$_POST[book_cat]'";
    $query_run2 = mysqli_query($connection, $query2);
    while ($row = mysqli_fetch_assoc($query_run2)) {
        $cat_id = $row['cat_id'];
    }
    $query = "insert into books values(null,'$_POST[book_name]',102,$cat_id,$_POST[book_no],$_POST[book_price])";
    $query_run = mysqli_query($connection, $query);
}
?>