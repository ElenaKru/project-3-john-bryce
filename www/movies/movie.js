  var moviesModule = function() {
                movieApiMethod =  'movie';
                return {
                    createMovie: function () {
                        var data = {
                            name: $('#movieName').val(),
                            d_id: $('#director').val(),
                            ctrl: movieApiMethod
                        }
                        jQuery.ajax({
                            url: '../../api/api.php',
                            data: data,
                            type: 'POST',
                            success: function (result) {
                                alert('Movie was added successfully!');
                                //   callback(result);
                            }
                        });
                    },
                    getMovie: function (id, callback) {
                        var data = {
                            ctrl: movieApiMethod
                        };
                        if (id)
                            data.id = id;

                        jQuery.ajax({
                            url: '../../api/api.php',
                            data: data,
                            type: 'GET',
                            success: function (result) {

                                callback(result);
                            }
                        });
                    },
                    deleteMovie: function () {

                        var data = {
                            id: $('#movieID').val(),
                            ctrl: movieApiMethod
                        };

                        jQuery.ajax({
                            url: '../../api/api.php',
                            data: data,
                            type: 'DELETE',
                            success: function (result) {
                                alert('Movie was deleted successfully!');
                            }
                        });
                    },
                    updateMovie: function (){

                        var data = {
                            id: $( "#movieID" ).val(),
                            name : $('#movieName').val(),
                            d_id: $('#director').val(),
                            ctrl: movieApiMethod
                        };
                        $.ajax(
                            {
                                url: '../../api/api.php',
                                type: 'PUT',
                                data: data,
                                // dataType: "json",
                                success: function(result) {
                                    // if(result.status == 0){
                                        alert ('MOVIE WAS UPDATED SUCCESSFULLY');
                                    // } else {
                                    //     alert('ERROR');
                                    // }
                                }
                            });
                    },

                    getMoviesIds: function (callback) {
                        jQuery.ajax({
                            url: '../../api/api.php',
                            data: {
                                ctrl: movieApiMethod
                            },
                            type: 'GET',
                            success: function (result) {

                                callback(result);
                            }
                        });
                    }
                }
            }