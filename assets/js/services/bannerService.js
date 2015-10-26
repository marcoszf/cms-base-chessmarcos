cmsApp.factory("BannerServices", function($http){
	_deleteBanner = function(id){
		return $http.delete(id +'/exclude');
	};
	return {
		deleteBanner: _deleteBanner
	};
});