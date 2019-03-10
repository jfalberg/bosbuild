<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<title>Boston Buildup Purdy Point utility page</title>
<script type="text/javascript">
function validate_file(field,alerttxt)
{
with (field)
{
dotpos=value.tolower.lastIndexOf(".prn");
if (dotpos<4) 
  {alert(alerttxt);return false;}
else {
  return true;
  }
}
}
function validate_form(thisform)
{
with (thisform)
{
if (validate_file(xfile,"Not a valid prn file!")==false)
  {xfile.focus();return false;}
}
   xfilein.value = xfile.value;
}

</script>

<! https://www.w3schools.com/css/css_navbar.asp >
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #4CAF50;
}
</style>
</head>

<body style="background-color:aqua">

<ul>
  <li><a class="active" href="bbpurdy1.php">Home</a></li>
  <li><a href="bbstand_mysql.php" target="_blank">Results</a></li>
  <li><a href="http://clubct.org/Buildup.html" target="_blank">Buildup</a></li>
</ul>
<!--
<div id="purdyinput">
<form action="purdy.php" method="post" onsubmit="return validate_form(this);"
 enctype="multipart/form-data">

</form>
</div>
-->

<?php 
  $data = $_POST['bbbtn'];
  $myFileIn = $_POST['xfilein']; 
  $xOldName = $_POST['xOldName'];   
  $xNewName = $_POST['xNewName'];   
  $xdupname = $_POST['xdupname'];   
  $xdupcat  = $_POST['xdupcat'];   
  $runcntDisp = "";
  $xDoBB2 = "N";

/*-------- MySQL ------------*/
  ini_set('display_errors', 'On');
  error_reporting(E_ALL);
  /*--------- DATABASE CONNECTION INFO---------*/ 
  $hostname="localhost"; 
  $mysql_login="root"; 
  $mysql_password="accucom250"; 
  $database="bbdata"; 
  
  // connect to the database server 
  $link = mysqli_connect($hostname, $mysql_login, $mysql_password);
  if (!$link) {
    die("Could not connect: " . mysql_error());
  }
//  echo "<br>" . mysqli_get_client_version() . "<br>";
  if (strlen($data) == 0) {
     $xOldName = "";
	 $xNewName = "";
  }
  if ($data == "xProCSV" && strlen($myFileIn) > 0)  
  {
  	 $xxDistance = $_POST['xdist']; 
	 $lines = explode("<br>", $myFileIn);
	 $query = "DELETE from bbdata.bbimport;";
     mysqli_query($link, $query);
	 $foo = 1;
	 $xdelim = ",";
	 $xtabkey = "\t";
	 if (strpos($myFileIn, $xtabkey) !== False) {
	     $xdelim = $xtabkey;
	 }
	 echo "<pre>";

	 foreach ($lines as &$value) 
	 {
        if (strlen(trim($value)) > 0) {
		   if ($foo > 0) {
       		   $bbfields = explode($xdelim, $value);
			   $foo = 0;
		   }
		   else {
		   	   $ddfields = explode($xdelim, $value);
			   for ($i = 0; $i < sizeof($ddfields); $i++) {
			       $xfield = $bbfields[$i];
			       if ($xfield == "FIRST_NAME") {
                       $xfield = "FIRST NAME";
				   }
			       if ($xfield == "LAST_NAME") {
                       $xfield = "LAST NAME";
				   }
			       if ($xfield == "GENDER") {
                       $xfield = "SEX";
				   }
			       if ($xfield == "RACE_AGE") {
                       $xfield = "AGE";
				   }
			       if ($xfield == "FINISH_NET_TIME") {
                       $xfield = "TIME";
				   }
			       if ($xfield == "FIRST NAME") {
                       $xxFirstName = $ddfields[$i];
				   }
			       if ($xfield == "LAST NAME") {
                       $xxLastName = $ddfields[$i];
				   }
			       if ($xfield == "AGE") {
                        $xxAge = $ddfields[$i];
				   }
			       if ($xfield == "SEX") {
                        $xxSex = $ddfields[$i];
						$xxCatSex = "M";
						if ($xxSex == "F") {
						    $xxCatSex = "W";
						}
				   }
//					  case "CITY":
//					  case "STATE":
//					  case "PLACE":
			       if ($xfield == "TIME") {
                       $xxTime = $ddfields[$i];
					   $xxTime = str_replace('"', "", $xxTime);
                       if (strlen($xxTime) == 5) {
                           $xxTime = "0:" . $xxTime;
					   }
                       if (strlen($xxTime) == 8) {
                           $xxTime = substr($xxTime, -7);
					   }
			       }
			   }
     		   $xxName = addslashes($xxFirstName . " " . $xxLastName);
			   $xxAgeVal = (int)$xxAge;
			   if ($xxAgeVal < 30) 
			      $xxCategory = "Op" . $xxCatSex;
			   else
                  $xxCategory = $xxCatSex . min(60, floor($xxAgeVal / 10)*10);
//	    	   $xxCategory = substr($value,25,4);
//		       $xxTime = substr($value, 29, 7);
//		       $xxDistance 
    		   $xxMeasure = "k";
	    	   $xxFiller1 = "Purdy =";
     		   $val2 = substr($xxFirstName . " " . $xxLastName . str_repeat(" ", 25),0,25) . $xxCategory . " " . $xxTime;
		       $xxPoints = inres($val2, $xxDistance);
               $stringData = substr($val2, 0, 36) . " " . $xxDistance . "k Purdy = " . $xxPoints;
	    	   echo " " . $stringData . "<br/>";
		       $query = "INSERT INTO bbdata.bbimport (Name, Category, Time, Distance, Measure, ";
    		   $query = $query . "Filler1, Points) VALUES ('" . $xxName . "', '" . $xxCategory . "', '";
    		   $query = $query . $xxTime . "', " . $xxDistance . ", '" . $xxMeasure . "', '";
     		   $query = $query . $xxFiller1 . "', " . $xxPoints . ")";
	    	   mysqli_query($link, $query);
               echo "<br/>Inserted rows: " . mysqli_affected_rows($link);
		   }
		}
	 }
     echo "</pre>";
  }


//  ** legagy way of importing purdy import file  
  if ($data == "xProc2" && strlen($myFileIn) > 0)  
  {
	 $xxDistance = $_POST['xdist']; 
	 $lines = explode("<br>", $myFileIn);
	 $query = "DELETE from bbdata.bbimport;";
     mysqli_query($link, $query);
	 
	 foreach ($lines as &$value) 
	 {
        if (strlen(trim($value)) > 0) {
		   $xxName = addslashes(substr($value, 0, 25));
		   $xxCategory = substr($value,25,4);
		   $xxTime = substr($value, 29, 7);
//		   $xxDistance 
		   $xxMeasure = "k";
		   $xxFiller1 = "Purdy =";
		   $xxPoints = inres($value, $xxDistance);
           $stringData = substr($value, 0, 36) . " " . $xxDistance . "k Purdy = " . $xxPoints;
		   echo " " . $stringData . "<br/>";
		   $query = "INSERT INTO bbdata.bbimport (Name, Category, Time, Distance, Measure, ";
		   $query = $query . "Filler1, Points) VALUES ('" . $xxName . "', '" . $xxCategory . "', '";
		   $query = $query . $xxTime . "', " . $xxDistance . ", '" . $xxMeasure . "', '";
   		   $query = $query . $xxFiller1 . "', " . $xxPoints . ")";
		   mysqli_query($link, $query);
        }
	 }
  }

  if ($data == "bb1")
  {
	 $query = "Insert into bbdata.bb1 Select * from bbdata.bbimport";
	 echo '<br/><br/>' . $query;
     mysqli_query($link, $query);
	 echo "<br/>Inserted rows: " . mysqli_affected_rows($link);
	 $query = "Delete from bbdata.bbimport";
	 echo '<br/><br/>' . $query;
     mysqli_query($link, $query);
	 echo "<br/>Deleted rows: " . mysqli_affected_rows($link);
  }
  
//  change name if incorrect on any of them
  if ($data == "bbfix1" && strlen($xOldName) > 0 && strlen($xNewName) > 0)  
  {
	 $query = "UPDATE bbdata.bb1 SET Name = '" . $xNewName . "' ";
     $query = $query . "where name = '" . $xOldName . "'";
	 echo '<br/><br/>' . $query;
     mysqli_query($link, $query);
	 echo "<br/>Updated rows: " . mysqli_affected_rows($link) . "<br/><br/>";
     $xDoBB2 = "Y";
  }

//  correct category for given person
  if ($data == "bbduc" && strlen($xdupname) > 0 && strlen($xdupcat) > 0)  
  {
	 $query = "UPDATE bbdata.bb1 SET Category = '" . $xdupcat . "' ";
     $query = $query . "where name = '" . $xdupname . "'";
	 echo '<br/><br/>' . $query;
     mysqli_query($link, $query);
	 echo "<br/>Updated rows: " . mysqli_affected_rows($link) . "<br/><br/>";
     $xDoBB2 = "Y";
  }

  if ($data == "bb2")  
  {
     $xDoBB2 = "Y";
  }
  
  if ($xDoBB2 == "Y")  
  {
      $query = file_get_contents("bb2-process.sql");
	  echo $query;
	  $mycmd = "\"C:\\Program Files\\MySQL\\MySQL Server 5.1\\bin\\mysql.exe\" -h " . $hostname . " --user=";
	  $mycmd = $mycmd . $mysql_login . " --password=" . $mysql_password . " --database=";
	  $mycmd = $mycmd . $database . " < bb2-process.sql";
	  echo '<br/><br/>' . $mycmd;
	  $output = shell_exec($mycmd);
//	  echo '<br/><br/>' . $output;
      $query = "SELECT count(*) as dcnt FROM bbdata.bb2";
	  echo '<br/><br/>' . $query . '<br/><br/>';	  
	  $result = mysqli_query($link, $query);
      $row = mysqli_fetch_assoc($result);
      $dcnt = (int)$row['dcnt'];
      if ($dcnt > 0) 
          $runcntDisp = "Runner Count = " . $dcnt;
  }
 
    
  if ($data == "bbdup") 
  {
     $query = "SELECT Bb2.name, count(*) as dcnt ";
     $query = $query . "FROM bbdata.bb2 ";
     $query = $query . "GROUP BY Bb2.name ";
     $query = $query . "HAVING count(*) > 1 ";
	 $result = mysqli_query($link, $query);
	 
	 while ($row = mysqli_fetch_assoc($result)) 
	 {
		    $Name = cWrite($row['name'], 40);
            $dcnt = nWrite((int)$row['dcnt'], 5);
		    echo '<br/><br/>' . str_repeat(" ", 5) . $Name . "   " . $dcnt;
	 }
  }
  
  if (strlen($myFileIn) > 0)
  {
  echo '<script type="text/javascript">',
     'xfilein.value = "";',
     '</script>'
 	;
  }
  echo "</pre>";
//  mysqli_close(); 
?>
<br/>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >

<label>Distance:
<select name="xdist" id="xdist" tabindex="1">
  <option value="10" selected="selected">10k</option>
  <option value="15">15k</option>
  <option value="20">20k</option>
  <option value="25">25k</option>
</select>
</label>
<p>
  <label>
  <input type="hidden" name="xfilein" id="xfilein" style="white-space:pre" value="" />
  </label>
  <input type="file" name="fileInput" id="fileInput" onchange="xfilein.value = xfile.value" accept="text/plain"/><br/>
  <button id="xProCSV" name="bbbtn" value="xProCSV" onclick="xfilein.value = getElementById('fileDisplayArea').innerText.replace(/(?:\r\n|\r|\n)/g, '<br>');">Process from Results</button><br/>  
  <pre id="fileDisplayArea" name="fileDisplayArea" style="white-space:pre"></pre>
  <script src="text.js"></script>

</p>
<hr />
Move records from bbimport to bb1<br/>
<button id="bb1" name="bbbtn" value="bb1">Import from bbimport</button><br/>
<br/>
Merge all the records from bb1 into bb2 and produce the current results<br/>
<button id="bb2" name="bbbtn" value="bb2">Process from Results</button><br/>
<?php
echo $runcntDisp;
?>
<br/><br/>
<button id="bbdup" name="bbbtn" value="bbdup">Check for Duplicates</button>
<br/><br/>
<div style="color:maroon;">Fix the following same runner misspelled differently:</div>
Old Name: <input type="text" name="xOldName" value="<?php echo $xOldName;?>"><br/>
New Name: <input type="text" name="xNewName" value="<?php echo $xNewName;?>"><br/>
<button id="bbfix1" name="bbbtn" value="bbfix1">Fix runner</button>
<br/><br/>
<div style="color:maroon;">Fix the following same runner with appropriate category:</div>
Dup Name: <input type="text" name="xdupname" value="<?php echo $xdupname;?>"><br/>
Dup Category: <select name="xdupcat" id="xdupcat" tabindex="1">
  <option value="OpM" selected="selected">OpM</option>
  <option value="M30">M30</option>
  <option value="M40">M40</option>
  <option value="M50">M50</option>
  <option value="M60">M60</option>
  <option value="OpW">OpW</option>
  <option value="W30">W30</option>
  <option value="W40">W40</option>
  <option value="W50">W50</option>
  <option value="W60">W60</option>
</select>
<br/>
<button id="bbduc" name="bbbtn" value="bbduc">Fix runner</button>
</form>
</body>
<?php
function inres($instr, $xxk) {
//   $xxk = 25;
   $amile = 1609.344;
   $akilo = 1000;
   $dist = (float)$xxk * $akilo;

   $hh = intval(substr($instr, 29, 1));
   $mm = intval(substr($instr, 31, 2));  
   $ss = intval(substr($instr, 34, 2));  
   $secs = (float)(($hh * 60 * 60) + ($mm * 60) + $ss);
   return round(purdy($dist, $secs));
}

/****************************************************************/
/* calculate the famous purdy points */
function purdy($dist, $tsec) {
/*
portugese running table, distance, speed
Table was from World Record times up to 1936
They are arbitrarily given a Purdy point of 950
*/

  $ptable= array(40.0,11.000, 50.0,10.9960, 60.0,10.9830, 70.0,10.9620,
  80.0,10.934, 90.0,10.9000,100.0,10.8600,110.0,10.8150,
  120.0,10.765,130.0,10.7110,140.0,10.6540,150.0,10.5940,
  160.0,10.531,170.0,10.4650,180.0,10.3960,200.0,10.2500,
  220.0,10.096,240.0, 9.9350,260.0, 9.7710,280.0, 9.6100,
  300.0, 9.455,320.0, 9.3070,340.0, 9.1660,360.0, 9.0320,
  380.0, 8.905,400.0, 8.7850,450.0, 8.5130,500.0, 8.2790,
  550.0, 8.083,600.0, 7.9210,700.0, 7.6690,800.0, 7.4960,
  900.0,7.32000, 1000.0,7.18933, 1200.0,6.98066, 1500.0,6.75319,
  2000.0,6.50015, 2500.0,6.33424, 3000.0,6.21913, 3500.0,6.13510,
  4000.0,6.07040, 4500.0,6.01822, 5000.0,5.97432, 6000.0,5.90181,
  7000.0,5.84156, 8000.0,5.78889, 9000.0,5.74211,10000.0,5.70050,
 12000.0,5.62944,15000.0,5.54300,20000.0,5.43785,25000.0,5.35842,
 30000.0,5.29298,35000.0,5.23538,40000.0,5.18263,50000.0,5.08615,
  60000.0,4.99762,80000.0,4.83617,100000.0,4.68988,
                            -1.0,0.0 );
  $c1=0.20;
  $c2=0.08;
  $c3=0.0065;
  $d=0.1;
/* get time from port. table */
/* find dist in table */
  for ($i=0; $dist > $d && $d>0;$i+=2) {
          $d=$ptable[$i];
  }
  if ($d<1) {
          return 0;    /* cant find distance*/
  }
  $i+=-2;
  $d3=$ptable[$i];        /* get distance */
  $t3= $d3/$ptable[$i+1];    /* get time */
  $d1=$ptable[$i-2];
  $t1=$d1/$ptable[$i-1];
/* use linear interpolation to get time of 950 pt. performance*/
  $t = $t1 + ($t3-$t1)*($dist-$d1)/($d3-$d1);
  $v = $dist/$t;
/* now add the slow down from start and curves */
  $t950 = $t +$c1+$c2*$v +$c3 * frac( (float)$dist )*$v*$v;
/* calc purdy points */
  $k = 0.0654 - 0.00258*$v;
  $a = 85/$k;
  $b = 1-950/$a;
  $p = (float)($a*($t950/$tsec - $b));        /* here it is */
  if ($p<0) {
      $p=0;
  }
  return $p;
}
/*******************************************************/
/* calc the fraction of time from track curves that slows down the time from the tables */
  function frac($d)
  {
//  int $laps,$partlaps,$meters;
//  float $tmeters;
  if ($d < 110) {
          return 0;
  }
  else
  {
      $laps = (int)($d / 400);
      $meters = (int)($d - $laps * 400); 
      $partlaps = 0;
	  switch (true)
	  {
	  case ($meters <= 50):
		$partlaps = 0;
		break;
	  case ($meters <= 150):
	        $partlaps = $meters - 50;
		break;
	  case ($meters <= 250):
		$partlaps = 100;
		break;
	  case ($meters <= 350):
		$partlaps = 100 + ($meters - 250);
		break;
	  case ($meters <= 400):
		$partlaps = 200;
		break;
	  }  
      $tmeters = (float)($laps * 200 + $partlaps);    
      return ($tmeters/$d);    
  }
}

// takes the points from 4 races and scores them
function nPoints($n1, $n2, $n3, $n4)
{
    $numb = array($n1, $n2, $n3, $n4);
	sort($numb);
	
    return $numb[0] * 1 + $numb[1] * 2 + $numb[2] * 3 + $numb[3] * 4;
}

function cWrite ($cData, $nlen) {
    return str_pad($cData,$nlen," ",STR_PAD_RIGHT);
}

function nWrite ($nData, $nlen) {
    return str_pad((int)$nData,$nlen," ",STR_PAD_LEFT);
}

?>

</html>
