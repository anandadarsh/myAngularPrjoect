
	//require model if require
	var MongoClient = require('mongodb').MongoClient;
var url = "mongodb://localhost:27017/";

	MongoClient.connect(url, function(err, db) {
					  if (err) throw err;
					  var dbo = db.db("school");
					  
			});
	
		
	const ContactModel = require('../model/contact');
	
	exports.home = function(request,responce){
		responce.render('./../views/frontend/home');
	};
	
	exports.about = function(request, responce){
		responce.render('./../views/frontend/about');
		
	};
	
	exports.contact = function(request, responce){
		responce.render('./../views/frontend/contact');
		
	};
	
	exports.gallery = function(request, responce){
		responce.render('./../views/frontend/gallery');
		
	};
	exports.saveContact = function(request, responce){
		 ContactModel.create(request.body, function(err, ContactModel) {
        if(err) return next(err); // do something on error
			return responce.render('./../views/frontend/contact',{'msg':'Your Contact Data has been saved'});
		});
	}
	exports.getContactDetail = function(request, responce){
		ContactModel.getAllData(function(err, result){
			if(err) throw err;
			responce.render('./../views/frontend/contactdetail',{'rr':result});
		});
	}
	exports.getUpdateContact = function(request, responce){
		var userId = request.params.name;
		ContactModel.getSelectedData(userId, function(err, data){
			if(err) throw err;
			responce.render('./../views/frontend/contactdetail',{'selData':data});
		});
	}
	exports.updateContactDetail = function(request, responce){
		var userId = request.params.name;
		var formData = request.body;
		ContactModel.updateContactDetails(formData, userId ,function(err,result){
				if(err) throw err;
				return responce.redirect('/contactDetail');
		
		});
	}
	exports.deleteContact = function(request, responce){
		var userId = request.params.name;
		ContactModel.deleteContact(userId, function(err, result){
			if(err) throw err;
			return responce.redirect('/contactDetail');
		});
	}
	
	
