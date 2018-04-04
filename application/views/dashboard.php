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
        <link rel="stylesheet" href="assets/css/azm.css" />

        <link rel="stylesheet" href="assets/css/bootstrap-theme.css" />

        <!--[if lt IE 9]>
            <script src="js/html5shiv.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <?php
        $this->load->view('menu');
        ?>
        <div class="mobilMenu visible-xs">
            <i class="fa fa-chevron-left fa-lg arrow" aria-hidden="true"></i>
            <ul class="list-unstyled">
                <li><a href="#"><i class="fa fa-history fa-lg" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-heart fa-lg" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-user fa-lg" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-language fa-lg" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></a></li>
            </ul>
        </div>

        <section class="section container">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-tabs mt-30 light-teal-tab">
                        <li class="active"><a data-toggle="tab" href="#Home">Home</a></li>
                        <li><a data-toggle="tab" href="#Wishlist">Wishlist</a></li>
                        <li><a data-toggle="tab" href="#MyBookings">My Bookings</a></li>
                        <li><a data-toggle="tab" href="#MyTours">My Tours</a></li>
                        <li><a data-toggle="tab" href="#MyReviews">My Reviews</a></li>
                        <li><a data-toggle="tab" href="#MyOffers">My Offers</a></li>
                    </ul>
                    <div class="tab-content light-teal-tab-content box-shadow">
                        <div class="panel-body tab-pane fade in active" id="Home">
                            <ul class="nav nav-tabs line-tab">
                                <li class="active"><a data-toggle="tab" href="#Summary">Summary</a></li>
                                <li><a data-toggle="tab" href="#ContactInformation">Contact Information</a></li>
                                <li><a data-toggle="tab" href="#ChangePassword">Change Password</a></li>
                                <li><a data-toggle="tab" href="#Preferences">Preferences</a></li>
                            </ul>
                            <div class="tab-content line-tab-content">
                                <div class="panel-body tab-pane fade in active" id="Summary">
                                    <h2 class="relative">My Profile<span class="h-right"><a href="">Edit profile</a> | <a href="">View your public profile</a></span></h2>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <img src="../../assets/images/profile.jpg" alt="Profile Picture" class="profile-picture box-shadow">
                                            <a href="" class="img-link">Change my photo</a>
                                        </div>
                                        <div class="col-xs-9">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempor est augue, dignissim auctor enim condimentum ut. Morbi ultrices eu risus eget mattis. Etiam hendrerit suscipit diam, sit amet elementum metus lobortis semper. Donec porttitor felis quis dignissim posuere. Sed sagittis neque a nulla venenatis aliquet. Pellentesque at ultricies nulla. Morbi mattis nisl in eros commodo egestas. Donec dictum venenatis commodo. Suspendisse eu lectus neque. Mauris in imperdiet quam. Donec a scelerisque nunc.
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body tab-pane fade in" id="ContactInformation">
                                    <h2 class="relative">Contact Details<span class="h-right"><a href="">Edit my contact details</a></span></h2>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempor est augue, dignissim auctor enim condimentum ut. Morbi ultrices eu risus eget mattis. Etiam hendrerit suscipit diam, sit amet elementum metus lobortis semper. Donec porttitor felis quis dignissim posuere. Sed sagittis neque a nulla venenatis aliquet. Pellentesque at ultricies nulla. Morbi mattis nisl in eros commodo egestas. Donec dictum venenatis commodo. Suspendisse eu lectus neque. Mauris in imperdiet quam. Donec a scelerisque nunc.</p>
                                            <div><span class="highlight">First name:</span> Comelait</div>
                                            <div><span class="highlight">Last name:</span> R Planho</div>
                                            <div><span class="highlight">Email address:</span> crplanho@gmail.com</div>
                                            <div><span class="highlight">Alternate email address:</span> </div>
                                            <div><span class="highlight">Phone number:</span> </div>
                                        </div>
                                    </div>
                                    <h2 class="relative">Booking Details<span class="h-right"><a href="">Edit my booking details</a></span></h2>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempor est augue, dignissim auctor enim condimentum ut. Morbi ultrices eu risus eget mattis. Etiam hendrerit suscipit diam, sit amet elementum metus lobortis semper. Donec porttitor felis quis dignissim posuere. Sed sagittis neque a nulla venenatis aliquet. Pellentesque at ultricies nulla. Morbi mattis nisl in eros commodo egestas. Donec dictum venenatis commodo. Suspendisse eu lectus neque. Mauris in imperdiet quam. Donec a scelerisque nunc.</p>
                                            <div><span class="highlight">Billing address (Line 1):</span> </div>
                                            <div><span class="highlight">Billing address (Line 2):</span> </div>
                                            <div><span class="highlight">City:</span> </div>
                                            <div><span class="highlight">Country:</span> </div>
                                            <div><span class="highlight">Province/State/County:</span> </div>
                                            <div><span class="highlight">Postcode/ZIP:</span> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body tab-pane fade in" id="ChangePassword">
                                    <h2 class="relative">Change Password</h2>
                                    <p>Passwords must be at least 6 characters long. Forgot your old password? <a href="">Click here</a> and we will resend it to your confirmed email address.</p>
                                    <form method="post" action="">
                                        <div class="form-group">
                                            <label>New password</label>
                                            <input type="password" name="" value="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm new password</label>
                                            <input type="password" name="" value="" class="form-control">
                                        </div>
                                        <input type="submit" name="" value="Save" class="btn btn-teal">
                                    </form>
                                </div>
                                <div class="panel-body tab-pane fade in" id="Preferences">
                                    <h2 class="relative">Facebook Sharing Options</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempor est augue, dignissim auctor enim condimentum ut. Morbi ultrices eu risus eget mattis. Etiam hendrerit suscipit diam, sit amet elementum metus lobortis semper. Donec porttitor felis quis dignissim posuere. Sed sagittis neque a nulla venenatis aliquet. Pellentesque at ultricies nulla. Morbi mattis nisl in eros commodo egestas. Donec dictum venenatis commodo. Suspendisse eu lectus neque. Mauris in imperdiet quam. Donec a scelerisque nunc.</p>
                                    <a href="#" class="btn btn-facebook2 btn-facebook-border litle-radius"><i class="fa fa-facebook fa-lg fa-padding"><span></span></i> Connect with Facebook</a>
                                    <h2 class="relative mt-15">Google+ Account Options</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempor est augue, dignissim auctor enim condimentum ut. Morbi ultrices eu risus eget mattis. Etiam hendrerit suscipit diam, sit amet elementum metus lobortis semper. Donec porttitor felis quis dignissim posuere. Sed sagittis neque a nulla venenatis aliquet. Pellentesque at ultricies nulla. Morbi mattis nisl in eros commodo egestas. Donec dictum venenatis commodo. Suspendisse eu lectus neque. Mauris in imperdiet quam. Donec a scelerisque nunc.</p>
                                    <a href="#" class="btn btn-google2 litle-radius"><i class="fa fa-google-plus fa-lg fa-padding"><span></span></i> Connect with Google+</a>
                                    <h2 class="relative mt-15">My Communication Preferences</h2>
                                    <div><span class="highlight">Email address:</span> crplanho@gmail.com | <a href="">Change my email address</a></div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempor est augue, dignissim auctor enim condimentum ut. Morbi ultrices eu risus eget mattis. Etiam hendrerit suscipit diam, sit amet elementum metus lobortis semper. Donec porttitor felis quis dignissim posuere. Sed sagittis neque a nulla venenatis aliquet. Pellentesque at ultricies nulla. Morbi mattis nisl in eros commodo egestas. Donec dictum venenatis commodo. Suspendisse eu lectus neque. Mauris in imperdiet quam. Donec a scelerisque nunc.</p>
                                    <form method="post" action="">
                                        <ul class="checkbox-list">
                                            <li>
                                                <input class="form-check-input" type="checkbox" value="" id="Check1">
                                                <label for="Check1">
                                                    <span class="highlight">Newsletters, Deals & Alerts</span><br>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempor est augue, dignissim auctor enim condimentum ut. Morbi ultrices eu risus eget mattis. Etiam hendrerit suscipit diam, sit amet elementum metus lobortis semper. Donec porttitor felis quis dignissim posuere. Sed sagittis neque a nulla venenatis aliquet. Pellentesque at ultricies nulla. Morbi mattis nisl in eros commodo egestas. Donec dictum venenatis commodo. Suspendisse eu lectus neque. Mauris in imperdiet quam. Donec a scelerisque nunc.
                                                </label>
                                            </li>
                                            <li>
                                                <input class="form-check-input" type="checkbox" value="" id="Check1">
                                                <label for="Check1">
                                                    <span class="highlight">Newsletters, Deals & Alerts</span><br>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempor est augue, dignissim auctor enim condimentum ut. Morbi ultrices eu risus eget mattis. Etiam hendrerit suscipit diam, sit amet elementum metus lobortis semper. Donec porttitor felis quis dignissim posuere. Sed sagittis neque a nulla venenatis aliquet. Pellentesque at ultricies nulla. Morbi mattis nisl in eros commodo egestas. Donec dictum venenatis commodo. Suspendisse eu lectus neque. Mauris in imperdiet quam. Donec a scelerisque nunc.
                                                </label>
                                            </li>
                                            <li>
                                                <input class="form-check-input" type="checkbox" value="" id="Check1">
                                                <label for="Check1">
                                                    <span class="highlight">Newsletters, Deals & Alerts</span><br>
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas tempor est augue, dignissim auctor enim condimentum ut. Morbi ultrices eu risus eget mattis. Etiam hendrerit suscipit diam, sit amet elementum metus lobortis semper. Donec porttitor felis quis dignissim posuere. Sed sagittis neque a nulla venenatis aliquet. Pellentesque at ultricies nulla. Morbi mattis nisl in eros commodo egestas. Donec dictum venenatis commodo. Suspendisse eu lectus neque. Mauris in imperdiet quam. Donec a scelerisque nunc.
                                                </label>
                                            </li>
                                        </ul>
                                        <input type="submit" name="" value="Save" class="btn btn-teal">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body tab-pane fade in" id="Wishlist">
                            <h2 class="relative">1 Items in My Wishlist</h2>
                            <!-- Asztali nézet -->
                            <a href="" class="hidden-xs wishlist-send-friend">
                                <i class="fa fa-envelope" aria-hidden="true"></i> Email wishlist to a friend
                            </a>
                            <a href="" class="row media-box media-box-horizontal relative hidden-xs">
                                <figure class="col-sm-3 col-xs-4 media-box-pic">
                                    <img src="../../assets/images/pictures/product2.jpg" alt="" />
                                    <div href="#" class="media-box-like"><i class="cw-heart"></i></div>
                                </figure>
                                <div class="col-sm-7 col-xs-8 media-box-content">
                                    <h3 class="media-box-title">Budapest Castle Tour</h3>
                                    <p class="hidden-xs">In the heart of the city accessible on foot to all ages The Free Budapest Walking Tour is a good way to see many of the cities famous lan...</p>
                                    <div class="rating">
                                        <input class="input-rating rating-loading" disabled="disabled" value="3.5" />
                                        <div class="rating-caption">10 reviews</div>
                                    </div>
                                </div>
                                <div class="media-box-price"><span>from</span><br>USD 43.99</div>
                                <i class="fa fa-shopping-cart media-box-horizontal-cart" aria-hidden="true"></i>
                            </a>
                            <a href="" class="hidden-xs wishlist-send-friend">
                                <i class="fa fa-envelope" aria-hidden="true"></i> Email wishlist to a friend
                            </a>
                            <a href="" class="row media-box media-box-horizontal relative hidden-xs">
                                <figure class="col-sm-3 col-xs-4 media-box-pic">
                                    <img src="../../assets/images/pictures/product2.jpg" alt="" />
                                    <div href="#" class="media-box-like"><i class="cw-heart"></i></div>
                                </figure>
                                <div class="col-sm-7 col-xs-8 media-box-content">
                                    <h3 class="media-box-title">Budapest Castle Tour</h3>
                                    <p class="hidden-xs">In the heart of the city accessible on foot to all ages The Free Budapest Walking Tour is a good way to see many of the cities famous lan...</p>
                                    <div class="rating">
                                        <input class="input-rating rating-loading" disabled="disabled" value="3.5" />
                                        <div class="rating-caption">10 reviews</div>
                                    </div>
                                </div>
                                <div class="media-box-price"><span>from</span><br>USD 43.99</div>
                                <i class="fa fa-shopping-cart media-box-horizontal-cart" aria-hidden="true"></i>
                            </a>
                            <!-- Asztali nézet vége -->
                            <!-- Mobil nézet -->
                            <div class="row hidden visible-xs">
                                <div class="col-sm-3 col-xs-6">
                                    <a href="" class="media-box box-shadow block box-shadow-none-xs">
                                        <figure class="media-box-pic">
                                            <div><img src="../../assets/images/pictures/product3.jpg" alt="" /></div>
                                            <div href="#" class="media-box-like"><i class="cw-heart"></i></div>
                                        </figure>
                                        <div class="media-box-content">
                                            <p class="media-box-hover">Budapest Caste Tour in the heart of the city accessible on foot to all ages...</p>
                                            <div class="clearfix">
                                                <input class="input-rating rating-loading" disabled="disabled" value="3.5" />
                                                <div class="rating-caption">10 reviews</div>
                                            </div>
                                            <div class="media-box-price price-t"><span>from</span> USD 43.99</div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <a href="" class="media-box box-shadow block box-shadow-none-xs">
                                        <figure class="media-box-pic">
                                            <div><img src="../../assets/images/pictures/product3.jpg" alt="" /></div>
                                            <div href="#" class="media-box-like"><i class="cw-heart"></i></div>
                                        </figure>
                                        <div class="media-box-content">
                                            <p class="media-box-hover">Budapest Caste Tour in the heart of the city accessible on foot to all ages...</p>
                                            <div class="clearfix">
                                                <input class="input-rating rating-loading" disabled="disabled" value="3.5" />
                                                <div class="rating-caption">10 reviews</div>
                                            </div>
                                            <div class="media-box-price price-t"><span>from</span> USD 43.99</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <!-- Mobil nézet vége -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer">
            <div class="footer-area">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3 col-xs-8 col-xs-offset-2">
                            <ul class="list-unstyled select-footer">
                                <li class="dropdown lang">
                                    <select class="selectpicker">
                                        <option>EN</option>
                                        <option>HUN</option>
                                    </select>
                                </li>
                            </ul>
                            <ul class="list-unstyled select-footer">
                                <li class="dropdown">
                                    <select class="selectpicker">
                                        <option>US$</option>
                                        <option>EUR</option>
                                        <option>HUF</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-3 col-xs-6 text-left-xs">
                            <span class="title-footer">CityWander Company</span>
                            <ul class="list-unstyled">
                                <li><a href="">About us</a></li>
                                <li><a href="">Why Work With Us</a></li>
                                <li><a href="">New Suppliers</a></li>
                                <li><a href="">Travel Agents</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-3 col-xs-6 text-left-xs">
                            <span class="title-footer">Customers Info</span>
                            <ul class="list-unstyled">
                                <li><a href="">Help desk</a></li>
                                <li><a href="">FAQ</a></li>
                                <li><a href="">Groups services</a></li>
                                <li><a href="">Terms &amp; Conditions</a></li>
                                <li><a href="">Privacy Policy</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <span class="title-footer">Connect with us</span>
                            <ul class="list-unstyled">
                                <li><a href=""><i class="fa fa-instagram fa-3x" aria-hidden="true"></i></a></li>
                                <li><a href=""><i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row footer-row">
                    <div class="col-sm-5 sm-copy">
                        <p>Copyright 2017 &copy; CityWander Hungary</p>
                    </div>
                </div>
            </div>
        </footer>

        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/daterangepicker.js"></script>
        <script src="assets/js/bootstrap-select.min.js"></script>
        <script src="assets/js/star-rating.min.js"></script>

        <!-- JS script -->
        <script src="assets/js/script.js"></script>
    </body>
</html>