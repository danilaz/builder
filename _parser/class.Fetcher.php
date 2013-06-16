<?php

///////////////////////////////////
// CLASS Fetcher

class Fetcher {
	
	private $base_options_httpheader = array(
		'Expect:',
		'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
		'Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4',
		'Accept-Charset: UTF-8,*;q=0.5',
		'Accept-Encoding: gzip,deflate'
	);
	private $base_options = array(
		CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 5.1; rv:7.0.1) Gecko/20100101 Firefox/7.0.1 ',
		CURLOPT_HEADER => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_TIMEOUT => 600,
		CURLOPT_CONNECTTIMEOUT => 30
	);
	private $opts_save_cookies = false;
	private $opts_send_cookies = false;
	private $conv_enc_from = false;
	private $conv_enc_to = false;
	private $opts_follow_location = false;
	private $opts_maxredirs = 5;
	private $var_proxy_id = 0;
	private $var_curr_tries = 0;
	private $save_file_h = false;
	public $curl_handler = false;
	public $curr_url = false;
	public $curr_host = false;
	public $curr_proxy = false;
	public $cookies = array();
	public $delay = 0;
	public $auto_ref = false;
	public $ref = false;
	public $last_error = false;
	public $proxylist = false;
	public $proxylist_change_on_error = false;
	public $retries_on_error = 0;
	public $log_func = 'fetcher_log';
	public $proxy_func = false;
	
	public function __construct() {
		$this->base_options[CURLOPT_HTTPHEADER] = $this->base_options_httpheader;
		$this->curl_handler = curl_init();
		if(!$this->curl_handler) return false;
		else return true;
	}
	
	public function __destruct() {
		curl_close($this->curl_handler);
	}
	
	public function log($s) {
		if(is_callable($this->log_func)) call_user_func_array($this->log_func, array($s, &$this));
	}
	
	public function proxy($proxy = false, $proxytype = false, $proxy_user_pswd = false) {
		if($proxy) {
			$this->base_options[CURLOPT_PROXY] = $proxy;
			$this->curr_proxy = $proxy;
			$this->log('proxy change to "'.$proxy.'"');
		} else
			unset($this->base_options[CURLOPT_PROXY]);
		if(strtolower(substr($proxytype,0,4))=='http') $proxytype = CURLPROXY_HTTP;
		elseif(strtolower(substr($proxytype,0,5))=='socks') $proxytype = CURLPROXY_SOCKS5;
		if($proxytype) $this->base_options[CURLOPT_PROXYTYPE] = $proxytype;
		else unset($this->base_options[CURLOPT_PROXYTYPE]);
		if($proxy_user_pswd) $this->base_options[CURLOPT_PROXYUSERPWD] = $proxy_user_pswd;
		else unset($this->base_options[CURLOPT_PROXYUSERPWD]);
	}
	
	public function load_proxylist_from_url($url, $change_on_error = false) {
		$a = file($url);
		if(!$a) {
			$this->log('fail to load proxylist "'.$url.'"!');
			return false;
		} else
			return $this->load_proxylist_from_array($a, $change_on_error);
	}
	
	public function load_proxylist_from_string($s, $change_on_error = false) {
		$a = explode("\n", $s);
		return $this->load_proxylist_from_array($a, $change_on_error);
	}
	
	public function load_proxylist_from_array($a, $change_on_error = false) {
		$this->proxylist = array();
		foreach($a as $s) {
			$s = trim($s);
			if(!$s) continue;
			$this->proxylist[] = $s;
		}
		if(count($this->proxylist) > 0) {
			shuffle($this->proxylist);
			$this->var_proxy_id = mt_rand(0, (count($this->proxylist)-1));
			$this->proxylist_change();
			$this->proxylist_change_on_error = $change_on_error;
			return true;
		} else {
			$this->log('proxylist is empty!');
			return false;
		}
	}
	
	public function user_agent($ua = false) {
		if($ua) $this->base_options[CURLOPT_USERAGENT] = $ua;
		else unset($this->base_options[CURLOPT_USERAGENT]);
	}
	
	public function http_headers($hdrs = false) {
		if(!is_array($hdrs)) $hdrs = array();
		$this->base_options[CURLOPT_HTTPHEADER] = 
				array_merge($this->base_options_httpheader, $hdrs);
	}
	
	public function save_to_file($filename = false) {
		if($filename) {
			$this->save_file_h = fopen($filename, 'w');
			if(!$this->save_file_h) return false;
			$this->base_options[CURLOPT_FILE] = $this->save_file_h;
		} else
			unset($this->base_options[CURLOPT_FILE]);
		return true;
	}
	
	public function follow_location($val = true, $maxredirs = 5, $follow_post = false) {
		$this->opts_follow_location = $val;
		$this->opts_maxredirs = $maxredirs;
		$this->opts_follow_location_post = $follow_post;
	}
	
	public function cookies_process($save_cookies = true, $send_cookies = true) {
		$this->opts_save_cookies = $save_cookies;
		$this->opts_send_cookies = $send_cookies;
	}
	
	public function timeout($val1 = 600, $val2 = 30) {
		if($val1!==false) $this->base_options[CURLOPT_TIMEOUT] = $val1;
		else unset($this->base_options[CURLOPT_TIMEOUT]);
		if($val2!==false) $this->base_options[CURLOPT_CONNECTTIMEOUT] = $val2;
		else unset($this->base_options[CURLOPT_CONNECTTIMEOUT]);
	}
	
	public function conv_enc($from = false, $to = false) {
		$this->conv_enc_from = $from;
		$this->conv_enc_to = $to;
	}
	
	public function before_run($url, $post = false, $host = false) {
		if($host===false) $host = parse_url($url, PHP_URL_HOST);
		curl_setopt_array($this->curl_handler, $this->base_options);
		curl_setopt($this->curl_handler, CURLOPT_URL, $url);
		$this->curr_url = $url;
		$this->curr_host = $host;
		if($this->ref) curl_setopt($this->curl_handler, CURLOPT_REFERER, $this->ref);
		if($post) {
			curl_setopt($this->curl_handler, CURLOPT_POST, true);
			curl_setopt($this->curl_handler, CURLOPT_POSTFIELDS, $post);
		} else
			curl_setopt($this->curl_handler, CURLOPT_POST, false);
		if($this->opts_send_cookies) {
			if(isset($this->cookies[$host])) {
				$cooks = array();
				foreach($this->cookies[$host] as $cooknam=>$cookval) {
					$cooks[] = $cooknam.'='.$cookval;
				}
				$cooks = implode('; ', $cooks);
				if($cooks) curl_setopt($this->curl_handler, CURLOPT_COOKIE, $cooks);
			} else {
				curl_setopt($this->curl_handler, CURLOPT_COOKIE, false);
			}
		}
	}
	
	public function run() {
		while(true) {
			if($this->save_file_h) curl_setopt($this->curl_handler, CURLOPT_HEADER, false);
			$s = curl_exec($this->curl_handler);
			if($this->save_file_h) curl_setopt($this->curl_handler, CURLOPT_HEADER, true);
			sleep($this->delay);
			if(($this->retries_on_error) || ($this->proxylist_change_on_error)) {
				if((!$s) || ($this->get_last_http_code() >= 400)) {
					$this->var_curr_tries++;
					if($this->var_curr_tries >= $this->retries_on_error)
						$this->var_curr_tries = 0;
					else {
						if($this->proxylist_change_on_error) $this->proxylist_change();
						$this->log('fail to fetch! one more try  "'.curl_error($this->curl_handler).'"');
						continue;
					}
				}
			}
			break;
		}
		$this->var_curr_tries = 0;
		return $s;
	}
	
	public function after_run($s) {
		if(!$s) {
			$this->last_error = curl_error($this->curl_handler);
			$this->log('fail to fetch!  "'.$this->last_error.'"');
			return false;
		}
		if($this->auto_ref) $this->ref = $this->curr_url;
		$r = new FetcherResponse($s, $this->curr_host, $this->curr_url, $this->conv_enc_from, $this->conv_enc_to);
		if($this->opts_save_cookies) {
			if(preg_match_all('/\sSet-Cookie:\s*([^=]+)=([^;\n]+)/i', $r->h, $m)) {
				if(!isset($this->cookies[$this->curr_host])) $this->cookies[$this->curr_host] = array();
				foreach($m[1] as $mkey=>$cookname) {
					$this->cookies[$this->curr_host][$cookname] = trim($m[2][$mkey]);
				}
			}
		}
		if($this->save_file_h) {
			fclose($this->save_file_h);
			unset($this->base_options[CURLOPT_FILE]);
			$this->save_file_h = false;
		}
		return $r;
	}
	
	public function fetch($url, $post = false) {
		if($this->opts_follow_location) {
			$del = $this->delay;
			$nredir = 0;
		}
		$host = parse_url($url, PHP_URL_HOST);
		while(true) {
			$this->before_run($url, $post, $host);
			$s = $this->run();
			if(!$s) {
				$s = false;
				break;
			} else $s = $this->after_run($s);
			if($this->opts_follow_location) {
				$url = $s->get_loc();
				if(!$url) break;
				else {
					$nredir++;
					if($nredir > $this->opts_maxredirs) break;
					$this->log('follow redirect to '.$url);
					if(!$this->opts_follow_location_post) $post = false;
					$this->delay = 0;
					continue;
				}
			} else
				break;
		}
		if($this->opts_follow_location) $this->delay = $del;
		return $s;
	}
	
	public function fetchs($url, $post = false) {
		$x = $this->fetch($url, $post);
		if(!$x) return false;
		else {
			$s = $x->b;
			unset($x);
			return $s;
		}
	}
	
	public function proxylist_change() {
		if(!$this->proxy_func) {
			$this->var_proxy_id++;
			if($this->var_proxy_id >= count($this->proxylist)) $this->var_proxy_id = 0;
			$pr = $this->proxylist[$this->var_proxy_id];
		} else {
			$pr = call_user_func($this->proxy_func);
		}
		$this->proxy($pr);
	}
	
	public function get_last_http_code() {
		return curl_getinfo($this->curl_handler, CURLINFO_HTTP_CODE);
	}
	
	public function make_post_str($post_arr) {
		if(function_exists('http_build_query')) return http_build_query($post_arr);
		$spost = array();
		foreach($post_arr as $key=>$val) {
			$spost[]=urlencode($key).'='.urlencode($val);
		}
		$spost = implode('&', $spost);
		return $spost;
	}
	
}


///////////////////////////////////
// CLASS FetcherResponse

class FetcherResponse {
	public $h = false;
	public $b = false;
	public $att_filename = false;
	public $host = false;
	public $url = false;
	
	
	function __construct($s, $host, $url, $conv_enc_from, $conv_enc_to) {
		$this->url = $url;
		$this->host = $host;
		if(substr($s, 0, 35) == 'HTTP/1.0 200 Connection established') $hpos = 36;
		else $hpos = 0;
		$hpos = strpos($s, "\r\n\r\n", $hpos);
		if($hpos===false) $hpos = strpos($s, "\n\n", $hpos);
		if($hpos!==false) {
			$this->h = rtrim(substr($s, 0, $hpos));
			$this->b = ltrim(substr($s, $hpos));
			if(preg_match('/\sContent-Disposition:[^\n]*attachment;\sfilename=(.+)(\n|$)/i', $this->h, $m)) {
				$this->att_filename = trim($m[1]);
				$this->att_filename = trim($this->att_filename, '"\'');
				if(substr($this->att_filename, 0, 10) == '=?UTF-8?B?')
					$this->att_filename = base64_decode(substr($this->att_filename, 10, strlen($this->att_filename)-12));
			}
			if(preg_match('/Content-Encoding:\s*gzip\s*(\n|$)/i', $this->h))  $this->b = gzinflate(substr($this->b,10,-8));
			elseif(preg_match('/Content-Encoding:\s*deflate\s*(\n|$)/i', $this->h))  $this->b = gzinflate($this->b);
		} else {
			$this->h = false;
			$this->b = $s;
		}
		if($conv_enc_to) {
			if(!$conv_enc_from)  $conv_enc_from = $this->get_enc();
			$this->b = mb_convert_encoding($this->b, $conv_enc_to, $conv_enc_from);
		}
	}
	
	function __destruct() {
		unset($this->h);
		unset($this->b);
		unset($this->att_filename);
		unset($this->host);
	}
	
	public function __get($name) {
		if($name=='s') return $this->h."\r\n\r\n".$this->b;
		$trace = debug_backtrace();
		trigger_error(
			'Undefined property via __get(): ' . $name .
			' in ' . $trace[0]['file'] .
			' on line ' . $trace[0]['line'],
			E_USER_NOTICE
		);
		return null;
	}
	
	
	public function get_loc() {
		if(preg_match('/\sLocation:(.*?)(\n|$)/i', $this->h, $m)) {
			$ret = trim(html_entity_decode($m[1]));
			if(substr($ret,0,4) != 'http') {
				if(substr($ret,0,1) != '/') $ret = '/' . $ret;
				$ret = 'http://' . $this->host . $ret;
			}
		} else {
			$ret = false;
		}
		return $ret;
	}
	
	public function get_enc() {
		if(preg_match('/\sContent-Type:(.+)(\n|$)/i', $this->h, $m)) $ret[] = trim($m[1]);
		if(preg_match_all('/<meta[^>] *?(.*) *?\/?>/isU', $this->s, $meta)) {
			foreach($meta[1] as $attr) {
				if (
					preg_match('/(http-equiv|name) *?= *?([\'"]{0,1})content-type\\2/i', $attr, $key) &&
					preg_match('/content *?= *?([\'"]{0,1})(.*?)\\1/i', $attr, $val)
					) $ret[] = $val[2];
			}
		}
		foreach($ret as $ret2) {
			if(preg_match('/charset\s*=\s*(.+)$/', $ret2, $m))  return strtoupper(trim($m[1]));
		}
		return false;
	}
	
}

?>