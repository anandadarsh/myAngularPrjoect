obj = {
	protfun : function(name){
		this.name = name;
	}
}	

obj.protfun.prototype = {
	greet:function(){
			console.log('this is prototype',this.name);
	}
	
}

ob = new obj.protfun('Adarsh');
ob.greet();

