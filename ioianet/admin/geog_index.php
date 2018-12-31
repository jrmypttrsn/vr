<?php

// Include ezSQL core

include_once "../../../ez_sql_core.php";

// Include ezSQL database specific component (in this case mySQL)

include_once "../../../ez_sql_mysql.php";


echo "<h1>Geographical Index</h1>";

$country='';

$region='';

//Extract Your Database Fields

$export = $db->get_results("SELECT country, region, state_code AS state,

	CONCAT(firstname,' ',middle,' ',lname) AS name

	FROM ioia_names

	LEFT  JOIN states ON state_id = state_code

	LEFT  JOIN countries ON country_id = country_code

	WHERE  (status = 'AC' OR status = 'I' OR status = 'AP') AND active = 'yes'

	ORDER  BY country, region, lname, firstname");

foreach($export as $row)

{

	if($row->country!=$country)

	{

		echo "<br><strong>".$row->country."</strong><br>";

		$country=$row->country;

	}

	if($row->region!=$region)

	{

		echo "<br><strong>".$row->region."</strong><br>";

		$region=$row->region;

	}

	if($row->state=='')

	{

		echo $row->name."<br>";

	}

	else

	{

		echo $row->name.", ".$row->state."<br>";

	}

}

?>

