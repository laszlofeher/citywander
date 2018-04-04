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
        <!-- carousel -->
        <?php
        $this->load->view('carousel');
        ?>
        <!-- end of carousel -->	
        <section id="button-list" class="container">
            <ul class="btn-list text-center sm-btn-list">
                <li><a href="<?php print(base_url()."index.php/listview/index/1/-1/1/1/10/-1"); ?>" class="btn btn-orange btn-lg" id="things_to_do"><img src="../../assets/images/pictures/city.jpg" alt=""><?php print($things_to_do); ?></a>
                <li><a href="<?php print(base_url()."index.php/listview/index/2/-1/1/1/10/-1"); ?>" class="btn btn-orange btn-lg" id="sightseeing"><img src="../../assets/images/pictures/city.jpg" alt=""><?php print($sightseeing); ?></a>
                <li><a href="<?php print(base_url()."index.php/listview/index/3/-1/1/1/10/-1"); ?>" class="btn btn-orange btn-lg" id="activities"><img src="../../assets/images/pictures/city.jpg" alt=""><?php print($activities); ?></a>
                <!--<li><a href="#" class="btn btn-orange btn-lg" id="packages"><img src="../../assets/images/pictures/city.jpg" alt=""><?php print($packages); ?></a>-->
                <li><a href="<?php print(base_url()."index.php/listview/index/5/-1/1/1/10/-1"); ?>" class="btn btn-orange btn-lg" id="must_try"><img src="../../assets/images/pictures/city.jpg" alt=""><?php print($must_try); ?></a>
            </ul>
        </section>
        <!-- Popular things to do-->
        <section class="section container" id="scontainer">
            <h2 class="section-title text-center hidden-xs"><?php print($popular_things_to_do);?></h2>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="<?php if(isset($popularthings[0]['link'])){print($popularthings[0]['link']);} ?>" class="tile">
                                <img src="../../assets/images/pictures/<?php if(isset($popularthings[0]['picturepath'])){print($popularthings[0]['picturepath']);}?>" alt="" class="tile-bg" />
                                <span class="tile-text"><?php if(isset($popularthings[0]['name'])){print($popularthings[0]['name']);}?></span>
                            </a>
                        </div>

                        <div class="col-xs-6">
                            <a href="<?php if(isset($popularthings[1]['link'])){print($popularthings[1]['link']);} ?>" class="tile">
                                <img src="../../assets/images/pictures/<?php if(isset($popularthings[1]['picturepath'])){print($popularthings[1]['picturepath']);}?>" alt="" class="tile-bg" />
                                <span class="tile-text"><?php if(isset($popularthings[1]['name'])){print($popularthings[1]['name']);}?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <a href="<?php if(isset($popularthings[2]['link'])){print($popularthings[2]['link']);} ?>" class="tile">
                        <img src="../../assets/images/pictures/<?php if(isset($popularthings[2]['picturepath'])){print($popularthings[2]['picturepath']);}?>" alt="" class="tile-bg" />
                        <span class="tile-text"><?php if(isset($popularthings[2]['name'])){print($popularthings[2]['name']);}?></span>
                    </a>
                </div>

                <div class="col-xs-6">
                    <a href="<?php if(isset($popularthings[3]['link'])){print($popularthings[3]['link']);} ?>" class="tile">
                        <img src="../../assets/images/pictures/<?php if(isset($popularthings[3]['picturepath'])){print($popularthings[3]['picturepath']);}?>" alt="" class="tile-bg" />
                        <span class="tile-text"><?php if(isset($popularthings[3]['name'])){print($popularthings[3]['name']);}?></span>
                    </a>
                </div>
            </div>
            <p class="text-center  xs-view-al">
                <a href="<?php print(base_url()."index.php/listview/index/1/1/1/10/-1"); ?>" class="btn btn-orange"><?php print($view_all);?><i class="fa fa-angle-right xs-chevron fa-lg" aria-hidden="true"></i></a>
            </p>
        </section>
        <!-- end of Popular things to do-->
        <!-- Top sightseeings-->
        
        <section class="section container" id="scontainer2">
            <h2 class="section-title text-center"><?php print($top_sightseeings);?></h2>

            <div class="owl-carousel box-carousel-noloop">
                <?php
                    if(isset($topsightseeings)){
                        for($i = 0; $i<count($topsightseeings); $i++){
                ?>
                <article class="media-box">
                    <figure class="media-box-pic">
                        <a href="http://citywander.website/index.php/promotiondetail/index/<?php print($topsightseeings[$i]["id"]); ?>"><img src="../../assets/images/pictures/city.jpg" alt="" /></a>
                    </figure>

                    <div class="media-box-content">
                        <p><?php print(sentencetruncate($topsightseeings[$i]["smalldescription"],50)); ?></p>

                        <div class="clearfix">
                            <input class="input-rating rating-loading" disabled="disabled" value="<?php print($topsightseeings[$i]["rate"]); ?>" />
                            <div class="rating-caption"><?php print($topsightseeings[$i]["countreflection"]); ?> reviews</div>
                        </div>
                    </div>
                </article>
                <?php
                        }
                    }                
                ?>
            </div>
            <p class="text-center xs-view-al">
                <a href="<?php print(base_url()."index.php/listview/index/14/1/1/10/-1"); ?>" class="btn btn-orange"><?php print($view_all);?><i class="fa fa-angle-right xs-chevron fa-lg" aria-hidden="true"></i></a>
            </p>
        </section>
        <!-- end of Top sightseeings-->
        <!--
        <section class="section container sm-something" id="scontainer3">
            <div class="row">
                <div class="col-xs-6">
                    <a href="" class="text-box bg-teal">
                        <img src="../../assets/images/pictures/city.jpg" alt="" class="tile-bg" />
                        <span class="text-box-inner"><?php print($i_want_something_else);?></span>
                    </a>
                </div>

                <div class="col-xs-6">
                    <a href="" class="text-box bg-teal">
                        <img src="../../assets/images/pictures/city.jpg" alt="" class="tile-bg" />
                        <span class="text-box-inner"><?php print($get_in_touch_budapest_assistant);?></span>
                    </a>
                </div>
            </div>
        </section>
        -->
        <section class="section container"  id="scontainer4">
            <h2 class="section-title text-center"><?php print($top_activities);?></h2>

            <div class="owl-carousel box-carousel-noloop">
                <?php
                    if(isset($topactivities)){
                        for($i = 0; $i<count($topactivities); $i++){
                ?>
                <article class="media-box">
                    <figure class="media-box-pic">
                        <a href="http://citywander.website/index.php/promotiondetail/index/<?php print($topactivities[$i]["id"]); ?>"><img src="../../assets/images/pictures/city.jpg" alt="" /></a>
                    </figure>

                    <div class="media-box-content">
                        <p><?php print(sentencetruncate($topactivities[$i]["smalldescription"],50)); ?></p>

                        <div class="clearfix">
                            <input class="input-rating rating-loading" disabled="disabled" value="<?php print($topactivities[$i]["rate"]); ?>" />
                            <div class="rating-caption"><?php print($topactivities[$i]["countreflection"]); ?> reviews</div>
                        </div>
                    </div>
                </article>
                <?php
                        }
                    }                
                ?>
            </div>

            <p class="text-center xs-view-al">
                <a href="" class="btn btn-orange"><?php print($view_all);?><i class="fa fa-angle-right xs-chevron fa-lg" aria-hidden="true"></i></a>
            </p>
        </section>
        <!-- footer -->
        <?php $this->load->view('footer');  ?>
        <!-- end of footer -->
        
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <!--<script src="assets/js/jquery.min.js"></script> -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/daterangepicker.js"></script>
        <script src="assets/js/bootstrap-select.min.js"></script>
        <script src="assets/js/star-rating.min.js"></script>


        <!-- JS script -->
        <script src="assets/js/mset.js"></script>
        <script src="assets/js/msearch.js"></script>
        <script src="assets/js/mlistview.js"></script>
        <script src="assets/js/script.js"></script>
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
                    $("#scontainer").unbind( "DOMNodeInserted" );
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