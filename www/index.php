<?php
    require_once 'autoload.php';
    session_start();

    if(!isset($_SESSION['user'])){
        header("Location: login.php"); exit();
    }
    $user = new UserModel($_SESSION['user']);
    $error = '';
    if(!empty($_SESSION['error'])){
        $error = implode(', ',$_SESSION['error']);
        unset($_SESSION['error']);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>theschool</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="styles/style.css" />
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/mustache.min.js"></script>

    </head>
    <body>
        <!-- navigation -->
        <nav class="navbar navbar-default navbar-fixed-top"></nav>
        <div style="top: 170px;  position: absolute;  background-color: red;  width: 100%;"><?php echo $error; ?></div>
        <div id="mainPanel">
            <div id="resultAdministration">
            </div>
        </div>

        <div id="container">
        </div>


        <script src="courses/course.js"></script>
        <script src="students/student.js"></script>
        <script src="users/user.js"></script>

        <script>
            function checkHash() {
                var hash = location.hash;
                var re = /#([-0-9A-Za-z]+)(\:(.+))?/;
                var match = re.exec(hash);
                if (match) {
                    hash = match[1];
                    var param = match[3];
                    c.currentID = param;
                    s.currentID = param;
                    u.currentID = param;
                    console.log(param);
                    switch (hash) {
                        case 'school':
                            $("#school-link").click();
                            break;
                        case 'course':
                            
                            $("#school-link").click();
                            break;
                    }
                }
            }


            var c = coursesModule();
            var s = studentsModule();
            var u = usersModule();


            $(document).ready(function(){
                    var view = {
                    name : "<?php echo $user->getName();?>",
                    role: "<?php echo $user->getRoleName();?>",
                    viewAdminLink : <?php echo ($user->getRole() == 3 ? 'false' : 'true'); ?>
                };
                $("#templates").load("tpl/navigation.html",function(){
                    var template = document.getElementById('nav-bar-tpl').innerHTML;
                    var output = Mustache.render(template, view);
                    $(".navbar-default").html(output);
                    checkHash();
                });
            });
            $('.navbar-default').on('click', '#school-link', function(){
                $("#mainPanel").html('');
                $("#container").html('');
                $("#templates").load("tpl/schoolContent.html", function(){


                    c.getCourses(function (res) {

                        res = JSON.parse(res);
                            var view = {
                                courses : res
                            };
                                var template = $('#resultCourse-tpl').html();
                                var output = Mustache.render(template, view);
                                $("#mainPanel").append(output);

                            if(c.currentID != undefined){
                                $("#courseItem-" + c.currentID).click();
                            }
                    });

                    s.getStudents(function (res) {

                        res = JSON.parse(res);
                            var view = {
                                students : res
                            };
                                var template = $('#resultStudent-tpl').html();
                                var output = Mustache.render(template, view);
                                $("#mainPanel").append(output);
                            if(s.currentID != undefined){
                                $("#studentItem-" + s.currentID).click();
                            }
                    });

                    c.getCoursesCount(function (res) {
                        res = JSON.parse(res);
                      
                        var view = {
                            coursesCount : res
                        };
                    //    $("#templates").load("tpl/schoolContent.html #mainPanelCourseResume-tpl",function(){
                            var template = document.getElementById('mainPanelCourseResume-tpl').innerHTML;
                            var output = Mustache.render(template, view);
                            $("#container").append(output);
                     //   });

                    });

                    s.getStudentsCount(function (res) {
                        res = JSON.parse(res);
                       
                        var view = {
                            studentsCount : res
                        };
                     //   $("#templates").load("tpl/schoolContent.html #mainPanelStudentResume-tpl",function(){
                        var template = document.getElementById('mainPanelStudentResume-tpl').innerHTML;
                        var output = Mustache.render(template, view);
                        $("#container").append(output);
                    //    });

                    });

                });

            });


            $('.navbar-default').on('click', '#administration-link', function(){
                $("#mainPanel").html('');
                $("#container").html('');
                $("#templates").load("tpl/adminContent.html", function(){
                    u.getUsers(function (res) {
                        res = JSON.parse(res);
                     
                        if (res.id) {
                            document.getElementsByTagName('div')[0].innerHTML =
                                "<span>" + "ID: " + res.id + "</span><br><span>" + "NAME: " + res.name + "</span>";
                        } else {
                            var view = {
                                admins : res
                            };
                            var template = document.getElementById('resultAdmin-tpl').innerHTML;
                            var output = Mustache.render(template, view);
                            $("#mainPanel").append(output);
                            if(u.currentID != undefined){
                                $("#adminItem-" + u.currentID).click();
                            }
                        }
                    });

                    u.getUsersCount(function (res) {
                        res = JSON.parse(res);
                      
                        var view = {
                            adminsCount : res
                        };
                        $("#templates").load("tpl/adminContent.html #mainPanelAdminResume-tpl",function(){
                            var template = document.getElementById('mainPanelAdminResume-tpl').innerHTML;
                            var output = Mustache.render(template, view);
                            $("#container").append(output);
                        });

                    });

                });

            });

            $('#mainPanel').on('click', '#addCourse', function(){
                var view = {
                    method : 'POST'
                };
                $("#templates").load("tpl/schoolContent.html #addCourseTpl",function(){
                var template = document.getElementById('addCourseTpl').innerHTML;
                var output = Mustache.render(template, view);
                $("#container").html(output);
                });
            });

            $('#mainPanel').on('click', '#addStudent', function(){
                var view = {
                    method : 'POST'
                };
                $("#templates").load("tpl/schoolContent.html #addStudentTpl",function(){
                var template = document.getElementById('addStudentTpl').innerHTML;
                var output = Mustache.render(template, view);
                $("#container").html(output);
                });
            });

            $('#mainPanel').on('click', '#addAdmin', function(){
                var view = {
                    method : 'POST'
                };
                $("#templates").load("tpl/adminContent.html #addAdminTpl",function(){
                    var template = document.getElementById('addAdminTpl').innerHTML;
                    var output = Mustache.render(template, view);
                    $("#container").html(output);
                });
            });

            $('#container').on('click', '#editCourse', function(){
            
                var view = {
                    course : c.currentItem,
                    method: 'POST'
                };
                $("#templates").load("tpl/schoolContent.html #addCourseTpl",function(){
                var template = document.getElementById('addCourseTpl').innerHTML;
                var output = Mustache.render(template, view);
                $("#container").html(output);
                });
            });



            $('#container').on('click', '#editStudent', function(){
              
                var view = {
                    student : s.currentItem,
                    method: 'POST'
                };
                $("#templates").load("tpl/schoolContent.html #addStudentTpl",function(){
                    var template = document.getElementById('addStudentTpl').innerHTML;
                    var output = Mustache.render(template, view);
                    $("#container").html(output);
                });
            });


            $('#container').on('click', '#editAdmin', function(){
             
                var view = {
                    admin : u.currentItem,
                    method: 'POST'
                };
                $("#templates").load("tpl/adminContent.html #addAdminTpl",function(){
                    var template = document.getElementById('addAdminTpl').innerHTML;
                    var output = Mustache.render(template, view);
                    $("#container").html(output);
                });
            });


            $('#mainPanel').on('click', '.courseItem', function(){
                console.log('clicked', $(this).data('course-id'));
                var courseId = $(this).data('course-id');
                c.currentID = courseId;
                location.hash = '#course:'+ courseId;
                c.getCourse(courseId, function (res) {
                    res = JSON.parse(res);
                    c.currentItem = res;
                        var view = {
                            course : res
                        };
                        $("#templates").load("tpl/schoolContent.html #mainPanelCourseContent-tpl",function(){
                        var template = document.getElementById('mainPanelCourseContent-tpl').innerHTML;
                        var output = Mustache.render(template, view);
                        $("#container").html(output);
                        });

                });
            });

            $('#mainPanel').on('click', '.studentItem', function(){
                var studentId = $(this).data('student-id');
                s.currentID = studentId;
                location.hash = '#student:'+ studentId;
                s.getStudent(studentId, function (res) {
                    res = JSON.parse(res);
                    s.currentItem = res;
                    var view = {
                        student : res
                    };
                    $("#templates").load("tpl/schoolContent.html #mainPanelStudentContent-tpl",function(){
                    var template = document.getElementById('mainPanelStudentContent-tpl').innerHTML;
                    var output = Mustache.render(template, view);
                    $("#container").html(output);
                    });

                });
            });


            $('#mainPanel').on('click', '.adminItem', function(){
                var adminId = $(this).data('admin-id');
                u.currentID = adminId;
                location.hash = '#admin:'+ adminId;
                u.getUser(adminId, function (res) {
                    res = JSON.parse(res);
                    u.currentItem = res;
                    var view = {
                        admin : res
                    };
                    $("#templates").load("tpl/adminContent.html #mainPanelAdminContent-tpl",function(){
                    var template = document.getElementById('mainPanelAdminContent-tpl').innerHTML;
                    var output = Mustache.render(template, view);
                    $("#container").html(output);
                    });

                });
            });

       </script>

        <p id="person"></p>
        <div id="templates" style="display: none;"></div>
    </body>
</html>