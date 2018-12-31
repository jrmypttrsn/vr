<?php

ob_start();

// Include ezSQL core

include_once "../../../ez_sql_core.php";

// Include ezSQL database specific component (in this case mySQL)

include_once "../../../ez_sql_mysql.php";


//Extract Your Database Fields

$export = $db->get_results("SELECT CONCAT(firstname,' ',middle,' ',lname) AS Name,

	bus_name AS Business, address1, address2, city, state_code, zip, country, status 

	FROM ioia_names

	LEFT JOIN countries ON country_code = country_id

	WHERE active = 'yes' OR status = 'NEWS'");

foreach ( $db->get_col_info("name")  as $name ) {

	$header .= $name."\t";

}



//Extract Your Data

ob_clean();

foreach($export as $row) {

    $line = '';

    foreach($row as $value) {

        if ((!isset($value)) OR ($value == "")) {

            $value = "\t";

        } else {

            $value = str_replace('"', '""', $value);

            $value = '"' . $value . '"' . "\t";

        }

        $line .= $value;

    }

    $data .= trim($line)."\n";

}

$data = str_replace("\r","",$data);



//Setting A Default Message

if ($data == "") {

    $data = "\n(0) Records Found!\n";

}



//Setting Up An Automatic Download

header("Content-type: application/vnd.ms-excel");

header("Content-Disposition: attachment; filename=maillist-all.xls");

header("Pragma: no-cache");

header("Expires: 0"); 

print "$header\n$data";

ob_end_flush();

?>

