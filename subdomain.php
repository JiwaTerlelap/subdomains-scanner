<?php 
/**
 * Subdomain Scanner
 * Coded : galehdotid
 * thx   : Indoxploit - xaisyndicate - all indonesia Hacker Rulez
 * Open Result subdomain.txt !
 * Usage :  Usage : php subdomain site.com
 */
error_reporting(0);
class Scan{
	function ngecek($url){
			$ch = curl_init();
			$options = [
              CURLOPT_URL => "https://findsubdomains.com/subdomains-of/$url",
              CURLOPT_RETURNTRANSFER => TRUE,
              CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0",
              CURLOPT_SSL_VERIFYHOST  => FALSE,
              CURLOPT_SSL_VERIFYPEER  => FALSE
			];
			curl_setopt_array($ch, $options);
			$aksi = curl_exec($ch);
			// print_r($aksi);
			preg_match_all("/<div class=\"domains js-domain-name\">([^`]*?)<\/div>/",$aksi, $data);
			  foreach ($data[1] as $key) {
			  	    echo "[+] Di Temukan -> {$key}\r\n";
			  	    $file = fopen("subdomain.txt", "a");
			  	            fwrite($file, $key. "\r\n");
			  	            fclose($file);
			  }
	}
}
$dork = new Scan();
$get = $argv[1];
 if($get){
     $dork->ngecek($get);
   }else{
	  echo "Usage php subdomain.php site.com";
}

?>
