<?php

class Printer{

	/*
		打印机初始化
		$domain		打印机域名
		$key		通信密钥
		$debug		是否输出调试信息
	*/
	function __construct( $domain, $key, $debug = FALSE ) {
		$this->debug = $debug;
		$this->domain = $domain;
		$this->key = $key;
		//print "In BaseClass constructor\n";
	}
	
	/*
		发送打印内容至打印机
		$type		内容类型
		$text		内容文本（UTF-8编码）
		$qrcode		二维码内容（UTF-8编码）
	*/
	function SendData( $type, $text, $qrcode = NULL ){
	
		$data['type'] = $type;  	// qrcode   
		$data['content'] = $text;  	// content 编码 utf8 
		$data['createtime'] = time();
		
		//混合打印模式
		if( $type == 'twin' && $qrcode ) $data['qr_content'] = $qrcode;
		
		$code = $this -> EncyptUrl( $data , $this -> key );
		
		$site = 'http://'. $this -> domain .'.unifw.com';
		
		/////////////////////
		
		if( $type == 'twin' && $qrcode ){
			$path = '/service/sendPrintDataCombo.php?content='. urlencode( $data['content'] ) .'&qr_content='.urlencode( $data['qr_content'] ).'&type='. $type .'&key='. $code .'&createtime='.$data['createtime'];
		}else{
			$path = '/service/sendPrintData.php?content='. urlencode( $data['content'] ) .'&type='. $type .'&key='. $code .'&createtime='.$data['createtime'];
		}
		
		$url = $site . $path;

		if ($this -> debug){
			echo "$url  \n";
		}
		
		$content = file_get_contents($url);
		
		/////////////////////
		
		//$return = json_decode( $content );
		
		//print_r ($content);
		
		//prin  qr_content
		
		return json_decode( $content );
	
	}
	
	/*
		编码当前参数，生成核验密钥
		$data	数据 
		$key	通信密钥
	*/
	function EncyptUrl($data , $key) {
		ksort($data, SORT_STRING);
		$avs = array_values($data);
		$src = implode(",", $avs) . $key;
		//echo "[user: $src_string ]";
		$md5 = md5($src);
		return $md5;
	}

}


