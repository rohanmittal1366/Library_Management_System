<?php
$connection = mysqli_connect("localhost", "root", "", "lms");
$db = mysqli_select_db($connection, "lms");
// if($connection)echo "Database is connected";
// else echo"Problem Occured";

$query = "insert into users values(null,'$_POST[name]','$_POST[email]','$_POST[password]',$_POST[mobile],'$_POST[address]')";
$mysql_run = mysqli_query($connection, $query);
?>
<script type="text/javascript">
    alert("Registration is successfull ... You may login now.")
    window.location.href = "./index.php";
</script>