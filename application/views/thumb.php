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
            <li><a href="">Hungary</a></li>
            <li><a href="">Budapest</a></li>
            <li>Top Activities</li>
        </ul>

        <section class="section container">
            <div class="row">
                <aside class="col-md-3">
                    <p class="visible-sm visible-xs">
                        <a href="#" class="btn btn-teal btn-block sb-filter-btn">Filter <i class="fa fa-angle-down"></i></a>
                    </p>

                    <form method="post" class="form-section box-shadow sb-filter">
                        <h4 class="form-title"><?php print($your_search_within_budapest);  ?></h4>

                        <div class="input-with-addon form-group">
                            <input type="text" class="form-control" placeholder="Search..." >
                            <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>

                        <hr />

                        <h5 class="form-subtitle"><?php print($categories);  ?></h5>

                        <ul class="form-list">
                            <?php
                                if(isset($promotioncategory)){
                                    for($i=0;$i<count($promotioncategory); $i++){
                            ?>
                            <li><a href="<?php print(base_url('index.php/listview/1/1/1/15/-1')); ?>"><?php print($promotioncategory[$i]['name']); ?></a></li>
                            
                            <?php
                                    }
                                
                                }
                            ?>
                            
                            <!--
                            <li><a href="">All Activities</a></li>
                            <li><a href="">Top Activities</a></li>
                            <li><a href="">Tours &amp; Sightseeing</a></li>
                            <li><a href="#">Food, Wine &amp; Nightlife <i class="fa fa-angle-down form-list-toggle"></i></a>
                                <ul>
                                    <li><a href="">Restaurants</a></li>
                                    <li><a href="">Fine Dining</a></li>
                                    <li><a href="">Wine Tasting</a></li>
                                    <li><a href="">Clubs</a></li>
                                </ul>
                            </li>
                            <li><a href="">Day Tours &amp; Trips</a></li>
                            -->
                            
                        </ul>

                        <hr />

                        <h5 class="form-subtitle"><?php print($duration);  ?></h5>

                        <ul class="form-list">
                            <li><label><input type="checkbox" /><?php print($duration1);  ?></label></li>
                            <li><label><input type="checkbox" /><?php print($duration2);  ?></label></li>
                            <li><label><input type="checkbox" /><?php print($duration3);  ?></label></li>
                            <li><label><input type="checkbox" /><?php print($duration4);  ?></label></li>
                        </ul>

                        <hr />

                        <h5 class="form-subtitle"><?php print($price_range);  ?></h5>

                        <ul class="form-list">
                            <li><label><input type="checkbox" /> <?php  print('0 - '.number_format($pricemargin['_first'],0,',',' ')); ?></label></li>
                            <li><label><input type="checkbox" /> <?php  print(number_format($pricemargin['_first'],0,',',' ').' - '.number_format($pricemargin['_sec'],0,',',' ')); ?></label></li>
                            <li><label><input type="checkbox" /> <?php  print(number_format($pricemargin['_sec'],0,',',' ').' - '.number_format($pricemargin['_third'],0,',',' ')); ?></label></li>
                            <li><label><input type="checkbox" /> <?php  print(number_format($pricemargin['_third'],0,',',' ').' - '); ?></label></li>
        
                        </ul>
                        <hr />
                        <h5 class="form-subtitle"><?php print($date);  ?></h5>
                        <ul class="form-list">
                            <li><label><input type="checkbox" /> $$$</label></li>
                        </ul>
                        <hr />
                        <h5 class="form-subtitle"><?php print($daytime);  ?></h5>
                        <ul class="form-list">
                            <li><label><input type="checkbox" /><?php print($morning);  ?></label></li>
                            <li><label><input type="checkbox" /><?php print($during_the_day);  ?></label></li>
                            <li><label><input type="checkbox" /><?php print($afternoon);  ?></label></li>
                            <li><label><input type="checkbox" /><?php print($evening);  ?></label></li>
                            <li><label><input type="checkbox" /><?php print($night);  ?></label></li>
                        </ul>
                        <div class="text-center">
                            <button type="button" class="btn btn-orange"><?php print($clear_filters);  ?></button>
                        </div>
                    </form>
                </aside>

                <section class="col-md-9">
                    <h1 class="section-title"><?php  if(isset($sectiontitle)){print($sectiontitle);} ?></h1>

                    <div class="row box-filter">
                        <!-- pager -->
                        <?php if(strlen($links) >0 ) {echo $links;}else{ print('<div class="col-sm-6 col-sm-push-3"><ul class="paginate"></ul></div>');} ?>
                        <!-- end of pager -->

                        <div class="col-xs-6 col-sm-3 col-sm-pull-6">
                            <div class="input-group">
                                <select class="selectpicker" id="sortby1">
                                    <option value="-1"><?php print($sort_by);  ?></option>
                                    <option value="1" <?php if(isset($sorttype) && $sorttype==1){ print('selected');}  ?>><?php print($most_popular);  ?></option>
                                    <option value="2" <?php if(isset($sorttype) && $sorttype==2){ print('selected');}  ?>><?php print($lowest_price);  ?></option>
                                    <option value="3" <?php if(isset($sorttype) && $sorttype==3){ print('selected');}  ?>><?php print($highest_price);  ?></option>
                                    <option value="4" <?php if(isset($sorttype) && $sorttype==4){ print('selected');}  ?>><?php print($shortest_program);  ?></option>
                                    <option value="5" <?php if(isset($sorttype) && $sorttype==5){ print('selected');}  ?>><?php print($longest_program);  ?></option>
                                </select>
                                <select class="selectpicker"  id="count1">
                                    <option value="15" <?php if(isset($itemcount) && $itemcount==15){ print('selected');}  ?>>15</option>
                                    <option value="30" <?php if(isset($itemcount) && $itemcount==30){ print('selected');}  ?>>30</option>
                                    <option value="50" <?php if(isset($itemcount) && $itemcount==50){ print('selected');}  ?>>50</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-3 text-right">
                            <div class="btn-radio">
                                <div class="box-filter-title"><?php print($view);  ?></div>

                                <div class="btn-group">
                                    <a href="<?php print($thumburl);  ?>" class="btn active"><i class="fa fa-th"></i></a>
                                    <a href="<?php print($listurl);  ?>" class="btn"><i class="fa fa-list"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- list view -->
                    <?php
                        if(isset($promotions)){
                            for($i=0;$i<count($promotions); $i++){
                                if($i%5 == 0 &&  $i!= 0){
                    ?>
                    <div class="row">
                    <?php
                                }
                    ?>
                        <div class="col-sm-3 col-xs-6">
                            <a href="http://citywander.website/index.php/promotiondetail/index/<?php print($promotions[$i]["id"]); ?>" class="media-box box-shadow block box-shadow-none-xs">
                                <input type="hidden" name="promotionid<?php print($i); ?>" id="promotionid<?php print($i); ?>" value="<?php print($promotions[$i]["id"]); ?>" />
                                <input type="hidden" name="onwishlist<?php print($i); ?>" id="onwishlist<?php print($i); ?>" value="<?php if($loggedin && $promotions[$i]['wishlist_visitor_id'] == $visitor_id){print($promotions[$i]["wishlist"]);}else{print('1');} ?>" />
                                <figure class="media-box-pic">
                                    <div><img src="../../assets/images/pictures/product3.jpg" alt="" /></div>
                                    <div href="#" class="media-box-like"><i class="cw-heart"></i></div>
                                </figure>
                                <div class="media-box-content">
                                    <p class="media-box-hover"><?php print(sentencetruncate($promotions[$i]["smalldescription"],100)); ?></p>
                                    <div class="clearfix">
                                        <input class="input-rating rating-loading" disabled="disabled" value="<?php print($promotions[$i]["rate"]); ?>" />
                                        <div class="rating-caption"><?php print($promotions[$i]["countreflection"]); ?> reviews</div>
                                    </div>
                                    <div class="media-box-price price-t"><span>from</span><?php print($promotions[$i]["currency"]." ". number_format($promotions[$i]["price"],0,' ',' ')); ?></div>
                                </div>
                            </a>
                            <?php // if($loggedin && $promotions[$i]['wishlist_visitor_id'] == $visitor_id){if($promotions[$i]["wishlist"] == 2){ print('fa-heart');}else{print('fa-heart-o');}}else{print('fa-heart-o');} ?>
                        </div>
                    <?php
                            if($i%5 == 0 &&  $i!= 0){
                    ?>
                    </div>
                    <?php
                                    }
                               }
                        }
                    ?>
                    <div class="row box-filter">
                        <!-- pager -->
                        <?php if(strlen($links) >0 ) {echo $links;}else{ print('<div class="col-sm-6 col-sm-push-3"><ul class="paginate"></ul></div>');} ?>
                        <!-- end of pager -->

                        <div class="col-xs-6 col-sm-3 col-sm-pull-6">
                            <div class="input-group">
                                <select class="selectpicker" id="sortby1">
                                    <option value="-1"><?php print($sort_by);  ?></option>
                                    <option value="1" <?php if(isset($sorttype) && $sorttype==1){ print('selected');}  ?>><?php print($most_popular);  ?></option>
                                    <option value="2" <?php if(isset($sorttype) && $sorttype==2){ print('selected');}  ?>><?php print($lowest_price);  ?></option>
                                    <option value="3" <?php if(isset($sorttype) && $sorttype==3){ print('selected');}  ?>><?php print($highest_price);  ?></option>
                                    <option value="4" <?php if(isset($sorttype) && $sorttype==4){ print('selected');}  ?>><?php print($shortest_program);  ?></option>
                                    <option value="5" <?php if(isset($sorttype) && $sorttype==5){ print('selected');}  ?>><?php print($longest_program);  ?></option>
                                </select>
                                <select class="selectpicker"  id="count1">
                                    <option value="15" <?php if(isset($itemcount) && $itemcount==15){ print('selected');}  ?>>15</option>
                                    <option value="30" <?php if(isset($itemcount) && $itemcount==30){ print('selected');}  ?>>30</option>
                                    <option value="50" <?php if(isset($itemcount) && $itemcount==50){ print('selected');}  ?>>50</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-6 col-sm-3 text-right">
                            <div class="btn-radio">
                                <div class="box-filter-title"><?php print($view);  ?></div>

                                <div class="btn-group">
                                    <a href="<?php print($thumburl);  ?>" class="btn active"><i class="fa fa-th"></i></a>
                                    <a href="<?php print($listurl);  ?>" class="btn"><i class="fa fa-list"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <section class="section container">
            <h2 class="section-title"><?php print($might_interest_you);  ?></h2>

            <div class="owl-carousel box-carousel">
                <article class="media-box">
                    <figure class="media-box-pic">
                        <a href=""><img src="../../assets/images/pictures/city.jpg" alt="" /></a>
                    </figure>

                    <div class="media-box-content">
                        <p>fghgfghfghfgh ghfghfghfgf ghf ghf fghf ghgh fhg</p>
                        <div class="clearfix">
                            <input class="input-rating rating-loading" disabled="disabled" value="3.5" />
                            <div class="rating-caption">10 reviews</div>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <!-- footer -->
        <?php $this->load->view('footer');  ?>
        <!-- end of footer -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/daterangepicker.js"></script>
        <script src="assets/js/bootstrap-select.min.js"></script>
        <script src="assets/js/star-rating.min.js"></script>

        <!-- JS script -->
        <script src="assets/js/script.js"></script>
        <script src="assets/js/mset.js"></script>
    </body>
</html>