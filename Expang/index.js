var express = require('express');
var app = express();

var Mongojs = require('mongojs');
var db = Mongojs('shop', ['contact']);
var bodyParser = require('body-parser');
var ObjectId = require('mongojs').ObjectID;

var jwt = require('jsonwebtoken');

// parse application/json
app.use(bodyParser.json());

app.use((req, res, next) => {
    res.append('Access-Control-Allow-Origin', ['*']);
    res.append('Access-Control-Allow-Methods', 'GET,PUT,POST,DELETE');
    res.append('Access-Control-Allow-Headers', 'Content-Type');
    next();
});
  

app.use(bodyParser.urlencoded({
  extended: true
}));

//Route

//get all record

app.get('/getContacts',function(req, responce){
	return db.contact.find(function (err, res) {
    	    	 responce.json( res );
	})
});

//delete a record 
app.get('/edit/:id',function(req,responce){
      var myquery = {'_id' : new ObjectId(req.params.id)};
       return db.contact.find(myquery ,function(err, res){
           responce.json(res);   
      })  
})


//insert a record in db
app.post('/insert', function(req,responce){
      return db.contact.insert(req.body ,function(err, res){
           responce.json({ success: true });   
      })  

});
app.get('/search/:key',function(req,responce){
       return db.contact.find( { fname : {$regex : req.params.key} },function(err, res) {
	   responce.json(res);   
      })  
})



//update a record in db
app.post('/update/:id',veryToken,function(req,responce){
	
	jwt.verify(req.token,'secretkey',function(err,authData){
			if(err){
				responce.sendStatus(403)
			}else{
					 var myquery = {'_id' : new ObjectId(req.params.id)};
						return db.contact.update(myquery,req.body ,function(err, res){
							responce.json({ success: true }); 
						}) 
			}
		})
	
});

//delete a record 
app.get('/delete/:id',veryToken,function(req,responce){
	jwt.verify(req.token,'secretkey',function(err,authData){
			if(err){
				responce.sendStatus(403)
			}else{
			var myquery = {'_id' : new ObjectId(req.params.id)};
				return db.contact.remove(myquery ,function(err, res){
					responce.json({ success: true });   
					})	
			}
		})
})


app.get('/verifyUsers/',veryToken,function(req,responce){
	jwt.verify(req.token,'secretkey',function(err,authData){
			if(err){
				return false
			}else{
				return true;
			}
		})
})



app.post('/login',function(req,responce){
	
     return db.contact.find(req.body ,function(err, res){
		  if (res.length==0) {
			 responce.json({message:'Username and password is incorrect',"status":"0"});
			} else {
						const user = req.body;
						jwt.sign({user},'secretkey',{expiresIn : '30s'},function(err,token){
						responce.json({
							token,"status":"1"
						})
					});
				}  //end of else
      })  
})



function veryToken(req,res,next){
	const brerHeader = req.query.token;
	
	if(typeof brerHeader != 'undefined'){
		const brer = brerHeader.split(' ');
			req.token =  brer[1];
			next();
	}else{
		res.sendStatus(403);
		
	}
}



	
app.listen(3000);
console.log('!ok');