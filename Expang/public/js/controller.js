var app = angular.module('ngListApp',[]);
 
//create services for get data
app.factory('MyContactServices',function($http){
		var listObj = {};
			//get all contact List.
				listObj.list = function(){
					return $http({
							method:'GET',
							url:'/contacts'
					})
				},
			//end of get all contact list.
			//start for insert contact.	
				
				listObj.addNewContact = function(val){alert(val);
					return $http({
							method:'POST',
							url:'/addContacts',
							data:val
							
					})
				}

			//End  of get all contact list.
			
		return listObj;
});

app.controller('ngListController',function($scope, MyContactServices){
			//$scope.GetcontactList = function(){
			MyContactServices.list().then(function(res){
				$scope.MysetVar = res.data;
			})
			//}
			$scope.AddNewContact = function(form){alert(form);
				var config = {"color" : $scope.color, "category" : $scope.category,"type" : $scope.type }
				MyContactServices.addNewContact(config).then(function(res){
					alert('ok');		
				 })
			}

});