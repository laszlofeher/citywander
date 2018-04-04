<aside class="col-md-3">
    <p class="visible-sm visible-xs">
        <a href="#" class="btn btn-orange btn-block sb-filter-btn">Filter <i class="fa fa-angle-down"></i></a>
    </p>
    <form method="post" id="filterform" action="" class="form-section box-shadow sb-filter">
        <input type="hidden" name="reloadurl" id="reloadurl" value="<?php if(isset($listurl)){print($listurl);} ?>"/>
        <h4 class="form-title"><?php print($your_search_within_budapest); ?></h4>
        <div class="input-with-addon form-group">
            <input type="text" class="form-control" placeholder="Search..." >
            <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
        <hr />
        <h5 class="form-subtitle"><?php print($categories); ?></h5>
        <ul class="form-list">
            <?php
            if (isset($promotioncategory)) {
                $ul = false;
                for ($i = 0; $i < count($promotioncategory); $i++) {
                    if((isset($promotioncategory[$i]['pcgname'])&& isset($promotioncategory[$i+1]['pcgname'])) && $promotioncategory[$i]['pcgname'] !== $promotioncategory[$i+1]['pcgname']){
                    ?>
                        <li><a href="<?php print(base_url('index.php/listview/index/6/' . $promotioncategory[$i]['id'] . '/1/1/15/-1')); ?>"><?php print($promotioncategory[$i]['name']); ?></a></li>
                    <?php
                    if($ul){
                        ?>
                            </ul>
                        <?php
                        $ul = false;
                        }
         
                    }else if((isset($promotioncategory[$i]['pcgname'])&& isset($promotioncategory[$i-1]['pcgname']) && isset($promotioncategory[$i+1]['pcgname'])) && ($promotioncategory[$i]['pcgname'] !== $promotioncategory[$i-1]['pcgname'])&& ($promotioncategory[$i]['pcgname'] === $promotioncategory[$i+1]['pcgname'])){
                        $ul = true;
                    ?>    
                        <li><a href="#"><?php print($promotioncategory[$i]['pcgname']); ?><i class="fa fa-angle-down form-list-toggle"></i></a></li>
                        <ul>
                            <li><a href="<?php print(base_url('index.php/listview/index/6/' . $promotioncategory[$i]['id'] . '/1/1/15/-1')); ?>"><?php print($promotioncategory[$i]['name']); ?></a></li>
                    <?php    
                    }else if((isset($promotioncategory[$i]['pcgname'])&& isset($promotioncategory[$i+1]['pcgname'])) && ($promotioncategory[$i]['pcgname'] === $promotioncategory[$i-1]['pcgname'])&& ($promotioncategory[$i]['pcgname'] === $promotioncategory[$i+1]['pcgname'])){
                    ?>   
                        <li><a href="<?php print(base_url('index.php/listview/index/6/' . $promotioncategory[$i]['id'] . '/1/1/15/-1')); ?>"><?php print($promotioncategory[$i]['name']); ?></a></li>
                    <?php
                    }
                }
                if($ul){
                    ?>
                        </ul>
                    <?php
                }
            }
            ?>
        </ul>
        <hr />
        <h5 class="form-subtitle"><?php print($duration); ?></h5>

        <ul class="form-list">
            <li><label><input type="checkbox" id="duration1" value="0-1"/><?php print($duration1); ?></label></li>
            <li><label><input type="checkbox" id="duration2" value="1-4"/><?php print($duration2); ?></label></li>
            <li><label><input type="checkbox" id="duration3" value="4-8"/><?php print($duration3); ?></label></li>
            <li><label><input type="checkbox" id="duration4" value="fullyday"/><?php print($duration4); ?></label></li>
        </ul>
        <hr />
        <h5 class="form-subtitle"><?php print($price_range); ?></h5>
        <ul class="form-list">
            <li><label><input type="checkbox" id="pricecategory1" value="<?php print('0 - ' . number_format($pricemargin['_first'], 2, ',', ' ')); ?>"/> <?php print('0 - ' . number_format($pricemargin['_first'], 2, ',', ' ')); ?></label></li>
            <li><label><input type="checkbox" id="pricecategory2" value="<?php print(number_format($pricemargin['_first'], 2, ',', ' ') . ' - ' . number_format($pricemargin['_sec'], 2, ',', ' ')); ?>"/> <?php print(number_format($pricemargin['_first'], 2, ',', ' ') . ' - ' . number_format($pricemargin['_sec'], 2, ',', ' ')); ?></label></li>
            <li><label><input type="checkbox" id="pricecategory3" value="<?php print(number_format($pricemargin['_sec'], 2, ',', ' ') . ' - ' . number_format($pricemargin['_third'], 2, ',', ' ')); ?>"/> <?php print(number_format($pricemargin['_sec'], 2, ',', ' ') . ' - ' . number_format($pricemargin['_third'], 2, ',', ' ')); ?></label></li>
            <li><label><input type="checkbox" id="pricecategory4" value="<?php print(number_format($pricemargin['_third'], 2, ',', ' ') . ' - '); ?>"/> <?php print(number_format($pricemargin['_third'], 2, ',', ' ') . ' - '); ?></label></li>
        </ul>
        <hr />
        <h5 class="form-subtitle"><?php print($date); ?></h5>
        <ul class="form-list">
            <li><label><input type="checkbox" /> $$$</label></li>
        </ul>
        <hr />
        <h5 class="form-subtitle"><?php print($daytime); ?></h5>
        <ul class="form-list">
            <li><label><input type="checkbox" id="daytime1" value="1"/><?php print($morning); ?></label></li>
            <li><label><input type="checkbox" id="daytime2" value="2" /><?php print($during_the_day); ?></label></li>
            <li><label><input type="checkbox" id="daytime3" value="3" /><?php print($afternoon); ?></label></li>
            <li><label><input type="checkbox" id="daytime4" value="4" /><?php print($evening); ?></label></li>
            <li><label><input type="checkbox" id="daytime5" value="5" /><?php print($night); ?></label></li>
        </ul>
        <div class="text-center">
            <button id="clearfilter" type="button" class="btn btn-orange"><?php print($clear_filters); ?></button>
        </div>
    </form>
</aside>