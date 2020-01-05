function rate(rate, id, route_name) {
    $.ajax(
        {
            url: '/'+route_name+'/'+id+'/rate/'+rate, 
            type: 'PUT', 
            success: function(result) {
                console.log(result);
            }
        }
    );
}