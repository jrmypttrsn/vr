<?php include 'admincontrol.php'; ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">

<html>

<!--

   HTML 3.2

   Document type as defined on http://www.w3.org/TR/REC-html32

-->

<head>

       <title>IOIA Admin Options</title>

</head>

<body>

<center><h1>IOIA Admin Options</h1>

<h2>Choose Data Entry Activity:</h2>

<form action="names.php"><input type="submit" value="Names"></form>

<form action="training.php"><input type="submit" value="Training"></form>

<h2>Download Excel Table</h2>

<form action="excel4.php"><input type="submit" value="Accredited Inspectors"></form>

<form action="active_excel.php"><input type="submit" value="Active Inspector Members"></form>

<form action="news.php"><input type="submit" value="Newsletter Only"></form>

<form action="excel-all.php"><input type="submit" value="Entire List with Member/Active Status"></form>

<strong>Choose the Newsletter Mailing List Type:</strong>

<form action="excel1.php"><input type="submit" value="All Active Members & Newsletter"></form>

<form action="excel2.php"><input type="submit" value="Single Copy"></form>

<form action="excel3.php"><input type="submit" value="Multiple Copies"></form>

<h2>View Indices:</h2>

<form action="lang_index.php"><input type="submit" value="Language Index"></form>

<form action="geog_index.php"><input type="submit" value="Geographical Index"></form>

<form action="name_index.php"><input type="submit" value="Name Index"></form>

</center>

</body>

</html>

