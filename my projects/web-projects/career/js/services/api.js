app.service('Api', ['$http', 'Upload', function($http, Upload) {

    this.getData = function(url){
        return $http.get(url);
    };

    this.uploadMedia = function(url , file){

        return Upload.upload({
            url: url,
            data: {
                file:file
            }
        });

    };

    this.postData = function (url, id, data, optional) {
       var d = {
           id: id
           };
        if(optional)
            d[optional] = data;
        else
            d.d = data;
        return Upload.upload({
            url: url,
            data: d
        });
    };
    this.deleteData = function (url, id, t) {
        return Upload.upload({
            url: url,
            data: {
                delete:id,
                table: t
            }
        });
    };

}]);