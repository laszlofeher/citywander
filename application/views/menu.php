<nav class="navbar navbar-fixed-top">
    <div class="container">
        <div id="navbar">
            <a href="<?php print(base_url()); ?>" class="logo pull-left hidden-sm hidden-xs"><img src="<?php print(base_url()); ?>assets/images/logo.png" alt="" /></a>
            <ul class="nav navbar-nav navbar-right hidden-sm hidden-xs">
                <li><a href="<?php print(base_url()); ?>index.php/home"><?php if(isset($home)){print($home);}else{print("Home");} ?></a></li>
                <li><a href="<?php print(base_url()); ?>index.php/myhistory"><?php if(isset($my_history)){print($my_history);}else{print("My history");} ?><span class="nav-item-count"><?php if(isset($historycount)){print($historycount);}  ?></span></a></li>
                <?php
                    if(isset($loggedin) && $loggedin){
                ?>
                <li><a href="<?php print(base_url()); ?>index.php/mywishlist"><?php if(isset($my_wishlist)){print($my_wishlist);}else{print("My wishlist");} ?><span class="nav-item-count"><?php if(isset($historycount)){print($historycount);}  ?></span></a></li>
                <li><a href="<?php print(base_url()); ?>index.php/dashboard"><?php if(isset($profile)){print($profile);}else{print("Profile");} ?></a></li>
                <li><a href="<?php print(base_url()); ?>index.php/logout"><?php if(isset($logout)){print($logout);}else{print("Logout");} ?></a></li>
                <?php
                    }else{
                ?>
                    <li><a href="<?php print(base_url()); ?>index.php/login"><?php if(isset($login)){print($login);}else{print("Login");} ?></a></li>
                <?php
                    }
                ?>
                <?php
                    if(!isset($loggedin) || (isset($loggedin) && !$loggedin)){
                ?>
                <li><a href="<?php print(base_url()); ?>index.php/registration"><?php if(isset($register)){print($register);}else{print("Register");} ?></a></li>
                <?php
                    }
                ?>
                <li class="dropdown">
                    <select class="selectpicker" id="currency" >
                        <option  value="HUF" <?php if(isset($currency['id']) ){if($currency['id'] == 'HUF'){print('selected');}} ?>>HUF</option>
                        <option  value="USD" <?php if(isset($currency['id']) ){if($currency['id'] == 'USD'){print('selected');}} ?>>USD</option>
                        <option  value="EUR" <?php if(isset($currency['id']) ){if($currency['id'] == 'EUR'){print('selected');}} ?>>EUR</option>
                    </select>
                </li>
                <li class="dropdown">
                    <select class="selectpicker" id="languageselect" >
                        <option value="hu" <?php if($lang == 'hu'){print('selected');} ?>>Hungarian</option>
                        <option value="en" <?php if($lang == 'en'){print('selected');} ?>>English</option>
                        <option value="de" <?php if($lang == 'de'){print('selected');} ?>>Deutsch</option>
                    </select>
                </li>
                <?php
                    if(!isset($cartcontent) || (isset($cartcontent)) && count($cartcontent) == 0){
                ?>
                <li><a href="<?php print(base_url()); ?>index.php/cart"><?php if(isset($cart)){print($cart);}else{print("Cart");} ?></a></li>
                <?php
                    }else{
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php if(isset($cart)){print($cart);}else{print("Cart");} ?><i class="fa fa-heart" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu dropdown-wishlist" role="menu">
                        <?php
                        foreach($cartcontent as $row){
                    ?>
                    
                        <li class="col-xs-12">
                            <a href="#" class="row">
                                <img src="../../assets/images/pictures/city.jpg" alt="" class="col-xs-4" />
                                <div class="col-xs-8">
                                    <?php print($row['name']);  ?><br>USD43.99
                                </div>
                            </a>
                        </li>
                    
                    <?php
                        }
                    ?>
                    <li class="col-xs-12">
                        <a href="index.php/cart" class="row">
                            <img src="" alt="" class="col-xs-4" />
                            <div class="col-xs-8">
                                <?php if(isset($cart)){print($cart);}else{print("Cart");} ?>
                            </div></a>
                    </li>
                    </ul>
                </li>
                <?php
                    }
                ?>
                <li><a href="#"><i class="fa fa-search fa-lg" aria-hidden="true"></i></a></li>
            </ul>
            <a href="<?php print(base_url()); ?>" class="logo pull-left visible-sm visible-xs"><img src="<?php print(base_url()); ?>assets/images/logo-glass.png" alt="" /></a>
            <ul class="nav navbar-nav pull-right visible-sm visible-xs">
                <li><a href="#"><i class="fa fa-history fa-lg" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-heart fa-lg" aria-hidden="true"></i></a></li>
                <li><a href="<?php print(base_url()); ?>index.php/login"><i class="fa fa-user fa-lg" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-language fa-lg" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
</nav>
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