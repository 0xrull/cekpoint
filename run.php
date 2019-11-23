<?php
/*
MASS CHECK POINT MARLBORO.COM
Created By Alip Dzikri
PT MISKIN TERUS Aka Hijrah ~ 2019
*/
error_reporting(0);
echo "MARLBORO CHECK POINT \n";
echo "File Akun : ";
$fileakun = trim(fgets(STDIN));
print PHP_EOL."Total Ada : ".count(explode("\n", str_replace("\r","",@file_get_contents($fileakun))))." Akun, Letsgo..\n";
foreach(explode("\n", str_replace("\r", "", @file_get_contents($fileakun))) as $c => $akon)
	{
		$pecah = explode("|", trim($akon));
		$email = trim($pecah[0]);
		$password = trim($pecah[1]);

$urlencode = urlencode($email);
$urlencode1 = urlencode($password);
$get_cookie = get_cookie();
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $get_cookie, $cookie);
preg_match('/<input type="hidden" name="decide_csrf" value="(.*?)"/',$get_cookie, $a);
$login = login($cookie,$urlencode,$urlencode1,$a);
if(preg_match('/success/i', $login)){
	echo "$email = ";
	preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $login, $cookiess);
	$get_token = get_token();
preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $get_token, $cookies);
$get_point = get_point($cookies,$cookiess);
preg_match('/let point_value = \'(.*?)\'/',$get_point, $point);
echo "$point[1] pts \n";
 $livee = "listakun_point.txt";
    $fopen = fopen($livee, "a+");
    $fwrite = fwrite($fopen, "\r  ".$email."|".$password."| ".$point[1]." \n");
    fclose($fopen);

}
}
function get_cookie(){
$c = curl_init("https://www.marlboro.id/auth/login");
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($c, CURLOPT_MAXREDIRS, 15);
    curl_setopt($c, CURLOPT_TIMEOUT, 30);
    curl_setopt($c, CURLOPT_ENCODING, "");
    curl_setopt($c, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($c, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_HEADER, true);
    $response = curl_exec($c);
    return $response;

}
	function login($cookie,$urlencode,$urlencode1,$a){
		$header = array();
			$header[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0";
			$header[] = "Accept: text/html,application/xhtml+xml,application/xml";
			$header[] = "Accept-Language: en-US,en";
			$header[] = "Accept: application/json";
			$header[] = 'Cookie: scs=1; '.$cookie[1][1].'; '.$cookie[1][2].'';
	$c = curl_init("https://www.marlboro.id/auth/login");
	curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($c, CURLOPT_POSTFIELDS, 'email='.$urlencode.'&password='.$urlencode1.'&remember_me=remember_me&ref_uri=/&decide_csrf='.$a[1].'&param=&exception_redirect=false');
	curl_setopt($c, CURLOPT_POST, true);
	curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_HEADER, true);
	curl_setopt($c, CURLOPT_HTTPHEADER, $header);
	$response = curl_exec($c);
	return $response;
	}
	function get_token(){
	$header = array();
	$header[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0";
	$header[] = "Accept: text/html,application/xhtml+xml,application/xml";
	$header[] = "Accept-Language: en-US,en";
	$header[] = "Accept: application/json";
	$c = curl_init("https://www.marlboro.id");
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($c, CURLOPT_MAXREDIRS, 15);
    curl_setopt($c, CURLOPT_TIMEOUT, 30);
    curl_setopt($c, CURLOPT_ENCODING, "");
    curl_setopt($c, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($c, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_HEADER, true);
	curl_setopt($c, CURLOPT_HTTPHEADER, $header);
	$cc = curl_exec($c);
	return $cc;
}
function get_point($cookies,$cookiess){
	$header = array();
	$header[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0";
	$header[] = "Accept: text/html,application/xhtml+xml,application/xml";
	$header[] = "Accept-Language: en-US,en";
	$header[] = "Accept: application/json";
	$header[] = "cookie: ".$cookies[1][1]."; _gcl_au=1.1.65478177.1573957176; _ga=GA1.2.266604734.1573957177; kppid_managed=NDN7Xbeh; _hjid=e1d185cc-fa47-4fa8-beec-5400bdb19cdc; accC=true; _p1K4r_=true; pikar_redirect=true; _gid=GA1.2.1216032581.1574233608; scs=1; ins-gaSSId=374e2685-1c21-3bd4-5846-4db11c6049a1_1574310183; ".$cookiess[1][0]."; ev=1; ".$cookies[1][2]."; ".$cookies[1][3]."; insdrSV=24; _gat_UA-102334128-3=1; ".$cookies[1][4]."";
	$c = curl_init("https://www.marlboro.id/profile");
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($c, CURLOPT_MAXREDIRS, 15);
    curl_setopt($c, CURLOPT_TIMEOUT, 30);
    curl_setopt($c, CURLOPT_ENCODING, "");
    curl_setopt($c, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($c, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_HEADER, true);
	curl_setopt($c, CURLOPT_HTTPHEADER, $header);
	$cc = curl_exec($c);
	return $cc;
}
