<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>BOSTON BUILDUP WINTER SERIES STANDINGS</title>
</head>
<body alink="#23ff22" bgcolor="#ffffff" link="#150b79" text="#000000" vlink="#b118ff">
<div style="text-align:center">
<h1><img src="http://clubct.org/Buildup/BB2019w.png" alt="BOSTON BUILDUP XLI WINTER SERIES 2019" width="383" height="426" /></h1>
<hr/>
<h2>Series Standings</h2><hr/>
</div>
<pre>
The age-group leaders are:

<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
/*--------- DATABASE CONNECTION INFO---------*/ 
$hostname="localhost"; 
$mysql_login="root"; 
$mysql_password="accucom250"; 
$database="bbdata"; 

// connect to the database server 
// $link = mysql_connect($hostname, $mysql_login, $mysql_password);
$link = mysqli_connect($hostname, $mysql_login, $mysql_password, $database);
if (!$link) {
    die("Could not connect: " . mysqli_error($link));
}

$gsSQL = "SELECT MAX(NRACES) AS COL1 FROM bbdata.bb2 ";
$result = mysqli_query($link, $gsSQL);
$row = mysqli_fetch_assoc($result);
$intRaces = (int)$row['COL1'];

$gsSQL = "";
$gsSQL = $gsSQL . "SELECT Bb4.corder, Bb2.cat2, Bb2.crank, Bb2.name, Bb2.ptotal, Bb2.nraces ";
$gsSQL = $gsSQL . "FROM bbdata.bb2 INNER JOIN bbdata.bb4 ";
$gsSQL = $gsSQL . "ON bB2.CAT2 = bB4.CAT2 ";
$gsSQL = $gsSQL . "WHERE Bb2.crank <= 5 ";
$gsSQL = $gsSQL . "ORDER BY Bb4.corder, Bb2.cat2, Bb2.crank, Bb2.name";

$result = mysqli_query($link, $gsSQL);
while ($row = mysqli_fetch_assoc($result)) {
   $crank = (int)$row['crank'];
   if ($crank == 1) {
     $cat2 = $row['cat2'];
     switch ($cat2)	 {
        Case "OpM":  
				 echo "<b>...Men 29 &amp; Under (OpM):</b>";
        			 break;
        Case "M30":  
				 echo "<b>...Men 30 - 39 (M30):</b>";
        			 break;
        Case "M40":  
				 echo "<b>...Men 40 - 49 (M40):</b>";
        			 break;
        Case "M50":  
				 echo "<b>...Men 50 - 59 (M50):</b>";
        			 break;
        Case "M60":  
				 echo "<b>...Men 60 &amp; Up (M60):</b>";
        			 break;
        Case "OpW":  
				 echo "<b>...Women 29 &amp; Under (OpW):</b>";
        			 break;
        Case "W30";  
				 echo "<b>...Women 30 - 39 (W30):</b>";
        			 break;
        Case "W40";  
				 echo "<b>...Women 40 - 49 (W40):</b>";
        			 break;
        Case "W50":  
				 echo "<b>...Women 50 - 59 (W50):</b>";
        			 break;
        Case "W60":  
				 echo "<b>...Women 60 &amp; Up (W60):</b>";
        			 break;
	}?>

<?php
  }
  $Name = cWrite($row['name'], 25);
  $Ptotal = nWrite((int)$row['ptotal'], 5);

  echo str_repeat(" ", 5) . $Name . "   " . $Ptotal;

  $intCnt = (int)$row['nraces'];
  if ($intRaces > $intCnt) {
    echo " (<i>ran only ";
    echo $intCnt;
    echo " race";
    if ($intCnt > 1) {
       echo "s";
    }
    echo "</i>)";
  }?>

<?php
}

echo "</pre>";
?>
<br/><br/>In the Series scoring, <b>Purdy Points </b>are awarded for each race: the
points reflect the runner's pace per minute, weighted for the number of miles in
that race. Then, the runner's best race is multiplied by 4, his next best race
by 3, next by 2 and his worst race remains unmultiplied.
<h4>........................................STANDINGS,
OVER-ALL...........................................<br/></h4>
<pre><b>    ACCUM                           T I M E   A N D   P O I N T S
     PTS GRP  RUNNER                    10-KM    15-KM    20-KM    25-KM</b>
     
<?php
$gsSQL = "";
$gsSQL = $gsSQL . "Select PRANK, PTOTAL, CAT2, NAME, TIME1, TIME2, TIME3, TIME4, ";
$gsSQL = $gsSQL . "PT1, PT2, PT3, PT4 ";
$gsSQL = $gsSQL . "FROM bbdata.bb2 ORDER BY PRANK, NAME, CAT2";

$result = mysqli_query($link, $gsSQL);
while ($row = mysqli_fetch_assoc($result)) {
  $Prank = nWrite((int)$row['PRANK'], 3);
  $Ptotal = nWrite((int)$row['PTOTAL'], 5);
  $Cat2 = cWrite($row['CAT2'], 3);
  $Name = cWrite($row['NAME'], 25);
  $Time1 = DispTime($row['TIME1']);
  $Time2 = DispTime($row['TIME2']);
  $Time3 = DispTime($row['TIME3']);
  $Time4 = DispTime($row['TIME4']);
  $Pt1 = DispPts((int)$row['PT1']);
  $Pt2 = DispPts((int)$row['PT2']);
  $Pt3 = DispPts((int)$row['PT3']);
  $Pt4 = DispPts((int)$row['PT4']);
  echo $Prank . $Ptotal . " " . $Cat2 . "  " . $Name . $Time1 . "  " . $Time2 . "  " . $Time3 . "  " . $Time4;?>
  
<?php
  echo str_repeat(" ", 39) . $Pt1 . str_repeat(" ", 5) . $Pt2 . str_repeat(" ", 5) . $Pt3 . str_repeat(" ", 5) . $Pt4 ;?>
  

<?php
}
mysqli_close($link); 
echo "</pre>";
?>
<ul>
  <li><b><a href="http://www.clubct.org/Buildup/BBInfo.html">General
  Information</a><br/></b>
  </li>
  <li><b><a href="http://www.clubct.org/Buildup/BBSked.html">Race Schedule &amp;
  Directions</a><br/></b>
  </li>
  <li><b><a href="http://www.clubct.org/Buildup/BBMaps.html">Course
  Maps</a><br/></b>
  </li>
  <li><b><a href="http://www.clubct.org/Results/BBResults.html">Race
  Results</a><br/></b>
  </li>
  <li><b><a href="http://www.clubct.org/Buildup/BosBuild.html">Back to Boston
  Buildup Home Page</a></b>
  <br/><br/>
</li>
  <li><b><a href="http://www.clubct.org/">Back to Club Connecticut Home Page</a></b></li></ul>
</body>
<?php
function cWrite ($cData, $nlen) {
    return str_pad($cData,$nlen," ",STR_PAD_RIGHT);
}

function nWrite ($nData, $nlen) {
    return str_pad((int)$nData,$nlen," ",STR_PAD_LEFT);
}

function DispTime ($chkTime) {
  if (substr($chkTime,0,2) == "0:") {
     $chkTime = "  " . substr($chkTime,2,5);
  }
  return cWrite($chkTime, 7);
}

function DispPts ($chkPt) {
  if ($chkPt == 0) {
     $chk0 = "    ";
  }
  else {
     $chk0 = nWrite($chkPt, 4);
  }
  return $chk0;
}
?>
</html>
