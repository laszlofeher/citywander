<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>CityWander</title>
        <base href="<?php print(base_url()); ?>">
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
        <ul class="container breadcrumb">
            <li><a href="">Home</a></li>
            <li><a href="">Hungary</a></li>
            <li><a href="">Budapest</a></li>
            <li><a href="">Top Activities</a></li>
            <li>Danube Cruise</li>
        </ul>

        <section class="section container">
            <div class="row">
                <!-- filter -->
                <?php $this->load->view("filter"); ?>
                <!-- end of filter -->

                <section class="col-md-9">
                    <h1 class="section-title"><?php print($promotiondetail['promotion_name']); ?></h1>

                    <div class="row mb-15">
                        <div class="col-md-8 col-xs-12">
                            <div class="col-xs-12 product-social">
                                <div class="pull-left">
                                    <?php print($share); ?>
                                    <a href="" class="fa-stack">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                    </a>
                                    <a href="" class="fa-stack">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                    </a>
                                    <a href="" class="fa-stack">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-instagram fa-stack-1x fa-inverse"></i>
                                    </a>
                                </div>
                                <ul class="ps-list pull-right">
                                    <li>
                                        <a href="">
                                            <span  class="fa-stack">
                                                <i class="fa fa-print fa-stack-2x"></i>
                                            </span>
                                            <?php print($print); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <span  class="fa-stack">
                                                <i class="fa fa-share-square-o fa-stack-2x"></i>
                                            </span>
                                            <?php print($share_with_friend); ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 col-xs-12">
                            <div class="product-carousel-holder">
                                <div class="owl-carousel product-slide" data-slider-id="1">
                                    <div class="item">
                                        <img src="<?php print(base_url()); ?>assets/images/pictures/product.jpg" alt="">
                                    </div>
                                    <div class="item">
                                        <img src="<?php print(base_url()); ?>assets/images/pictures/product.jpg" alt="">
                                    </div>
                                </div>
                                <a href="#" class="next">
                                    <i class="fa fa-chevron-circle-left fa-3x" aria-hidden="true"></i>
                                </a>
                                <a href="#" class="prev">
                                    <i class="fa fa-chevron-circle-right fa-3x" aria-hidden="true"></i>
                                </a>
                            </div>

                            <ul class="nav nav-tabs nav-justified mt-30 product-tab">
                                <li class="active"><a data-toggle="tab" href="#overview"><?php print($overview); ?></a></li>
                                <li><a data-toggle="tab" href="#important"><?php print($important); ?></a></li>
                                <li><a data-toggle="tab" href="#reviews"><?php print($reviews); ?></a></li>
                            </ul>
                            <div class="tab-content product-tab-content">
                                <div class="panel-body tab-pane fade in active" id="overview">
                                    <h4 class="text-uppercase">Highlights1</h4>
                                    <?php print($promotiondetail['smalldescription']); ?>
                                </div>
                                <div class="panel-body tab-pane fade" id="important">
                                    <h4 class="text-uppercase">Highlights2</h4>
                                    <?php print($promotiondetail['description']); ?>
                                </div>
                                <div class="panel-body tab-pane fade" id="reviews">
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="rating-content col-xs-12">
                                                <h4 class="text-uppercase"><?php print($viewing_all); ?> <?php print(count($promotiondetail['reflections'])); ?> <?php print($reviews); ?></h4>

                                                <ul class="paginate">
                                                    <li><a href="">Previous</a></li>
                                                    <li><a href="">1</a></li>
                                                    <li><a href="">2</a></li>
                                                    <li class="active"><a href="">3</a></li>
                                                    <li><a href="">4</a></li>
                                                    <li><a href="">5</a></li>
                                                    <li>...</li>
                                                    <li><a href="">17</a></li>
                                                    <li><a href="">Next</a></li>
                                                </ul>
                                                <ul class="rating-list col-xs-12">
                                                    <?php
                                                        if(isset($promotiondetail['reflections'])){
                                                            for($i=0; $i<count($promotiondetail['reflections']); $i++){
                                                    ?>
                                                    
                                                    
                                                    <li class="row">
                                                        <div class="col-xs-2 text-center">
                                                            <i class="fa fa-user-circle-o fa-4x" aria-hidden="true"></i>
                                                        </div>
                                                        <div class="col-xs-10">
                                                            <div class="name"><?php print($promotiondetail['reflections'][$i]['firstname']." ".substr($promotiondetail['reflections'][$i]['lastname'],0,1)."."); ?></div>
                                                            <input class="input-rating rating-input" disabled="disabled" value="<?php print($promotiondetail['reflections'][$i]['rate']); ?>">
                                                            <div><?php print($promotiondetail['reflections'][$i]['day']." ".$promotiondetail['reflections'][$i]['month']); ?></div>
                                                            <div class="comment"><?php print($promotiondetail['reflections'][$i]['memo']); ?></div>
                                                        </div>
                                                    </li>
                                                    <?php
                                                            }
                                                        }
                                                    ?>
                                                    
                                                </ul>
                                                <ul class="paginate">
                                                    <li><a href="">Previous</a></li>
                                                    <li><a href="">1</a></li>
                                                    <li><a href="">2</a></li>
                                                    <li class="active"><a href="">3</a></li>
                                                    <li><a href="">4</a></li>
                                                    <li><a href="">5</a></li>
                                                    <li>...</li>
                                                    <li><a href="">17</a></li>
                                                    <li><a href="">Next</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <aside class="col-md-4">
                            <div class="col-xs-12 box-shadow sm-mt-15">
                                <div class="row product-price">
                                    From <span><?php print(number_format($promotiondetail['price'], 0, ' ', ' ') . ' ' . $currency['symbol']); ?></span><br> per person
                                </div>
                                <h4 class="form-title mt-15"><?php print($best_price_guaranted); ?></h4>
                                <a href="<?php print(base_url("index.php/activity/index/".$promotionid)); ?>" class="btn btn-orange btn-block btn-lg text-uppercase"><?php print($view_dates); ?></a>
                                <ul class="col-xs-12 like-container list-unstyled">
                                    <li>
                                        <input type="hidden" name="promotionid" id="promotionid" value="<?php print($promotiondetail["id"]); ?>" />
                                        <input type="hidden" name="onwishlist" id="onwishlist" value="<input type="hidden" name="onwishlist" id="onwishlist" value="<?php if($loggedin && $promotiondetail['wishlist_visitor_id'] == $visitor_id){print($promotiondetail["wishlist"]);}else{print('1');} ?>" />
                                        <a href="#" class="product-like"><i class="fa <?php if($loggedin && $promotiondetail['wishlist_visitor_id'] == $visitor_id){if($promotiondetail["wishlist"] == 2){ print('fa-heart');}else{print('fa-heart-o');}}else{print('fa-heart-o');} ?>"><span>Save to wishlist</span></i></a>
                                    </li>

                                    <?php if ($loggedin) { ?>
                                        <li>
                                            <a href="http://citywander.website/index.php/rating/index/<?php print($promotiondetail['id']);  ?>" class="product-rating"><i class="fa fa-star"></i> <span>Rating</span></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </aside>
                    </div>

                </section>

            </div>
        </section>

        <section class="section container">
            <h2 class="section-title">You Might Also Like...</h2>

            <div class="owl-carousel box-carousel">
                <article class="media-box">
                    <figure class="media-box-pic">
                        <a href=""><img src="<?php print(base_url()); ?>assets/images/pictures/city.jpg" alt="" /></a>
                    </figure>

                    <div class="media-box-content">
                        <p>Budapest Caste Tour in the heart of the city accessible on foot to all ages...</p>

                        <div class="clearfix">
                            <input class="input-rating rating-loading" disabled="disabled" value="3.5" />
                            <div class="rating-caption">10 reviews</div>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <!-- footer -->
        <?php $this->load->view('footer'); ?>
        <!-- end of footer -->

        <script src="<?php print(base_url()); ?>assets/js/jquery.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/owl.carousel.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/owl.carousel.thumbs.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/moment.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/daterangepicker.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/bootstrap-select.min.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/star-rating.min.js"></script>

        <!-- JS script -->
        <script src="<?php print(base_url()); ?>assets/js/mset.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/msearch.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/mlistview.js"></script>
        <script src="<?php print(base_url()); ?>assets/js/script.js"></script>
    </body>
</html>