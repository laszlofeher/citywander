<!--
<footer class="footer">
    <div class="footer-area">
        <div class="container"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <p>Copyright 2017 &copy; CityWander Hungary</p>
            </div>

            <div class="col-sm-7">
                <ul class="footer-nav">
                    <li><a href="http://citywander.website/index.php/page/index/_terms_and_conditions"><?php print($term_conditions); ?></a></li>
                    <li><a href="http://citywander.website/index.php/page/index/_faq"><?php print($faq); ?></a></li>
                    <li><a href="http://citywander.website/index.php/page/index/_legal"><?php print($legal); ?></a></li>
                    <li><a href="http://citywander.website/index.php/page/index/_contact"><?php print($contact); ?></a></li>
                    <li><a href="http://citywander.website/index.php/page/index/_sitemap"><?php print($sitemap); ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
-->
<footer class="footer">
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-xs-12">
                    <ul class="list-unstyled select-footer">
                        <li class="dropdown lang">
                            <select class="selectpicker"  id="languageselect1">
                                <option value="hu" <?php if($lang == 'hu'){print('selected');} ?>>Hungarian</option>
                                <option value="en" <?php if($lang == 'en'){print('selected');} ?>>English</option>
                                <option value="de" <?php if($lang == 'de'){print('selected');} ?>>Deutsch</option>
                            </select>
                        </li>
                    </ul>
                    <ul class="list-unstyled select-footer">
                        <li class="dropdown">
                            <select class="selectpicker"  id="currency1">
                                <option  value="HUF" <?php if($currency == 'HUF'){print('selected');} ?>>HUF</option>
                                <option  value="USD" <?php if($currency == 'USD'){print('selected');} ?>>USD</option>
                                <option  value="EUR" <?php if($currency == 'EUR'){print('selected');} ?>>EUR</option>
                            </select>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-3 col-xs-6 text-left-xs">
                    <span class="title-footer">CityWander Company</span>
                    <ul class="list-unstyled">
                        <li><a href="index.php/page/aboutus">About us</a></li>
                        <li><a href="index.php/page/whyworkwithus">Why Work With Us</a></li>
                        <li><a href="index.php/page/newsuppliers">New Suppliers</a></li>
                        <li><a href="index.php/page/travelagents">Travel Agents</a></li>
                    </ul>
                </div>
                <div class="col-sm-3 col-xs-6 text-left-xs">
                    <span class="title-footer">Customers Info</span>
                    <ul class="list-unstyled">
                        <li><a href="index.php/page/helpdesk">Help desk</a></li>
                        <li><a href="index.php/page/faq">FAQ</a></li>
                        <li><a href="index.php/page/groupsservices">Groups services</a></li>
                        <li><a href="index.php/page/termsconditions">Terms &amp; Conditions</a></li>
                        <li><a href="index.php/page/privacypolicy">Privacy Policy</a></li>
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

            <div class="col-sm-7 sm-term">
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