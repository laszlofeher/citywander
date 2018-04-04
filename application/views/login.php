<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>CityWander</title>

        <link rel="stylesheet" href="<?php print(base_url()); ?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php print(base_url()); ?>assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php print(base_url()); ?>assets/css/owl.carousel.min.css" />
        <link rel="stylesheet" href="<?php print(base_url()); ?>assets/css/daterangepicker.min.css" />
        <link rel="stylesheet" href="<?php print(base_url()); ?>assets/css/datepicker3.min.css" />
        <link rel="stylesheet" href="<?php print(base_url()); ?>assets/css/bootstrap-select.min.css" />
        <link rel="stylesheet" href="<?php print(base_url()); ?>assets/css/star-rating.min.css" />

        <link rel="stylesheet" href="<?php print(base_url()); ?>assets/css/bootstrap-theme.css" />

        <!--[if lt IE 9]>
            <script src="js/html5shiv.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <!-- menu navigation bar -->
        <?php
        $this->load->view('menu');
        ?>
        <!-- end of menu navigation bar -->
        <section class="section container" id="gosection">
            <div class="row">
                <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-center">
                                <h3><i class="fa fa-user-circle fa-4x"></i></h3>
                                <h2 class="text-center">Login</h2>
                                <div class="panel-body">

                                    <form role="form" autocomplete="off" class="login" method="post" action="login">
                                        <?php echo validation_errors(); ?>
                                        <div class="form-group">
                                            <label for="frmEmail">Email:</label>
                                            <input type="text" class="form-control" id="frmEmail" name="emailaddress"  value="<?php echo set_value('emailaddress'); ?>"  placeholder="Type in your email address..." />
                                        </div>
                                        <?php echo form_error('emailaddress', '<div >','</div>'); ?>
                                        <div class="form-group">
                                            <label for="frmPassword">Password:</label>
                                            <input type="password" class="form-control" id="frmPassword" name="password" placeholder="Type in your password..." />
                                            <a href="http://citywander.website/index.php/forgotpassword" class="color-black">Forgot the password?</a>
                                        </div>
                                        <?php echo form_error('password', '<div >','</div>'); ?>
                                        <div class="form-group">
                                            <div class="g-recaptcha" data-sitekey="6LcwiEAUAAAAABqR4tek9jkZKy2x99Xq2DI4iDwF"></div>
                                        </div>
                                        <div class="form-group">
                                            <input name="send" class="btn btn-lg btn-orange btn-block" value="Sign in" type="submit">
                                        </div>
                                        
                                        <a href="<?php print($facebookurl); ?>" class="btn btn-lg btn-block btn-facebook"><i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i> Sign in with Facebook</a>
                                        <a href="<?php print($googleurl); ?>" class="btn btn-block btn-lg btn-social btn-google"><i class="fa fa-google-plus"></i> Sign in with Google</a>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- footer -->
        <?php $this->load->view('footer');  ?>
        <!-- end of footer -->

        <script src="<?php print(base_url()); ?>assets/js/jquery.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/owl.carousel.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/moment.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/daterangepicker.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/bootstrap-select.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/star-rating.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <!-- JS script -->
        <script src="<?php print(base_url()); ?>assets/js/script.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/mset.js"></script>
    </body>
</html>