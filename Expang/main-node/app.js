var express = require('express');
var bodyParser = require('body-parser');
var swig = require('swig');
var app = express();

//


var home = require('./routes/frontendRoutes/home');//for home routes
var about = require('./routes/frontendRoutes/about');//for about routes
var gallery = require('./routes/frontendRoutes/gallery');//for gallery
var contact = require('./routes/frontendRoutes/contact');//for contact
var login = require('./routes/frontendRoutes/login');//for login
var contactDetail = require('./routes/frontendRoutes/contactDetail');
//initlise twig library
var swig = new swig.Swig();
app.engine('html', swig.renderFile);
app.set('view engine', 'html');
//use for css ,image and js file path.

app.use('/css', express.static(__dirname + '/public/css'));
app.use('/img', express.static(__dirname + '/public/image'));
app.use('/js', express.static(__dirname + '/public/js'));
//for initalige body parser

app.use(bodyParser.urlencoded({ extended : true }));
app.use(bodyParser.json());
//use for main page.

	app.use('/', home);
	app.use('/about', about);
	app.use('/gallery', gallery);
	app.use('/contact', contact);
	app.use('/login', login);
	app.use('/contactDetail', contactDetail);
 
 app.listen(3000);//maintain server port
 console.log('ok');