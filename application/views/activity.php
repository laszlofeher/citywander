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
            <li><a href="">Top Activities</a></li>
            <li>Danube Cruise</li>
        </ul>

        <section class="section container">
            <div class="row">
                <!-- filter -->
                <?php $this->load->view("filter"); ?>
                <!-- end of filter -->

                <section class="col-md-9">
                    <div class="row">
                        <div class="col-md-8 col-xs-12 header-group">
                            <h1 class="section-title"><?php print($activity_options); ?></h1>
                            <span><?php print($select_dates_and_participants); ?></span>
                        </div>
                        <div class="col-md-4 col-xs-12">
                            <div class="pull-right social">
                                Share
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
                        </div>
                    </div>
                    <form action="<?php print(base_url("index.php/activity/add2cart")); ?>" method="post">
                        <div class="row">
                            <div class="col-md-8 col-xs-12 sm-mt-15">
                                <?php
                                if (isset($promotionoptions)) {
                                    for ($i = 0; $i < count($promotionoptions); $i++) {
                                        ?>
                                        <article class="row media-box media-box-horizontal box-shadow activityOptions">
                                            <input type="radio" name="promotion_option" value="<?php print($promotionoptions[$i]["promotionid"]); ?>" class="hidden">
                                            <div class="col-sm-5 col-xs-12 col-sm-push-7 activity-box-details">
                                                <div class="activity-box-price"><?php print($promotionoptions[$i]["optionprice"] . " " . $currency['symbol']); ?></div>
                                                <div class="text-center">
                                                    <span class="best-price">
                                                        <i class="fa fa-check-circle fa-2x"></i>
                                                        <span>Best price guaranted</span>
                                                    </span>
                                                    <!--<a href="" class="btn btn-orange mt-15">Add to cart</a>-->
                                                </div>
                                            </div>
                                            <div class="col-sm-7 col-xs-12 col-sm-pull-5 activity-box-content">
                                                <h3 class="media-box-title"><?php print($promotionoptions[$i]["optionname"]); ?></h3>
                                                <p>
                                                    <?php print($promotionoptions[$i]["optiondetail"]); ?>
                                                </p>
                                            </div>
                                        </article>
                                        <?php
                                    }
                                }
                                ?>
                            </div>

                            <aside class="col-md-4">
                                <div class="col-xs-12 box-shadow">

                                    <div class="row product-price">
                                        From <span><?php
                                            if (isset($promotionoptions[0]['price'])) {
                                                print($promotionoptions[0]['price']);
                                            }
                                            ?></span><br> per person
                                    </div>
                                    <div class="content-separator"></div>
                                    <span class="step-text">1. <?php print($choose_a_date); ?></span>
                                    <div class="row activity-select-group color-teal">
                                        <span class="col-xs-2"><i class="fa fa-calendar fa-2x" aria-hidden="true"></i></span>
                                        <span class="col-xs-4 days">
                                            <select class="selectpicker" id="days" name="date1">
                                                <?php
                                                for ($i = isset($startday) ? $startday : 1; $i <= 31; $i++) {
                                                    ?>
                                                    <option value="<?php print($i); ?>"><?php print($i); ?></option>
                                                    <?php
                                                }
                                                ?>

                                            </select>
                                        </span>
                                        <span class="col-xs-6 months">
                                            <select class="selectpicker" id="date2" name="date2">
                                                <?php
                                                $nowyear = (int) (new DateTime())->format('Y');
                                                $nowmonth = (int) (new DateTime())->format('n');
                                                //print("dfgds ".(new DateTime())->format('n'));
                                                $j = $nowmonth;
                                                for ($i = $nowmonth; $i < $nowmonth + 12; $i++) {
                                                    if ($j % 13 === 0) {
                                                        $j = 1;
                                                        $nowyear++;
                                                    }
                                                    ?>
                                                    <option value="<?php print($nowyear . "," . $j); ?>"><?php print($namesofmonth[$j] . " " . $nowyear); ?></option>
                                                    <?php
                                                    $j++;
                                                }
                                                ?>
                                            </select>
                                        </span>
                                    </div>
                                    <div class="content-separator"></div>
                                    <span class="step-text">2. <?php print($how_many_people); ?>?</span>
                                    <div class="activity-select-group">
                                        <div class="form-group">
                                            <label for="adult"><?php print($adults); ?></label>
                                            <select class="selectpicker" id="adult" name="adult">
                                                <option>0</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="chilrden"><?php print($chilrden); ?></label>
                                            <select class="selectpicker" id="chilrden" name="children">
                                                <option>0</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="infants"><?php print($infants); ?></label>
                                            <select class="selectpicker" id="infants" name="infants">
                                                <option>0</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="content-separator"></div>
                                    <span class="step-text">3. <?php print($check_availability); ?></span>
                                    
                                    <input type="submit" name="viewnow" id="viewnow" value="View now" class="btn btn-orange btn-lg btn-block mt-15">
                                    
                                </div>
                            </aside>
                        </div>
                        <!-- end of row -->
                    </form>
                </section>
            </div>
        </section>

        <nsection class="section container">
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
        <!-- footer -->
<?php $this->load->view('footer'); ?>
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
        <script>
            $('#date2').on('change', function (evt) {
                var value = $('#date2').val();
                $.post("<?php print(base_url("index.php/activity/getdayinmonth")); ?>", {year: value.substring(0, value.indexOf(',')), month: value.substring(value.indexOf(',') + 1, value.length)})
                        .done(function (data) {
                            for (i = 27; i <= 31; i++) {
                                $('#days  option[value=' + (i + 1) + ']').removeAttr("disabled");
                                /*if($('ul.dropdown-menu > li').data('original-index') == i){
                                 $('ul.dropdown-menu > li').attr('disabled','disabled');
                                 }*/
                            }
                            for (i = parseInt(data); i <= 31; i++) {
                                $('#days  option[value=' + (i + 1) + ']').attr('disabled', 'disabled');
                                /*if($('ul.dropdown-menu > li').data('original-index') == i){
                                 $('ul.dropdown-menu > li').attr('disabled','disabled');
                                 }*/
                            }
                            $('#days').selectpicker('destroy');
                            $('#days').selectpicker();
                        });
            });

            $('#viewnow').attr('disabled', 'disabled');

            $('#adult').on('change', function () {
                if ($('#adult').val() > 0) {
                    $('#viewnow').removeAttr('disabled');
                } else {
                    $('#viewnow').attr('disabled', 'disabled');
                }
            });


        </script>
    </body>
</html>