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
        <link rel="stylesheet" type="text/css" href="styles/st.css" />
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
//                        case 'admin':
//                            $("#administration-link").click();
//                            break;
                    }

                    // console.log(hash, param);
                }
            }


            var c = coursesModule();
            var s = studentsModule();
            var u = usersModule();


//            document.getElementsByTagName('a')[0].addEventListener('click', function() {
//                var res = d.getCourse(document.getElementsByTagName('a')[0].value, function(res) {
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
                      //  console.log(res);
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
                       // console.log(res);
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
                $("#templates").load("tpl/adminContent.html", function(){
                    u.getUsers(function (res) {
                        res = JSON.parse(res);
                     //   console.log(res);
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
                      //  console.log(res);
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
            //    console.log(c.currentItem);
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
              //  console.log(s.currentItem);
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
             //   console.log(u.currentItem);
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







//            $('#school-link').click(function () {
//                var res = c.getCourses(function (res) {
//                    res = JSON.parse(res);
//                    console.log(res);
//                    if (res.id) {
//                        document.getElementsByTagName('div')[0].innerHTML =
//                            "<span>" + "ID: " + res.id + "</span><br><span>" + "NAME: " + res.name + "</span>";
//                    } else {
//                        $('#resultCourse').append('<b><u>Courses</u></b> <button id="addCourse">+</button><br><br>');
//                        $.each(res, function () {
//                            $('#resultCourse').append(' NAME: ' + this.name + '<br>');
//                        });
//                    }
//                });
//            });



         /*   $('#school-link').click(function () {

            });*/



/*            $('#school-link').click(function () {
                var res = s.getStudentsCount(function (res) {
                    res = JSON.parse(res);
                    console.log(res);
                    if (res.id) {
                        document.getElementsByTagName('div')[1].innerHTML =
                            "<span>" + "ID: " + res.id + "</span><br><span>" + "NAME: " + res.name + "</span>";
                    } else {
                        $('#container').append('<b><u>Students</u></b> res<br><br>');
//                        $.each(res, function () {
//                            $('#container').append(' NAME: ' + this.name + ' PHONE: ' + this.phone + '<br>');
//                        });
                    }
                });
            });*/





           /* $( document ).ready(function() {
                var res = u.getUsers('#user', function (res) {
                    res = JSON.parse(res);
                    console.log(res);
                    if (res.id) {
                        document.getElementsByTagName('span')[0].innerHTML =
                            "<span>" + "ID: " + res.id + "</span><br><span>" + "NAME: " + res.name + "</span>";
                    } else {
                        $.each(res, function () {
                            $('#user').append(' NAME: ' + this.name + ' ROLE: ' + this.role + '<br>');
                        });
                    }
                });
            });*/





            // new Vue({
            //     el: '#app',
            //     data: {
            //         message: 'Hello Vue.js!'
            //     }
            // });
            // Vue.component('greeter', {

            //     template: require('./greeter.html'),

            //     props: ['name'],
            // });

//            var  data = {
//                "header": "Colors",
//                "items": [
//                    {"name": "red", "first": true, "url": "#Red"},
//                    {"name": "green", "link": true, "url": "#Green"},
//                    {"name": "blue", "link": true, "url": "#Blue"}
//                ],
//                "empty": false
//            };
//
//            var template = '<h1>{{header}}</h1>{{#bug}}{{/bug}}{{#items}}{{#first}}<li><strong>{{name}}</strong></li>{{/first}}{{#link}}<li><a href="{{url}}">{{name}}</a></li>{{/link}}{{/items}}{{#empty}}<p>The list is empty.</p>{{/empty}}';
//
//
//            document.getElementById("output").value = Mustache.to_html(template, data);



//            $(document).ready(function(){
//                var view = {
//                    name : "Joe",
//                    occupation : "Web Developer"
//                };
//                $("#templates").load("template.html #template1",function(){
//                    var template = document.getElementById('template1').innerHTML;
//                    var output = Mustache.render(template, view);
//                    $("#person").html(output);
//                });
//            });
//
//
//
       //     Mustache.to_html(template, data);


         /*   var data = [
                {
                    "id":"3",
                    "id_cat":"10",
                    "text":"Книга Секреты JavaScript ниндзя",
                    "url_link":"http://xxxLorem/id/22421421",
                    "url_img":"//xxxLorem.ru/1007123068.jpg"
                },
                {
                    "id":"4",
                    "id_cat":"10",
                    "text":"Книга JavaScript. Шаблоны",
                    "url_link":"http://xxxLorem/id/6287517",
                    "url_img":"//xxxLorem.ru/1002535209.jpg"
                },
                {
                    "id":"5",
                    "id_cat":"2",
                    "text":"Книга Отзывчивый веб-дизайн",
                    "url_link":"http://xxxLorem/id/8747299",
                    "url_img":"//xxxLorem.ru/1007055061.jpg"
                },
                {
                    "id":"6",
                    "id_cat":"4",
                    "text":"Книга Yii. Сборник рецептов",
                    "url_link":"http://xxxLorem/id/19756871/",
                    "url_img":"//xxxLorem.ru/1005845104.jpg"
                }
            ]*/
           /* function showStudent(data) {  // знак решетки({{#products}}) говорит, что надо пройтись по элементам массива
                $('#container').append(Mustache.to_html("{{#students}} \
                    <section> \
                        <div> \
                            <div class='clearfix' > \
                                <a href='{{url_link}}' title=''> \
                                    <img class='img'  src='{{url_img}}'> \
                                </a> \
                            </div> \
                            <div class='txt'> \
                                <div> \
                                    <a href='{{url_link}}'>{{text}}</a> \
                                </div> \
                            </div> \
                        </div> \
                    </section> \
                {{/students}}", { students: data }));
            }*/
       </script>

        <p id="person"></p>
        <div id="templates" style="display: none;"></div>
    </body>
</html>