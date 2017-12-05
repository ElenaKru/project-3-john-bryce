var coursesModule = function() {
    var currentID;
    var currentItem;
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
                   
                }

            });
        },
        getCourses: function(callback) {
            var data = {
                ctrl: courseApiMethod
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
        getCourse: function(courseId, callback) {
            var data = {
                ctrl: courseApiMethod,
                id: courseId
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

        getCoursesCount: function(callback) {
            var data = {
                ctrl: courseApiMethod,
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

        deleteCourse: function() {

        var data = {
            id: $('#courseID').val(),
            ctrl: courseApiMethod
        };
            
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
               
                success: function(result) {
                    // if(result.status == 0){
                        alert ('Course was updated successfully');
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