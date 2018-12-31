<?php // accesscontrol.php

session_start();

// Include ezSQL core

include_once "../../ez_sql_core.php";

// Include ezSQL database specific component (in this case mySQL)

include_once "../../ez_sql_mysql.php";

$uid = isset($_POST['uid']) ? $_POST['uid'] : $_SESSION['uid'];

$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : $_SESSION['pwd'];


if(!isset($uid)) {

  ?>

  <!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN"

    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>

    <title> Please Log In for Access </title>

    <meta http-equiv="Content-Type"

      content="text/html; charset=iso-8859-1" />

  </head>

  <body>

  <h1> Login Required </h1>

  <p>You must log in to access this area of the site. If you are

     not an IOIA member, contact the IOIA office to sign up for

	  online access!</p>

  <p><form method="post" action="<?=$_SERVER['PHP_SELF']?>">

    User ID: <input type="text" name="uid" size="16" /><br />

    Password: <input type="password" name="pwd" SIZE="8" /><br />

    <input type="submit" value="Log in" />

  </form></p>

<!-- remove the following after update is complete
<p>This part of the site is being updated. It is expected to be online again
on January 25, 2008.</p>                         -->
  </body>

  </html>

  <?php

  exit;

}



$_SESSION['uid'] = $uid;

$_SESSION['pwd'] = $pwd;


/*
$user = $db->get_row("SELECT * FROM ioia_names WHERE

        userid = '$uid' AND password = PASSWORD('$pwd')");
*/
$user = $db->get_row("SELECT * FROM ioia_names WHERE

        userid = '$uid' AND password = '$pwd'");


if ($db->num_rows == 0) {

  unset($_SESSION['uid']);

  unset($_SESSION['pwd']);

  ?>

  <!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.0 Transitional//EN"

    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

  <html xmlns="http://www.w3.org/1999/xhtml">

  <head>

    <title> Access Denied </title>

    <meta http-equiv="Content-Type"

      content="text/html; charset=iso-8859-1" />

  </head>

  <body>

  <h1> Access Denied </h1>

  <p>Your user ID or password is incorrect, or you are not a

     registered user on this site. To try logging in again, click

     <a href="<?=$_SESSION['PHP_SELF']?>">here</a>.</p>

  </body>

  </html>

  <?php

  exit;

}

$_SESSION['id']=$user->id;

?>

