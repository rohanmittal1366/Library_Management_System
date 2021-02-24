<?php
session_start();
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "lms");
$query = "update admins set name='$_POST[name]',mobile='$_POST[mobile]' where email = '$_SESSION[email]'";
$query_run = mysqli_query($connection, $query);
?>
<script type="text/javascript">
    alert("Updated successfully!");
    window.location.href = "admin_dashboard.php";
</script>
