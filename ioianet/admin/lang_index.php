<?php

// Include ezSQL core

include_once "../../../ez_sql_core.php";

// Include ezSQL database specific component (in this case mySQL)

include_once "../../../ez_sql_mysql.php";


echo "<h1>Language Index</h1>";

$lang='';

//Extract Your Database Fields

$export = $db->get_results("SELECT language, lang_ability,

	CONCAT(firstname,' ',middle,' ',lname) AS name

	FROM ioia_names

	LEFT  JOIN language_ability ON name_id = id

	LEFT  JOIN languages USING ( lang_id )

	WHERE  (status = 'AC' OR status = 'I' OR status = 'AP') AND active = 'yes'

	ORDER  BY language, lname, firstname");

foreach($export as $row)

{

	if($row->language!=$lang)

	{

		echo "<br><strong>".$row->language."</strong><br>";

		$lang=$row->language;

	}

	echo $row->name;

	if($row->lang_ability!='F') echo ' - '.$row->lang_ability;

	echo "<br>";

}

?>

