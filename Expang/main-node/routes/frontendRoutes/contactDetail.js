var express = require('express');
var router = express.Router();

var applicationController = require('./../../controller/applicationController');

	router.get('/', applicationController.getContactDetail);
	router.get('/:name/update', applicationController.getUpdateContact);
	router.post('/:name/update',applicationController.updateContactDetail);
	router.get('/:name/delete', applicationController.deleteContact);
	
	
module.exports = router;