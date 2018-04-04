<!doctype html>
<html lang="en">
    <head>
        <title>CITYWANDER HOME</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link href="<?php print(base_url()); ?>assets/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link href="<?php print(base_url()); ?>assets/css/citywander.custom.css" rel="stylesheet">
        <!-- daterange picker -->
        <link rel="stylesheet" href="<?php print(base_url()); ?>assets/plugins/daterangepicker/daterangepicker.css">
        <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="<?php print(base_url()); ?>assets/plugins/datepicker/datepicker3.css">
    </head>
    <body>
        <div class="container_nopadding" >
            <!-- HEADER -->
            <header>
                <nav class="navbar navbar-expand-md navbar-dark fixed-top color_bg_teal_dark" >
                    <a class="navbar-brand" href="#">CITYWANDER</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#"><?php print($home); ?> <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><?php print($link); ?></a>
                            </li>
                            <!-- login form -->
                            <li class="dropdown" id="login">
                                <a class="nav-link" data-toggle="dropdown" href="#login">
                                    <?php print($login); ?>
                                    <b class="caret"></b>
                                </a>
                                <div class="dropdown-menu">
                                    <form style="margin: 0px" accept-charset="UTF-8" action="/sessions" method="post">
                                        <fieldset class='textbox' style="padding:10px">
                                            <label for="username">
                                                Email
                                                <input style="margin-top: 8px" type="text" placeholder="Username" name="userrname" id="username" />
                                            </label>
                                            <label for="password">
                                                Password
                                                <input style="margin-top: 8px" type="password" placeholder="Passsword" name="password" id="password"/>
                                            </label>
                                            <input class="btn-primary" name="commit" type="submit" value="Log In" />
                                        </fieldset>
                                    </form>
                                </div>
                            </li>
                            <!-- end of login form -->
                            <!-- register form -->
                            <li class="dropdown" id="register">
                                <a class="nav-link" data-toggle="dropdown" href="#register">
                                    <?php print($registration); ?>
                                    <b class="caret"></b>
                                </a>
                                <div class="dropdown-menu">
                                    <form style="margin: 0px" accept-charset="UTF-8" action="/sessions" method="post">
                                        <fieldset class='textbox' style="padding:10px">
                                            <label for="firstname">
                                                Firstname
                                                <input style="margin-top: 8px" type="text" placeholder="firstname" name="firstname" id="firstname" />
                                            </label>
                                            <label for="lastname">
                                                Lastname
                                                <input style="margin-top: 8px" type="text" placeholder="lastname" name="lastname" id="lastname" />
                                            </label>
                                            <label for="mobile">
                                                Mobile
                                                <input style="margin-top: 8px" type="text" placeholder="mobile" name="mobile" id="mobile" />
                                            </label>
                                            <label for="username">
                                                Email
                                                <input style="margin-top: 8px" type="text" placeholder="Username" name="userrname" id="username" />
                                            </label>
                                            <label for="password1">
                                                Password
                                                <input style="margin-top: 8px" type="password" placeholder="Passsword" name="password1" id="password1"/>
                                            </label>
                                            <label for="password2">
                                                Password
                                                <input style="margin-top: 8px" type="password" placeholder="Passsword" name="password2" id="password2"/>
                                            </label>
                                            <input class="btn-primary" name="commit" type="submit" value="Save" />
                                        </fieldset>
                                    </form>
                                </div>
                            </li>
                            <!-- end of register form -->
                            <li class="dropdown nav-item">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#"><?php print($language); ?></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Magyar</a></li>
                                    <li><a href="#">Angol</a></li>
                                    <li><a href="#">Német</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Disabled</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#"><?php var_dump($lang); ?></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <main role="main">
                <!-- CONTENT -->
                <div class="row">
                    <!-- MAIN PIC -->
                    <div class="col-lg-12" style="background: url(<?php print(base_url()); ?>assets/img/landing_img.jpg) no-repeat center red; background-size:cover; width: 100%;">
                        <div style="background: rgba(255, 255, 255, 0.5); margin: 120px auto; width: 75%; padding:30px; border-radius: 15px; box-shadow: 5px 5px  10px rgba(0,0,0, 0.2);">
                            <p class="subtitle_teal_dark" style="text-align:center;"><?php print($what_do_you_want_to_do_in_budapest); ?></p>
                            <div class="row">
                                <div class="col-lg-5">
                                    <!-- Date range -->  
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="reservation" name="dateintervall">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
                                </div>
                                <div class="col-lg-4">
                                    <!-- Activity filter -->
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-camera"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="activity" name="searchtext">
                                        </div>
                                        <!-- /.input group -->
                                    </div>
                                    <!-- /.form group -->
                                </div>
                                <div class="col-lg-3">
                                    <a class="btn btn-teal_light btn-block" href="#" role="button" style="vertical-align:bottom" id="searchbutton"><i class="fa fa-search"></i><?php print($search); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>

                <div class="container">
                    <!-- QUICK LINKS -->
                    <div class="row" style="margin: 40px 0;">
                        <div class="col-lg-12" style="text-align: center;">
                            <a class="btn btn-lg btn-teal_light" href="#" role="button" id="things_to_do"><?php print($things_to_do); ?></a>
                            <a class="btn btn-lg btn-teal_light" href="#" role="button" id="sightseeing"><?php print($sightseeing); ?></a>
                            <a class="btn btn-lg btn-teal_light" href="#" role="button" id="activities"><?php print($activities); ?></a>
                            <a class="btn btn-lg btn-teal_light" href="#" role="button" id="packages"><?php print($packages); ?></a>
                            <a class="btn btn-lg btn-teal_light" href="#" role="button" id="must_try"><?php print($must_try); ?></a>   
                        </div>
                    </div>

                    <!-- POPULAR THINGS TO DO -->

                    <div class="row"  style="text-align:center">
                        <h2>Popular things to do</h2>  
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-xs-6" style="margin-bottom:15px;">
                            <div class="image_container" style="height: 180px;">  
                                <img src="<?php print(base_url()); ?>assets/img/landing_img.jpg" class="centered" style="width: 100%; max-height:180px;"/>
                                <div class="centered box_inside">hop-on <br>hop-off</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-6" style="margin-bottom:15px;">
                            <div class="image_container" style="height: 180px;">  
                                <img src="<?php print(base_url()); ?>assets/img/landing_img.jpg" class="centered" style="width: 100%; max-height:180px;"/>
                                <div class="centered box_inside">authentic</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-6" style="margin-bottom:15px;">
                            <div class="image_container" style="height: 180px;">  
                                <img src="<?php print(base_url()); ?>assets/img/landing_img.jpg" class="centered" style="width: 100%; max-height:180px;"/>
                                <div class="centered box_inside">gastro</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-xs-6" style="margin-bottom:15px;">
                            <div class="image_container" style="height: 180px;">  
                                <img src="<?php print(base_url()); ?>assets/img/landing_img.jpg" class="centered" style="width: 100%; max-height:180px;"/>
                                <div class="centered box_inside">budapest transport</div>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <p><a class="btn btn-lg btn-teal_light" href="#" role="button">View all</a></p>  
                    </div> 

                    <!-- TOP SIGHTSEEINGS -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Top sightseeings</h2>  
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin dolor est, tincidunt et est fermentum, imperdiet consequat nunc. Aliquam tempus, quam ac fermentum blandit, quam massa vulputate arcu, ut luctus diam est at enim. Vestibulum sed vestibulum justo. Suspendisse nunc massa, fermentum in ante sit amet, facilisis egestas sem. Nullam luctus, nunc in venenatis vestibulum, sem elit cursus mauris, quis facilisis libero ipsum ac lorem. Nullam et pharetra lacus. Aliquam erat volutpat. Nulla facilisi. Nulla sed lacinia mauris, eget varius odio. Duis scelerisque fermentum ipsum, ac gravida quam condimentum vel. Nam sagittis nec lorem vitae fermentum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin ultricies mi nec lectus volutpat, non elementum dolor venenatis.
                            <p><a class="btn btn-lg btn-teal_light" href="#" role="button">View all</a></p>
                        </div>
                    </div>
                    <!-- TOP ACTIVITIES -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Top activities</h2>  
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin dolor est, tincidunt et est fermentum, imperdiet consequat nunc. Aliquam tempus, quam ac fermentum blandit, quam massa vulputate arcu, ut luctus diam est at enim. Vestibulum sed vestibulum justo. Suspendisse nunc massa, fermentum in ante sit amet, facilisis egestas sem. Nullam luctus, nunc in venenatis vestibulum, sem elit cursus mauris, quis facilisis libero ipsum ac lorem. Nullam et pharetra lacus. Aliquam erat volutpat. Nulla facilisi. Nulla sed lacinia mauris, eget varius odio. Duis scelerisque fermentum ipsum, ac gravida quam condimentum vel. Nam sagittis nec lorem vitae fermentum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin ultricies mi nec lectus volutpat, non elementum dolor venenatis.
                            <p><a class="btn btn-lg btn-teal_light" href="#" role="button">View all</a></p>
                        </div>
                    </div>

                </div>

            </main>
            <footer class="footer">
                <!-- FOOTER -->
                <div class="row">
                    <div class="col-lg-12">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin dolor est, tincidunt et est fermentum, imperdiet consequat nunc. Aliquam tempus, quam ac fermentum blandit, quam massa vulputate arcu, ut luctus diam est at enim. Vestibulum sed vestibulum justo. Suspendisse nunc massa, fermentum in ante sit amet, facilisis egestas sem. Nullam luctus, nunc in venenatis vestibulum, sem elit cursus mauris, quis facilisis libero ipsum ac lorem. Nullam et pharetra lacus. Aliquam erat volutpat. Nulla facilisi. Nulla sed lacinia mauris, eget varius odio. Duis scelerisque fermentum ipsum, ac gravida quam condimentum vel. Nam sagittis nec lorem vitae fermentum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin ultricies mi nec lectus volutpat, non elementum dolor venenatis.
                    </div>
                </div>
            </footer>



        </div>  


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <!-- date-range-picker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap datepicker -->
        <script src="<?php print(base_url()); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script>
            $(function () {
                //Date range picker
                $('#reservation').daterangepicker();

                //click on search button
                $('#searchbutton').click(function () {
                    var jssearchtext = $('#activity').val();

                    $.post("index.php/home/search", {searchtext: jssearchtext})
                            .done(function (data) {
                                alert("Data Loaded: " + data);
                            });
                });
                $('#things_to_do').click(function () {
                    $.post("index.php/home/searchByCategory", {categoryid: 1})
                            .done(function (data) {
                                alert("Data Loaded: " + data);
                            });
                });
                $('#sightseeing').click(function () {
                    $.post("index.php/home/searchByCategory", {categoryid: 2})
                            .done(function (data) {
                                alert("Data Loaded: " + data);
                            });
                });
                $('#activities').click(function () {
                    $.post("index.php/home/searchByCategory", {categoryid: 3})
                            .done(function (data) {
                                alert("Data Loaded: " + data);
                            });
                });
                $('#packages').click(function () {
                    $.post("index.php/home/searchByCategory", {categoryid: 4})
                            .done(function (data) {
                                alert("Data Loaded: " + data);
                            });
                });
                $('#must_try').click(function () {
                    $.post("index.php/home/searchByCategory", {categoryid: 5})
                            .done(function (data) {
                                alert("Data Loaded: " + data);
                            });
                });



                $('*').click(function (event){
                    $.post("index.php/history/addHistory", {event: event.target.id})
                            .done(function (data) {
                                alert("Data Loaded: " + data);
                            });
                    
                });
            });
        </script>
    </body>
</html>