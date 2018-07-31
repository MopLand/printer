
var Printer = {
	
	Init : function(){
		
		Mo( window ).bind('load',Printer.Preview);
		Mo( 'textarea' ).bind('change',Printer.Preview).bind('input',Printer.Preview);
		
		//////////////////////
		
		Mo( 'input[name=type]' ).bind('change',function(){
			
			var val = Mo( 'input[name=type]' ).value();
			
			if( val == 'twin' ){
				
				Mo('*[data-block=qrcode]').show();
				
			}else{
				Mo('*[data-block=qrcode]').hide();
			}
			
			Printer.Preview();
			
		}).event('change');
		
	},
	
	
	Preview : function(){
		
		var type = Mo('input[name=type]').value();
		var text = Mo('textarea[name=content]').value();
	
		/*
		array[0] = ''
		array[1] = 'CC!-CC!'
		array[2] = 'sdfsdfsfdsf'
		array[3] = ''
		array[4] = 'CC!-CC!'
		array[5] = 'aaaaaaaaaaaaa'
		array[6] = ''
		*/
		
		var data = text.split(/(\S{2}\!\-\S{2}\!)(.*)/gi);
		var html = '';
		
		/*
		“CC!-CC!” # 居中打印
		“BC!-BC!” # 居中打印并加粗
		“BB!-BB!” # 加粗打印
		“B1!-B1!”
		“B2!-B2!” # 加宽
		“B3!-B3!”
		“B4!-B4!”
		“H1!-H1!” # 加高
		“H2!-H2!”
		“H3!-H3!”
		“H4!-H4!”
		推荐 用 H1!-H1! H2!-H2!
		*/
		
		for( var i = 1; i < data.length; i+= 3 ){
			console.log( data[i], data[i+1] );
			
			var s = data[i];
			var t = data[i+1];
			
			switch( s ){
				
				//居中打印
				case 'CC!-CC!':
					s = 'text-align:center;';
				break;
				
				//居中打印并加粗
				case 'BC!-BC!':
					s = 'text-align:center;font-weight:bold;';
				break;
				
				//加粗打印
				case 'BB!-BB!':
					s = 'font-weight:bold;';
				break;
				
				////////////////////////////////
				
				//加宽
				case 'B1!-B1!':
					s = 'font-size:150%;';
				break;
				
				case 'B2!-B2!':
					s = 'font-size:180%;';
				break;
				
				case 'B3!-B3!':
					s = 'font-size:200%;';
				break;
				
				case 'B4!-B4!':
					s = 'font-size:220%;';
				break;
				
				////////////////////////////////
				
				//加高
				case 'H1!-H1!':
					s = 'font-size:150%; line-height:120%;';
				break;
				
				case 'H2!-H2!':
					s = 'font-size:180%; line-height:130%;';
				break;
				
				case 'H3!-H3!':
					s = 'font-size:200%; line-height:140%;';
				break;
				
				case 'H4!-H4!':
					s = 'font-size:220%; line-height:150%;';
				break;
				
			}
			
			html += '<p style="'+ s +'">'+ t +'</p>';
			
		}
		
		Mo('.view dd').html( html );
		
		///////////////////////
		
		if( type == 'qrcode' && text ){
			
			html = '<img src="http://chart.apis.google.com/chart?cht=qr&chl='+ encodeURIComponent( text ) +'&chld=M&choe=UTF-8&chs=200x200" />';
			
			Mo('.view dd').html( html );
			
		}
		
		///////////////////////
		
		var code = Mo('textarea[name=qrcode]').value();
		
		if( type == 'twin' && code ){
			
			html = '<img src="http://chart.apis.google.com/chart?cht=qr&chl='+ encodeURIComponent( code ) +'&chld=M&choe=UTF-8&chs=200x200" />';
			
			Mo('.view dd').html( html, true );
			
		}
		
	}	
	
}