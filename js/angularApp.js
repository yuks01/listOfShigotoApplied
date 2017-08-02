var app = angular.module('myApp', ['ngRoute']);

app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {
	$locationProvider.html5Mode(true);
	$locationProvider.hashPrefix('!');
	$routeProvider
		.when ('/home', {
			templateUrl: 'views/listShigoto.html',
			controller: 'readData'
		})
		.when ('/login', {
			templateUrl: 'views/login.html',
			controller: 'loginCtrl'
		})
		.when ('/add', {
			templateUrl: 'views/addShigoto.html',
			controller: 'AppliedShigotoCtrl'
		})
		.when ('/register', {
			templateUrl: 'views/register.html',
			controller: 'registerCtrl'
		})
		.when ('/home/:id', {
			templateUrl: 'views/viewShigoto.html',
			controller: 'viewShigotoCtrl'
		})
		.when ('/logout', {	
			controller: 'loginCtrl'
		})
		.otherwise({redirectTo:'/home'});
}]);







app.controller('AppliedShigotoCtrl', ['$scope', '$http', 'ShigotoData', function($scope, $http, ShigotoData){
	//$scope.shigotoData = ShigotoData.modalAdd();
	console.log("ASDASD");
	$('#add').modal({complete: function() { $(".button-collapse").sideNav('hide'); window.location = "/shigoto/#!/home"; }});
	$('#add').modal('open');

	$scope.addAppliedShigoto = function(){
		$http.post('addshigotoPost.php',{
		'companyName' : $scope.companyName,
		'position' : $scope.position,
		'details' : $scope.details,
		'dateApplied' : $scope.dateApplied,
		'coverletter' : $scope.coverletter,
		'appliedLink' : $scope.appliedLink
		}).then(function (data, status, headers, config){
			console.log(data);
			Materialize.toast(data.data, 4000);
			// $('AppliedModal').modal('close');

		});	
	}

}]);


app.controller('readData', ['$scope', '$http', 'ShigotoData', 'loginService', function($scope, $http, ShigotoData, loginService){
	$('nav').removeClass('ng-hide');
	$(".button-collapse").sideNav('hide');
	$scope.getAll = function() {
		ShigotoData.getAllList().then(function(response){
			console.log(response);
			$scope.shigotos = response;
		});
	};
	
	$scope.deleteOne = function(id){
		console.log(id);

	};
	if(loginService.islogged()){
	$scope.getAll();
	loginService.getUser()}
	// console.log($scope.editOne);
}]);

app.controller('viewShigotoCtrl', ['$scope', 'ShigotoData', '$routeParams', function($scope, ShigotoData, $routeParams){
	var id = $routeParams.id;
	$scope.loadShigoto = function(){
		// console.log(id);
		// $scope.shigoto = ShigotoData.loadShigoto(id);
		// console.log($scope.shigoto);
		ShigotoData.loadShigoto(id).then(function(response){
			$scope.shigoto = response;
		});
	};

	$scope.editOne = function(shigoto){
		$scope.dataOfOne = ShigotoData.getOne($scope.shigoto);
		var toBeEdited = $scope.dataOfOne;
		console.log(toBeEdited);
		$('#edit').modal({complete: function() { location.reload(); }});
		$('#edit').modal('open');
		// console.log(ShigotoData.list);
		
		$scope.editAppliedShigoto = function() {
			console.log($scope.dataOfOne.dateApplied);
			ShigotoData.editShigoto(toBeEdited);
		};
	};

	$scope.confirmDelete = function () {
		$('#delete').modal({complete: function() { $(".button-collapse").sideNav('hide'); location.reload(); }});
		$('#delete').modal('open');

		$scope.deleteAppliedShigoto = function(){
			console.log(id);
			ShigotoData.deleteShigoto(id).then(function(){
				window.location = "/shigoto/#!/home";
			});

		};
		$scope.reloadForDelete = function() {
			$('#delete').modal('close');
		};
	}


	// $scope.shigoto = ShigotoData.loadShigoto(id);
}]);

app.factory('ShigotoData', function($http) {
	var list = [];
	var selected;


	var loadShigoto = function(id){
		console.log(id);
		return $http.post("loadShigoto.php", id).then(function(response){
			console.log(response.data);
			return response.data;
		});
	};

	var editShigoto = function(data){
		console.log(data);
		return $http.post('editshigotoPost.php',{
			'id' : data.id,
			'companyName' : data.companyName,
			'position' : data.position,
			'details' : data.details,
			'dateApplied' : data.dateApplied,
			'coverletter' : data.coverletter,
			'appliedLink' : data.appliedLink,
			'dateContacted1' : data.dateContacted1,
			'emailLink1' : data.emailLink1,
			'dateofInterview1' : data.dateofInterview1,
			'dateContacted2' : data.dateContacted2,
			'emailLink2' : data.emailLink2,
			'dateofInterview2' : data.dateofInterview2,
			'dateContacted3' : data.dateContacted3,
			'emailLink3' : data.emailLink3,
			'dateofInterview3' : data.dateofInterview3,
			'dateContacted4' : data.dateContacted4,
			'emailLink4' : data.emailLink4,
			'dateofInterview4' : data.dateofInterview4,
			'dateContacted5' : data.dateContacted5,
			'emailLink5' : data.emailLink5,
			'dateofInterview5' : data.dateofInterview5,
			'comment' : data.comment
			}).then(function (data, status, headers, config){
				console.log(data);
				Materialize.toast(data.data, 4000);
				// $('AppliedModal').modal('close');

			});	
	};

	var deleteShigoto = function (id) {
		return $http.post('deleteshigotoPost.php', {
			'id' : id
		}).then(function(data, status, headers, config){
			console.log(data);
		});
	};

	var getAllFromDB = function(){

		return $http.get("readShigotoPost.php").then(function(response){
			var shigotos = response.data;
			list = shigotos;
			 // console.log(list);
			 // console.log(response);

			 function searchLatest(search){
			 	
			 	for (var i = 0; i < shigotos.length; i++) {
			 		var count = 1;
			 		while(shigotos[i][search + count] != ""){
			 			count++;
			 		}
			 		shigotos[i]["latest" + search] = shigotos[i][search + (count - 1)];
			 	}
			 	
			 }
			 searchLatest("dateofInterview");
			 searchLatest("dateContacted");
			return shigotos;
		});
	};

	var getOneData = function(shigoto) {
		// console.log(typeof(id));
		// console.log(list);
		$("label").addClass("active");

		var selected = shigoto;
		console.log(selected);
		return selected;

	};


		// console.log(selected);

  return {
  	getAllList: getAllFromDB,
  	getOne: getOneData,
  	loadShigoto: loadShigoto,
  	editShigoto: editShigoto,
  	deleteShigoto: deleteShigoto
  };
});

app.controller('homeCtrl', ['$scope','loginService', function($scope,loginService){
	// var getUserName= function(){
	// 	loginService.getUser().then(function(user){
	// 		user = user.substring(1,user.length-1);
	// 		$scope.userName = user;
	// 		console.log(user);
	// 	});
	// 	// console.log(loginService.getUser());
	// 	// console.log($scope.userName);
	// };
	
	$scope.logout=function(){
		loginService.logout();
	}
	$scope.goHome = function(){
		$(".button-collapse").sideNav('hide');
		window.location = "/shigoto/#!/home";
	};
	if (loginService.islogged()) {loginService.getUser();}
	
}]);

app.controller('loginCtrl', ['$scope', 'loginService', function($scope, loginService){
	$scope.msgtxt='';
	$('nav').addClass('ng-hide');
	loginService.logout();
	$scope.login=function(data){
		loginService.login(data,$scope); //call login service
	};                    
  
}]);

app.controller('registerCtrl', ['$scope', 'registerService', function($scope, registerService){
	$scope.register = function(data) {
		registerService.register(data, $scope);
	};
}]);


app.factory('loginService', function($http, $location, sessionService){
	return {
		login: function(data, scope){
			var $promise = $http.post('loginPost.php', data);
			$promise.then(function(msg){
				// var uid = msg.data;
				// if (uid) {
				// 	$location.path('/home');
				// } else {
				// 	$location.path('/login');
				// }
				if(msg.data) {
					console.log(msg.data[0]);
					console.log(msg.data[1]);
					$location.path('/home');
				} else {
					alert('Wrong username or password');
				}
				
			});
		},
		logout:function(){
			$(".button-collapse").sideNav('hide');
			sessionService.destroy('uid');
			$location.path('/login');
		},
		islogged:function(){
			var $checkSessionServer=$http.post('check_session.php');
			return $checkSessionServer;
			/*
			if(sessionService.get('user')) return true;
			else return false;
			*/
		},
		getUser:function(){
			var getLoggedUser=$http.get('getLoggedUser.php');
			var user = getLoggedUser.then(function(response){
				console.log(response.data);
				 $('#userNameHere').text(response.data.substring(1, response.data.length-1));
			});
			// user = function(){return user.substring(1,user.length-1)};
			// $('#userNameHere').value(user);
		}
	};
});

app.factory('registerService', function($http, $location){
	return {
		register:function(data, scope){
			var post = $http.post('registerPost.php', data);
			post.then(function(msg){
				if (msg.data == "success") {
					console.log(msg.data);
					$location.path("/login");
				} else {
					alert('User already registered');
				}
			});
		}
	};
});

app.factory('homeService', function($http, $location){
	return {

	};
});

app.factory('sessionService', ['$http', function($http){
	return{
		set:function(key,value){
			return sessionStorage.setItem(key,value);
		},
		get:function(key){
			return sessionStorage.getItem(key);
		},
		destroy:function(key){
			$http.post('destroy_session.php');
			return sessionStorage.removeItem(key);
		}
	};
}]);

app.run(function($rootScope, $location, loginService){
	var routespermission=['/home', '/add', '/logout'];  //route that require login
	$rootScope.$on('$routeChangeStart', function(){

		result = routespermission.filter(function(item){
			var location = $location.path();
			var checkLocation = function (location) {
				if(location.split("/").length - 1 > 1){

					return location.substr(0,location.lastIndexOf('/'));
				} else {
					return location;
				}
			};
			var checkedLocation = checkLocation(location);
			
			return typeof item == 'string' && item.indexOf(checkedLocation) > -1;  
		});

		// console.log(result);

		if( result != "")
		{
			var connected=loginService.islogged();
			connected.then(function(msg){
				if(!msg.data) $location.path('/login');
			});
		}
	});
});