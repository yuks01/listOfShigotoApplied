var app = angular.module('myApp', ['ngRoute']);

app.config(function($routeProvider, $locationProvider) {
	$routeProvider
		.when ('/home', {
			templateUrl: 'listShigoto.html',
			controller: 'readData'
		})
		.when ('/login', {
			templateUrl: 'login.html',
			controller: 'loginCtrl'
		})
		.when ('/add', {
			templateUrl: 'addShigoto.html',
			controller: 'AppliedShigotoCtrl'
		})
		.otherwise({redirectTo:'/home'});
});







app.controller('AppliedShigotoCtrl', ['$scope', '$http', 'ShigotoData', function($scope, $http, ShigotoData){
	//$scope.shigotoData = ShigotoData.modalAdd();
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
			Materialize.toast(data, 4000);
			// $('AppliedModal').modal('close');

		});	
	}

}]);


app.controller('readData', ['$scope', '$http', 'ShigotoData', function($scope, $http, ShigotoData){
	$('nav').removeClass('ng-hide');
	$scope.getAll = function() {
		ShigotoData.getAllList().then(function(response){
			$scope.shigotos = response;

		});
	};
	$scope.editOne = function(id){
		$scope.dataOfOne = ShigotoData.getOne(id);
		$('#edit').modal({complete: function() { window.location = "/shigoto/#!/home"; }});
		$('#edit').modal('open');
		// console.log(ShigotoData.list);
		
		$scope.editAppliedShigoto = function() {
			console.log($scope.dataOfOne.dateApplied);
			$http.post('editshigotoPost.php',{
			'id' : $scope.dataOfOne.id,
			'companyName' : $scope.dataOfOne.companyName,
			'position' : $scope.dataOfOne.position,
			'details' : $scope.dataOfOne.details,
			'dateApplied' : $scope.dataOfOne.dateApplied,
			'coverletter' : $scope.dataOfOne.coverletter,
			'appliedLink' : $scope.dataOfOne.appliedLink,
			'dateContaced' : $scope.dataOfOne.dateContaced,
			'emailLink' : $scope.dataOfOne.emailLink,
			'dateofInterview' : $scope.dataOfOne.dateofInterview,
			'comment' : $scope.dataOfOne.comment
			}).then(function (data, status, headers, config){
				console.log(data);
				Materialize.toast(data, 4000);
				// $('AppliedModal').modal('close');

			});	
		};
	};

	$scope.deleteOne = function(id){
		console.log(id);
		$http.post('deleteshigotoPost.php', {
			'id' : id
		}).then(function(data, status, headers, config){
			ShigotoData.getAllList().then(function(response){
			$scope.shigotos = response;

		});
			console.log(data);
			Materialize.toast(data, 4000);
		});
	};
	// console.log($scope.editOne);
}]);

app.factory('ShigotoData', function($http) {
	var list = [];
	var selected;


	var getAllFromDB = function(){

		return $http.get("readShigotoPost.php").then(function(response){
			var shigotos = response.data;
			list = shigotos;
			 console.log(list);
			return shigotos;
		});
	};

	var getOneData = function(id) {
		// console.log(typeof(id));
		// console.log(list);

		getOneFromList();
		// console.log(chosenOne);
				console.log(selected);
		return selected;
		function getOneFromList(){
			var chosen;
			list.forEach(function(value, index, array){
				if(value.id == id){
					// console.log(value);
					chosen = value;
				}
			});

			selected = chosen;
			// console.log(selected);
		}

	};


		// console.log(selected);

  return {
  	getAllList: getAllFromDB,
  	getOne: getOneData
  };
});

app.controller('homeCtrl', ['$scope','loginService', function($scope,loginService){
	$scope.txt='Page Home';

	$scope.logout=function(){
		$(".button-collapse").sideNav('hide');
		loginService.logout();
	}
}])

app.controller('loginCtrl', ['$scope', 'loginService', function($scope, loginService){
	$scope.msgtxt='';
	$('nav').addClass('ng-hide');
	$scope.login=function(data){
		loginService.login(data,$scope); //call login service
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
					$location.path('/home')
				} else {
					console.log("SDSD");
				}
				
			});
		},
		logout:function(){
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
		}
	}
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
}])

app.run(function($rootScope, $location, loginService){
	var routespermission=['/home', '/add', '', '/'];  //route that require login
	$rootScope.$on('$routeChangeStart', function(){
		if( routespermission.indexOf($location.path()) !=-1)
		{
			var connected=loginService.islogged();
			connected.then(function(msg){
				if(!msg.data) $location.path('/login');
			});
		}
	});
});