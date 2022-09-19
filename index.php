<?php
//sdie('hello');
date_default_timezone_set("UTC");
echo date('h:i:s', time());
if(isset($_GET['u']) && $_GET['u'] != ''){
  if($_GET['u'] == 'embrolio'){
    $username = isset($_GET['key']) && $_GET['key'] == 'dontmesswithme' ? 'embrolio' : 'luifa';
  }else{
    $username = strip_tags($_GET['u']);
  }
}else{
  $username = 'luifa';
}

$platform = "ANDROID";
if(isset($_GET['p']) && $_GET['p'] != ''){
        $platform = $_GET['p'];
}

if(isset($_GET['c']) && $_GET['c'] != ''){
        $category = $_GET['c'];
}
if(isset($_GET['ref']) && $_GET['ref'] != ''){
        $referrer = $_GET['ref'];
}

$aString = array(
    'u'=>$username, 't'=>time()+1000000, 'b'=> $platform, 'ma'=>'3', 'mi'=>'0'
);
$aStringLive = array(
    'u'=>$username, 't'=>time() + 1000000, 'b'=> $platform, 'ma'=>'3', 'mi'=>'0'
);

if (isset($category)){
        $aString['c']=$category;
        $aStringLive['c']=$category;
}
if (isset($referrer)){
        $aString['ref']=$referrer;
        $aStringLive['ref']=$referrer;
}
//var_dump($aString);
foreach($aString as &$val) {
    $val = urlencode($val);
}
//var_dump($aString);
foreach($aStringLive as &$val) {
    $val = urlencode($val);
}

//generating signature
ksort($aString);
$str = '';
foreach($aString as $key => $value){
  $str .= $key.'='.$value;
}
$sKey = 'fMv9FzIevMaP3d5A'; //dev

/*
//live
ksort($aStringLive);
$str = '';
foreach($aStringLive as $key => $value){
  $str .= $key.'='.$value;
}
$sKey = 'OOZLXgBj9uKwdOcf';
*/
$str .= $sKey;
$signature = md5($str);

foreach($aString as &$val) {
    $val = urldecode($val);
}

foreach($aStringLive as &$val) {
    $val = urldecode($val);
}

$aString['signature']=$signature;
$aStringLive['signature']=$signature;

$token = http_build_query($aString);
$tokenLive = http_build_query($aStringLive);

var_dump($token);
var_dump($tokenLive);

?>
<html>
<body>
<p>
<b>TOKEN (no category):</b> <? var_dump($token) ?>
<br />
Dev1-voipnim: <a href="http://shopdev1.voipnim.com/?<?= $token ?>">Goto shop</a>
<br />
Dev1: <a href="http://shopdev1.nimbuzz.com/?<?= $token ?>">Goto shop</a>
<br />
Dev2: <a href="http://shopdev2.nimbuzz.com/?<?= $token ?>">Goto shop</a>
<br />
Dev3: <a href="http://shopdev3.nimbuzz.com/?<?= $token ?>">Goto shop</a>
<br />
Dev4: <a href="http://shopdev4.nimbuzz.com/?<?= $token ?>">Goto shop</a>
<br />
Buzzaa: <a href="http://shop.buzzaa.com/?<?= $tokenLive ?>">Goto shop</a>
<br />
Profile Buzzaa: <a href="http://profile.buzzaa.com/?<?= $tokenLive ?>">Goto shop</a>
<br />
Live: <a href="http://shop.nimbuzz.com/?<?= $tokenLive ?>">Goto shop</a>
<br />
Shop - branch: <a href="http://br-shopmf.nimbuzz.com/?<?= $token ?>">Goto shop</a>
<br />
Shop - trunk <a href="http://tr-shopmf.nimbuzz.com/?<?= $token ?>">Goto shop</a>
<br/>
Shop UI: <a href="http://myshop.nimbuzz.com/?<?= $token ?>">Goto shop</a>
<br/>
Profile: <a href="http://mypublicpage.nimbuzz.com/?<?= $token ?>">Goto profile</a>
<br/>
Dev1-Profile: <a href="http://publicpagedev1.voipnim.com/?<?= $token ?>">Goto profile</a>
<br/>
Get-local: <a href="http://tr-get.local.com/tell-us?<?= $token ?>">Goto get</a>
<br/>
Get-nimbuzz: <a href="http://getdev1.nimbuzz.com/tell-us?<?= $token ?>">Goto get</a>
</p>
Rates: <a href="http://myservices.nimbuzz.com/voip_rates?<?= $token ?>">Goto rates</a>
</p>
<p>
<b>TOKEN (avatar):</b> <? var_dump($token_avatar) ?>
<br />
Dev1: <a href="http://shopdev1.nimbuzz.com/?t=<?= $token_avatar ?>">Goto shop (avatar)</a>
<br />
Dev2: <a href="http://shopdev2.nimbuzz.com/?t=<?= $token_avatar ?>">Goto shop (avatar)</a>
<br />
Dev3: <a href="http://shopdev3.nimbuzz.com/?t=<?= $token_avatar ?>">Goto shop (avatar)</a>
<br />
Buzzaa: <a href="http://shop.buzzaa.com/?t=<?= $token_avatar ?>">Goto shop (avatar)</a>
<br />
Live: <a href="http://shop.nimbuzz.com/?t=<?= $token_avatar ?>">Goto shop (avatar)</a>
</p>
</body>
</html>
