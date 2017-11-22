var studentsModule = function() {
    studentApiMethod =  'student';
    return {
        createStudent: function() {

            var data = {
                name: $('#studentName').val(),
                ctrl: studentApiMethod
            }
            jQuery.ajax({
                url: '../api/api.php' ,
                data: data,
                type: 'POST',
                success: function(result) {
                    alert('Student was added successfully!');
                    //   callback(result);
                }

            // jQuery.post(studentApiUrl).always(function(data) {
            //     console.log(data);
            });
        },
        getStudents: function(callback) {
            var data = {
                ctrl: studentApiMethod
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

        getStudent: function(studentId, callback) {
            var data = {
                ctrl: studentApiMethod,
                id: studentId
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

        deleteStudent: function() {

        var data = {
            id: $('#studentID').val(),
            ctrl: studentApiMethod
        };
            // data.id = id;
            jQuery.ajax({
                url: '../api/api.php' ,
                data: data,
                type: 'DELETE',
                success: function(result) {
                    alert('Student was deleted successfully!');
                }
            });
        },
        updateStudent: function (){

        var data = {
            id: $( "#studentID" ).val(),
            name : $('#studentName').val(),
            ctrl: studentApiMethod
        };
        $.ajax(
            {
                url: '../api/api.php',
                type: 'PUT',
                data: data,
                // dataType: "json",
                success: function(result) {
                    // if(result.status == 0){
                        alert ('Student was updated successfully');
                    // } else {
                    //     alert('ERROR');
                    // }
                }
            });
        },

        getStudentsIds: function(callback) {
            jQuery.ajax({
                url: '../api/api.php' ,
                data: {
                    ctrl: studentApiMethod
                },
                type: 'GET',
                success: function(result) {

                    callback(result);
                }
            });

        },

        getStudentsCount: function(callback) {
            var data = {
                ctrl: studentApiMethod,
                search: 'count'
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
        }
    }
}