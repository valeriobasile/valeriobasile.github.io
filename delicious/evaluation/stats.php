<?
function fleissKappa($table){

    /*
    *   author Tom Aizenberg
    *   
    *   $table is an n x m array containing the classification counts
    *   
    *   adapted from the example in en.wikipedia.org/wiki/Fleiss'_kappa 
    * 
    */

    $subjects = count($table);
    $classes = count($table[0]);
    $raters = array_sum($table[0]);

    for($q = 1; $q < count($table); $q++){

        if(count($table[$q])!=$classes){

            print("no equal number of classes.");
            exit(0);
        }

        if(array_sum($table[$q])!=$raters){

            print("no equal number of raters.");
            exit(0);
        }

    }

    $pj = array();
    $pi = array();

    for($j = 0; $j < $subjects; $j++){

        $pi[$j] =0;
    }

    for($i = 0; $i < $classes; $i++){

        $tpj = 0;

        for($j = 0; $j < $subjects; $j++){

            $tpj += $table[$j][$i];
            $pi[$j] +=  $table[$j][$i]*$table[$j][$i];

        }

        $pj[$i] = $tpj/($raters*$subjects);

    }

    for($j = 0; $j < $subjects; $j++){
        $pi[$j] = $pi[$j]-$raters;
        $pi[$j] = $pi[$j]*(1/($raters*($raters-1)));
    }

    $pcarret = array_sum($pi)/$subjects;
    $pecarret = 0;

    for($i = 0; $i < count($pj);$i++){

        $pecarret += $pj[$i]*$pj[$i];

    }

    $kappa = ($pcarret-$pecarret)/(1-$pecarret);

    return $kappa;

}



function cohen_kappa($PP, $PN, $NP, $NN){
	$tot = ($PP+$PN+$NP+$NN);
	#$tot = 50;
	$PP = $PP / $tot;
	$NP = $NP / $tot;
	$PN = $PN / $tot;
	$NN = $NN / $tot;
	$o = $PP + $NN;
	$mPP_NP = $PP+$NP;
	$mPN_NN = $PN+$NN;
    $mPP_PN = $PP+$PN;
	$mNP_NN = $NP+$NN;
	$e = ($mPP_NP * $mPP_PN) + ($mPN_NN * $mNP_NN);
	if ($e<1)
		$k = ($o-$e)/(1-$e);
    else
        $k = 0;
/*
    if ($k < 0){
        print $PP." ".$PN." ".$NP." ".$NN."<br/>";
        print $o."-".$e."=".($o-$e)."<br/>";
    }
*/
    return $k;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it-it" lang="it-it" >
<head>
<title>Crawling del.icio.us</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body {
     margin-left:20%;
     margin-right:20%;
}

td {
   border: 1px solid #ddd;
}

.td_number {
	   text-align: right;
}
.footnote {
	  font-size: smaller;
	  font-style: italic;
}

pre {
    background: #ddd;
}
</style>
</head>
<body>
<?php
$db_file = "db/list.sqlite";
$table_name = "list";
$users = Array("FT", "FV", "SP", "VB");
$tags = Array("online", "free", "howto", "books", "python", "game", "environment", "healthcare", "philosophy", "vegetarian");
$db = sqlite_open($db_file) or die("ERROR: Could not open database!"); 
?>

<h2>Totals</h2>
<table>
<thead>
<th>user</th>
<th>tagged</th>
<th>subject</th>
<th>non subject</th>
<th>#S/total</th>
</thead>
<tbody>

<?
foreach ($users as $user){
	$query = sqlite_query($db, "select count($user) as count, $user from $table_name group by $user");
	$assoc = sqlite_fetch_all($query);
	$subject = 0;
	$nonsubject = 0;
	foreach ($assoc as $row){
		if ($row[$user] == "0")
			$untagged = $row["count"];
		elseif ($row[$user] == "1") 
		       $subject = $row["count"];
		elseif ($row[$user] == "2")
		       $nonsubject = $row["count"];
	}
	
	$tagged = $subject + $nonsubject;
#	if ($subject > 0)
		$ratio = $subject / 500;
#	else
#		$ratio = "inf.";	
	
	echo("<tr>\n");
	echo("<td>$user</td>\n");
	echo("<td>".$tagged." (".($tagged/5)."%)</td>\n");
	echo("<td>$subject (".($subject/5)."%)</td>\n");
	echo("<td>$nonsubject(".($nonsubject/5)."%)</td>\n");
	echo("<td>$ratio</td>\n");
	echo("</tr>\n");

}
?>

</tbody>
</table>

<h2># Subject tags / total ratio</h2>

<table>
<thead>
<th>tag</th>
<th>FT</th>
<th>FV</th>
<th>SP</th>
<th>VB</th>
</thead>
<tbody>

<?
foreach ($tags as $tag){
	$query = sqlite_query($db, "select * from $table_name where tag = '$tag'");
	$assoc = sqlite_fetch_all($query);

	$s_FT = 0;
	$n_FT = 0;
	$s_FV = 0;
	$n_FV = 0;
	$s_SP = 0;
	$n_SP = 0;
	$s_VB = 0;
	$n_VB = 0;

	foreach ($assoc as $row){
		if ($row["FT"] == "1") $s_FT += 1;
		if ($row["FT"] == "2") $n_FT += 1;
		if ($row["FV"] == "1") $s_FV += 1;
		if ($row["FV"] == "2") $n_FV += 1;
		if ($row["SP"] == "1") $s_SP += 1;
		if ($row["SP"] == "2") $n_SP += 1;
		if ($row["VB"] == "1") $s_VB += 1;
		if ($row["VB"] == "2") $n_VB += 1;

	}
	
	$ratio_FT = $s_FT == "0" ? "0" : round($s_FT / 50, 2);
	$ratio_FV = $s_FV == "0" ? "0" : round($s_FV / 50, 2);
	$ratio_SP = $s_SP == "0" ? "0" : round($s_SP / 50, 2);
	$ratio_VB = $s_VB == "0" ? "0" : round($s_VB / 50, 2);

	echo("<tr>\n");
	echo("<td>$tag</td>\n");
	echo("<td>$ratio_FT</td>\n");
	echo("<td>$ratio_FV</td>\n");
	echo("<td>$ratio_SP</td>\n");
	echo("<td>$ratio_VB</td>\n");
	echo("</tr>\n");

}
?>

</tbody>
</table>

<h2>Inter-annotator agreement - Cohen's kappa</h2>

<table>
<thead>
<th>tag</th>
<th>avg. Cohen's K</th>
<th>Fleiss' K</th>
</thead>
<tbody>
<!-- inter-annotator agreement (Cohen's Kappa) -->
<?
foreach ($tags as $tag){
	$avg = 0;
	$table=Array();
	foreach ($users as $user1){
		foreach ($users as $user2){
			if ($user1 < $user2){
				# positive / positive
				$query = sqlite_query($db, "select count(*) as count from $table_name where $user1=1 and $user2=1 and tag='$tag' and valid='1'");
				$assoc = sqlite_fetch_all($query);
				$PP = $assoc[0]["count"];
		
				# positive / negative
				$query = sqlite_query($db, "select count(*) as count from $table_name where $user1=1 and $user2=2 and tag='$tag' and valid='1'");
				$assoc = sqlite_fetch_all($query);
				$PN = $assoc[0]["count"];
		
				# negative / positive
				$query = sqlite_query($db, "select count(*) as count from $table_name where $user1=2 and $user2=1 and tag='$tag' and valid='1'");
				$assoc = sqlite_fetch_all($query);
				$NP = $assoc[0]["count"];
		
				# negative / negative
				$query = sqlite_query($db, "select count(*) as count from $table_name where $user1=2 and $user2=2 and tag='$tag' and valid='1'");
				$assoc = sqlite_fetch_all($query);
				$NN = $assoc[0]["count"];		

				$avg += cohen_kappa($PP, $PN, $NP, $NN);
				#echo "<tr><td>$user1-$user2</td><td>".cohen_kappa($PP, $PN, $NP, $NN)."</td></tr>";
				
			}
		}
	}
	$query = sqlite_query($db, "select url, FT, FV, SP, VB from $table_name where tag='$tag' and valid='1'");
	while ($row = sqlite_fetch_array($query)){
	    $array_count = array_count_values($row);
		$sum0 = $array_count['0'];
		$sum1 = $array_count['1'];
		$sum2 = $array_count['2'];
		$table[] = array($sum0, $sum1, $sum2);
    }
	$avg = round($avg /= 6, 2);

	echo "<tr><td>$tag</td><td>$avg</td><td>".round(fleissKappa($table),2)."</td></tr>";
}
?>
</tbody>
</table>

<table>
<thead>
<th>annotator pair</th>
<th>avg Cohen's K</th>
</thead>
<tbody>
<!-- inter-annotator agreement -->
<?
foreach ($users as $user1){
	foreach ($users as $user2){
		if ($user1 < $user2){
			# positive / positive
			$query = sqlite_query($db, "select count(*) as count from $table_name where $user1=1 and $user2=1 and valid='1'");
			$assoc = sqlite_fetch_all($query);
			$PP = $assoc[0]["count"];
		
			# positive / negative
			$query = sqlite_query($db, "select count(*) as count from $table_name where $user1=1 and $user2=2 and valid='1'");
			$assoc = sqlite_fetch_all($query);
			$PN = $assoc[0]["count"];
		
			# negative / positive
			$query = sqlite_query($db, "select count(*) as count from $table_name where $user1=2 and $user2=1 and valid='1'");
			$assoc = sqlite_fetch_all($query);
			$NP = $assoc[0]["count"];
		
			# negative / negative
			$query = sqlite_query($db, "select count(*) as count from $table_name where $user1=2 and $user2=2 and valid='1'");
			$assoc = sqlite_fetch_all($query);
			$NN = $assoc[0]["count"];		

			$k = round(cohen_kappa($PP, $PN, $NP, $NN), 2);
	
			echo "<tr><td>$user1-$user2</td><td>$k</td></tr>";
			
		}
	}
	
}
?>
</tbody>
</table>
</body>
</html>
