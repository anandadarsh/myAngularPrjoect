var express = require('express');
var router = express.Router();
var applicationController = require('./../../controller/applicationController');

	router.get('/', applicationController.gallery);
	
module.exports = router;	