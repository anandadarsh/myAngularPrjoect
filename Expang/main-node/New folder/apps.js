var http = require('http');

	//function on request
	var onRequest = function(request, responce){
			if(request.method == 'GET'){
					responce.writeHead(200,{'Context-Type':'text/html'});
					responce.write('<b>Responce on url</b>');
					responce.end();	
			}else{
				responce404(request, responce);
			}
			
	}
	
	//function on 404 error
	var responce404 = function(request,responce){
			responce.write('Some thing went wrong Please try again.');
	}	
		
	http.createServer(onRequest).listen(8080);
		console.log('ok');
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//http.createServer(function(req,res){
	//		res.writeHead(200,{'Context-Type':'text/html'});
	//		res.write('<b>hello</b>');
	//		res.end();
	//}).listen(8080);
	//console.log('start');