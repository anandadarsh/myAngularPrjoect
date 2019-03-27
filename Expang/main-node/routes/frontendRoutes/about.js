var express = require('express');
var router  = express.Router();

	//controller for about 
	
	var applicationController = require('./../../controller/applicationController');	
	
	router.get('/', applicationController.about);
	

module.exports = router;