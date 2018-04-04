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
                            <h3><i class="fa fa-address-card-o fa-4x"></i></h3>
                            <h2 class="text-center"><?php print($registration); ?></h2>
                            <h5 class="text-center"><?php if(isset($buyeraquisitor_name)){print($buyeraquisitor_name);} ?></h5>
                            <div class="panel-body">
                                <?php echo form_open('index.php/registration'); ?>
                                <!--<form role="form" autocomplete="off" method="post" action="">-->
                                <?php echo validation_errors(); ?>
                                <input type="hidden" name="withbuyeraquisitor" id="withbuyeraquisitor" value="<?php if(isset($withbuyeraquisitor) && $withbuyeraquisitor == 1){print("1");}else{print("0");} ?>" />
                                <input type="hidden" name="buyeraquisitor_id" id="buyeraquisitor_id" value="<?php if(isset($buyeraquisitor_id) && $buyeraquisitor_id == 1){print($buyeraquisitor_id);}else{print("-1");} ?>" />
                                <div class="form-group">
                                    <label for="fullname"><?php print($fullname); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="<?php print($type_in_your_fullname); ?>" value="<?php echo set_value('fullname'); ?>" />
                                    </div>
                                    <?php echo form_error('fullname', '<div class="color-red fg-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="emailaddress">Email:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" id="emailaddress" name="emailaddress" placeholder="<?php print($type_in_your_email); ?>"  value="<?php echo set_value('emailaddress'); ?>" />
                                    </div>
                                    <?php echo form_error('emailaddress', '<div class="color-red fg-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="password1"><?php print($password); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" id="password1" name="password1" placeholder="<?php print($type_in_your_password); ?>"  value="<?php echo set_value('password1'); ?>" />
                                    </div>
                                    <?php echo form_error('password1', '<div class="color-red fg-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="password2"><?php print($confirm_password); ?></label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                        <input type="password" class="form-control" id="password2" name="password2" placeholder="<?php print($type_in_your_password_again); ?>"  value="<?php echo set_value('password2'); ?>" />
                                    </div>
                                    <?php echo form_error('password2', '<div class="color-red fg-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="6LcwiEAUAAAAABqR4tek9jkZKy2x99Xq2DI4iDwF"></div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" id="terms" name="terms">
                                             <?php print($i_accept_the); ?><a href="<?php print(base_url()); ?>index.php/page/index/_terms_and_conditions"><?php print($terms_and_conditions); ?></a>.
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="send" class="btn btn-lg btn-orange btn-block" value="<?php print($register); ?>" type="submit">
                                </div>
                                <a href="<?php print($facebookurl); ?>" class="btn btn-lg btn-block btn-facebook"><i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i><?php print($sign_in_with_facebook); ?></a>
                                <a href="<?php print($googleurl); ?>" class="btn btn-lg btn-block btn-google btn-social"><i class="fa fa-google-plus"></i><?php print($sign_in_with_google); ?></a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <!-- footer -->
    <?php $this->load->view('footer'); ?>
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
    <script src="<?php print(base_url()); ?>assets/js/mset.js"></script>
    <script src="<?php print(base_url()); ?>assets/js/script.js"></script>
</body>
</html>