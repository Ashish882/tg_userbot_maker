<?php session_start(); ?>

<html>
<body>

<p>Entre the channel name example @examplechannel </p>
<form method="post" action="app.php">
  Name: <input type="text" name="channel">
  <input type="submit" name="submit">
</form>

<?php
if (isset($_POST['submit'])) {
    // collect value of input field

    $_SESSION['channel'] = $_POST['channel'];
  
}
?>

</body>
</html>