<?php
require_once 'autoload.php';
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php"); exit();
}
$user = new UserModel($_SESSION['user']);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>theschool</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="styles/st.css" />
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/vue"></script>
    </head>
    <body>


        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="menu">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <img src="images/theschool.jpg" class="img-fluid img-thumbnail"  width="170" height="170" alt="Responsive image">
                        <a id="school-link" class="linkAdminMenu" href="#">School</a>
                    <?php if($user->getRole() !=3){ ?>
                        <a id="administration-link" class="linkAdminMenu" href="#">Administration</a>
                    <?php } ?>
                    </div>
                    <div>
                        <ul class="nav navbar-nav navbar-right">
                            <h4><span class="largenav">Ilana Krutovsky,</span></h4>
                            <h4><span class="largenav">Owner</span></h4>
                            <!-- <li><label>Ilana Krutovsky,</label></li>
                            <li><label>Owner</label></li><br> -->
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                            <li><img id="admr-image" src="images/admin.jpg" width="100" height="100" ></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>


        <!-- <nav class="navbar navbar-inverse">
            <div class="container-fluid blui">
                <div class="navbar-header">
                    <img src="images/theschool.jpg" class="img-fluid img-thumbnail"  width="205" height="62" alt="Responsive image">
                </div>
                <ul class="nav navbar-nav">
                    <li><a id="school-link" class="linkAdminMenu" href="#">School</a></li>
                    <li><a id="administration-link" class="linkAdminMenu" href="#">Administration</a></li>
                </ul>
                <div class="pull-right">
                    <ul class="nav navbar-nav righti">
                        <li><label id="admr-name">Ilana Krutovsky,</label></li>
                        <li><label id="admr-role" >Owner</label></li>
                        <li><a href="logout.php">Logout</a></li>
                        <li><img id="admr-image" src="images/admin.jpg" width="100" height="100" ></li>
                    </ul>
                </div>
            </div>
        </nav> -->


        <!-- HELLO HOME PAGE

        <a href="logout.php">logout</a> -->
        <div id="result">
        </div>
        <!-- <div id="app">
            <p>{{ message }}</p>
        </div> -->
        <script src="courses/course.js"></script>
        <script>
            var d = coursesModule();

//            document.getElementsByTagName('a')[0].addEventListener('click', function() {
//                var res = d.getCourse(document.getElementsByTagName('a')[0].value, function(res) {

            $('#school-link').click(function () {
                var res = d.getCourses(function (res) {
                        res = JSON.parse(res);
                      //  console.log(res);
                        if (res.id) {
                            document.getElementsByTagName('div')[0].innerHTML =
                                "<span>" + "ID: " + res.id + "</span><br><span>" + "NAME: " + res.name + "</span>";
                        } else {
                            $('#result').append('Courses <button id="addCourse">+</button><br/>');
                            $.each(res, function () {
                                $('#result').append('ID: ' + this.id + ' NAME: ' + this.name + '<br>');
                            });
                        }
                    });
                });



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
        </script>

    </body>
</html>