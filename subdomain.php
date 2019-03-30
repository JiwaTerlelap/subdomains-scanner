<?php 
/**
 * Subdomain Scanner
 * Coded : galehdotid
 * thx   : Indoxploit - xaisyndicate - all indonesia Hacker Rulez
 * Open Result : randomsubdomain.txt !
 * Usage :  Usage : php subdomain site.com
 */
error_reporting(0);
class Scan{
	public function ngecek($url){
			$ch = curl_init();
			$options = [
              CURLOPT_URL => "https://findsubdomains.com/subdomains-of/$url",
              CURLOPT_RETURNTRANSFER => TRUE,
              CURLOPT_USERAGENT => "Mozilla/5.0 (Windows NT 6.1; rv:32.0) Gecko/20100101 Firefox/32.0",
              CURLOPT_SSL_VERIFYHOST  => false,
              CURLOPT_SSL_VERIFYPEER  => false
			];
			curl_setopt_array($ch, $options);
			return curl_exec($ch);
	}
	public function main($url){
		$data = $this->ngecek($url);
		if(preg_match_all("/<div class=\"domains js-domain-name\">([^`]*?)<\/div>/", $data, $result)){
			foreach (str_replace(" ", "", $result[1]) as $key => $value) {
				echo "[+] Subdomain : " . $value . "\r\n";
				$filename = date('ymdhis') . " - subdomain.txt";
				$this->save($filename, $value);
			}
		}
		else
		  echo "[-] Gagal menemukan subdomain !";
			
	}
	public function save($filename, $result){
		 $file = fopen($filename, "a");
		         fwrite($file, $result . "\r\n");
		         fclose($file);
	}
  
}
$scan = new Scan();
 if($argv[1]){
     $scan->main($argv[1]);
   }else{
	  echo "Usage php subdomain.php site.com";
}

?>
