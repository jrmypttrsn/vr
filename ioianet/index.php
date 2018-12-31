<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
       <title>IOIA Online Directory</title>
</head>
<body bgcolor="#FFD880">
<?php  
error_reporting(E_none);  //use E_ALL during development & E_NONE for deployment
// Include ezSQL in order to use it.
include_once "../../ez_sql.php";
// Register global variables
include("global.inc.php");
$db->show_errors;  //use show_errors during development & hide_errors for deployment

pt_register('POST','submit','region','state','country','language','lastname',
	'exp1','exp2','mbrst');
pt_register('GET','id','state','country','language','lastname');
pt_register('SERVER','PHP_SELF');
//echo " id: ".$id." submit: ".$submit." answer: ".$answer." select: ".$select;

?>
<form action="<?=$PHP_SELF?>" method="post">
<div align="center"><h1>IOIA Online Directory</h1>
<?
if($submit=="New Search" or (!$submit and !$id))
{
?>
<table border=0>
<tr><td>Last Name</td><td><input type=text name='lastname'></td>
</tr><tr><td>Language</td><td><SELECT NAME="language" SIZE=0>
   <option value='0'></option>
<?php
//fill language dropdown list from database table - limit to those listed by inspectors
$language = $db->get_results("SELECT DISTINCT language,languages.lang_id FROM languages
	LEFT JOIN `language_ability` USING (lang_id)
	WHERE lang_abil_id IS NOT NULL
	ORDER BY language");
foreach ( $language as $la )
{
?>
	<option value='<?=$la->lang_id?>'><?=$la->language?></option>";
<?
}
?>
</select></td></tr>
</tr><tr><tr><td>State or Province</td><td><select name="state"  SIZE=0>
   <option></option>
<?
//fill state dropdown list from database table - select only states with inspectors
$states = $db->get_results("SELECT `state`,state_id,region FROM states
	LEFT JOIN `ioia_names` ON state_id = state_code
	WHERE id IS NOT NULL
	GROUP BY `state`");
foreach ( $states as $st )
{
?>
	<option value='<?=$st->state_id?>'><?=$st->state?></option>";
<?
}
?>
</select></td>
</tr><tr><td>Region</td><td><select name="region"  SIZE=0>
   <option></option>
<?
//fill region dropdown list from database table - select only regions with inspectors
$region = $db->get_results("SELECT region FROM states
	LEFT JOIN `ioia_names` ON state_id = state_code
	WHERE id IS NOT NULL
	GROUP BY `region`");
foreach ( $region as $re )
{
?>
	<option value='<?=$re->region?>'><?=$re->region?></option>";
<?
}
?>
</select></td></tr>

<tr><td>Country</td><td><SELECT NAME="country" SIZE=0>
   <option value=' '></option>
<?php
//fill country dropdown list from database table - select only countries with inspectors
$countries = $db->get_results("SELECT country,country_id FROM countries
	LEFT JOIN `ioia_names` ON country_id = country_code
	WHERE id IS NOT NULL
	GROUP BY country");
foreach ( $countries as $cn )
{
?>
	<option value='<?=$cn->country_id?>'><?=$cn->country?></option>";
<?
}
?>
</select></td></tr>
<tr><td>Experience Keyword(s)</td><td><input type=text name='exp1'> <input type=text name='exp2'></td></tr>
</table>
<input type="radio" name="mbrst" value="I','AP','AC" checked>All Inspectors
<input type="radio" name="mbrst" value="AC">Accredited Inspectors
<br>Supporting:
<input type="radio" name="mbrst" value="SI">Individual
<input type="radio" name="mbrst" value="SB">Business
<input type="radio" name="mbrst" value="SCA">Certification Agency
<input type="radio" name="mbrst" value="PATR">Patron Member
<br><input type=submit name='submit' value='Search'>
<input type=reset value='Clear'></form><br>
Leaving the search fields blank will return a list of all inspectors.<br></div>
The following is a list of common keywords:<br>
<table border=0>
<tr><td><strong>Inspection Experience:</strong> Aquaculture, Cacao, Citrus, Coffee, Cotton, Field Crops/row crops, Fresh vegetables, Greenhouse, Grower groups, Herbs, Honey, Maple syrup, Nuts, Medicinal plants, Mushrooms, Quinoa, Rice, Small fruits, Sorghum, Spices, Sprouts, Sugarcane, Tea, Tropical fruits, Tree fruits, Tobacco, Vineyards, Wildcrafting
</td></tr><tr><td><strong>Livestock Inspection Experience:</strong> Beef, Bison, Dairy, Eggs, Goats, Hogs, Poultry, Sheep
</td></tr><tr><td><strong>Process Inspection Experience:</strong> Baking, Beer, Butter, Bottling, Canning, Cereals, Cheese, Chocolate, Coffee, Cooking, Cosmetics, Decaffeination, Dehydration, Distillation, Distributors, Egg cracking, Extruding, Fermentation, Flaking, Flours, Fresh packing, Freezing, Fruit pitting, Ginning, Grain cleaning, Herbs, Honey extraction, Hulling, Juicing, IQF, Malting, Masa, Meat, Milk, Milling, Multi-ingredient, Nut butters, Oil extraction, Pasta, Pasteurization, Purees, Retail, Sauces, Slaughtering, Spices, Sugar, Soy products, Textile process, Tofu, Vinegar, Vitamins/supplements, Wine, Yogurt
</td></tr></table>
<small><div align="right">Powered by <a href="http://www.organicweb.org">OrganicWeb.org</a></div></small>
<?
}
else
{
//build select expression
	if($id)
	{
		$select_exp="WHERE id = $id";
	}
	else
	{
		$select_exp="WHERE `status` IN ('".stripslashes($mbrst)."') AND `active`='yes'";
		if($lastname) $select_exp.=" AND `lname` LIKE '".$lastname."%' ";
		if($state) $select_exp.=" AND `state_code` LIKE '".$state."' ";
		if($region) $select_exp.=" AND `region` LIKE '".$region."' ";
		if($country) $select_exp.=" AND `country_code` LIKE '".$country."' ";
		if($language) $select_exp.=" AND `lang_id` = ".$language." ";
		if($exp1) $select_exp.=" AND CONCAT(`farm_exp`,`livestock_exp`,`process_exp`,
			`other_farm_exp`,`other_livestock_exp`,`other_process_exp`) LIKE '%".$exp1."%'";
		if($exp2) $select_exp.=" AND CONCAT(`farm_exp`,`livestock_exp`,`process_exp`,
			`other_farm_exp`,`other_livestock_exp`,`other_process_exp`) LIKE '%".$exp2."%'";
	}
		//list matching inspectors
	$inspectors = $db->get_results("SELECT * FROM `ioia_names`
		LEFT JOIN states ON state_id = state_code
		LEFT JOIN countries ON country_id = country_code
		LEFT JOIN language_ability ON language_ability.name_id = id
		LEFT JOIN ioia_directory ON ioia_directory.name_id = id
 		$select_exp
		GROUP BY lname,firstname");

if ($submit=='Search')
{
?>
	<input type="hidden" name="state" value="<?=$state?>">
	<input type="hidden" name="country" value="<?=$country?>">
	<input type="hidden" name="region" value="<?=$region?>">
	<input type="hidden" name="language" value="<?=$language?>">
	<input type="hidden" name="lastname" value="<?=$lastname?>">
	<input type="hidden" name="exp1" value="<?=$exp1?>">
	<input type="hidden" name="exp2" value="<?=$exp2?>">
	<input type="hidden" name="mbrst" value="<?=stripslashes($mbrst)?>">
	<h3>Search complete - <?=$db->num_rows?> Member(s) found  <input type="submit" name="submit" value="New Search">
		<input type="submit" name="submit" value="Show All Details"></h3>
	<table border=0>
<?
	foreach ( $inspectors as $in )
	{
//		$maplink=generate_mapquest_link ($in->address1, $in->city, $in->state_code, $in->country, $in->zip);
		if($in->country == 'UNITED STATES' or $in->country == 'CANADA')
		{
			$co=str_replace(" ","+",$in->country);
			$ci=str_replace(" ","+",$in->city);
			$search="city=".$ci."&state=".$in->state_code."&zip=".$in->zip."&country=".$co;
		}
		else
		{
			$co=str_replace(" ","+",$in->country);
			$ci=str_replace(" ","+",$in->city);
			$ci=str_replace(",","",$ci);
			$search="country=".$co."&city=".$ci;
		}

//		$search="country=".$in->country."&city=".$ci."&state=".$in->state_code."&zip=".$in->zip;
?>
	<tr><td><a href="<?=$PHP_SELF?>?id=<?=$in->id?>">
	<?=$in->firstname?> <?=$in->lname?></a> - <?=$in->bus_name?> - <?=$in->city?>, <?=$in->state?> <?=$in->country?>
	<a href="http://www.mapquest.com/maps/map.adp?<?=$search?>&zoom=2">map</a>
	</td></tr>
	
<?
	}
?>
	</table>
<?
}
else
{
?>
	<input type="hidden" name="state" value="<?=$state?>">
	<input type="hidden" name="country" value="<?=$country?>">
	<input type="hidden" name="region" value="<?=$region?>">
	<input type="hidden" name="language" value="<?=$language?>">
	<input type="hidden" name="lastname" value="<?=$lastname?>">
	<input type="hidden" name="exp1" value="<?=$exp1?>">
	<input type="hidden" name="exp2" value="<?=$exp2?>">
	<input type="hidden" name="mbrst" value="<?=stripslashes($mbrst)?>">
	<h3>Details of <?=$db->num_rows?> Member(s)</h3></div>
<?
	foreach ( $inspectors as $member )
	{
$name='<b><big>'.stripslashes($member->firstname).' '.stripslashes($member->middle).' '
	.stripslashes($member->lname).'</big></b>';
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
if($member->status=='I') $status='<b><big>Inspector</big></b>';
if($member->status=='AP')	$status='<b><big>Apprentice Inspector</big></b>';
if($member->status=='AC')	$status='<b><big>Accredited Inspector</big></b>';
if($member->status=="SI") $status='<b><big>Supporting Individual</big></b>';
if($member->status=="SB") $status='<b><big>Supporting Business</big></b>';
if($member->status=="SCA") $status='<b><big>Supporting Certification Agency</big></b>';
if($member->status=="PATR") $status='<b><big>Patron Member</big></b>';
if($member->status=="NEWS") $status='<b><big>Newsletter</big></b> ('
	.$member->subscription.')';
if($member->status=="PEND") $status='<b><big>Pending</big></b>';
if($member->status=="") $status='<b><big>No Status Listed</big></b>';

$hphone=stripslashes($member->hphone);
if($member->status=="SB") $hphone='';
if($member->status=="SCA") $hphone='';
if($hphone) $hphone='Home: '.$hphone.'<br>';
$cphone=stripslashes($member->cphone);
if($cphone) $cphone='Cell: '.$cphone.'<br>';
$wphone=stripslashes($member->wphone);
if($wphone) $wphone='Work: '.$wphone.'<br>';
$fax=stripslashes($member->fax);
if($fax) $fax='Fax: '.$fax.'<br>';
$email=stripslashes($member->email);
if($email) $email='Email: <a href="mailto:'.$email.'">'.$email.'</a><br>';
if(strstr("I,AP,AC,SI",$member->status))
{
	$languages=$db->get_col("SELECT CONCAT(language,' (', lang_ability, ')') AS language
		FROM language_ability
		LEFT JOIN languages USING ( lang_id )
		WHERE name_id = $member->id ORDER BY language");
	$lang_list=implode(', ',$languages);
	if($lang_list) $lang_list='Languages: '.$lang_list.'<br>';
}
$dir=$db->get_row("SELECT * FROM ioia_directory WHERE name_id = $member->id");
if ($dir->mentor=='on') $mentor='<strong>Willing to mentor. </strong>';
else $mentor='';
if ($dir->consult=='on') $mentor.='<strong>Willing to consult. </strong>';
if ($dir->review=='on') $mentor.='<strong>Willing to review.</strong>';
$mentor.='<br>';

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
// This section creates the list of training and accreditation status.
	$transcript=$db->get_results("SELECT training_type AS type, DATE_FORMAT(date_end, '%Y') AS year, ioia_register.training_id AS sam
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
// $db->debug();
if($accred) $status.=" (".implode(', ',$accred).")";
if($status) $status.='<br>';
// echo $status;
	// Add Trainer Info.
	$transcript=$db->get_results("SELECT training_type AS type, DATE_FORMAT(date_end, '%Y') AS year
		FROM ioia_register
		LEFT JOIN ioia_training USING ( training_id )
		WHERE name_id = $member->id AND certificate = 'Trainer'
		ORDER BY type, year");
	if($db->num_rows)
	{
		$tran_list.='<br><strong>Trainer:</strong> ';
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
	$other_training = stripslashes($dir->other_training);
	$inspect_org = stripslashes($dir->inspect_org);
	$academic = stripslashes($dir->academic);
	$personal = stripslashes($dir->personal);
// create html to display inspector's directory entry
echo '<hr><table align="center" border=0 width=85%><tr><td valign="top">'.$name.$business.$addr1.$addr2.$city.$country.$mentor.'</td>';
echo '<td valign="top" align="right">'.$status.$hphone.$cphone.$wphone.$fax.$email.$lang_list.'</td></tr>';
?>
</table><table align='center' border=0 width="85%">
<?
	if($member->status=='I' OR $member->status=='AP' OR $member->status=='AC')
	{
 		if($tran_list) echo "<tr><td><strong>IOIA Training:</strong> $tran_list<br>";
		if($other_training) echo "<tr><td><strong>Other Training: </strong>$other_training<br>";
		if($inspect_org) echo "<tr><td><strong>Organizations Inspected for: </strong>$inspect_org<br>";
		echo "<tr><td>";
		if($farm) echo "<strong>Farm Inspection Experience: </strong>$farm<br>";
		if($livestock) echo "<strong>Livestock Inspection Experience: </strong>$livestock<br>";
		if($process) echo "<strong>Process Inspection Experience: </strong>$process<br>";
		echo "<tr><td>";
		if($academic) echo "<strong>Academic: </strong>$academic<br>";
		if($personal) echo "<strong>Personal: </strong>$personal";
	}
	elseif($member->status=='SI')
	{
 		if($tran_list) echo "<tr><td><strong>IOIA Training:</strong> $tran_list<br>";
		if($personal) echo "<tr><td><strong>Information: </strong>$personal";
	}
	else
	{
		if($personal) echo "<tr><td><strong>Information: </strong>$personal";
	}
?>
	</table>
<?
	}
}
}
?>
</body>
</html>



