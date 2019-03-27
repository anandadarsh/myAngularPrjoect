var express = require('express');
var router = express.Router();

	var applicationController = require('./../../controller/applicationController');

	router.get('/', applicationController.contact);
	router.post('/', applicationController.saveContact);
	
	
module.exports = router;