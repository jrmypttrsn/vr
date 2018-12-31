<?php

// Include ezSQL core

include_once "../../../ez_sql_core.php";

// Include ezSQL database specific component (in this case mySQL)

include_once "../../../ez_sql_mysql.php";


echo "<h1>Name Index</h1>";

//Extract Your Database Fields

$export = $db->get_results("SELECT CONCAT(firstname,' ',middle,' ',lname) AS name, status

	FROM ioia_names

	WHERE  (status = 'AC' OR status = 'I' OR status = 'AP') AND active = 'yes'

	ORDER  BY lname, firstname");

foreach($export as $row)

{

	if($row->status=='AC')

	{

		echo "<strong>".$row->name."*</strong><br>";

	}

	else

	{

		echo $row->name."<br>";

	}

}

?>

