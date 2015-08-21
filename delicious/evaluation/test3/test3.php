<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it-it" lang="it-it" >
<head>
<title>del.icio.us annotation - test 3</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body {
	margin-left:20%;
	margin-right:20%;
}
</style>
</head>
<body>
<?php
$colors = array(
    0 => "lightyellow", 
    1 => "red", 
    2 => "pink", 
    3 => "lightgrey", 
    4 => "lightblue", 
    5 => "blue"
);

$labels = array(
    1 => "Always or mostly<br/>non-topical", 
    2 => "Usually<br/>non-topical",
    3 => "both ways", 
    4 => "Usually<br/>topical", 
    5 => "Always or mostly<br/>topical"
);

/*
How much do you expect ***these tags*** to have been used...

Poi farei un padding sinistro e destro dei radio button piuttosto potente, da stare larghi, e magari come header della tabella, invece che 1, 2, 3, 4 e 5 metti
<tr>
<th>Always or mostly<br/>non-topical</th>
<th>Usually<br/>non-topicall</th>
<th>both waysl</th>
<th>Usually<br/>topicall</th>
<th>Always or mostly<br/>topical</th>

*/
?>



<h1>del.icio.us annotation - test 3</h1>
<p>
<em>
How much do you expect these tags to have been used in 
folksonomies as <strong>topical</strong> (i.e. representing topics of the content of the document)<br/>
or <strong>non-topical</strong> (i.e. representing something that is NOT a topic of the document):
</em>
</p>
<ol>
<li><span style="background-color:<?=$colors[1]?>">&nbsp;&nbsp;</span>Always or mostly non-topical. The use as topical is quite unlikely.</li>
<li><span style="background-color:<?=$colors[2]?>">&nbsp;&nbsp;</span>Usually non-topical, but there might have been documents in which was used as topical.</li>
<li><span style="background-color:<?=$colors[3]?>">&nbsp;&nbsp;</span>It could have been used in both ways, or I really have no idea.</li>
<li><span style="background-color:<?=$colors[4]?>">&nbsp;&nbsp;</span>Usually topical, but there might have been documents in which was used as non-topical.</li>
<li><span style="background-color:<?=$colors[5]?>">&nbsp;&nbsp;</span>Always or mostly topical. The use as non-topical is quite unlikely.</li>
</ol>
<?
function table_row($tag){
	global $labels;
	global $colors;
	
	print "<tr>";
	print "<td style=\"text-align: left; padding: 0.2em;\" id=\"tag_$tag\">$tag</td>";
	for ($i=1; $i<=5; $i++)
    	print "<td style=\"text-align: center; padding: 0.2em; background-color: ".$colors[$i]."\"><input name=\"".$tag."\" type=\"radio\" value=\"$i\" onclick=\"document.getElementById('tag_$tag').style.backgroundColor = 'lightgreen'\"></input></td>";
	print "</tr>";
}

print ("<div style=\"height:400px; overflow-y: scroll\">");
print ("<form name=\"form_test3\" action=\"save_test3.php\" method=\"post\" target=\"_top\">");
print ("Your Name: <input type=\"text\" name=\"user\" /><br/><br/>");

$tags = array(
    "science",
	"graphics",
	"useful",
	"blogs",
	"make",
	"engine",
	"editing",
	"configuration",
	"examples",
	"directory",
	"viapackratius",
	"javascript",
	"ipod",
	"new",
	"comparison",
	"support",
	"extensions",
	"social",
	"portal",
	"programming",
	"fashion",
	"community",
	"socialmedia",
	"power",
	"twitter",
	"graphic",
	"urban",
	"share",
	"ssl",
	"safety",
	"aspnet",
	"art",
	"internet",
	"website",
	"read",
	"geo",
	"teachers",
	"dessert",
	"australia",
	"hiking",
	"arthurmerlin",
	"startrek",
	"merlinarthur",
	"harrydraco",
	"sherlock",
	"arthureames",
	"mckaysheppard",
	"jaredjensen",
	"stevedanny",
	"hp",
	"brendonryan",
	"merlin",
	"kurtblaine",
	"sherlockjohn",
	"pairingarthureames",
	"fandomsherlock",
	"inception",
	"harrypotter",
	"deancastiel",
	"kirkspock"
);

shuffle($tags);



print ("<table border=\"0\">");
print "<thead>";
print "<th>Tag</th>";
print "<th style=\"text-align: center; padding: 0.2em; background-color: ".$colors[1]."\">".$labels[1]."</th>";
print "<th style=\"text-align: center; padding: 0.2em; background-color: ".$colors[2]."\">".$labels[2]."</th>";
print "<th style=\"text-align: center; padding: 0.2em; background-color: ".$colors[3]."\">".$labels[3]."</th>";
print "<th style=\"text-align: center; padding: 0.2em; background-color: ".$colors[4]."\">".$labels[4]."</th>";
print "<th style=\"text-align: center; padding: 0.2em; background-color: ".$colors[5]."\">".$labels[5]."</th>";
print "</thead>";
print "<tbody>";

foreach ($tags as $tag){
        print (table_row($tag));
}

print "</tbody>";
print ("</table>");
print ("<br/><input type=\"submit\" value=\"save\" />");
print ("</form>");
print ("</div>");
?>
</body>
</html>
