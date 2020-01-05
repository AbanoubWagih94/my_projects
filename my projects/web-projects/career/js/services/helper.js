app.factory('Helper', function () {
    return{
        sortData : function (obj) {
            var sortable = [];
            for(var i in obj){
                sortable.push([obj[i], i]);
            }
            sortable.sort(function (a, b) {
                return a < b;
            });
            return sortable;
        },
    };
});