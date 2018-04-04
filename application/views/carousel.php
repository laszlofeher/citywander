<section class="carousel-holder">
    <div class="owl-carousel slideshow">
        <?php 
        if(isset($carousel)){ 
            for($i=0; $i < count($carousel); $i++){
        ?>
                <div class="item" style="background-image: url('<?php print(base_url()); ?>assets/images/pictures/<?php print($carousel[$i]['picture']); ?>')"></div>
        <?php 
            }
        } 
        ?>
        
    </div>
    <div class="container carousel-search">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <form action="http://citywander.website/index.php/listview/index/15/-1/1/1/15/-1" method="post">
                    <h1 class="carousel-search-title hidden-xs hidden-sm"><?php if(isset($carousel_text)){ print($carousel_text);}else{print("");} ?></h1>
                    <div class="col-xs-12 carousel-search-group">
                        <div class="col-sm-10 col-xs-9 input-group">
                            <span class="input-group-addon"><i class="fa fa-search fa-lg"></i></span>
                            <input type="hidden" id="tempsearch" >
                            <input type="hidden" id="tempsearchtype" >
                            <input type="text" name="search"  class="form-control" placeholder="<?php if(isset($what_do_you_want_to_do_in_budapest)){ print($what_do_you_want_to_do_in_budapest);}else{print("");} ?>" >
                        </div>
                        <div class="col-sm-2 col-xs-3">
                            <button type="submit" class="btn btn-orange"><?php print($search); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <a href="#button-list" class="scroll-to-btn"><i class="fa fa-angle-down"></i></a>
</section>