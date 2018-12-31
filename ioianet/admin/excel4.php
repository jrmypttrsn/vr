<?php

ob_start();

// Include ezSQL core

include_once "../../../ez_sql_core.php";

// Include ezSQL database specific component (in this case mySQL)

include_once "../../../ez_sql_mysql.php";


//Extract Your Database Fields

$export = $db->get_results("SELECT DISTINCT id,

	CONCAT(firstname,' ',middle,' ',lname) AS Name, status, active

	FROM ioia_names

	LEFT  JOIN ioia_register ON name_id = id

	LEFT  JOIN ioia_training USING ( training_id )

	WHERE  STATUS  =  'AC' 

	ORDER  BY lname, firstname");

foreach ( $db->get_col_info("name") as $name ) {

	$header .= $name."\t";

}

$header.="Farm\tLivestock\tProcess";

if (!$db->num_rows) {

//Setting A Default Message

    echo "\n(0) Records Found!\n";

}

else {

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

    $farm = $db->get_var("SELECT count(*) FROM ioia_register

		LEFT JOIN ioia_training USING ( training_id )

		WHERE $row->id = name_id

		AND DATE_FORMAT(date_end,'%Y') = 0

		AND training_type = 'farm'");

	if(!$farm) $farm=''; else $farm='X';

    $stock = $db->get_var("SELECT count(*) FROM ioia_register

		LEFT JOIN ioia_training USING ( training_id )

		WHERE $row->id = name_id

		AND DATE_FORMAT(date_end,'%Y') = 0

		AND training_type = 'livestock'");

	if(!$stock) $stock=''; else $stock='X';

    $process = $db->get_var("SELECT count(*) FROM ioia_register

		LEFT JOIN ioia_training USING ( training_id )

		WHERE $row->id = name_id

		AND DATE_FORMAT(date_end,'%Y') = 0

		AND training_type = 'process'");

	if(!$process) $process=''; else $process='X';

    $data .= trim($line)."\t".$farm."\t".$stock."\t".$process."\n";

}

$data = str_replace("\r","",$data);



//Setting Up An Automatic Download

header("Content-type: application/vnd.ms-excel");

header("Content-Disposition: attachment; filename=accredited.xls");

header("Pragma: no-cache");

header("Expires: 0"); 

print "$header\n$data";

}

ob_end_flush();

?>



