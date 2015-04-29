<pre>
<?
function HSVtoRGB(array $hsv) {
    list($H,$S,$V) = $hsv;
    //1
    $H *= 6;
    //2
    $I = floor($H);
    $F = $H - $I;
    //3
    $M = $V * (1 - $S);
    $N = $V * (1 - $S * $F);
    $K = $V * (1 - $S * (1 - $F));
    //4
    switch ($I) {
        case 0:
            list($R,$G,$B) = array($V,$K,$M);
            break;
        case 1:
            list($R,$G,$B) = array($N,$V,$M);
            break;
        case 2:
            list($R,$G,$B) = array($M,$V,$K);
            break;
        case 3:
            list($R,$G,$B) = array($M,$N,$V);
            break;
        case 4:
            list($R,$G,$B) = array($K,$M,$V);
            break;
        case 5:
        case 6: //for when $H=1 is given
            list($R,$G,$B) = array($V,$M,$N);
            break;
    }
    return array($R, $G, $B);
}

function zeropad($num, $lim) {
   return (strlen($num) >= $lim) ? $num : zeropad("0" . $num);
}

function username_hash($username, $modulo){
    $sum = 0;
    for ($i=0; $i < strlen($username); $i++) {
        $sum += ord(substr($username, $i, 1));
    }
    return $sum % $modulo;
}

function username_color($username) {
    $hue = username_hash($username, 256) / 256;
    $rgb = HSVtoRGB(array($hue, 0.2, 0.8));
    
    $r = zeropad(dechex($rgb[0]*256),2);
    $g = zeropad(dechex($rgb[1]*256),2);
    $b = zeropad(dechex($rgb[2]*256),2);

    return "#".$r.$g.$b;
}
?>
</pre>
