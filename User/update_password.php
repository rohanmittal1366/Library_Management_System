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
$password = "";
$query = "select * from users where email = '$_SESSION[email]'";
$query_run = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($query_run)) {
   $password = $row['password'];
}
if ($password == $_POST['old_password']) {
   $query = "update users set password = '$_POST[new_password]' where email = '$_SESSION[email]'";
   $query_run = mysqli_query($connection, $query);
}
?>
<script type="text/javascript">
   alert("Updated successfully!");
   window.location.href = "user_dashboard.php";
</script>