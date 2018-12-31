<?php include 'admincontrol.php'; ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"

    "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" >

   <title>IOIA Admin Page</title>

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

if($_GET['id']) $id = $_GET['id'];

if($_GET['alpha']) $alpha = $_GET['alpha'];

//pt_register('GET','alpha','id');

$PHP_SELF = $_SERVER[PHP_SELF];

//pt_register('SERVER','PHP_SELF');

//pt_register('POST','cmd','submit','select','chgpw','newpw','newpw2','userid','id','alpha');



$cmd = $_POST[cmd];

$submit = $_POST[submit];

$select = $_POST[select];

$chgpw = $_POST[chgpw];

$newpw = $_POST[newpw];

$newpw2 = $_POST[newpw2];

$userid = $_POST[userid];

if($_POST['id']) $id = $_POST['id'];

if($_POST['alpha']) $alpha = $_POST['alpha'];

//echo 'id: '.$id.' alpha: '.$alpha.'<br>';

//echo " cmd: ".$cmd." submit: ".$submit." select: ".$select;

//echo ' uid: '.$uid.' result: '.$user->id;



//Form links back to self with code to determine action.

?>

<form action="<?=$PHP_SELF?>" method="post">

<h1>IOIA Membership Directory Listing</h1>

<input type="hidden" name="id" value=<?=$id?>>

<?php

if(!$id) //generates selection form.

{

	if($cmd=="add") //Creates form to add new member.

	{

		?>

		<h2>Add New Member</h2>

		<table border=0>

		<tr><td>First Name: </td><td><INPUT TYPE="TEXT" NAME="firstname" SIZE=30></td></tr>

		<tr><td>Middle Name: </td><td><INPUT TYPE="TEXT" NAME="middle" SIZE=30></td></tr>

		<tr><td>Last Name: </td><td><INPUT TYPE="TEXT" NAME="lname" SIZE=30></td></tr>

		<tr><td>Business Name: </td><td><INPUT TYPE="TEXT" NAME="bus_name" SIZE=30></td></tr>

		<tr><td>Address line 1: </td><td><INPUT TYPE="TEXT" NAME="address1" SIZE=30></td></tr>

		<tr><td>Address line 2: </td><td><INPUT TYPE="TEXT" NAME="address2" SIZE=30></td></tr>

		<tr><td>City: </td><td><INPUT TYPE="TEXT" NAME="city" SIZE=30></td></tr>

		<tr><td>State/Province: </td><td><SELECT NAME="state_code">

		<OPTION></OPTION>

		<?PHP

			//fill state dropdown list from database table

			$stts = $db->get_results("SELECT * FROM `states` ORDER BY `state`");

			foreach ($stts as $st )

			{

				echo "<option value='".$st->state_id."'>".$st->state."</option>";

			}

			?>

			</select></td></tr>

		<tr><td>Postal Code: </td><td><INPUT TYPE="TEXT" NAME="zip" SIZE=30></td></tr>

		<tr><td>Country: </td><td><SELECT NAME="country_code">

		<OPTION></OPTION>

		<?

			//fill country dropdown list from database table

			$cntry = $db->get_results("SELECT * FROM `countries` ORDER BY `country`");

			foreach ($cntry as $cn )

			{

				echo "   <option value='".$cn->country_id."' SIZE=30>".$cn->country."</option>";

			}

			?>

			</select></td></tr>

		<tr><td>Home Phone: </td><td><INPUT TYPE="TEXT" NAME="hphone" SIZE=30></td></tr>

		<tr><td>Cell Phone: </td><td><INPUT TYPE="TEXT" NAME="cphone" SIZE=30></td></tr>

		<tr><td>Work Phone: </td><td><INPUT TYPE="TEXT" NAME="wphone" SIZE=30></td></tr>

		<tr><td>Fax: </td><td><INPUT TYPE="TEXT" NAME="fax" SIZE=30></td></tr>

		<tr><td>Email: </td><td><INPUT TYPE="TEXT" NAME="email" SIZE=60></td></tr>

		<tr><td>Number of Newsletters: </td><td><INPUT TYPE="TEXT" NAME="num_news" SIZE=30></td></tr>

		<tr><td>Subscription: </td><td><INPUT TYPE="TEXT" NAME="subscription" SIZE=30></td></tr>

		<tr><td>Status: </td><td><select name="status">

			<option value=""></option>

			<option value="I">Inspector</option>

			<option value="AC">Accredited Inspector</option>

			<option value="AP">Apprentice Inspector</option>

			<option value="SI">Supporting Individual</option>

			<option value="SB">Supporting Business</option>

			<option value="SCA">Supporting Certification Agency</option>

			<option value="NEWS">Newsletter</option>

			<option value="PEND">Pending</option>

			<option value="PATR">Patron Member</option>

			<option value="SUST">Sustaining Member</option>


		</select><br></td></tr>

		</table>

		<input type="hidden" name="cmd" value="">

		<input type="Submit" name="submit" value="Save">

		<input type="Submit" value="Cancel">

		</form>

		<?php

	}

	else

	{

	?>

	<h2>View/Select Names</h2>

	<p align="center"><b> |

	<a href="<?=$PHP_SELF?>?alpha=">All</a> |

	<a href="<?=$PHP_SELF?>?alpha=A">A</a> |

	<a href="<?=$PHP_SELF?>?alpha=B">B</a> |

  	<a href="<?=$PHP_SELF?>?alpha=C">C</a> |

	<a href="<?=$PHP_SELF?>?alpha=D">D</a> |

	<a href="<?=$PHP_SELF?>?alpha=E">E</a> |

	<a href="<?=$PHP_SELF?>?alpha=F">F</a> |

	<a href="<?=$PHP_SELF?>?alpha=G">G</a> |

  	<a href="<?=$PHP_SELF?>?alpha=H">H</a> |

	<a href="<?=$PHP_SELF?>?alpha=I">I</a> |

	<a href="<?=$PHP_SELF?>?alpha=J">J</a> |

	<a href="<?=$PHP_SELF?>?alpha=K">K</a> |

	<a href="<?=$PHP_SELF?>?alpha=L">L</a> |

	<a href="<?=$PHP_SELF?>?alpha=M">M</a> |

  	<a href="<?=$PHP_SELF?>?alpha=N">N</a> |

	<a href="<?=$PHP_SELF?>?alpha=O">O</a> |

  	<a href="<?=$PHP_SELF?>?alpha=P">P</a> |

  	<a href="<?=$PHP_SELF?>?alpha=Q">Q</a> |

  	<a href="<?=$PHP_SELF?>?alpha=R">R</a> |

  	<a href="<?=$PHP_SELF?>?alpha=S">S</a> |

	<a href="<?=$PHP_SELF?>?alpha=T">T</a> |

	<a href="<?=$PHP_SELF?>?alpha=U">U</a> |

  	<a href="<?=$PHP_SELF?>?alpha=V">V</a> |

	<a href="<?=$PHP_SELF?>?alpha=W">W</a> |

	<a href="<?=$PHP_SELF?>?alpha=X">X</a> |

	<a href="<?=$PHP_SELF?>?alpha=Y">Y</a> |

	<a href="<?=$PHP_SELF?>?alpha=Z">Z</a> |

	&nbsp;</b></p>

	<input type="submit" name="cmd" value="add">

	<table border=1>

	<tr><th>Name</th><th>State/Province</th><th>Country</th></tr>

	<?PHP

	$names = $db->get_results("SELECT * FROM ioia_names

		LEFT JOIN states ON state_code = state_id

		LEFT JOIN countries ON country_code = country_id

		WHERE lname LIKE '".$alpha."%'

		ORDER BY lname,bus_name ");

	foreach ($names as $n)

  	{

		$name = stripslashes($n->firstname).' '.stripslashes($n->middle).' '

		  .stripslashes($n->lname);

  		if($n->bus_name) $name.=' - '.stripslashes($n->bus_name);

		?>

		<td align="left"><a href="<?=$PHP_SELF?>?id=<?=$n->id?>&alpha=<?=$alpha?>"><?=$name?></a></td>

		<td align="left"><?=stripslashes($n->state)?></td>

		<td align="left"><?=stripslashes($n->country)?></td></tr>

		<?php

	}

	?>

	</table>

	</form>

	<?php

	}

   if($submit=="Save") // Adds new member record.

   {

   	pt_register("POST","bus_name", "firstname", "middle", "lname", "address1",

			"address2", "city", "state_code", "zip", "country_code", "hphone", "cphone",

			"wphone", "fax", "email");

      $db->query("INSERT INTO ioia_names SET

			firstname='".$db->escape($firstname)."',

			middle='".$db->escape($middle)."',

			lname='".$db->escape($lname)."',

			bus_name='".$db->escape($bus_name)."',

			address1='".$db->escape($address1)."',

			address2='".$db->escape($address2)."',

			city='".$db->escape($city)."',

			state_code='".$db->escape($state_code)."',

		  	zip='".$db->escape($zip)."',

			country_code='".$db->escape($country_code)."',

			hphone='".$db->escape($hphone)."',

			cphone='".$db->escape($cphone)."',

		  	wphone='".$db->escape($wphone)."',

			fax='".$db->escape($fax)."',

			email='".$db->escape($email)."'");

	}

}

else

{

   if($submit=="Update Address") //Updates selected member record.

   {

   	pt_register("POST","bus_name", "firstname", "middle", "lname", "address1",

			"address2", "city", "state_code", "zip", "country_code", "hphone", "cphone",

			"wphone", "fax", "email");

      $db->query("UPDATE ioia_names SET

			firstname='".$db->escape($firstname)."',

			middle='".$db->escape($middle)."',

			lname='".$db->escape($lname)."',

			bus_name='".$db->escape($bus_name)."',

			address1='".$db->escape($address1)."',

			address2='".$db->escape($address2)."',

			city='".$db->escape($city)."',

			state_code='".$db->escape($state_code)."',

		  	zip='".$db->escape($zip)."',

			country_code='".$db->escape($country_code)."',

			hphone='".$db->escape($hphone)."',

			cphone='".$db->escape($cphone)."',

		  	wphone='".$db->escape($wphone)."',

			fax='".$db->escape($fax)."',

			email='".$db->escape($email)."'

		  	WHERE id=$id");

	}

   if($submit=="Update Admin") //Updates selected member record.

   {

   	pt_register("POST","status", "subscription", "num_news", "training", "active", "comment");

      $db->query("UPDATE ioia_names SET

			status='".$db->escape($status)."',

			num_news='".$db->escape($num_news)."',

			subscription='".$db->escape($subscription)."',

			training='".$db->escape($training)."',

			active='".$db->escape($active)."',

			comment='".strip_tags($db->escape($comment))."'

		  	WHERE id=$id");

	}

   if($submit=="Update Directory") //Updates selected member record.

   {

   	pt_register("POST","other_training", "inspect_org", "farm_exp", "livestock_exp",

			"process_exp", "academic", "personal", "other_farm", "other_livestock",

			"other_process", "mentor", "consult", "review");

		$dir_exists = $db->get_var("SELECT count(*) FROM ioia_directory WHERE name_id=$id");

		if(!$dir_exists)

		{

			$db->query("INSERT INTO ioia_directory SET

			other_training='".$db->escape($other_training)."',

			inspect_org='".$db->escape($inspect_org)."',

			farm_exp='".implode(', ',$_POST['farmx'])."',

			other_farm_exp='".$db->escape($other_farm)."',

			livestock_exp='".implode(', ',$_POST['stockx'])."',

			other_livestock_exp='".$db->escape($other_livestock)."',

			process_exp='".implode(', ',$_POST['processx'])."',

			other_process_exp='".$db->escape($other_process)."',

			academic='".$db->escape($academic)."',

			personal='".$db->escape($personal)."',

			mentor='".$mentor."',

			consult='".$consult."',

			review='".$review."',

		  	name_id='".$db->escape($id)."'");

		}

		else

		{

			$db->query("UPDATE ioia_directory SET

			other_training='".$db->escape($other_training)."',

			inspect_org='".$db->escape($inspect_org)."',

			farm_exp='".implode(', ',$_POST['farmx'])."',

			other_farm_exp='".$db->escape($other_farm)."',

			livestock_exp='".implode(', ',$_POST['stockx'])."',

			other_livestock_exp='".$db->escape($other_livestock)."',

			process_exp='".implode(', ',$_POST['processx'])."',

			other_process_exp='".$db->escape($other_process)."',

			academic='".$db->escape($academic)."',

			mentor='".$mentor."',

			consult='".$consult."',

			review='".$review."',

			personal='".$db->escape($personal)."'

		  	WHERE name_id=$id");

		}

	}

   if($submit=="Delete Language") //Deletes language from selected member record.

        {

					$db->query("DELETE FROM language_ability
					WHERE lang_abil_id='".$_POST['la_id']."'");

        }
   if($submit=="Add Language") //Adds language to selected member record.

   {

				$db->query("INSERT INTO language_ability SET

				lang_id='".$_POST['langid']."',

				lang_ability='".$_POST['lang_ability']."',

			  	name_id='".$id."'");

			}

	}

// This section displays the directory listing for an individual inspector.

$member = $db->get_row("SELECT * FROM ioia_names

 		LEFT JOIN states ON state_code = state_id

		LEFT JOIN countries ON country_code = country_id

		WHERE id = $id");

$name=stripslashes($member->firstname).' '.stripslashes($member->middle).' '

	.stripslashes($member->lname);

if($name) $name.='<br>';

$business=stripslashes($member->bus_name);

if($business) $business.='<br>';

$addr1=stripslashes($member->address1);

if($addr1) $addr1.='<br>';

$addr2=stripslashes($member->address2);

if($addr2) $addr2.='<br>';

$city=stripslashes($member->city).', '.stripslashes($member->state_code).' '

	.stripslashes($member->zip);

if($city) $city.='<br>';

$country=$db->get_var("SELECT country FROM countries

	WHERE country_id='$member->country_code'");

if($country) $country.='<br>';

if($member->status=='I') {

	$name_bus='<b><big>'.$name.'</big></b>'.$business;

	$status='<b><big>Inspector</big></b>';

}

if($member->status=='AP') {

	$name_bus='<b><big>'.$name.'</big></b>'.$business;

	$status='<b><big>Apprentice Inspector</big></b>';

}

if($member->status=='AC')	{

	$name_bus='<b><big>'.$name.'</big></b>'.$business;

	$status='<b><big>Accredited Inspector</big></b>';

}

if($member->status=="SI") {

	$name_bus='<b><big>'.$name.'</big></b>'.$business;

	$status='<b><big>Supporting Individual</big></b>';

}

if($member->status=="SCA") {

	$name_bus='<b><big>'.$business.'</big></b>'.$name;

	$status='<b><big>Supporting Certification Agency</big></b>';

}

if($member->status=="SB") {

	$name_bus='<b><big>'.$business.'</big></b>'.$name;

	$status='<b><big>Supporting Business</big></b>';

}

if($member->status=="NEWS") {

	$name_bus='<b><big>'.$business.'</big></b>'.$name;

	$status='<b><big>Newsletter</big></b> ('.$member->subscription.')';

}

if($member->status=="PEND") {

	$name_bus='<b><big>'.$name.'</big></b>'.$business;

	$status='<b><big>Pending</big></b>';

}

if($member->status=="PATR") {

	$name_bus='<b><big>'.$name.'</big></b>'.$business;

	$status='<b><big>Patron Member</big></b>';

}

if($member->status=="SUST") {

	$name_bus='<b><big>'.$name.'</big></b>'.$business;

	$status='<b><big>Sustaining Member</big></b>';

}

if($member->status=="") {

	$name_bus='<b><big>'.$name.'</big></b>'.$business;

	$status='<b><big>No Status Listed</big></b>';

}

if($member->active=='yes') $status.=' (active)';

if($member->active=='no') $status.=' (inactive)';



// This section creates the list of training and accreditation status.

	$transcript=$db->get_results("SELECT training_type AS type, DATE_FORMAT(date_end, '%Y') AS year

		FROM ioia_register

		LEFT JOIN ioia_training USING ( training_id )

		WHERE name_id = $member->id AND certificate = 'Completion'

		ORDER BY type, year");

	$lasttype='new';

	$tran_list='';

	unset($accred);

	foreach ($transcript AS $tran)

	{

		if($tran->year==0)

		{

			$accred[].=$tran->type;

		}

		elseif($lasttype!=$tran->type)

		{

			if($tran_list)

			{

				$tran_list.=') ';

			}

    		$tran_list.=$tran->type.' (';

			$tran_list.=$tran->year;

			$lasttype=$tran->type;

		}

		else

		{

			$tran_list.=', '.$tran->year;



		}

	}

	$tran_list.=')';

if($accred) $status.=" (".implode(', ',$accred).")";

//if($status) $status.='<br>';

	// Add Training Coordinator Info.

	$transcript=$db->get_results("SELECT training_type AS type, DATE_FORMAT(date_end, '%Y') AS year

		FROM ioia_register

		LEFT JOIN ioia_training USING ( training_id )

		WHERE name_id = $member->id AND certificate = 'Training Coordinator'

		ORDER BY type, year");

	if($db->num_rows)

	{

		$tran_list.='<br><strong>Training Coordinator:</strong> ';

		$lasttype='new';

		foreach ($transcript AS $tran)

		{

			if($lasttype!=$tran->type)

			{

				if($tran_list AND $lasttype!='new') {

					$tran_list.=') ';

				}

	    		$tran_list.=$tran->type.' ('.$tran->year;

				$lasttype=$tran->type;

			}

			else

			{

				$tran_list.=', '.$tran->year;

			}

		}

		$tran_list.=')';

	}

	if($tran_list==')') $tran_list='';

if($status) $status.='<br>';





$hphone=stripslashes($member->hphone);

if($hphone) $hphone='Home: '.$hphone.'<br>';

$cphone=stripslashes($member->cphone);

if($cphone) $cphone='Cell: '.$cphone.'<br>';

$wphone=stripslashes($member->wphone);

if($wphone) $wphone='Work: '.$wphone.'<br>';

$fax=stripslashes($member->fax);

if($fax) $fax='Fax: '.$fax.'<br>';

$email=stripslashes($member->email);

if($email) $email='Email: <a href="mailto:'.$email.'">'.$email.'</a><br>';

$languages=$db->get_col("SELECT CONCAT(language,' (', lang_ability, ')') AS language

	FROM language_ability

	LEFT JOIN languages USING ( lang_id )

	WHERE name_id = $id ORDER BY language");

$lang_list=implode(', ',$languages);

if($lang_list) $lang_list='Languages: '.$lang_list.'<br>';



$dir=$db->get_row("SELECT * FROM ioia_directory WHERE name_id = $id");





if(!$cmd)

{

	echo '<table border=0>

		<tr><td width=55%>'.$name_bus.$addr1.$addr2.$city.$country.'</td>';

	echo '<td width=40%>'.$status.$hphone.$cphone.$wphone.$fax.$email.$lang_list.'</td></tr>';

	$farm=stripslashes($dir->farm_exp);

	if (!$farm) {

		$farm=$dir->other_farm_exp;

	}

	else {

		if ($dir->other_farm_exp) 	{

		$farm.=', '.$dir->other_farm_exp;

		}

	}

	$livestock=stripslashes($dir->livestock_exp);

	if (!$livestock) {

		$livestock=$dir->other_livestock_exp;

	}

	else {

	if ($dir->other_livestock_exp) 	{

		$livestock.=', '.$dir->other_livestock_exp;

	}

}

$process=stripslashes($dir->process_exp);

if (!$process) {

	$process=$dir->other_process_exp;

}

else {

	if ($dir->other_process_exp) 	{

		$process.=', '.$dir->other_process_exp;

	}

}

?>

</table>

<br>

<?

if(strstr("I,AP,AC",$member->status))

{

	if ($dir->mentor) echo '<strong>Willing to mentor. </strong><br>';
	if ($dir->consult) echo '<strong>Willing to consult. </strong><br>';
	if ($dir->review) echo '<strong>Willing to review. </strong><br>';

?>



	<strong>IOIA Training:</strong> <?=$tran_list?><br>

	<strong>Other Training: </strong><?=stripslashes($dir->other_training)?><br>

	<strong>Organizations Inspected for: </strong><?=stripslashes($dir->inspect_org)?><br>

	<br>

	<strong>Farm Inspection Experience: </strong><?=$farm?><br>

	<strong>Livestock Inspection Experience: </strong><?=$livestock?><br>

	<strong>Process Inspection Experience: </strong><?=$process?><br>

	<br>

	<strong>Academic: </strong><?=stripslashes($dir->academic)?><br>

	<strong>Personal: </strong><?=stripslashes($dir->personal)?><br>

<?

}

else

{

?>

	<strong>Information: </strong><?=stripslashes($dir->personal)?><br>

<?

}

?>

<br>

<big><b>Select Item to Edit: </b></big>

<input type="hidden" name="id" value=<?=$id?>>

<input type="hidden" name="alpha" value=<?=$alpha?>>

<input type="submit" name="cmd" value="Reset Password">

<input type="submit" name="cmd" value="Address">

<input type="submit" name="cmd" value="Directory">

<input type="submit" name="cmd" value="Admin">

<?

if(strstr("I,AP,AC,SI",$member->status))

{


	?>
	<input type="submit" name="cmd" value="Languages">

	<input type="submit" name="cmd" value="Training">

	<?

}

?>

		</form>

		<form action="<?=$PHP_SELF?>" method="post">

		<br>

		<input type="hidden" name="alpha" value=<?=$alpha?>>

		<input type="submit" value="Go to Member List">

		</form>

<?php

}



if($cmd=="Reset Password")

{

	//create new login info & email to member.

$member = $db->get_row("SELECT * FROM ioia_names

		WHERE id = $id");

$newpass = substr(md5(time()),0,6);

$ename = explode('@',$member->email);

if(!$member->userid and $member->email) $newuid=$ename[0];

else $newuid=$member->userid;


/*
$db->query("UPDATE ioia_names SET

		userid = '$newuid',

		password = PASSWORD('$newpass')

		WHERE id = $id");
*/
$db->query("UPDATE ioia_names SET

		userid = '$newuid',

		password = '$newpass'

		WHERE id = $id");



    // Email the login info to the member.

//final message

$message = "Dear $member->firstname,



Your member account for the IOIA Online Inspector Directory

has been created! To log in, proceed to the following address:



    http://www.organicweb.org/ioia/member.php



Your personal login ID and password are as follows:



    user id: $newuid

    password: $newpass



You aren't stuck with these choices! You can change your user id

or your password at any time after you have logged in.



Once you have logged in, you can update your information that

will appear in the IOIA Directory.  Be sure to update your languages.

English is now an option on the list.



If you have any problems, feel free to contact me at ioiassistant@rangeweb.net.



Kathy Bowers, Office Assistant

International Organic Inspectors Association

PO Box 6

Broadus, MT 59317

Phone: (406) 436-2031

Email: ioia@rangeweb.net

Website: www.ioia.net

";



mail($member->email,"Your IOIA Directory Login", $message, "From:Kathy Bowers <ioiassistant@rangeweb.net>");



?>

<center><p>Login for <?=$name?> has been sent.</p>

<input type="hidden" name="id" value=<?=$id?>>

<input type="hidden" name="alpha" value=<?=$alpha?>>

<input type="hidden" name="cmd" value="">

<input type="submit" value="OK"></center>

<?php

}

if($cmd=="Languages")

{

	echo '<center>'.$name.$lang_list.'<br>';
	$lang=$db->get_results("SELECT * FROM language_ability

		LEFT JOIN languages USING ( lang_id )

		WHERE name_id = $id

		ORDER BY language");

	foreach ($lang as $la)

	{

		?>
        <?=$la->language?>
        <input type="hidden" name="cmd" value="Languages">
		<input type="hidden" name="id" value=<?=$id?>>
		<input type="hidden" name="alpha" value=<?=$alpha?>>
        <input type="hidden" name="la_id" value="<?=$la->lang_abil_id?>">
		<input type="submit" name="submit" value="Delete Language"></form>
	<form action="<?=$PHP_SELF?>" method="post">

		<?php

		//fill language dropdown list from database table

	}

	?>

	<select name="langid">

	<OPTION value="">*add language*</OPTION>

	<?php

	//fill language dropdown list from database table

	$lan = $db->get_results("SELECT * FROM languages ORDER BY language");

	foreach ($lan as $l )

	{

		echo "<option value='".$l->lang_id."'>".$l->language."</option>";

	}

	?>

	</select>

	<input type="radio" name="lang_ability" value="F" checked>Fluent

	<input type="radio" name="lang_ability" value="C">Conversational

	<input type="radio" name="lang_ability" value="R">Read only

	<br>
 	<br>

	<input type="hidden" name="cmd" value="Languages">
		<input type="hidden" name="id" value=<?=$id?>>
		<input type="hidden" name="alpha" value=<?=$alpha?>>
        <input type="hidden" name="la_id" value="<?=$la->lang_abil_id?>">
		<input type="submit" name="submit" value="Add Language"></form>

	<br>

	<br>

	<form action="<?=$PHP_SELF?>" method="post">

		<input type="hidden" name="id" value=<?=$id?>>

		<input type="hidden" name="alpha" value=<?=$alpha?>>

		<input type="submit" value="Return to Listing">

	</form>

</center>

<?php

}



if($cmd=="Admin")

{

	echo '<center>'.$name.'<br>';

	?>

	<table border=1><tr><td>Member Status:</td><td>

		<?php

			if($member->status=="I") echo "Inspector";

			if($member->status=="AC") echo "Accredited Inspector";

			if($member->status=="AP") echo "Apprentice Inspector";

			if($member->status=="SI") echo "Supporting Individual";

			if($member->status=="SCA") echo "Supporting Certification Agency";

			if($member->status=="SB") echo "Supporting Business";

			if($member->status=="NEWS") echo "Newsletter";

			if($member->status=="PEND") echo "Pending";

			if($member->status=="PATR") echo "Patron Member";

			if($member->status=="SUST") echo "Sustaining Member";

		?></td><td>

		<select name="status">

		<?php

			if($member->status=="I") echo "<option value='I'>Inspector</option>";

			if($member->status=="AC") echo "<option value='AC'>Accredited Inspector</option>";

			if($member->status=="AP") echo "<option value='AP'>Apprentice Inspector</option>";

			if($member->status=="SI") echo "<option value='SI'>Supporting Individual</option>";

			if($member->status=="SCA") echo "<option value='SCA'>Supporting Certification Agency</option>";

			if($member->status=="SB") echo "<option value='SCA'>Supporting Business</option>";

			if($member->status=="NEWS") echo "<option value='NEWS'>Newsletter</option>";

			if($member->status=="PEND") echo "<option value='PEND'>Pending</option>";

			if($member->status=="PATR") echo "<option value='PATR'>Patron Member</option>";

			if($member->status=="SUST") echo "<option value='SUST'>Sustaining Member</option>";

		?>

			<option value=""></option>

			<option value="I">Inspector</option>

			<option value="AC">Accredited Inspector</option>

			<option value="AP">Apprentice Inspector</option>

			<option value="SI">Supporting Individual</option>

			<option value="SB">Supporting Business</option>

			<option value="SCA">Supporting Certification Agency</option>

			<option value="NEWS">Newsletter</option>

			<option value="PEND">Pending</option>

			<option value="PATR">Patron Member</option>

			<option value="SUST">Sustaining Member</option>

		</select><br></td></tr>

	<tr><td>Number of Newsletters:</td><td><?=$member->num_news?></td><td>

		<input type="text" name="num_news" value="<?=$member->num_news?>"></td></tr>

	<tr><td>Subscription:</td><td><?=$member->subscription?></td><td>

		<input type="text" name="subscription" value="<?=$member->subscription?>"></td></tr>

	<tr><td>Training:</td><td><?=$member->training?></td><td>

		<input type="text" name="training" value="<?=$member->training?>"></td></tr>

	<tr><td>Active:</td><td><?=$member->active?></td><td>

	<input type="radio" name="active" value="yes" <? if($member->active=="yes") echo "checked"; ?>>Yes

	<input type="radio" name="active" value="no" <? if($member->active=="no") echo "checked"; ?>>No

	<input type="radio" name="active" value="" <? if($member->active=="") echo "checked"; ?>>N/A

	</td></tr>

	<tr><td>Comments:</td><td><textarea rows=5 cols=40><?=$member->comment?></textarea></td><td>

		<textarea rows=5 cols=40 name="comment"><?=$member->comment?></textarea>

		</td></tr>

	</table>	<br>

	<input type="hidden" name="cmd" value="Admin">

		<input type="hidden" name="id" value=<?=$id?>>

		<input type="hidden" name="alpha" value=<?=$alpha?>>

		<input type="submit" name="submit" value="Update Admin"></form>

	<br>

	<br>

	<form action="<?=$PHP_SELF?>" method="post">

		<input type="hidden" name="id" value=<?=$id?>>

		<input type="hidden" name="alpha" value=<?=$alpha?>>

		<input type="submit" value="Return to Listing">

	</form>

</center>

<?php

}



if($cmd=="Training")

{

	echo '<center>'.$name.'<br>';

	$trng = $db->get_results("SELECT * FROM ioia_register

		LEFT JOIN ioia_training USING (training_id)

		WHERE $id = name_id ORDER BY date_beg");

?>

	<table border=1>

	<tr>

		<th>Location</th>

		<th>Start Date</th>

		<th>End Date</th>

		<th>Training Type</th>

		<th>Test</th>

		<th>Report</th>

		<th>Certificate</th>

	</tr>

	<?php

	foreach ( $trng as $tr )  // display each training event.

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

			<td><a href="training.php?id=<?=$tr->training_id?>&cmd=reg&yr=<?=$yr?>"><?=$location?></td>

			<td><?=$tr->date_beg?></td>

			<td><?=$tr->date_end?></td>

			<td><?=$tr->training_type?></td>

			<td><?=$tr->test_grade?></td>

			<td><?=$tr->report_grade?></td>

			<td><?=$tr->certificate?></td>

		</tr>

		<?php

	}

	?>

	</table>

	</form>

	<form action="<?=$PHP_SELF?>" method="post">

		<input type="hidden" name="id" value=<?=$id?>>

		<input type="hidden" name="alpha" value=<?=$alpha?>>

		<input type="submit" value="Return to Listing">

	</form>

</center>

<?php



}



if($cmd=="Directory")

{

?>

	<table border=0><tr><td><?=$name?></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td>

<?

if(strstr("I,AP,AC",$member->status))

{

?>

			<td>Willing to: <input type="checkbox" name="mentor"<?if ($dir->mentor) echo 'checked';?>> mentor
			&nbsp;&nbsp;<input type="checkbox" name="consult"<?if ($dir->consult) echo 'checked';?>> consult
			&nbsp;&nbsp;<input type="checkbox" name="review"<?if ($dir->review) echo 'checked';?>> review</td>

			</tr>

		<table border=1><col span=3 width=(2*,12*,1*)>

		<tr><td>Other training:</td><td>*Your IOIA training will be listed from your

			IOIA Transcript. Enter other related training here.

			<textarea cols=60 rows=5 NAME="other_training"><?=stripslashes($dir->other_training)?></textarea></td>

			</tr>

		<tr><td>Organizations Inspected for: </td>

			<td><textarea cols=60 rows=5 NAME="inspect_org"><?=stripslashes($dir->inspect_org)?></textarea>

		<tr><td>Farm Inspection Experience: </td>

			<td>

<input type="checkbox" name="farmx[]" value="Aquaculture"<?if(strstr($dir->farm_exp,"Aquaculture")) echo "checked";?>>&nbsp;Aquaculture

<input type="checkbox" name="farmx[]" value="Cacao" <?if(strstr($dir->farm_exp,"Cacao")) echo "checked";?>>&nbsp;Cacao

<input type="checkbox" name="farmx[]" value="Citrus"<?if(strstr($dir->farm_exp,"Citrus")) echo "checked";?>>&nbsp;Citrus

<input type="checkbox" name="farmx[]" value="Coffee"<?if(strstr($dir->farm_exp,"Coffee")) echo "checked";?>>&nbsp;Coffee

<input type="checkbox" name="farmx[]" value="Cotton"<?if(strstr($dir->farm_exp,"Cotton")) echo "checked";?>>&nbsp;Cotton

<input type="checkbox" name="farmx[]" value="Field Crops/row crops"<?if(strstr($dir->farm_exp,"Field Crops/row crops")) echo "checked";?>>&nbsp;Field&nbsp;Crops/row&nbsp;crops

<input type="checkbox" name="farmx[]" value="Fresh vegetables"<?if(strstr($dir->farm_exp,"Fresh vegetables")) echo "checked";?>>&nbsp;Fresh&nbsp;Vegetables

<input type="checkbox" name="farmx[]" value="Greenhouse"<?if(strstr($dir->farm_exp,"Greenhouse")) echo "checked";?>>&nbsp;Greenhouse

<input type="checkbox" name="farmx[]" value="Grower groups"<?if(strstr($dir->farm_exp,"Grower groups")) echo "checked";?>>&nbsp;Grower&nbsp;groups

<input type="checkbox" name="farmx[]" value="Herbs"<?if(strstr($dir->farm_exp,"Herbs")) echo "checked";?>>&nbsp;Herbs

<input type="checkbox" name="farmx[]" value="Honey"<?if(strstr($dir->farm_exp,"Honey")) echo "checked";?>>&nbsp;Honey

<input type="checkbox" name="farmx[]" value="Maple syrup"<?if(strstr($dir->farm_exp,"Maple syrup")) echo "checked";?>>&nbsp;Maple&nbsp;syrup

<input type="checkbox" name="farmx[]" value="Nuts"<?if(strstr($dir->farm_exp,"Nuts")) echo "checked";?>>&nbsp;Nuts

<input type="checkbox" name="farmx[]" value="Medicinal plants"<?if(strstr($dir->farm_exp,"Medicinal plants")) echo "checked";?>>&nbsp;Medicinal&nbsp;plants

<input type="checkbox" name="farmx[]" value="Mushrooms"<?if(strstr($dir->farm_exp,"Mushrooms")) echo "checked";?>>&nbsp;Mushrooms

<input type="checkbox" name="farmx[]" value="Quinoa"<?if(strstr($dir->farm_exp,"Quinoa")) echo "checked";?>>&nbsp;Quinoa

<input type="checkbox" name="farmx[]" value="Rice"<?if(strstr($dir->farm_exp,"Rice")) echo "checked";?>>&nbsp;Rice

<input type="checkbox" name="farmx[]" value="Small fruits"<?if(strstr($dir->farm_exp,"Small fruits")) echo "checked";?>>&nbsp;Small&nbsp;fruits

<input type="checkbox" name="farmx[]" value="Sorghum"<?if(strstr($dir->farm_exp,"Sorghum")) echo "checked";?>>&nbsp;Sorghum

<input type="checkbox" name="farmx[]" value="Spices"<?if(strstr($dir->farm_exp,"Spices")) echo "checked";?>>&nbsp;Spices

<input type="checkbox" name="farmx[]" value="Sprouts"<?if(strstr($dir->farm_exp,"Sprouts")) echo "checked";?>>&nbsp;Sprouts

<input type="checkbox" name="farmx[]" value="Sugarcane"<?if(strstr($dir->farm_exp,"Sugarcane")) echo "checked";?>>&nbsp;Sugarcane

<input type="checkbox" name="farmx[]" value="Tea"<?if(strstr($dir->farm_exp,"Tea")) echo "checked";?>>&nbsp;Tea

<input type="checkbox" name="farmx[]" value="Tropical fruits"<?if(strstr($dir->farm_exp,"Tropical fruits")) echo "checked";?>>&nbsp;Tropical&nbsp;fruits

<input type="checkbox" name="farmx[]" value="Tree fruits"<?if(strstr($dir->farm_exp,"Tree fruits")) echo "checked";?>>&nbsp;Tree&nbsp;fruits

<input type="checkbox" name="farmx[]" value="Tobacco"<?if(strstr($dir->farm_exp,"Tobacco")) echo "checked";?>>&nbsp;Tobacco

<input type="checkbox" name="farmx[]" value="Vineyards"<?if(strstr($dir->farm_exp,"Vineyards")) echo "checked";?>>&nbsp;Vineyards

<input type="checkbox" name="farmx[]" value="Wildcrafting"<?if(strstr($dir->farm_exp,"Wildcrafting")) echo "checked";?>>&nbsp;Wildcrafting

<br>Other:&nbsp;<input type="text" name="other_farm" value="<?=stripslashes($dir->other_farm_exp)?>" size="60">

	Limit: 5 other</td><td></td>

		<tr><td>Livestock Inspection Experience: </td>

			<td>

<input type="checkbox" name="stockx[]" value="Beef"<?if(strstr($dir->livestock_exp,"Beef")) echo "checked";?>>&nbsp;Beef

<input type="checkbox" name="stockx[]" value="Bison"<?if(strstr($dir->livestock_exp,"Bison")) echo "checked";?>>&nbsp;Bison

<input type="checkbox" name="stockx[]" value="Dairy"<?if(strstr($dir->livestock_exp,"Dairy")) echo "checked";?>>&nbsp;Dairy

<input type="checkbox" name="stockx[]" value="Eggs"<?if(strstr($dir->livestock_exp,"Eggs")) echo "checked";?>>&nbsp;Eggs

<input type="checkbox" name="stockx[]" value="Goats"<?if(strstr($dir->livestock_exp,"Goats")) echo "checked";?>>&nbsp;Goats

<input type="checkbox" name="stockx[]" value="Hogs"<?if(strstr($dir->livestock_exp,"Hogs")) echo "checked";?>>&nbsp;Hogs

<input type="checkbox" name="stockx[]" value="Poultry"<?if(strstr($dir->livestock_exp,"Poultry")) echo "checked";?>>&nbsp;Poultry

<input type="checkbox" name="stockx[]" value="Sheep"<?if(strstr($dir->livestock_exp,"Sheep")) echo "checked";?>>&nbsp;Sheep

<br>Other:&nbsp;<input type="text" name="other_livestock" value="<?=stripslashes($dir->other_livestock_exp)?>" size="60">

	Limit: 5 other

		<tr><td>Process Inspection Experience: </td>

			<td>

<input type="checkbox" name="processx[]" value="Baking"<?if(strstr($dir->process_exp,"Baking")) echo "checked";?>>&nbsp;Baking

<input type="checkbox" name="processx[]" value="Beer"<?if(strstr($dir->process_exp,"Beer")) echo "checked";?>>&nbsp;Beer

<input type="checkbox" name="processx[]" value="Butter"<?if(strstr($dir->process_exp,"Butter")) echo "checked";?>>&nbsp;Butter

<input type="checkbox" name="processx[]" value="Bottling"<?if(strstr($dir->process_exp,"Bottling")) echo "checked";?>>&nbsp;Bottling

<input type="checkbox" name="processx[]" value="Canning"<?if(strstr($dir->process_exp,"Canning")) echo "checked";?>>&nbsp;Canning

<input type="checkbox" name="processx[]" value="Cereals"<?if(strstr($dir->process_exp,"Cereals")) echo "checked";?>>&nbsp;Cereals

<input type="checkbox" name="processx[]" value="Cheese"<?if(strstr($dir->process_exp,"Cheese")) echo "checked";?>>&nbsp;Cheese

<input type="checkbox" name="processx[]" value="Chocolate"<?if(strstr($dir->process_exp,"Chocolate")) echo "checked";?>>&nbsp;Chocolate

<input type="checkbox" name="processx[]" value="Coffee"<?if(strstr($dir->process_exp,"Coffee")) echo "checked";?>>&nbsp;Coffee

<input type="checkbox" name="processx[]" value="Cooking"<?if(strstr($dir->process_exp,"Cooking")) echo "checked";?>>&nbsp;Cooking

<input type="checkbox" name="processx[]" value="Cosmetics"<?if(strstr($dir->process_exp,"Cosmetics")) echo "checked";?>>&nbsp;Cosmetics

<input type="checkbox" name="processx[]" value="Decaffeination"<?if(strstr($dir->process_exp,"Decaffeination")) echo "checked";?>>&nbsp;Decaffeination

<input type="checkbox" name="processx[]" value="Dehydration"<?if(strstr($dir->process_exp,"Dehydration")) echo "checked";?>>&nbsp;Dehydration

<input type="checkbox" name="processx[]" value="Distillation"<?if(strstr($dir->process_exp,"Distillation")) echo "checked";?>>&nbsp;Distillation

<input type="checkbox" name="processx[]" value="Distributors"<?if(strstr($dir->process_exp,"Distributors")) echo "checked";?>>&nbsp;Distributors

<input type="checkbox" name="processx[]" value="Egg cracking"<?if(strstr($dir->process_exp,"Egg cracking")) echo "checked";?>>&nbsp;Egg&nbsp;cracking

<input type="checkbox" name="processx[]" value="Extruding"<?if(strstr($dir->process_exp,"Extruding")) echo "checked";?>>&nbsp;Extruding

<input type="checkbox" name="processx[]" value="Fermentation"<?if(strstr($dir->process_exp,"Fermentation")) echo "checked";?>>&nbsp;Fermentation

<input type="checkbox" name="processx[]" value="Flaking"<?if(strstr($dir->process_exp,"Flaking")) echo "checked";?>>&nbsp;Flaking

<input type="checkbox" name="processx[]" value="Flours"<?if(strstr($dir->process_exp,"Flours")) echo "checked";?>>&nbsp;Flours

<input type="checkbox" name="processx[]" value="Fresh packing"<?if(strstr($dir->process_exp,"Fresh packing")) echo "checked";?>>&nbsp;Fresh&nbsp;packing

<input type="checkbox" name="processx[]" value="Freezing"<?if(strstr($dir->process_exp,"Freezing")) echo "checked";?>>&nbsp;Freezing

<input type="checkbox" name="processx[]" value="Fruit pitting"<?if(strstr($dir->process_exp,"Fruit pitting")) echo "checked";?>>&nbsp;Fruit&nbsp;pitting

<input type="checkbox" name="processx[]" value="Ginning"<?if(strstr($dir->process_exp,"Ginning")) echo "checked";?>>&nbsp;Ginning

<input type="checkbox" name="processx[]" value="Grain cleaning"<?if(strstr($dir->process_exp,"Grain cleaning")) echo "checked";?>>&nbsp;Grain&nbsp;cleaning

<input type="checkbox" name="processx[]" value="Herbs"<?if(strstr($dir->process_exp,"Herbs")) echo "checked";?>>&nbsp;Herbs

<input type="checkbox" name="processx[]" value="Honey extraction"<?if(strstr($dir->process_exp,"Honey extraction")) echo "checked";?>>&nbsp;Honey&nbsp;extraction

<input type="checkbox" name="processx[]" value="Hulling"<?if(strstr($dir->process_exp,"Hulling")) echo "checked";?>>&nbsp;Hulling

<input type="checkbox" name="processx[]" value="Juicing"<?if(strstr($dir->process_exp,"Juicing")) echo "checked";?>>&nbsp;Juicing

<input type="checkbox" name="processx[]" value="IQF"<?if(strstr($dir->process_exp,"IQF")) echo "checked";?>>&nbsp;IQF

<input type="checkbox" name="processx[]" value="Malting"<?if(strstr($dir->process_exp,"Malting")) echo "checked";?>>&nbsp;Malting

<input type="checkbox" name="processx[]" value="Masa"<?if(strstr($dir->process_exp,"Masa")) echo "checked";?>>&nbsp;Masa

<input type="checkbox" name="processx[]" value="Meat"<?if(strstr($dir->process_exp,"Meat")) echo "checked";?>>&nbsp;Meat

<input type="checkbox" name="processx[]" value="Milk"<?if(strstr($dir->process_exp,"Milk")) echo "checked";?>>&nbsp;Milk

<input type="checkbox" name="processx[]" value="Milling"<?if(strstr($dir->process_exp,"Milling")) echo "checked";?>>&nbsp;Milling

<input type="checkbox" name="processx[]" value="Multi-ingredient"<?if(strstr($dir->process_exp,"Multi-ingredient")) echo "checked";?>>&nbsp;Multi-ingredient

<input type="checkbox" name="processx[]" value="Nut butters"<?if(strstr($dir->process_exp,"Nut butters")) echo "checked";?>>&nbsp;Nut&nbsp;butters

<input type="checkbox" name="processx[]" value="Oil extraction"<?if(strstr($dir->process_exp,"Oil extraction")) echo "checked";?>>&nbsp;Oil&nbsp;extraction

<input type="checkbox" name="processx[]" value="Pasta"<?if(strstr($dir->process_exp,"Pasta")) echo "checked";?>>&nbsp;Pasta

<input type="checkbox" name="processx[]" value="Pasteurization"<?if(strstr($dir->process_exp,"Pasteurization")) echo "checked";?>>&nbsp;Pasteurization

<input type="checkbox" name="processx[]" value="Purees"<?if(strstr($dir->process_exp,"Purees")) echo "checked";?>>&nbsp;Purees

<input type="checkbox" name="processx[]" value="Retail"<?if(strstr($dir->process_exp,"Retail")) echo "checked";?>>&nbsp;Retail

<input type="checkbox" name="processx[]" value="Sauces"<?if(strstr($dir->process_exp,"Sauces")) echo "checked";?>>&nbsp;Sauces

<input type="checkbox" name="processx[]" value="Slaughtering"<?if(strstr($dir->process_exp,"Slaughtering")) echo "checked";?>>&nbsp;Slaughtering

<input type="checkbox" name="processx[]" value="Spices"<?if(strstr($dir->process_exp,"Spices")) echo "checked";?>>&nbsp;Spices

<input type="checkbox" name="processx[]" value="Sugar"<?if(strstr($dir->process_exp,"Sugar")) echo "checked";?>>&nbsp;Sugar

<input type="checkbox" name="processx[]" value="Soy products"<?if(strstr($dir->process_exp,"Soy products")) echo "checked";?>>&nbsp;Soy&nbsp;products

<input type="checkbox" name="processx[]" value="Textile process"<?if(strstr($dir->process_exp,"Textile process")) echo "checked";?>>&nbsp;Textile&nbsp;process

<input type="checkbox" name="processx[]" value="Tofu"<?if(strstr($dir->process_exp,"Tofu")) echo "checked";?>>&nbsp;Tofu

<input type="checkbox" name="processx[]" value="Vinegar"<?if(strstr($dir->process_exp,"Vinegar")) echo "checked";?>>&nbsp;Vinegar

<input type="checkbox" name="processx[]" value="Vitamins/supplements"<?if(strstr($dir->process_exp,"Vitamins/supplements")) echo "checked";?>>&nbsp;Vitamins/supplements

<input type="checkbox" name="processx[]" value="Wine"<?if(strstr($dir->process_exp,"Wine")) echo "checked";?>>&nbsp;Wine

<input type="checkbox" name="processx[]" value="Yogurt"<?if(strstr($dir->process_exp,"Yogurt")) echo "checked";?>>&nbsp;Yogurt

<br>Other:&nbsp;<input type="text" name="other_process" value="<?=stripslashes($dir->other_process_exp)?>" size="60">

	Limit: 5 other</td>

			<tr><td>Academic:<br>(type of degree or # of years enrolled, year of degree, school)</td>

			<td><textarea cols=60 rows=5 NAME="academic"><?=stripslashes($dir->academic)?></textarea>

		<tr><td>Personal: <br>(30 words or less)</td>

			<td><textarea cols=60 rows=5 NAME="personal"><?=stripslashes($dir->personal)?></textarea></td>

<?

}

elseif($member->status=="SCA")

{

?>

		<tr><td>Information: <br>(1/2 page in directory)</td>

			<td><textarea cols=60 rows=30 NAME="personal"><?=stripslashes($dir->personal)?></textarea></td>

<?

}

else

{

?>

		<tr><td>Information: <br>(75 words or less)</td>

			<td><textarea cols=60 rows=10 NAME="personal"><?=stripslashes($dir->personal)?></textarea></td>

<?

}

?>

		</table>

		<table border=0>

		<input type="hidden" name="alpha" value=<?=$alpha?>>

		<tr><td><input type="submit" name="submit" value="Update Directory"></td>

		<td><input type="submit" value="Cancel"></td>

		</tr></table>

		</form>

<?php

}

if($cmd=='Address')  //display selected member and options for other actions.

{

		?>

		<table border=1>

		<tr>

			<th>Item</th>

			<th>Current Value</th>

			<th>Change to:</th>

		</tr>

		<tr><td>First Name: </td><td><?=stripslashes($member->firstname)?></td>

			<td><INPUT TYPE="TEXT" NAME="firstname"

				VALUE="<?=stripslashes($member->firstname)?>" SIZE=30></td></tr>

		<tr><td>Middle Name: </td><td><?=stripslashes($member->middle)?></td>

			<td><INPUT TYPE="TEXT" NAME="middle"

				VALUE="<?=stripslashes($member->middle)?>" SIZE=30></td></tr>

		<tr><td>Last Name: </td><td><?=stripslashes($member->lname)?></td>

			<td><INPUT TYPE="TEXT" NAME="lname"

				VALUE="<?=stripslashes($member->lname)?>" SIZE=30></td></tr>

		<tr><td>Business Name: </td><td><?=stripslashes($member->bus_name)?></td>

			<td><INPUT TYPE="TEXT" NAME="bus_name"

				VALUE="<?=stripslashes($member->bus_name)?>" SIZE=30></td></tr>

		<tr><td>Address line 1: </td><td><?=stripslashes($member->address1)?></td>

			<td><INPUT TYPE="TEXT" NAME="address1"

				VALUE="<?=stripslashes($member->address1)?>" SIZE=30></td></tr>

		<tr><td>Address line 2: </td><td><?=stripslashes($member->address2)?></td>

			<td><INPUT TYPE="TEXT" NAME="address2"

				VALUE="<?=stripslashes($member->address2)?>" SIZE=30></td></tr>

		<tr><td>City: </td><td><?=stripslashes($member->city)?></td>

			<td><INPUT TYPE="TEXT" NAME="city"

				VALUE="<?=stripslashes($member->city)?>" SIZE=30></td></tr>

		<tr>

			<td>State/Province: </td><td><?=$member->state?></td>

			<td><SELECT NAME="state_code">

  			<option VALUE="<?=$member->state_code?>"><?=$member->state?></option>

			<OPTION></OPTION>

			<?

			//fill state dropdown list from database table

			$stts = $db->get_results("SELECT * FROM `states` ORDER BY `state`");

			foreach ($stts as $st )

			{

				echo "<option value='".$st->state_id."'>".$st->state."</option>";

			}

			?>

			</select></td></tr>

		<tr><td>Postal Code: </td><td><?=stripslashes($member->zip)?></td>

			<td><INPUT TYPE="TEXT" NAME="zip"

				VALUE="<?=stripslashes($member->zip)?>" SIZE=30></td></tr>

		<tr>

			<td>Country: </td><td><?=$member->country?></td>

			<td><SELECT NAME="country_code">

  			<option VALUE="<?=$member->country_code?>" SIZE=30><?=$member->country?></option>

			<OPTION></OPTION>

			<?

			//fill country dropdown list from database table

			$cntry = $db->get_results("SELECT * FROM `countries` ORDER BY `country`");

			foreach ($cntry as $cn )

			{

				echo "   <option value='".$cn->country_id."' SIZE=30>".$cn->country."</option>";

			}

			?>

			</select></td></tr>

		<tr><td>Home Phone: </td><td><?=stripslashes($member->hphone)?></td>

			<td><INPUT TYPE="TEXT" NAME="hphone"

				VALUE="<?=stripslashes($member->hphone)?>" SIZE=30></td></tr>

		<tr><td>Cell Phone: </td><td><?=stripslashes($member->cphone)?></td>

			<td><INPUT TYPE="TEXT" NAME="cphone"

				VALUE="<?=stripslashes($member->cphone)?>" SIZE=30></td></tr>

		<tr><td>Work Phone: </td><td><?=stripslashes($member->wphone)?></td>

			<td><INPUT TYPE="TEXT" NAME="wphone"

				VALUE="<?=stripslashes($member->wphone)?>" SIZE=30></td></tr>

		<tr><td>Fax: </td><td><?=stripslashes($member->fax)?></td>

			<td><INPUT TYPE="TEXT" NAME="fax"

				VALUE="<?=stripslashes($member->fax)?>" SIZE=30></td></tr>

		<tr><td>Email: </td><td><?=stripslashes($member->email)?></td>

			<td><INPUT TYPE="TEXT" NAME="email"

				VALUE="<?=stripslashes($member->email)?>" SIZE=60></td></tr>

		</table>

		<table border=0>

		<input type="hidden" name="alpha" value=<?=$alpha?>>

		<tr><td><input type="submit" name="submit" value="Update Address"></td>

		<td><input type="submit" value="Cancel"></td>

		</tr></table>

		</form>

		<?php

}

?>

</body>

</html>

