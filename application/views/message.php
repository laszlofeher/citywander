<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>CityWander Admin</title>

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
        <section class="section container" id="login">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-3">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-center">
                                <h3><i class="fa fa-address-card-o fa-4x"></i></h3>
                                <h2 class="text-center"><?php  if(isset($message['title'])){print($message['title']);}else{print('Kérem töltse ki a szöveget');} ?></h2>
                                <div class="panel-body">
                                    <?php if(isset($message['description'])){print($message['description']);}else{print(' Kérem töltse ki a szöveget !');} ?>
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

        <!-- JS script -->
        <script src="<?php print(base_url()); ?>assets/js/script.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/mset.js"></script>
    </body>
</html>