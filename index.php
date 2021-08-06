<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
header('Content-Type:text/html; charset=utf-8');
if( isset( $_GET['phpinfo'] ) ){
	phpinfo();
}
include 'Printer.php';
?>
<title>Web 打印机调用</title>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>

<body>
	
	<div id="wrap">
	
		<h1>Web 打印机调用</h1>
		
		<?php
		
		if(  isset( $_POST['submit'] ) && $_POST['submit'] == 'send' ){
			
			$p = new Printer( 'wuhan001', 'WYX_PT_001', isset( $_POST['debug'] ) ? TRUE : FALSE );
			$ret = $p -> SendData( $_POST['type'], $_POST['content'], $_POST['qrcode'] );
			
			echo '<div class="call">'. var_export( $ret, TRUE ) .'</div>';
			
		}
		
		?>
	
		<dl class="ctrl">
		
			<dt>打印设置</dt>
			<dd>
		
			<form action="" method="post">
				<p>
					<strong>打印类型</strong>
					<label><input type="radio" name="type" value="text" checked="checked" /> 文本</label>
					<label><input type="radio" name="type" value="qrcode" /> 二维码</label>
					<label><input type="radio" name="type" value="twin" /> 混合（文本+二维码）</label>
				</p>
				
				<p data-block="content">
					<strong>文本内容</strong>
					<textarea name="content" rows="15" cols="50">CC!-CC! # CC 居中打印
BC!-BC! # BC 居中打印并加粗
BB!-BB! # BB 加粗打印
B1!-B1! # B1 加宽
B2!-B2! # B2 加宽
B3!-B3! # B3 加宽
B4!-B4! # B4 加宽
H1!-H1! # H1 加高
H2!-H2! # H2 加高
H3!-H3! # H3 加高
H4!-H4! # H4 加高</textarea>
				</p>
				
				<p data-block="qrcode">
					<strong>二维码内容</strong>
					<textarea name="qrcode" rows="5" cols="50">CC!-CC! # CC 居中打印
BC!-BC! # BC 居中打印并加粗
BB!-BB! # BB 加粗打印
B1!-B1! # B1 加宽
B2!-B2! # B2 加宽</textarea>
				</p>
				
				<p>
					<button type="submit" name="submit" value="send">立即打印</button>
					<label><input type="checkbox" name="debug" value="true" />开启调试</label>
				</p>
			</form>
			</dd>
		
		</dl>
		
		<dl class="view">
			<dt>打印预览</dt>
			
			<dd>
			
			</dd>
		</dl>
		
		<dl class="code">
			<dt>格式指定</dt>
			<dd>
			<pre>
CC!-CC! # CC 居中打印
BC!-BC! # BC 居中打印并加粗
BB!-BB! # BB 加粗打印
B1!-B1! # B1 加宽
B2!-B2! # B2 加宽
B3!-B3! # B3 加宽
B4!-B4! # B4 加宽
H1!-H1! # H1 加高
H2!-H2! # H2 加高
H3!-H3! # H3 加高
H4!-H4! # H4 加高
			</pre>
			</dd>
		</dl>
		
	</div>
	
	<script src="http://www.veryide.com/projects/mojs/lib/mo.js"></script>
	<script src="Printer.js"></script>
	<script>
		<?php
		foreach( $_POST as $k => $v ){
			echo "Mo('*[name=". $k ."]').value('". preg_replace( '/\r\n/', '\r\n', $v ) ."');\n";	
		}
		?>
		Printer.Init();
	</script>
	
	</body>
</html>