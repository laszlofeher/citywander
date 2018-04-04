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
        <!-- header -->
        <?php
        $this->load->view('header');
        ?>
        <!-- end of header -->	


        <ul class="container breadcrumb">
            <li><a href="">Home</a></li>
            <li><a href="">Hungary</a></li>
            <li><a href="">Budapest</a></li>
            <li><a href="">Top Activities</a></li>
            <li><a href="">Danube Cruise</a></li>
            <li>Rating</li>
        </ul>

        <section class="section container">
            <div class="row">
                <aside class="col-md-3">
                    <p class="visible-sm visible-xs">
                        <a href="#" class="btn btn-orange btn-block sb-filter-btn">Filter <i class="fa fa-angle-down"></i></a>
                    </p>

                    <form method="post" class="form-section box-shadow sb-filter">
                        <h4 class="form-title">Your search within Budapest</h4>

                        <div class="input-with-addon form-group">
                            <input type="text" class="form-control" placeholder="Search..." >
                            <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>

                        <hr />

                        <h5 class="form-subtitle">Categories</h5>

                        <ul class="form-list">
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
                        </ul>

                        <hr />

                        <h5 class="form-subtitle">Duration</h5>

                        <ul class="form-list">
                            <li><label><input type="checkbox" /> Up to 1 hour</label></li>
                            <li><label><input type="checkbox" /> 1 to 4 hour</label></li>
                            <li><label><input type="checkbox" /> 4 to 8 hour</label></li>
                            <li><label><input type="checkbox" /> Full day</label></li>
                        </ul>

                        <hr />

                        <h5 class="form-subtitle">Price range</h5>

                        <ul class="form-list">
                            <li><label><input type="checkbox" /> $$$</label></li>
                            <li><label><input type="checkbox" /> $$</label></li>
                            <li><label><input type="checkbox" /> $</label></li>
                        </ul>

                        <div class="text-center">
                            <button type="button" class="btn btn-orange">Clear filters</button>
                        </div>
                    </form>
                </aside>

                <section class="col-md-9">
                    <h1 class="section-title"><?php print($promotiondetail['promotion_name']); ?></h1>

                    <div class="row">
                        <div class="col-md-8 col-xs-12">
                            <div class="rating-content col-xs-12">
                                <h4 class="text-uppercase">Viewing All <?php print(count($promotiondetail['reflections'])); ?> Reviews</h4>
                                <div class="row">
                                    <?php
                                        if(isset($ratingthisvisitorthispromotion) && $ratingthisvisitorthispromotion == 0){
                                    ?>
                                    <form method="post" action="http://citywander.website/index.php/rating/index/<?php print($promotiondetail['id']); ?>" class="col-xs-12">
                                        <?php echo validation_errors(); ?>
                                        <input type="hidden" name="promotionid" id="promotionid" value="<?php print($promotiondetail['id']); ?>" />
                                        <div class="form-group">
                                            <label for="">Rating:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-star" aria-hidden="true"></i></span>
                                                <select class="form-control" name="rate" id="rate">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <?php echo form_error('rate', '<div class="color-red fg-error">','</div>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Comment:</label>
                                            <textarea name="memo" id="memo" class="form-control"></textarea>
                                            <?php echo form_error('memo', '<div class="color-red fg-error">','</div>'); ?>
                                            <?php if(isset($recaptchaerror)){print('<div class="color-red fg-error">recaptcha error</div>');} ?>
                                        </div>
                                        <div class="form-group">
                                            <div class="g-recaptcha" data-sitekey="6LcwiEAUAAAAABqR4tek9jkZKy2x99Xq2DI4iDwF"></div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-orange btn-block btn-lg text-uppercase">Save</button>
                                        </div>
                                        
                                    </form>
                                    <?php
                                        }else{
                                            print("Shon rating");
                                        }
                                    ?>
                                </div>
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
                                    if (isset($promotiondetail['reflections'])) {
                                        for ($i = 0; $i < count($promotiondetail['reflections']); $i++) {
                                            ?>


                                            <li class="row">
                                                <div class="col-xs-2 text-center">
                                                    <i class="fa fa-user-circle-o fa-4x" aria-hidden="true"></i>
                                                </div>
                                                <div class="col-xs-9">
                                                    <div class="name"><?php print($promotiondetail['reflections'][$i]['firstname'] . " " . substr($promotiondetail['reflections'][$i]['lastname'], 0, 1) . "."); ?></div>
                                                    <input class="input-rating rating-input" disabled="disabled" value="<?php print($promotiondetail['reflections'][$i]['rate']); ?>">
                                                    <div><?php print($promotiondetail['reflections'][$i]['day'] . " " . $promotiondetail['reflections'][$i]['month']); ?></div>
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

                        <aside class="col-md-4">
                            <div class="col-xs-12 box-shadow sm-mt-15">
                                <div class="row product-price">
                                    From <span>$129</span><br> per person
                                </div>
                                <h4 class="form-title mt-15">Best price guaranted</h4>
                                <a href="" class="btn btn-orange btn-block btn-lg text-uppercase">View dates</a>
                                <ul class="col-xs-12 like-container list-unstyled">
                                    <li>
                                        <a href="#" class="product-like"><i class="fa fa-heart-o"></i> <span>Save to wishlist</span></a>
                                    </li>
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

        <footer class="footer">
            <div class="footer-area">
                <div class="container">
                    <h4>Footer area</h4>

                    <p>Text...</p>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <p>Copyright 2017 &copy; CityWander Hungary</p>
                    </div>

                    <div class="col-sm-7">
                        <ul class="footer-nav">
                            <li><a href="">Term &amp; Conditions</a></li>
                            <li><a href="">FAQ</a></li>
                            <li><a href="">Legal</a></li>
                            <li><a href="">Contact</a></li>
                            <li><a href="">Sitemap</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/owl.carousel.thumbs.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/daterangepicker.js"></script>
        <script src="assets/js/bootstrap-select.min.js"></script>
        <script src="assets/js/star-rating.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <!-- JS script -->
        <script src="assets/js/script.js"></script>
    </body>
</html>