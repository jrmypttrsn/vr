<?php include 'admincontrol.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" >
   <title>IOIA Training Events</title>
</head>
<body>
<?php
error_reporting(E_NONE);  //use E_ALL during development & E_NONE for deployment
// Include ezSQL core

include_once "../../../ez_sql_core.php";

// Include ezSQL database specific component (in this case mySQL)

include_once "../../../ez_sql_mysql.php";


$db->hide_errors;
// Register global variables
include("../global.inc.php");
pt_register('GET','yr','id','cmd','loc','type','mbr','nom');
pt_register('POST','cmd','submit','answer','id','yr','mbr','nom');
pt_register('SERVER','PHP_SELF');
/*echo "php_self:".$PHP_SELF." yr:".$yr." cmd:".$cmd." submit:".$submit
	." answer:".$answer." id:".$id;
*/
//Form links back to self with code to determine action.
?>
<center><form action="<?=$PHP_SELF?>" method="post">
	<h1>IOIA Training Events</h1>

<?php

/////////////////////////////////////////////////////////////////////////////////
if($submit=="Change") //Updates selected event.
{
  	pt_register('POST','training_id','city','state','country','date_beg','date_end',
		'training_type','sponsor');
   $db->query("UPDATE ioia_training SET city='".trim($city)."',state='".trim($state)."',
	  	country='".trim($country)."',date_beg='$date_beg',date_end='$date_end',
		training_type='".trim($training_type)."',sponsor='".trim($sponsor)."'
	  	WHERE training_id=$training_id");
}
if($submit=="Save") //Inserts new event.
{
	pt_register('POST','city','state','country','date_beg','date_end',
		'training_type','sponsor');
   $db->query("INSERT INTO ioia_training (city,state,country,date_beg,date_end,
		training_type,sponsor) values ('".$city."','".$state."','".$country
		."','".$date_beg."','".$date_end."','".$training_type."','".$sponsor."')");
}
if($submit=="Delete") // Deletes existing event.
{
	pt_register('POST','training_id','city','state','country','date_beg','date_end',
		'training_type','sponsor');
  	if($answer=="YES")
  	{
  		$db->query("DELETE FROM ioia_training WHERE training_id=$training_id");
  	}
  	else
  	{
		$id=$training_id;
     	$location=$city;
     	if ($state)
		{
			if($location) $location.=", ";
			$location.=$state;
		}
     	if ($country) $location.=", ".$country;
     	?>
		<h2>Are you sure that you want to delete the following event?</h2>
		<?=$location?><br>
		Dates: <?=$date_beg?> to <?=$date_end?><br>
		Type: <?=$training_type?><br>
		Cosponsor: <?=$sponsor?><br>
		<input type="hidden" name="submit" value="Delete">
		<input type="hidden" name="training_id" value="<?=$training_id?>">
		<input type="submit" name="answer" value="YES">
		</form>
		<form action="<?=$PHP_SELF?>" method="post">
		<input type="hidden" name="submit" value="">
		<input type="submit" value="NO">
		</form>
		<?php
	}
}
if($submit=="Save List") //Updates attendee list.
{
  	pt_register('POST','training_id','city','state','country','date_beg','date_end',
		'training_type','sponsor');
	$attendee = $db->get_results("SELECT * FROM ioia_names WHERE lname<>'' ");
	foreach ( $attendee as $att )  // display each attendee.
	{
		pt_register('POST',$att->id);
		if(${$att->id}=="on")
		{
            $db->query("INSERT INTO ioia_register SET
				training_id='".$db->escape($training_id)."',
				name_id='".$db->escape($att->id)."'");
		}
	}
}
if($submit=="Update Grades") //Updates attendee grades.
{
  	pt_register('POST','training_id','city','state','country','date_beg','date_end',
		'training_type','sponsor');
	$attendee = $db->get_results("SELECT * FROM ioia_names
	   LEFT JOIN ioia_register ON id=name_id
		WHERE lname<>'' and training_id=$training_id");
	foreach ( $attendee as $att )  // update grades for each attendee.
	{
		$t = "test".$att->id;
		$g = "grade".$att->id;
		$r = "report".$att->id;
		$c = "certificate".$att->id;
		pt_register('POST',$att->id,$t,$g,$r,$c);
		$db->query("UPDATE ioia_register SET
			test_grade='".${$t}."',
			report_grade='".${$g}."',
			report_rating='".${$r}."',
			certificate='".${$c}."'
			WHERE training_id=$training_id and name_id=$att->id");
	}
}
if($cmd=="add") //Creates form to add new event.
{
	if (!$submit)
   {
		?>
		<h2>Add New Event</h2>
		<table border=0>
			<tr><td>City: </td><td><INPUT TYPE="TEXT" NAME="city" SIZE=30></td></tr>
			<tr><td>State/Province: </td><td><SELECT NAME="state">
			<OPTION></OPTION>
			<?
			//fill state dropdown list from database table
			foreach ($db->get_col("SELECT state FROM `states` ORDER BY `state`",0) as $state )
			{
				echo "<option value='".$state."'>".$state."</option>";
			}
			?>
			</select></td></tr>
			<tr><td>Country: </td><td><SELECT NAME="country">
			<OPTION> </OPTION>
			<?
			//fill country dropdown list from database table
			foreach ($db->get_col("SELECT country FROM `countries`
				ORDER BY `country`",0) as $country )
			{
				echo "<option value='".$country."'>".$country."</option>";
			}
			?>
			</select></td></tr>
			<tr><td>Date Begins: </td><td><INPUT TYPE="TEXT" NAME="date_beg" SIZE=12></td></tr>
			<tr><td>Date Ends: </td><td><INPUT TYPE="TEXT" NAME="date_end" SIZE=12></td></tr>
			<tr><td>Training Type: </td><td><SELECT name="training_type">
			<OPTION> </OPTION>
			<?
			//fill training type dropdown list from database table
			foreach ($db->get_col("SELECT type FROM `trngtype`
				ORDER BY `type`",0) as $type )
			{
				echo "<option value='".$type."'>".$type."</option>";
			}
			?>
<!--			<OPTION>Farm</OPTION>
			<OPTION>Livestock</OPTION>
			<OPTION>Process</OPTION>
			<OPTION>Advanced</OPTION>
			<OPTION>Aquaculture</OPTION>
			<OPTION>GORP</OPTION>
			<OPTION>Crop Standards Workshop</OPTION>
			<OPTION>Livestock Standards Workshop</OPTION>
			<OPTION>Community Grower Group Inspection Workshop</OPTION>
			<OPTION>Train The Trainer</OPTION>
-->			</select></td></tr>
			<tr><td>Cosponsor: </td><td><INPUT TYPE="TEXT" NAME="sponsor" SIZE=45></td></tr>
		</table>
		<input type="hidden" name="cmd" value="">
		<input type="hidden" name="id" value="">
		<input type="hidden" name="yr" value=<?=$yr?>>
		<input type="Submit" name="submit" value="Save">
		<input type="submit" value="Cancel">
		<?php
	}
	?>
</form>
<?php
}
elseif($cmd=='delete')
{
  	if($answer=="YES")
  	{
  		echo 'Attendee <strong>'.$nom.'</strong> Deleted.<br>';
  		$db->query("DELETE FROM ioia_register WHERE training_id=$id AND name_id=$mbr");
?>
		<form action="<?=$PHP_SELF?>" method="post">
		<input type="hidden" name="cmd" value="reg">
		<input type="hidden" name="id" value="<?=$id?>">
		<input type="hidden" name="yr" value="<?=$yr?>">
		<input type="submit" value="OK">
		</form>
<?php
  	}
  	else
  	{
?>
		<h3>Are you sure that you want to delete</h3>
		<h2><?=$nom?></h2>
		<h3>from</h3>
		<h2><?=$type?> training in <?=$yr?> at <?=$loc?>?</h2>
		<input type="hidden" name="cmd" value="delete">
		<input type="hidden" name="id" value="<?=$id?>">
		<input type="hidden" name="mbr" value="<?=$mbr?>">
		<input type="hidden" name="yr" value="<?=$yr?>">
		<input type="hidden" name="nom" value="<?=$nom?>">
		<input type="submit" name="answer" value="YES">
		</form>
		<form action="<?=$PHP_SELF?>" method="post">
		<input type="hidden" name="cmd" value="reg">
		<input type="hidden" name="id" value="<?=$id?>">
		<input type="hidden" name="yr" value="<?=$yr?>">
		<input type="submit" value="NO">
		</form>
<?php
	}
}
else
{
?>
<?php
if(!$id) // No id selected: Creates form to select existing training event.
{
	if (!$yr) // get events for all years when no year chosen
	{
		$training = $db->get_results("SELECT * FROM ioia_training
		ORDER BY date_beg");
	}
	else     // get events for chosen year
	{
		$training = $db->get_results("SELECT * FROM ioia_training
		WHERE YEAR(date_beg) LIKE $yr
		ORDER BY date_beg");
	}
	?>
	<h2>View/Select Events</h2>
	<input type="submit" name="cmd" value="add">
	<p><b> |
	<a href="<?=$PHP_SELF?>?id=&yr=">All</a> |
	<?php
	$yrs = $db->get_col("SELECT DISTINCT YEAR(date_beg) AS year	FROM ioia_training
		ORDER BY year",0);
	foreach ( $yrs as $y )     // show choice of years to display
	{
		?>
		<a href="<?=$PHP_SELF?>?id=&yr=<?=$y?>"><?=$y?></a> |
		<?php
	}
	?>
	&nbsp;</b></p>
	<table border=1>
	<tr>
		<th></th>
		<th>Location</th>
		<th>Start Date</th>
		<th>End Date</th>
		<th>Training Type</th>
		<th>Cosponsor</th>
	</tr>
	<?php
	foreach ( $training as $tr )  // display each training event.
	{
      $location=$tr->city;
      if ($tr->state)
		{
			if($location) $location.=", ";
			$location.=$tr->state;
		}
      if ($tr->country) $location.=', '.$tr->country;
		?>
		<tr>
			<td><a href="<?=$PHP_SELF?>?id=<?=$tr->training_id?>&yr=<?=$yr?>">edit</a></td>
			<td><a href="<?=$PHP_SELF?>?id=<?=$tr->training_id?>&cmd=reg&yr=<?=$yr?>"><?=$location?></a></td>
			<td><?=$tr->date_beg?></td>
			<td><?=$tr->date_end?></td>
			<td><?=$tr->training_type?></td>
			<td><?=$tr->sponsor?></td>
		</tr>
		<?php
	}
	?>
	</table>
	</form>
	<?php
}
else		// id selected: 
{
	if($cmd=='reg') // Creates registration form.
	{
		$trg = $db->get_row("SELECT * FROM ioia_training WHERE training_id=$id");
      $location=$trg->city;
      if ($trg->state)
		{
			if($location) $location.=", ";
			$location.=$trg->state;
		}
      if ($trg->country) $location.=', '.$trg->country;
		?>
		<h2>Attendance Registration</h2> 
		<input type=hidden name="training_id" value="<?=$trg->training_id?>">
		<?=$location?> <a href="<?=$PHP_SELF?>?id=<?=$trg->training_id?>&yr=<?=$yr?>">edit</a>
		<br>
		<?=$trg->training_type?> Training <a href="excel_train.php?trng=<?=$trg->training_id?>">Create Excel</a><br>
		<?=date("F j, Y",strtotime($trg->date_beg))?> to <?=date("F j, Y",strtotime($trg->date_end))?><br>
		<br>
		<?
		if($submit=='Add Attendee')
		{
			echo "Check box to add attendee and Save<br>";
			?>
			<table border=1>
			<?php
			$attendee = $db->get_results("SELECT * FROM ioia_names LEFT JOIN ioia_register
				ON id=name_id and training_id=".$id." WHERE lname<>''  ORDER BY lname,firstname");
			foreach ( $attendee as $att )  // display each attendee.
			{
				$name=$att->firstname." ".$att->middle." ".$att->lname;
				?>
				<tr><td>
				<input type="checkbox" name="<?=$att->id?>" <?if($att->name_id) echo 'checked';?>>
				<?=$name?><br>
				</td></tr>
				<?php
			}
			?>
			</table><br>
				<input type="hidden" name="cmd" value="reg">
				<input type="hidden" name="id" value="<?=$trg->training_id?>">
				<input type="hidden" name="yr" value=<?=$yr?>>
				<input type="Submit" name="submit" value="Save List">
			</form>
			<form>
				<input type="hidden" name="cmd" value="">
				<input type="hidden" name="id" value="">
				<input type="hidden" name="yr" value=<?=$yr?>>
				<input type="submit" value="Return to List">
			</form

			<?

		}
		else
		{
			?>
			<table border=1>
			<tr>
				<th></th>
				<th>Attendee</th>
				<th>Special Diet</th>
				<th>Test Grade</th>
				<th>Report Grade</th>
				<th>Report Rating</th>
				<th>Certificate</th>
			</tr>
			<?php
			$attendee = $db->get_results("SELECT * FROM ioia_register LEFT JOIN ioia_names
				ON id=name_id WHERE training_id=$id ORDER BY lname,firstname");
			foreach ( $attendee as $att )  // display each attendee.
			{
				$name=$att->firstname." ".$att->middle." ".$att->lname;
				?>
				<tr>
					<td><a href="<?=$PHP_SELF?>?id=<?=$id?>&loc=<?=$location?>&type=<?=$trg->training_type?>&cmd=delete&yr=<?=$yr?>&mbr=<?=$att->name_id?>&nom=<?=$name?>">Oops</a></td>
					<td><?=$name?></td>
					<td><?=$att->special_diet?></td>
					<td><input type="text" name="test<?=$att->name_id?>" size="3"
					value="<?=$att->test_grade?>"></td>
					<td><input type="text" name="grade<?=$att->name_id?>" size="3"
					value="<?=$att->report_grade?>"></td>
					<td><select name="report<?=$att->name_id?>">
   					<option><?=$att->report_rating?></option>
						<option></option>
						<option>Unsatisfactory</option>
						<option>Satisfactory</option>
						<option>Good</option>
						<option>Excellent</option>
					</select>
					</td>
					<td><select name="certificate<?=$att->name_id?>">
						<option><?=$att->certificate?></option>
						<option></option>
						<option>Attendance</option>
						<option>Completion</option>
						<option>Trainer</option>
					</select>
					</td>
				</tr>
				<?php
			}
			?>
			</table><br>
				<input type="hidden" name="cmd" value="reg">
				<input type="hidden" name="id" value="<?=$trg->training_id?>">
				<input type="hidden" name="yr" value=<?=$yr?>>
				<input type="Submit" name="submit" value="Update Grades">

				<input type="Submit" name="submit" value="Add Attendee">
			</form>
			<form>
				<input type="hidden" name="cmd" value="">
				<input type="hidden" name="id" value="">
				<input type="hidden" name="yr" value=<?=$yr?>>
				<input type="submit" value="Return to List">
			</form

			<?
		}
	}
	else  //Creates form to edit existing event.
	{
		$trg = $db->get_row("SELECT * FROM ioia_training WHERE training_id=$id");
		?>
		<h2>Edit Existing Event</h2>
		<input type=hidden name="training_id" value="<?=$trg->training_id?>">
		<table border=1>
		<tr>
			<th>Field Name</th>
			<th>Current Value</th>
			<th>Change to:</th>
		</tr>
			<tr>
				<td>City: </td><td><?=$trg->city?></td>
				<td><INPUT TYPE="TEXT" NAME="city" VALUE="<?=$trg->city?>" SIZE=30></td>
			</tr>
			<tr>
				<td>State/Province: </td><td><?=$trg->state?></td>
				<td><SELECT NAME="state">
   			<option VALUE="<?=$trg->state?>"><?=$trg->state?></option>
				<OPTION></OPTION>
				<?
				//fill state dropdown list from database table
				foreach ($db->get_col("SELECT state FROM `states` ORDER BY `state`",0) as $state )
				{
					echo "   <option value='".$state."'>".$state."</option>";
				}
				?>
				</select></td></tr>
			<tr>
				<td>Country: </td><td><?=$trg->country?></td>
				<td><SELECT NAME="country">
   			<option VALUE="<?=$trg->country?>"><?=$trg->country?></option>
				<OPTION></OPTION>
				<?
				//fill country dropdown list from database table
				foreach ($db->get_col("SELECT country FROM `countries`
					ORDER BY `country`",0) as $country )
				{
					echo "   <option value='".$country."'>".$country."</option>";
				}
				?>
				</select></td></tr>
			<tr>
				<td>Date Begins: </td><td><?=$trg->date_beg?></td>
				<td><INPUT TYPE="TEXT" NAME="date_beg" VALUE="<?=$trg->date_beg?>" SIZE=12></td>
			</tr>
			<tr>
				<td>Date Ends: </td><td><?=$trg->date_end?></td>
				<td><INPUT TYPE="TEXT" NAME="date_end" VALUE="<?=$trg->date_end?>" SIZE=12></td>
			</tr>
			<tr>
				<td>Training Type: </td><td><?=$trg->training_type?></td>
				<td><select name="training_type">
				<OPTION SELECTED VALUE="<?=$trg->training_type?>"><?=$trg->training_type?></OPTION>
				<OPTION></OPTION>
			<?
			//fill training type dropdown list from database table
			foreach ($db->get_col("SELECT type FROM `trngtype`
				ORDER BY `type`",0) as $type )
			{
				echo "<option value='".$type."'>".$type."</option>";
			}
			?>
<!--			<OPTION>Farm</OPTION>
			<OPTION>Livestock</OPTION>
			<OPTION>Process</OPTION>
			<OPTION>Advanced</OPTION>
			<OPTION>Aquaculture</OPTION>
			<OPTION>GORP</OPTION>
			<OPTION>Crop Standards Workshop</OPTION>
			<OPTION>Livestock Standards Workshop</OPTION>
			<OPTION>Community Grower Group Inspection Workshop</OPTION>
			<OPTION>Train The Trainer</OPTION>
-->				</select></td>
			</tr>
			<tr>
				<td>Cosponsor: </td><td><?=$trg->sponsor?></td>
				<td><INPUT TYPE="TEXT" NAME="sponsor" VALUE="<?=$trg->sponsor?>" SIZE=60></td></tr>
		</table>
		<input type="hidden" name="cmd" value="">
		<input type="hidden" name="id" value="">
		<input type="hidden" name="yr" value=<?=$yr?>>
		<input type="Submit" name="submit" value="Change">
		<input type="submit" value="Cancel">
		<input type="submit" name="submit" value="Delete">
		</form>
		<?php
	}
}
}
?>
</body>
</html>
