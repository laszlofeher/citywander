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
            <li><a href="">Review order</a></li>
            <li class="active">Secure Checkout</li>
            <li>Print vouchers</li>
        </ul>

        <section class="section container checkout">
            <form method="POST" action="index.php/checkout" >
                <?php echo validation_errors(); ?>
                <div class="col-xs-12 border-green-2 price-holder">
                    <div class="row">
                        <div class="col-md-8 col-xs-21">
                            <div class="title-text">Secure checkout</div>
                            <div>Items in cart: <?php print($count); ?></div>
                        </div>
                        <div class="col-md-4 col-xs-12 total text-right">
                            Current cart total USD ($)<br>
                            <span class="price"><?php print(number_format($sum, 2, ',', ' ') . ' ' . $currency['symbol']); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 dark-teal-header">
                    Activity Info
                </div>
                <div class="col-xs-12 light-teal-row text-right">
                    Review your complete itinerary detail
                </div>
                <div class="col-xs-12 box-shadow content">
                    <div class="row product-head">
                        <div class="col-md-3 col-xs-12 datetime">
                            <span>04 MON</span>
                            <span>SEPT 2017</span>
                        </div>
                        <div class="col-md-9 col-xs-12">
                            <span class="product-name">Big Bus Pop-On Hop-Off Tour</span><br>
                            2 Day Premium Ticket
                        </div>
                    </div>
                    <div class="row equalizer-row eq-center mt-15 form-checkout">
                        <div class="col-md-3 col-xs-12 fw-normal">
                            Lead Traveler (Adult)
                        </div>
                        <div class="col-md-9 csol-xs-12">
                            <input type="text" name="leadtravelerfirstname" value="" placeholder="First/Given Name" class="i-text">
                            <input type="text" name="leadtravelerlastname" value="" placeholder="Last/Family Name" class="i-text">
                        </div>
                    </div>
                    <div class="row equalizer-row eq-center mt-15 form-checkout">
                        <div class="col-md-3 col-xs-12 fw-normal">
                            Traveler 2 (Adult)
                        </div>
                        <div class="col-md-9 csol-xs-12">
                            <input type="text" name="leadtravelerfirstname2" value="" placeholder="First/Given Name" class="i-text">
                            <input type="text" name="leadtravelerlastname2" value="" placeholder="Last/Family Name" class="i-text">
                        </div>
                    </div>
                    <div class="row equalizer-row eq-center mt-15 form-checkout">
                        <div class="col-md-3 col-xs-12 fw-normal">
                            Tour/Activity Language
                        </div>
                        <div class="col-md-9 csol-xs-12">
                            <select class="selectpicker">
                                <option>Hungarian</option>
                                <option>English</option>
                            </select>
                        </div>
                    </div>
                    <div class="row equalizer-row eq-center mt-15 form-checkout">
                        <div class="col-md-3 col-xs-12 fw-normal">
                            Special requirements
                        </div>
                        <div class="col-md-9 col-xs-12">
                            <a href="" id="open-note">Add an optional note for the tour provider</a>
                        </div>
                    </div>
                    <div class="row equalizer-row eq-center mt-15 toggle-hide form-checkout" id="toggle-note">
                        <div class="col-md-3 col-xs-12 fw-normal">
                            Note
                        </div>
                        <div class="col-md-9 col-xs-12">
                            <textarea name="" class="i-text"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 dark-teal-header">
                    Contact Info
                </div>
                <div class="col-xs-12 box-shadow content">
                    <div class="row form-group">
                        <div class="col-sm-4 col-xs-12">
                            <label>First name (*)</label>
                            <input type="text" name="firstname" value="<?php if($loggedin && isset($firstname)){print($firstname);}  ?>" placeholder="First/Given Name" class="i-text-max">
                        </div>
                        <div class="col-sm-4 col-xs-12 xs-mt-15">
                            <label>Last name (*)</label>
                            <input type="text" name="lastname" value="<?php if($loggedin && isset($lastname)){print($lastname);}  ?>" placeholder="Last/Family Name" class="i-text-max">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 col-xs-12 max">
                            <label>Country (*)</label>
                            <select class="selectpicker">
                                <option value="">Hungary</option>
                            </select>
                        </div>
                        <div class="col-sm-4 col-xs-12 xs-mt-15">
                            <label>Mobile (*)</label>
                            <input type="text" name="mobile" value="<?php if($loggedin && isset($mobile)){print($mobile);}  ?>" placeholder="Mobile" class="i-text-max">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-4 col-xs-12">
                            <label>Email (*)</label>
                            <input type="email" id="email" name="email" value="<?php if($loggedin && isset($email)){print($email);}  ?>" placeholder="Email" class="i-text-max">
                        </div>
                        <div class="col-sm-4 col-xs-12 xs-mt-15">
                            <label>Confirm email (*)</label>
                            <input type="email" name="confirmemail" value="" placeholder="Confirm email" class="i-text-max">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 dark-teal-header">
                    Payment Info
                </div>
                <div class="col-xs-12 box-shadow content">
                    <div class="row check-group">
                        <div class="col-xs-12 form-check">
                            <label>
                                <input name="pay" type="radio" value="paypal">
                                <span class="label-text"><i class="fa fa-cc-paypal fa-2x" aria-hidden="true"></i></span>
                            </label>
                        </div>
                        <div class="col-xs-12 form-check">
                            <label>
                                <input name="pay" type="radio" value="bank">
                                <span class="label-text">
                                    <i class="fa fa-cc-visa fa-2x" aria-hidden="true"></i>
                                    <i class="fa fa-cc-mastercard fa-2x" aria-hidden="true"></i>
                                    <i class="fa fa-cc-amex fa-2x" aria-hidden="true"></i>
                                    <i class="fa fa-cc-discover fa-2x" aria-hidden="true"></i>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <i class="fa fa-lock" aria-hidden="true"></i> <span class="color-teal">Your payment details are secure.</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <input type="submit" name="" value="Proceed to payment" class="btn btn-orange btn-lg">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 box-shadow content mt-15">
                    <div class="col-xs-12 bg-light-teal content">
                        <b>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</b>
                        <ul class="">
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                            <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                        </ul>
                    </div>
                </div>
            </form>
        </section>
        <!-- footer -->
        <?php $this->load->view('footer'); ?>
        <!-- end of footer-->
        <!--  login modal -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"  id="loginModal" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="text-center">
                            <h3><i class="fa fa-user-circle fa-4x"></i></h3>
                            <h2 class="text-center">Login</h2>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form role="form" autocomplete="off" class="login" method="post" action="login">
                            <div class="form-group">
                                <label for="frmEmail">Email:</label>
                                <input type="text" class="form-control" id="frmEmail" name="emailaddress" value="" placeholder="Type in your email address...">
                            </div>
                            <div class="form-group">
                                <label for="frmPassword">Password:</label>
                                <input type="password" class="form-control" id="frmPassword" name="password" placeholder="Type in your password...">
                                <a href="http://citywander.website/index.php/forgotpassword" class="color-black">Forgot the password?</a>
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LcwiEAUAAAAABqR4tek9jkZKy2x99Xq2DI4iDwF"><div style="width: 304px; height: 78px;"><div><iframe src="https://www.google.com/recaptcha/api2/anchor?k=6LcwiEAUAAAAABqR4tek9jkZKy2x99Xq2DI4iDwF&amp;co=aHR0cDovL2NpdHl3YW5kZXIud2Vic2l0ZTo4MA..&amp;hl=en&amp;v=v1522045847408&amp;size=normal&amp;cb=lx4gubc8dg4j" width="304" height="78" role="presentation" frameborder="0" scrolling="no" sandbox="allow-forms allow-popups allow-same-origin allow-scripts allow-top-navigation allow-modals allow-popups-to-escape-sandbox"></iframe></div><textarea id="g-recaptcha-response" name="g-recaptcha-response" class="g-recaptcha-response" style="width: 250px; height: 40px; border: 1px solid #c1c1c1; margin: 10px 25px; padding: 0px; resize: none;  display: none; "></textarea></div></div>
                            </div>
                            <div class="form-group">
                                <input name="send" class="btn btn-lg btn-orange btn-block" value="Sign in" type="submit">
                            </div>
                            <a href="https://www.facebook.com/v2.10/dialog/oauth?client_id=1577963905625109&amp;redirect_uri=http%3A%2F%2Fcitywander.website%2Findex.php%2Flogin%2Ffacebooklogin&amp;auth_type=rerequest&amp;scope=email" class="btn btn-lg btn-block btn-facebook"><i class="fa fa-facebook-square fa-lg" aria-hidden="true"></i> Sign in with Facebook</a>
                            <a href="https://accounts.google.com/o/oauth2/auth?response_type=code&amp;redirect_uri=http%3A%2F%2Fcitywander.website%2Findex.php%2Flogin%2Fgooglelogin&amp;client_id=862983035776-v9u2l3in0ort22mbvolhd614arrm0s7g.apps.googleusercontent.com&amp;scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email&amp;access_type=online&amp;approval_prompt=auto" class="btn btn-block btn-lg btn-social btn-google"><i class="fa fa-google-plus"></i> Sign in with Google</a>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--  end of login modal -->

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
            $('#email').focusout(function () {
                $.post("index.php/checkout/checkEmail", {email: $('#email').val()})
                        .done(function (data) {
                            if (data == 'exist_email') {
                                $('#loginModal').modal('show');
                            } else if (data == 'not_exist_email') {

                            }
                        });
            });
        </script>
    </body>
</html>