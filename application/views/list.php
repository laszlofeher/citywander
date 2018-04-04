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
                <!-- filter -->
                <?php $this->load->view("filter"); ?>
                <!-- end of filter -->
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
                                <select class="selectpicker" id="count1">
                                    <option value="15" <?php if(isset($itemcount) && $itemcount==15){ print('selected');}  ?>>15</option>
                                    <option value="30" <?php if(isset($itemcount) && $itemcount==30){ print('selected');}  ?>>30</option>
                                    <option value="50" <?php if(isset($itemcount) && $itemcount==50){ print('selected');}  ?>>összes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 text-right">
                            <div class="btn-radio">
                                <div class="box-filter-title"><?php print($view);  ?></div>
                                <div class="btn-group">
                                    <a href="<?php print($thumburl);  ?>" class="btn"><i class="fa fa-th"></i></a>
                                    <a href="<?php print($listurl);  ?>" class="btn active"><i class="fa fa-list"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- list view -->
                    <?php
                        if(isset($promotions)){
                            for($i=0;$i<count($promotions); $i++){
                    ?>
                    <a href="http://citywander.website/index.php/promotiondetail/index/<?php print($promotions[$i]["id"]); ?>" class="row media-box media-box-horizontal box-shadow relative hidden-xs">
                        <figure class="col-sm-3 col-xs-4 media-box-pic">
                            <img src="../../assets/images/pictures/<?php print($promotions[$i]["picture"]); ?>" alt="" />
                            <div href="#" class="media-box-like"><i class="cw-heart"></i></div>
                        </figure>
                        <div class="col-sm-7 col-xs-8 media-box-content">
                            <h3 class="media-box-title"><?php if(isset($searchtext)){print(markedsearchedtext($promotions[$i]["promotion_name"],$searchtext));}else{print($promotions[$i]["promotion_name"]);} ?></h3>
                            <p class="hidden-xs"><?php if(isset($searchtext)){print(markedsearchedtext(sentencetruncate($promotions[$i]["smalldescription"], 150),$searchtext));}else{print(sentencetruncate($promotions[$i]["smalldescription"], 150));} ?></p>
                            <div class="rating">
                                <input class="input-rating rating-loading" disabled="disabled" value="<?php print($promotions[$i]["rate"]); ?>" />
                                <div class="rating-caption"><?php print($promotions[$i]["countreflection"]); ?> reviews</div>
                            </div>
                        </div>
                        <div class="media-box-price"><span>from</span><br><?php print($promotions[$i]["currency"]." ". number_format($promotions[$i]["price"],0,' ',' ')); ?></div>
                        <i class="fa fa-shopping-cart media-box-horizontal-cart" aria-hidden="true"><!--<a href="<?php print(base_url("index.php/activity/index/".$promotions[$i]["id"])); ?>" ></a>--></i>
                        <input type="hidden" name="promotionid<?php print($i); ?>" id="promotionid<?php print($i); ?>" value="<?php print($promotions[$i]["id"]); ?>" />
                        <input type="hidden" name="onwishlist<?php print($i); ?>" id="onwishlist<?php print($i); ?>" value="<?php if($loggedin && $promotions[$i]['wishlist_visitor_id'] == $visitor_id){print($promotions[$i]["wishlist"]);}else{print('1');} ?>" />
                    </a>
                    <?php
                               }
                        }
                    ?>
                    <!-- list view -->
                    <!-- filter box --> 
                    <div class="row box-filter">
                        <!-- pager -->
                        <?php if(strlen($links) >0 ) {echo $links;}else{ print('<div class="col-sm-6 col-sm-push-3"><ul class="paginate"></ul></div>');} ?>
                        <!-- end of pager -->
                        <!-- sort by --> 
                        <div class="col-xs-6 col-sm-3 col-sm-pull-6">
                            <div class="input-group">
                                <select class="selectpicker" id="sortby2">
                                    <option value="-1"><?php print($sort_by);  ?></option>
                                    <option value="1" <?php if(isset($sorttype) && $sorttype==1){ print('selected');}  ?>><?php print($most_popular);  ?></option>
                                    <option value="2" <?php if(isset($sorttype) && $sorttype==2){ print('selected');}  ?>><?php print($lowest_price);  ?></option>
                                    <option value="3" <?php if(isset($sorttype) && $sorttype==3){ print('selected');}  ?>><?php print($highest_price);  ?></option>
                                    <option value="4" <?php if(isset($sorttype) && $sorttype==4){ print('selected');}  ?>><?php print($shortest_program);  ?></option>
                                    <option value="5" <?php if(isset($sorttype) && $sorttype==5){ print('selected');}  ?>><?php print($longest_program);  ?></option>
                                </select>
                                <select class="selectpicker" id="count2">
                                    <option value="15" <?php if(isset($itemcount) && $itemcount==15){ print('selected');}  ?>>15</option>
                                    <option value="30" <?php if(isset($itemcount) && $itemcount==30){ print('selected');}  ?>>30</option>
                                    <option value="50" <?php if(isset($itemcount) && $itemcount==50){ print('selected');}  ?>>50</option>
                                </select>
                            </div>
                        </div>
                        <!-- end of sort by -->
                        <!-- thumb or list -->
                        <div class="col-xs-6 col-sm-3 text-right">
                            <div class="btn-radio">
                                <div class="box-filter-title"><?php print($view);  ?></div>
                                <div class="btn-group">
                                    <a href="<?php print($thumburl);  ?>" class="btn"><i class="fa fa-th"></i></a>
                                    <a href="<?php print($listurl);  ?>" class="btn active"><i class="fa fa-list"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- end of thumb or list -->
                    </div>
                </section>
            </div>
        </section>
        <section class="section container">
            <h2 class="section-title">Might Interest You...</h2>
            <div class="owl-carousel box-carousel">
                <article class="media-box">
                    <figure class="media-box-pic">
                        <a href=""><img src="../../assets/images/pictures/city.jpg" alt="" /></a>
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
        <script>
            $("#clearfilter").on("click", function(){
                $('input:checkbox').removeAttr('checked');
                $.post("http://citywander.website/index.php/set/setFilterDefault/", { ok:'ok' })
                    .done(function (data) {
                        location.href = $('#reloadurl').val();
                    });
                
            });
            $("#duration1").on('change', function(){
                $.post("http://citywander.website/index.php/set/setDuration/", { duration1: $('#duration1').val(), duration2: $('#duration2').val(),duration3: $('#duration3').val(),duration4: $('#duration4').val() })
                    .done(function (data) {
                        location.href = $('#reloadurl').val();
                    });
            });
            $("#duration2").on('change', function(){
                $.post("http://citywander.website/index.php/set/setDuration/", { duration1: $('#duration1').val(), duration2: $('#duration2').val(),duration3: $('#duration3').val(),duration4: $('#duration4').val() })
                    .done(function (data) {
                        location.href = $('#reloadurl').val();
                    });
            });
            $("#duration3").on('change', function(){
                $.post("http://citywander.website/index.php/set/setDuration/", { duration1: $('#duration1').val(), duration2: $('#duration2').val(),duration3: $('#duration3').val(),duration4: $('#duration4').val() })
                    .done(function (data) {
                        location.href = $('#reloadurl').val();
                    });
            });
            $("#duration4").on('change', function(){
                $.post("http://citywander.website/index.php/set/setDuration/", { duration1: $('#duration1').val(), duration2: $('#duration2').val(),duration3: $('#duration3').val(),duration4: $('#duration4').val() })
                    .done(function (data) {
                        location.href = $('#reloadurl').val();
                    });
            });
            $("#daytime1").on('change', function(){
                $.post("http://citywander.website/index.php/set/setDayTime/", { daytime1: $('#daytime1').val(), daytime2: $('#daytime2').val(),daytime3: $('#daytime3').val(),daytime4: $('#daytime4').val(),daytime5: $('#daytime5').val() })
                    .done(function (data) {
                        location.href = $('#reloadurl').val();
                    });
            });
            $("#daytime2").on('change', function(){
                $.post("http://citywander.website/index.php/set/setDayTime/", { daytime1: $('#daytime1').val(), daytime2: $('#daytime2').val(),daytime3: $('#daytime3').val(),daytime4: $('#daytime4').val(),daytime5: $('#daytime5').val() })
                    .done(function (data) {
                        location.href = $('#reloadurl').val();
                    });
            });
            $("#daytime3").on('change', function(){
                $.post("http://citywander.website/index.php/set/setDayTime/", { daytime1: $('#daytime1').val(), daytime2: $('#daytime2').val(),daytime3: $('#daytime3').val(),daytime4: $('#daytime4').val(),daytime5: $('#daytime5').val() })
                    .done(function (data) {
                        location.href = $('#reloadurl').val();
                    });
            });
            $("#daytime4").on('change', function(){
                $.post("http://citywander.website/index.php/set/setDayTime/", { daytime1: $('#daytime1').val(), daytime2: $('#daytime2').val(),daytime3: $('#daytime3').val(),daytime4: $('#daytime4').val(),daytime5: $('#daytime5').val() })
                    .done(function (data) {
                        location.href = $('#reloadurl').val();
                    });
            });
            $("#daytime5").on('change', function(){
                $.post("http://citywander.website/index.php/set/setDayTime/", { daytime1: $('#daytime1').val(), daytime2: $('#daytime2').val(),daytime3: $('#daytime3').val(),daytime4: $('#daytime4').val(),daytime5: $('#daytime5').val() })
                    .done(function (data) {
                        location.href = $('#reloadurl').val();
                    });
            });
        </script>
        
        
        
    </body>
</html>