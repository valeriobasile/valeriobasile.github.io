<?
function make_radio($variable, $variable_label, $items, $hidden=false){
    if ($hidden){
        echo "<div class='subvariable' style='visibility:hidden' id='div_$variable'>\n";
    }
    else {
        echo "<div class='variable' id='div_$variable'>\n";
    }
    echo "<h2>".$variable_label."</h2>\n";
    foreach($items as $item){
        echo "<input type='radio' name='$variable' value='".$item["value"]."' id='$variable.".$item["value"]."' class='choice' onclick='check_visibility();'>\n";
        echo "<label for='$variable.".$item["value"]."'>".$item["label"]."</label>\n";
        echo "</input>\n";
    }
    echo "</div>\n";
}

require_once('items.php');

make_radio("T2", "Type of tweet", $T2_items);
make_radio("T3", "Interaction with", $T3_items, $hidden=true);
make_radio("T4", "Twittering behavior", $T4_items);
make_radio("T5", "Topic of Tweet", $T5_items);
make_radio("T6", "Criticized party", $T6_items, $hidden=true);
make_radio("T7", "Personal", $T7_items);
make_radio("T8", "Topic of personal", $T8_items, $hidden=true);
make_radio("T9", "Reaction: Leader debates", $T9_items);
make_radio("T10", "Reaction: News coverage", $T10_items);

?>

