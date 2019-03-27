var express = require('express');
var router = express.Router();

	//use login controller
	var loginController = require('./../../controller/loginController');

	router.get('/', loginController.login);
	
module.exports = router;
