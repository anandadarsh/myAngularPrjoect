var MongoClient = require('mongodb').MongoClient;
var url = "mongodb://localhost:27017/";
MongoClient.connect(url, function(err, db) {
				  if (err) throw err;
				  var dbo = db.db("school");
				  
		});
		
var mongoose = require('mongoose');
var Schema = mongoose.Schema;

var User = new Schema({
    email   : {type: String, required: false},
    passwords    : {type: String, required: false},
    is_remember    : {type: String, required: true}
});

module.exports = mongoose.model('user', User);