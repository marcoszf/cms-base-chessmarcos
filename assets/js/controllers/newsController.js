cmsApp.controller('insertUpdateController', function($scope, NewsService, FileUploader){

  $scope.news = {};
  $scope.alerts = [];

  /**  Upload imagens  **/
  var uploader = $scope.uploader = new FileUploader({
    url: 'upload'
  });

  // FILTERS

  uploader.filters.push({
      name: 'imageFilter',
      fn: function(item /*{File|FileLikeObject}*/, options) {
          var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
          return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
      }
  });

   // CALLBACKS

    uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        console.info('onWhenAddingFileFailed', item, filter, options);
    };
    uploader.onAfterAddingFile = function(fileItem) {
        console.info('onAfterAddingFile', fileItem);
    };
    uploader.onAfterAddingAll = function(addedFileItems) {
        console.info('onAfterAddingAll', addedFileItems);
    };
    uploader.onBeforeUploadItem = function(item) {
        console.info('onBeforeUploadItem', item);
    };
    uploader.onProgressItem = function(fileItem, progress) {
        console.info('onProgressItem', fileItem, progress);
    };
    uploader.onProgressAll = function(progress) {
        console.info('onProgressAll', progress);
    };
    uploader.onSuccessItem = function(fileItem, response, status, headers) {
        console.info('onSuccessItem', fileItem, response, status, headers);
    };
    uploader.onErrorItem = function(fileItem, response, status, headers) {
        console.info('onErrorItem', fileItem, response, status, headers);
    };
    uploader.onCancelItem = function(fileItem, response, status, headers) {
        console.info('onCancelItem', fileItem, response, status, headers);
    };
    uploader.onCompleteItem = function(fileItem, response, status, headers) {
        console.info('onCompleteItem', fileItem, response, status, headers);
    };
    uploader.onCompleteAll = function() {
        console.info('onCompleteAll');
    };

    console.info('uploader', uploader);
    /**  Upload imagens  **/
 

  /*-----Date-----*/
  $scope.today = function() {
    $scope.news.dt = new Date();
  };
  $scope.today();
  $scope.formats = ['dd/MM/yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
  $scope.format = $scope.formats[0];
  $scope.dateOptions = {
    formatYear: 'yy',
    startingDay: 1,
    language: 'pt-BR'
  };
  $scope.open = function($event) {//Data
    $event.preventDefault();
    $event.stopPropagation();
    $scope.opened = true;
  };
  /*-----Date-----*/
  
  $scope.save = function() {
    $scope.$broadcast('show-errors-check-validity');
    
    if ($scope.formInsertNews.$valid) {
      NewsService.saveNews($scope.news).success(function(data){
        console.log(data);
      });
      $scope.reset();
      $scope.alerts.push({msg: 'Registro cadastrado com sucesso!', type: 'success'});
    }
  };

  $scope.closeAlert = function(index) {
    $scope.alerts.splice(index, 1);
  };
  
  $scope.reset = function() {
    $scope.$broadcast('show-errors-reset');
    $scope.news = { name: '', email: '' };
  }
});

cmsApp.controller('listNews', function( $rootScope, $log, $scope, $mdDialog, $location, NewsService) {
	
	$scope.alerts = [];
	$scope.shouldExclude = 'no';

var alert;
  //$scope.showDialogImgs = showDialogImgs;
  $scope.items = [1,2,3];

$scope.showDialogImgs = function ($event) {
    var parentEl = angular.element(document.querySelector('md-content'));
    alert = $mdDialog.alert({
      parent: parentEl,
      targetEvent: $event,
      template:
        '<md-dialog aria-label="Sample Dialog">' +
        '  <md-content>'+
        '    <md-list>'+
        '      <md-item ng-repeat="item in ctrl.items">'+
        '       <p>{{item}}</p>' +
        '      </md-item>'+
        '    </md-list>'+
        '  </md-content>' +
        '  <div class="md-actions">' +
        '    <md-button class="btn btn-primary" ng-click="ctrl.closeDialog()">' +
        '      Fechar' +
        '    </md-button>' +
        '  </div>' +
        '</md-dialog>',
        locals: {
          items: $scope.items,
          closeDialog: $scope.closeDialog
        },
        bindToController: true,
        controllerAs: 'ctrl',
        controller: 'listNews'
    });
    
    $mdDialog
      .show( alert )
      .finally(function() {
        alert = undefined;
      });
  }
  $scope.closeDialog = function() {
    $mdDialog.hide();
  };

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

				NewsService.deleteNews(idRow).success(function(data){
				var el = document.getElementById("row-"+idRow);
				el.style.display = "none";
				$scope.shouldExclude = idRow;
				$scope.alerts.push({msg: 'Registro excluído com sucesso!', type: 'success'});
			}).error(function(){
				$scope.alerts.push({msg: 'Ops, ocorreu um erro ao tentar excluir o registro.', type: 'danger'});
			});
			
    }, function() {
      
    });
	};
});