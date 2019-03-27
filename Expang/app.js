var http = require('http');
var dt = require('./customModule/myModule');
var url = require('url');
var fs = require('fs');
var querystring = require('query-string');

var mongojs = require('mongojs'); 
var db = mongojs('shop',['contact']);
var ObjectId = require('mongojs').ObjectID;



http.createServer(function(req,res){
	
	q = url.parse(req.url,true);
	
	if(q.pathname == '/' || q.pathname == '/index' || q.pathname == ''){
			res.writeHead(200,{'Content-type':'text/html'});
			fs.readFile('myviews/index.html',function(err, data){
				if(err) throw err
				res.write(data);
					res.end();
			});		
		}
		
		//read file
		else if(q.pathname == "/readFile"){
			res.writeHead(200,{'Content-Type':'text/html'});
			res.write("<a href ='http://localhost:8080'>back</a><br>");
			fs.readFile('myFile.html',function(err ,data){
				if(err) throw err;
				res.write(data);
					res.end();
				
			});
		}
		else if(q.pathname == "/createFile"){
			res.writeHead(200,{'Content-Type':'text/html'});
			res.write("<a href ='http://localhost:8080'>back</a><br>");
			fs.writeFile('myNewfile.txt','This file has been generated diynamic',function(err){
				if(err) throw err;
				res.write('File has been created with Name: myNewfile.txt');
				res.end();
				
			})
		}
		else if(q.pathname == "/login" && req.method == 'GET'){
			res.writeHead(200,{'Content-Type':'text/html'});
			res.write("<a href ='http://localhost:8080'>back</a><br>");
			fs.readFile('myviews/login.html',function(err,data){
				if(err) throw err;
				res.write(data);
				res.end();
				
			})
		}
		else if(q.pathname == "/savedata" && req.method == 'POST'){
			
			var data = '';
			res.writeHead(200,{'Content-Type':'text/html'});
			req.on('data',function(chunk){
				data = data+chunk;
			});
			
			req.on('end',function(){
				var form_data = querystring.parse(data);
				console.log(form_data);
				db.contact.insert(form_data,function(err,responce){
						if(err) throw err;
						console.log('1 record is inserted');
					});
				});
			
			res.end();
				
			
		}
		else if(q.pathname == '/getcontactData'){
			res.writeHead(200,{'Content-Type':'text/html'});
			db.contact.find(function(err,data){
				if(err) throw err;
				//var myJSON  = JSON.stringify(data)
				//var d = querystring.parse(data);
				//console.log(Object.keys(data));
				var myTable = "<table border = '1'><tr><td>Fname</td><td>Lname</td><td>Email</td><td>Opration</td></tr>";
				var myTr = '';
				Object.keys(data).forEach(function(key) {
					myTr = myTr+ '<tr><td>'+data[key].fname+'</td><td>'+data[key].lname+'</td><td>'+data[key].email+'</td><td><a target="_blank" href = "edit?id='+data[key]._id+'">edit</a></td></tr>'
				})
				
				$rec = myTable + myTr+'</table>';
				res.end($rec);
				
				
			});
		}
		else if(q.pathname = '/edit' && req.method == 'GET' ){
			res.writeHead(200,{'Contect-Type':'text/html'});
			d = q.query;
			
			db.contact.findOne({_id: new mongojs.ObjectID(d.id)},function(err,doc){
				if (err) throw err;
				
				var fdata = '<form name = "frm" method = "post" action = "updateData"><input name = "fname" type = "text" value = "'+doc.fname+'"><input name = "lname" type = "text" value = "'+doc.lname+'"><input name = "lname" type = "text" value = "'+doc.email+'"><input type = "submit" name = "submit"></form>';
				
				res.end(fdata);
			});
			
			
		}
		
		else{
			res.writeHead(400);
			res.write("<a href ='http://localhost:8080'>back</a><br>");
			res.write("<a href ='http://localhost:8080'>back</a><br>");
			res.write('bye bye');
			res.end();
		}

	
}).listen(8080);
console.log('go on browser');


