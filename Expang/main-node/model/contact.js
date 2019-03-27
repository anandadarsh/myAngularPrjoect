//model file for contact

const User = require("../model/Contactmodelscema");
var MongoClient = require('mongodb').MongoClient;
var url = "mongodb://localhost:27017/";
var ObjectId = require('mongodb').ObjectID;
var db;

module.exports = {
	//get all data
    getAllData: function(callback) {
       MongoClient.connect(url, function(err, db) {
		  if (err) throw err;
		  var dbo = db.db("school");
			var dataValue =  dbo.collection("user").find().toArray(function(err, docs){
				if(err) throw err;
				callback(err, docs);
				db.close();
			});
		});
	}, 
    
	//create Or insert data
    create: function(data, callback) {
		MongoClient.connect(url, function(err, db) {
		  if (err) throw err;
		  var dbo = db.db("school");
			if(data.is_remember){
				data.is_remember = 1
			}else{
				data.is_remember = 0;
			} 
			dbo.collection("user").insertOne(data, function(err, res) {
			if (err) throw err;
			callback(err, data);
			db.close();
		  });
		}); 
	},
	
	//get single data 
	getSelectedData: function(UserId ,callback){
		MongoClient.connect(url, function(err, db){
			if(err) throw err;
			var dbo = db.db("school");
			dbo.collection("user").find({"_id": new ObjectId(UserId)}).toArray(function(err, result) {
			if (err) throw err;
			callback(err, result);
			db.close();
		  });
		});
	},
	
	//update contact detail.
	updateContactDetails:function(data, UserId, callback){
		MongoClient.connect(url, function(err, db){
			var dbo = db.db("school");
			if(err) throw err;
				if(data.is_remember){
				data.is_remember = 1
			}else{
				data.is_remember = 0;
			} 
				var myquery = { "_id": new ObjectId(UserId)};
				var newvalues = { $set: data };
			 dbo.collection("user").updateOne(myquery, newvalues, function(err, res) {
				 if(err) throw err
				 callback(err, res);
			 });
		});	
			
	},
	deleteContact : function(userId, callback){
		MongoClient.connect(url, function(err , db){
			var dbo = db.db('school');
			var myquery = {'_id' : new ObjectId(userId)};
			var tables = dbo.collection('user');
				tables.deleteOne(myquery, function(err, result){
					if(err) throw err;
					callback(err, result);
				});
		});
	},
	
}




 