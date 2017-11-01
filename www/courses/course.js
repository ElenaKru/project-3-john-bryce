var coursesModule = function() {
    courseApiMethod =  'course';
    return {
        createCourse: function() {

            var data = {
                name: $('#courseName').val(),
                ctrl: courseApiMethod
            }
            jQuery.ajax({
                url: '../api/api.php' ,
                data: data,
                type: 'POST',
                success: function(result) {
                    alert('Course was added successfully!');
                    //   callback(result);
                }

            // jQuery.post(courseApiUrl).always(function(data) {
            //     console.log(data);
            });
        },
        getCourses: function(callback) {
            var data = {
                ctrl: courseApiMethod
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
        deleteCourse: function() {

        var data = {
            id: $('#courseID').val(),
            ctrl: courseApiMethod
        };
            // data.id = id;
            jQuery.ajax({
                url: '../api/api.php' ,
                data: data,
                type: 'DELETE',
                success: function(result) {
                    alert('Course was deleted successfully!');
                }
            });
        },
        updateCourse: function (){

        var data = {
            id: $( "#courseID" ).val(),
            name : $('#courseName').val(),
            ctrl: courseApiMethod
        };
        $.ajax(
            {
                url: '../api/api.php',
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

    getCoursesIds: function(callback) {
            jQuery.ajax({
                url: '../api/api.php' ,
                data: {
                    ctrl: courseApiMethod
                },
                type: 'GET',
                success: function(result) {

                    callback(result);
                }
            });

        }
    }
}