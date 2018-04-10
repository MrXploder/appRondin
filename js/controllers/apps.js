/* by MrXploder @ Mixtura SpA. */
appRondin.controller('appRondinController', ["$scope", "$rootScope", "$http", "$localStorage", "$timeout", "$interval", "$window", "$filter", "$location", function($scope, $rootScope, $http, $localStorage, $timeout, $interval, $window, $filter, $location){
	$timeout(function(){
		Materialize.updateTextFields();
		$('select').material_select();    
		$('.collapsible').collapsible();
		$("#preloaderScreen").modal({
			dismissible:!1,
			opacity:.5,
			inDuration:300,
			outDuration:200,
			startingTop:"30%",
			endingTop:"30%"
		});
	},2000);

	$scope.rondin_isAdmin = {"name": "", "status": false, "access_level": ""};
	$scope.editTagName = false;
	$scope.newTag = {};
	/////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////////////////////////////////////////////////
	////////////SCOPE VARIABLES AND FUNCTIONS////////////////////////////////////

	function fetchUserData(){
		if($localStorage.rondin_admin_token && $localStorage.rondin_access_level){
			$scope.rondin_admin_token  = $localStorage.rondin_admin_token;
			$scope.rondin_access_level = $localStorage.rondin_access_level; 
			$http.get('../php/db_transactions/isAdmin.php', {params:{"admin_token": $scope.rondin_admin_token, "access_level": $scope.rondin_access_level}}).then(function successCallback(response){
				if(response.data.status === "found"){
					$scope.rondin_logs    = response.data.logs;
					$scope.rondin_tags    = response.data.tags;
					$scope.rondin_isAdmin = $localStorage.rondin_isAdmin  = {"status": true, "name": response.data.nom_operador, "access_level": response.data.access_level};
				}
			});
			$timeout(function(){
				$scope.isRouteLoading = false;
			},2000);
		}
		else{
			$localStorage.rondin_isAdmin = {"name": "", "status": false, "access_level": ""};
			$timeout(function(){
				$scope.isRouteLoading = false;
			},2000);
		}
	};

	fetchUserData();

	$scope.logOut = function(){
		delete $localStorage.rondin_admin_token;
		$window.location.reload();
	};

	$scope.formSubmit = function(nom_formulario){
		$('#preloaderScreen').modal('open');
		var formToSend    = ['registrarAdministrador'];
		var addressToSend = ['getAdmin.php'];
		var objectToSend  = [$scope.newAdministrator];
		
		var mainIndex = formToSend.indexOf(nom_formulario);

		$http.post('../php/db_transactions/'+addressToSend[mainIndex], objectToSend[mainIndex]).then(function successCallback(response){
			if(response.data.status === "found"){
				$localStorage.rondin_admin_token  = response.data.admin_token;
				$localStorage.rondin_access_level = response.data.access_level; 
				Materialize.toast('Ingresado con Exito', 5000, 'green');
				fetchUserData();
				$('#preloaderScreen').modal('close');
			}
			else{
				Materialize.toast('Error: '+response.data.status+' Codigo: '+response.data.code, 5000, 'amber');
				$('#preloaderScreen').modal('close');
			}
		}, function errorCallback(response){
			Materialize.toast('Error: No hay Conexión a Internet', 5000, 'red');
			$('#preloaderScreen').modal('close');
		});
	};

	$scope.enableEditTagNameInPlace = function(){
		$scope.editTagName = true;
	}

	$scope.saveEditedTagName = function(tag){
		$('#preloaderScreen').modal('open');
		$http.post('../php/db_transactions/saveTagName.php', tag).then(function successCallback(response){
			if(response.data.status === "success"){
				Materialize.toast('Guardado con Exito', 5000, 'green');
				$scope.editTagName = false;
				fetchUserData();
				$('#preloaderScreen').modal('close');
			}
			else{
				Materialize.toast('Error: '+response.data.status+' Codigo: '+response.data.code, 5000, 'amber');
				$('#preloaderScreen').modal('close');
			}
		}, function errorCallback(response){
			Materialize.toast('Error: No hay Conexión a Internet', 5000, 'red');
			$('#preloaderScreen').modal('close');
		});
	}

	$scope.saveNewTag = function(){
		$('#preloaderScreen').modal('open');
		$http.post('../php/db_transactions/saveNewTag.php', $scope.newTag).then(function successCallback(response){
			if(response.data.status === "success"){
				Materialize.toast('Guardado con Exito', 5000, 'green');
				$scope.newTag = {};
				fetchUserData();
				$('#preloaderScreen').modal('close');
			}
			else{
				Materialize.toast('Error: '+response.data.status+' Codigo: '+response.data.code, 5000, 'amber');
				$('#preloaderScreen').modal('close');
			}
		}, function errorCallback(response){
			Materialize.toast('Error: No hay Conexión a Internet', 5000, 'red');
			$('#preloaderScreen').modal('close');
		});
	}
}]);//close controller