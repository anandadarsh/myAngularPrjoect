var express = require('express');
var router = express.Router();
var twig = require('twig');

	//use controller 

	var applicationController = require('./../../controller/applicationController');
	
	router.get('/', applicationController.home);
	router.get('/home', applicationController.home);
	
	
	
module.exports = router;
