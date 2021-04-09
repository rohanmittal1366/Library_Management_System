<?php
session_start();


if (!isset($_SESSION['email'])) {
?>
    <script type="text/javascript">
        alert("You are not Logged-in ")
        window.location.href = "../index.php";
    </script>
<?php
}

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "lms");
$query = "update users set name='$_POST[name]',mobile='$_POST[mobile]',address='$_POST[address]' where email = '$_SESSION[email]'";
$query_run = mysqli_query($connection, $query);
?>
<script type="text/javascript">
    alert("Updated successfully!");
    window.location.href = "user_dashboard.php";
</script>