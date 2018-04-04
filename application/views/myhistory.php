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
        <section class="section container" id="scontainer">
            <?php
                if(isset($history) && count($history)){
                    for($i=0; $i<count($history) ; $i++){
            ?>
            <article class="row media-box media-box-horizontal box-shadow">
                <figure class="col-sm-3 col-xs-6 media-box-pic">
                    <a href="http://citywander.website/index.php/promotiondetail/index/<?php print($history[$i]['id']);  ?>"><img src="../../assets/images/pictures/city.jpg" alt="" /></a>
                </figure>

                <div class="col-sm-3 col-xs-6 col-sm-push-6 media-box-details bg-teal color-white">
                    <div class="media-box-price"><span>from</span><?php print(number_format($history[$i]['price'],0,' ',' ').' '.$history[$i]['currency']);  ?></div>

                    <input class="input-rating rating-loading" disabled="disabled" value="3.5" />
                    <div class="rating-caption">10 reviews</div>

                    <a href="<?php print(base_url("index.php/activity/index/".$promotions[$i]["id"])); ?>" class="btn btn-block btn-orange"><?php if(isset($i_want_it)){print($i_want_it);}else{print("I want it");}?></a>
                </div>

                <div class="col-sm-6 col-xs-12 col-sm-pull-3 media-box-content">
                    <h3 class="media-box-title"><?php print($history[$i]['promotion_name']);  ?></h3>

                    <p><?php print($history[$i]['smalldescription']);  ?></p>

                    <ul class="row text-uppercase">
                        <li class="col-sm-6">3 hours long</li>
                        <li class="col-sm-6">Discounted rates</li>
                        <li class="col-sm-6">Free drink</li>
                        <li class="col-sm-6">Longest route</li>
                    </ul>
                </div>

                <a href="#" class="media-box-like"><i class="fa fa-heart-o"></i></a>
            </article>
            <?php
                    }
                }else{
            
            ?>
            <h2> ... </h2>
            <?php
                }
            ?>
        </section>
        <!-- footer -->
        <?php $this->load->view('footer'); ?>
        <!-- end of footer -->

        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
                <!--<script src="<?php print(base_url()); ?>assets/js/jquery.min.js"></script> -->
        <script src="<?php print(base_url()); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/owl.carousel.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/moment.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/daterangepicker.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/bootstrap-select.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/star-rating.min.js"></script>


        <!-- JS script -->
        <script src="<?php print(base_url()); ?>assets/js/mset.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/msearch.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/mlistview.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/script.js"></script>
        <script>

            $(function () {
                //Date range picker
                $('#reservation').daterangepicker();
                $('#languageselect').click(function () {
                    $.get("index.php/home/index/" + $('#languageselect').val())
                            .done(function (data) {
                                //alert("Data Loaded: " + data);
                            });
                });
                $('#scontainer').bind("DOMNodeInserted", function (e) {
                    $("#scontainer").unbind("DOMNodeInserted");
                    //DOMNodeRemoved 
                    //DOMSubtreeModified általámnosan mindenre lefut, (DOMNodeRemoved, DOMNodeInserted) esetén kétszer egyszer remove, aztán insert
                    $('.media-box-like').on('click', function (e) {
                        e.preventDefault();
                        $(this).find('i').toggleClass('fa-heart-o fa-heart');
                    });

                });
                $('.selectpicker').selectpicker();
            });

        </script>
    </body>
</html>