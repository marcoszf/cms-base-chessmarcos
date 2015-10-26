cmsApp.factory('NewsService', function($http){

	_deleteNews = function(id){
		return $http.delete(id + '/exclude');
	}
	_saveNews = function(news){
		return $http.post('insert', news);
	}
	return {
		deleteNews: _deleteNews,
		saveNews: _saveNews
	}
});