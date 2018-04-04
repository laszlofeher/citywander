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
        <!-- carousel -->
        <?php
        $this->load->view('carousel');
        ?>
        <!-- end of carousel -->	
        
        <section class="section container" id="scontainer">
            <?php   print($content);  ?>
        </section>
        
        <!-- footer -->
        <?php $this->load->view('footer');  ?>
        <!-- end of footer -->
        
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <!--<script src="assets/js/jquery.min.js"></script> -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/daterangepicker.js"></script>
        <script src="assets/js/bootstrap-select.min.js"></script>
        <script src="assets/js/star-rating.min.js"></script>


        <!-- JS script -->
        <script src="assets/js/mset.js"></script>
        <script src="assets/js/msearch.js"></script>
        <script src="assets/js/mlistview.js"></script>
        <script src="assets/js/script.js"></script>
        <script>

            $(function () {
                //Date range picker
                $('#reservation').daterangepicker();
                $('#languageselect').click(function () {
                    $.get("index.php/home/index/" + $('#languageselect').val())
                            .done(function (data) {
                                //alert("Data Loaded: " + data);
                            });
                });
                $('#scontainer').bind("DOMNodeInserted", function (e) {
                    $("#scontainer").unbind( "DOMNodeInserted" );
                    //DOMNodeRemoved 
                    //DOMSubtreeModified általámnosan mindenre lefut, (DOMNodeRemoved, DOMNodeInserted) esetén kétszer egyszer remove, aztán insert
                    $('.media-box-like').on('click', function (e) {
                        e.preventDefault();
                        $(this).find('i').toggleClass('fa-heart-o fa-heart');
                    });
                    
                });
                $('.selectpicker').selectpicker();
            });
        </script>
    </body>
</html>