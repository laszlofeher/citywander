<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>CityWander</title>
        <base href="<?php print(base_url()); ?>">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css" />
        <link rel="stylesheet" href="assets/css/daterangepicker.min.css" />
        <link rel="stylesheet" href="assets/css/datepicker3.min.css" />
        <link rel="stylesheet" href="assets/css/bootstrap-select.min.css" />
        <link rel="stylesheet" href="assets/css/star-rating.min.css" />

        <link rel="stylesheet" href="assets/css/bootstrap-theme.css" />

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
        <ul class="container breadcrumb">
            <li><a href="">Home</a></li>
            <li><a href="">Cart</a></li>
            <li class="active">Review order</li>
            <li>Secure Checkout</li>
            <li>Print vouchers</li>
        </ul>

        <section class="section container">
            
            <div class="row">
                <div class="col-xs-12 text-right mb-15">
                    <a href="<?php print(base_url('index.php/checkout')); ?>" class="btn btn-orange btn-lg">Confirm Availability</a>
                    <!--<input type="submit" name="" value="Confirm Availability (button)" class="btn btn-orange btn-lg" />-->
                </div>
            </div>
            <?php
                if(isset($cartcontent)){
                    foreach($cartcontent as $row){
            ?>
            <article class="col-xs-12 box-shadow cart-item">
                <div class="row equalizer-row">
                    <div class="col-md-8 col-xs-12">
                        <h4>
                            <a href="" class=""><?php print($row['name']); ?></a>
                        </h4>
                        <div class="row">
                            <div class="col-md-4">
                                <figure class="cart-pic">
                                    <img src="../../assets/images/pictures/Bus.jpg" alt="">
                                </figure>
                            </div>
                            <div class="col-md-8 details">
                                <strong>Travel date:</strong><?php print($row['options']['year'].' '.$row['options']['month'].' '.$row['options']['day']); ?> <br>
                                <strong>Option:</strong><?php print($row['options']['optionname']); ?><br>
                                <strong>Number of adults:</strong><?php print($row['options']['adultcount']); ?><br>
                                <strong>Number of children:</strong><?php print($row['options']['childrencount']); ?><br>
                                <strong>Number of infants:</strong><?php print($row['options']['infantscount']); ?><br>
                                <strong>Booking status:</strong> Instant confirmation<br>
                                This activity will be charged to the credit card upon completion of booking
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <a href="">Change dates & details <i class="fa fa-caret-right" aria-hidden="true"></i></a><br>
                        <a href="">Change # of travellers <i class="fa fa-caret-right" aria-hidden="true"></i></a><br>
                        <a href=""><i class="fa fa-times" aria-hidden="true"></i> Remove ftom cart</a>
                    </div>
                    <div class="col-md-2 col-sm-6 csol-xs-12 price">
                        <?php print(number_format(($row['options']['adultsprice']*$row['options']['adultcount']) + ($row['options']['childrenprice']*$row['options']['childrencount']) + ($row['options']['infantscount']*$row['options']['infantsprice']), 2, ',', ' ').' '.$currency['symbol']); ?>
                    </div>
                </div>
            </article>
            <?php
                    }
                }
            ?>
            <div class="col-md-4 col-md-offset-8 col-xs-12 box-shadow promo-code">
                <div>
                    <b>Enter promotion code</b> (optional) <a href=""><b>What's this?</b></a>
                </div>
                <input type="text" name="" value="" placeholder="Enter promo code" class="i-text"> <a href="">Apply <i class="fa fa-caret-right" aria-hidden="true"></i></a><br> 
            </div>
            <div class="col-xs-12 text-right total">
                Current cart total USD ($)<br>
                <span class="price"><?php print(number_format($sum, 2, ',', ' ').' '.$currency['symbol']); ?></span>
            </div>
            <div class="row">
                <div class="col-xs-12 text-right">
                    <a href="<?php print(base_url('index.php/checkout')); ?>" class="btn btn-orange btn-lg">Confirm Availability</a>
                    <!--<input type="submit" name="" value="Confirm Availability (button)" class="btn btn-teal btn-lg">-->
                </div>
            </div>
        </section>

        <!-- footer -->
        <?php $this->load->view('footer');  ?>
        <!-- end of footer -->

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/owl.carousel.thumbs.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/daterangepicker.js"></script>
        <script src="assets/js/bootstrap-select.min.js"></script>
        <script src="assets/js/star-rating.min.js"></script>

        <!-- JS script -->
        <script src="assets/js/script.js"></script>
        <script src="assets/js/mset.js"></script>
    </body>
</html>