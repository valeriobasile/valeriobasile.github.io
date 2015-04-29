<?
$T2 = $_POST["T2"];
$T3 = $_POST["T3"];
$T4 = $_POST["T4"];
$T5 = $_POST["T5"];
$T6 = $_POST["T6"];

# insert new code in the database
$sql = "DELETE FROM code 
        WHERE coder = ?
        AND tweet_ind = ?";
try {
    $prev = $tweet_ind-1;
    $query = $db->prepare($sql);
    $query->bindParam(1,$coder);
    $query->bindParam(2,$prev);
    $res = $query->execute();
}
catch(PDOException $e) {
    echo"error: ";
    echo $e->getMessage();
}

# udpate last_code table
if ($TEST) {
$sql = "UPDATE last_code_test
        SET tweet_ind = ?
        WHERE coder = ?";
}
else {
$sql = "UPDATE last_code
        SET tweet_ind = ?
        WHERE coder = ?";
}

try {
    $prev = $tweet_ind-2;
    $query = $db->prepare($sql);
    $query->bindParam(1,$prev);
    $query->bindParam(2,$coder);
    $res = $query->execute();
}
catch(PDOException $e) {
    echo"error: ";
    echo $e->getMessage();
}
?>
