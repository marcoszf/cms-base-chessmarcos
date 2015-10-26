
cmsApp.controller('ListCtrl', function($scope, $mdDialog, $rootScope, $location, BannerServices) {

$scope.alerts = [];

$scope.shouldExclude = 'no';

	$scope.closeAlert = function(index) {
    $scope.alerts.splice(index, 1);
  };

	$scope.deleteRow = function(idRow){
		
		var confirmExclude = $mdDialog.confirm()
		.title('Deseja realmente excluir este registro? ')
		.ariaLabel('Lucky day')
		.ok('Sim')
    .cancel('Não')
		$mdDialog.show(confirmExclude).then(function() {

			BannerServices.deleteBanner(idRow).success( function(data){
				$scope.alerts.push({msg: 'Registro excluído com sucesso!', type: 'success'});
				//danger, warning, success, info
				var el = document.getElementById("row-"+idRow);
				el.style.display = "none";
				$scope.shouldExclude = idRow;
			}).error( function(){
				$scope.alerts.push({msg: 'Ops, ocorreu um erro ao tentar excluir o registro.', type: 'danger'});
			});
			
    }, function() {

    });
	};
});