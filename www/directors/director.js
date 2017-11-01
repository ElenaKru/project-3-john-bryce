var directorsModule = function() {
    directorApiMethod =  'director';
    return {
        createDirector: function() {

            var data = {
                name: $('#directorName').val(),
                ctrl: directorApiMethod
            }
            jQuery.ajax({
                url: '../../api/api.php' ,
                data: data,
                type: 'POST',
                success: function(result) {
                    alert('Director was added successfully!');
                    //   callback(result);
                }

            // jQuery.post(directorApiUrl).always(function(data) {
            //     console.log(data);
            });
        },
        getDirector: function(id, callback) {
            var data = {
                ctrl: directorApiMethod
            };
            if (id)
                data.id = id;

            jQuery.ajax({
                url: '../../api/api.php' ,
                data: data,
                type: 'GET',
                success: function(result) {

                    callback(result);
                }
            });
        },
        deleteDirector: function() {

        var data = {
            id: $('#directorID').val(),
            ctrl: directorApiMethod
        };
            // data.id = id;
            jQuery.ajax({
                url: '../../api/api.php' ,
                data: data,
                type: 'DELETE',
                success: function(result) {
                    alert('Director was deleted successfully!');
                }
            });
        },
        updateDirector: function (){

        var data = {
            id: $( "#directorID" ).val(),
            name : $('#directorName').val(),
            ctrl: directorApiMethod
        };
        $.ajax(
            {
                url: '../../api/api.php',
                type: 'PUT',
                data: data,
                // dataType: "json",
                success: function(result) {
                    // if(result.status == 0){
                        alert ('DIRECTOR WAS UPDATED SUCCESSFULLY');
                    // } else {
                    //     alert('ERROR');
                    // }
                }
            });
        },

    getDirectorsIds: function(callback) {
            jQuery.ajax({
                url: '../../api/api.php' ,
                data: {
                    ctrl: directorApiMethod
                },
                type: 'GET',
                success: function(result) {

                    callback(result);
                }
            });

        }
    }
}