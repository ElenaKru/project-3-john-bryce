var usersModule = function() {
    userApiMethod =  'user';
    return {
        createUser: function() {

            var data = {
                name: $('#userName').val(),
                ctrl: userApiMethod
            }
            jQuery.ajax({
                url: '../api/api.php' ,
                data: data,
                type: 'POST',
                success: function(result) {
                    alert('User was added successfully!');
                    //   callback(result);
                }

            // jQuery.post(userApiUrl).always(function(data) {
            //     console.log(data);
            });
        },

        getUsers: function(callback) {
            var data = {
                ctrl: userApiMethod
            };
            // if (id)
            //     data.id = id;

            jQuery.ajax({
                url: '../api/api.php' ,
                data: data,
                type: 'GET',
                success: function(result) {

                    callback(result);
                }
            });
        },

        getUser: function(adminId, callback) {
            var data = {
                ctrl: userApiMethod,
                id: adminId
            };
            // if (id)
            //     data.id = id;

            jQuery.ajax({
                url: '../api/api.php' ,
                data: data,
                type: 'GET',
                success: function(result) {

                    callback(result);
                }
            });
        },

        getUsersCount: function(callback) {
            var data = {
                ctrl: userApiMethod,
                search: 'count'
            };

            jQuery.ajax({
                url: '../api/api.php' ,
                data: data,
                type: 'GET',
                success: function(result) {

                    callback(result);
                }
            });
        },

        deleteUser: function() {

        var data = {
            id: $('#userID').val(),
            ctrl: userApiMethod
        };
            // data.id = id;
            jQuery.ajax({
                url: '../api/api.php' ,
                data: data,
                type: 'DELETE',
                success: function(result) {
                    alert('User was deleted successfully!');
                }
            });
        },
        updateUser: function (){

        var data = {
            id: $( "#userID" ).val(),
            name : $('#userName').val(),
            ctrl: userApiMethod
        };
        $.ajax(
            {
                url: '../api/api.php',
                type: 'PUT',
                data: data,
                // dataType: "json",
                success: function(result) {
                    // if(result.status == 0){
                        alert ('User was updated successfully!');
                    // } else {
                    //     alert('ERROR');
                    // }
                }
            });
        },

    getUsersIds: function(callback) {
            jQuery.ajax({
                url: '../api/api.php' ,
                data: {
                    ctrl: userApiMethod
                },
                type: 'GET',
                success: function(result) {

                    callback(result);
                }
            });

        }

        // getUsers: function(id, callback) {
        //     var data = {
        //         ctrl: userApiMethod
        //     };
        //     // if (id)
        //     //     data.id = id;
        //
        //     jQuery.ajax({
        //         url: '../api/api.php' ,
        //         data: data,
        //         type: 'GET',
        //         success: function(result) {
        //
        //             callback(result);
        //         }
        //     });
        // },


    }
}