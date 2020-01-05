app.factory("HollandHelper", function () {
    var shuffle  = function (arr, len) {

        var stack = [] , ret = [];
        for(var i = 0; i < arr.length; i++){
            stack.push(arr[i]);
            ret.push(arr[i]);
        }
        while(stack.length){
            var current = stack.pop();
            if(current.length < len){
                for(var i = 0; i < arr.length; i++){
                    var regex = new RegExp(arr[i]);
                    if(!regex.test(current))
                    {
                        stack.push(current + arr[i]);
                        ret.push(current + arr[i]);
                    }

                }
            }
        }
        return ret;
    };
    var leveling = function (arr) {

        var temp = [[],[],[]], x=0;
        var level = arr[0][0];
        for(var i = 0; i < arr.length; i++){
            if(level == arr[i][0]){
                temp[x].push(arr[i][1]);
            }else{
                x++;
                temp[x].push(arr[i][1]);
                level = arr[i][0];
            }
        }
        return temp;
    };
    var sortData = function (obj) {
        var sortable = [];
        for(var i in obj){
            sortable.push([obj[i], i]);
        }
        sortable.sort(function (a, b) {
            return a < b;
        });
        return sortable;
    };
    return{
        getCopmintations : function (obj) {
            var ret = [];
            var arr = sortData(obj);
            var levels = leveling(arr);
            var level1 = shuffle(levels[0],3);
            var level2 = shuffle(levels[1],2);
            var level3 = levels[2];
            for(var i = 0; i < level1.length; i++){
                if(level1[i].length == 3){
                    {
                        ret.push(level1[i]);
                    }
                }else if(level1.length == 2){
                    for(var j = 0 ; j < level3.length; j++){
                        var regex = new RegExp(level1[i]);
                        if(!regex.test(level3[j]))
                        {
                            ret.push(level1[i]+level3[j]);
                        }
                    }
                }else if(level1.length == 1){
                    for(var j = 0 ; j < level2.length; j++){
                        var regex = new RegExp(level1[i]);
                        if(!regex.test(level2[j]))
                        {
                            ret.push(level1[i]+level2[j]);
                        }
                    }
                }
            }
            return ret;
        }
    };


});