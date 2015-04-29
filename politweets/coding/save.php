<?
$T2 = $_POST["T2"];
$T3 = $_POST["T3"];
$T4 = $_POST["T4"];
$T5 = $_POST["T5"];
$T6 = $_POST["T6"];
$T7 = $_POST["T7"];
$T8 = $_POST["T8"];
$T9 = $_POST["T9"];
$T10 = $_POST["T10"];

if ($TEST)
    $partition = 'test';
else
    $partition = 'twoweeks';    


# insert new code in the database
$sql = "INSERT INTO code (coder, tweet_ind, party, partition, T2, T3, T4, T5, T6, T7, T8, T9, T10) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
try {
    $query = $db->prepare($sql) or die('error preparing the query');
    $query->bindParam(1,$coder);
    $query->bindParam(2,$tweet_ind);
    $query->bindParam(3,$party);
    $query->bindParam(4,$partition);
    $query->bindParam(5,$T2);
    $query->bindParam(6,$T3);
    $query->bindParam(7,$T4);
    $query->bindParam(8,$T5);
    $query->bindParam(9,$T6);
    $query->bindParam(10,$T7);
    $query->bindParam(11,$T8);
    $query->bindParam(12,$T9);
    $query->bindParam(13,$T10);
    $res = $query->execute();
}
catch(PDOException $e) {
    echo"error: ";
    echo $e->getMessage();
}

if ($TEST) {
    # udpate last_code table
    $sql = "UPDATE last_code_test
            SET tweet_ind = ?
            WHERE coder = ?";
    try {
        $query = $db->prepare($sql);
        $query->bindParam(1,$tweet_ind);
        $query->bindParam(2,$coder);
        $res = $query->execute();
    }
    catch(PDOException $e) {
        echo"error: ";
        echo $e->getMessage();
    }
}
else {
    # udpate last_code table
    $sql = "UPDATE last_code
            SET tweet_ind = ?, party = ?
            WHERE coder = ?";
    try {
        $query = $db->prepare($sql);
        $query->bindParam(1,$tweet_ind);
        $query->bindParam(2,$party);
        $query->bindParam(3,$coder);
        $res = $query->execute();
    }
    catch(PDOException $e) {
        echo"error: ";
        echo $e->getMessage();
    }
}
?>
