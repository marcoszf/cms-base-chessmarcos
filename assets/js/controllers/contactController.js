cmsApp.controller('listContact', function($scope){

});

cmsApp.controller('insertContact', function($scope){
	$scope.contact = {};
	$scope.alerts = [];

  $scope.reset = function() {
	    $scope.$broadcast('show-errors-reset');
	    $scope.contact = { name: '', email: '', subject: '', message: '' };
	  }

  $scope.save = function() {
    $scope.$broadcast('show-errors-check-validity');
    
    if ($scope.formInsertContact.$valid) {
      /*NewsService.saveNews($scope.news).success(function(data){
        console.log(data);
      });*/
      $scope.reset();
      $scope.alerts.push({msg: 'Registro cadastrado com sucesso!', type: 'success'});
    }
  };

});