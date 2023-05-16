<?php namespace App\Repositories;

use Mail;
use Swift_Mailer;

use App\Client;
use App\Payment;
use App\Order;

class MyFunction
{

	public function isInternal($url) {
	  $components = parse_url($url);
	  $host = env('APP_HOST');
	  $return = false;
	  if ( empty($components['host']) )  {  // we will treat url like '/relative.php' as relative
	  	$return = true;
	  }else{
		  if ( strcasecmp($components['host'], $host) === 0 ) { // url host looks exactly like the local host
		  	$return = true;
		  	// check if the url host is a subdomain
		  }elseif(strrpos(strtolower($components['host']), '.'.$host) == strlen($components['host']) - strlen('.'.$host)) {
		  	$return = true;
		  }
	  }
	  return $return;
	}

	private function crypto_rand_secure($min, $max)
	{
	    $range = $max - $min;
	    if ($range < 1) return $min; // not so random...
	    $log = ceil(log($range, 2));
	    $bytes = (int) ($log / 8) + 1; // length in bytes
	    $bits = (int) $log + 1; // length in bits
	    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
	    do {
	        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
	        $rnd = $rnd & $filter; // discard irrelevant bits
	    } while ($rnd > $range);
	    return $min + $rnd;
	}

	public function getToken($length)
	{
	    $token = "";
	    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
	    $codeAlphabet.= "0123456789";
	    $max = strlen($codeAlphabet); // edited

	    for ($i=0; $i < $length; $i++) {
	        $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
	    }

	    return $token;
	}

	public function get_deposit($order)
	{
		$payments = $order->payments;
		$deposit = 0;
		if(!empty($payments)) {
			foreach ($payments as $payment) {
				$deposit = $deposit + $payment->amount;
			}
		}
		return $deposit;
	}

	public function get_balance($order)
	{
		$price = '';
		if(!empty($order->price)) {
			$price = $order->price;
		}else{
			$price = $order->plan->price;
		}
		if(is_numeric((int)$price)) {
			if(empty($payments)) {
				$balance = $price;
			}else{
				$deposit = $this->get_deposit($order);
				$balance = $price - $deposit;
			}
		}else{
			$balance = "Not Available";
		}
		return $balance;
	}

	public function is_myOrder($order, $client)
	{
		if($order->client_id == $client->id) {
			return true;
		}else{
			return false;
		}
	}

	public function getIp()
	{
	    foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
	        if (array_key_exists($key, $_SERVER) === true){
	            foreach (explode(',', $_SERVER[$key]) as $ip){
	                $ip = trim($ip); // just to be safe
	                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
	                    return $ip;
	                }
	            }
	        }
	    }
	}
}