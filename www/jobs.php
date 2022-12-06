<?php
    $db = require $_SERVER['DOCUMENT_ROOT'] . '/common/db.php';
    /** @var $db PDO */
    $jobs_listed = $db->query("SELECT SUM(vacancy_tally) as sum FROM jobs")->fetch(PDO::FETCH_ASSOC);

    $is_first = true;
    $query_str = "SELECT *
            FROM jobs
            JOIN city on city.id = jobs.city 
            JOIN job_nature ON job_nature.id = jobs.job_nature 
            JOIN country ON country.id = city.country
            JOIN qualifications ON qualifications.id = jobs.qualification";

    $keyword = $_GET['keyword'] ?? null;

    if ($keyword != "") {
        where_or_and($is_first, $query_str);

        $query_str .= "LOWER(title) LIKE LOWER('%{$keyword}%') OR LOWER(description) LIKE LOWER('%{$keyword}%')";
    }

    $loc = $_GET['loc'] ?? null;

    if ($loc != "") {
        where_or_and($is_first, $query_str);

        $query_str .= "city.id = {$loc}";
    }

    $cat = $_GET['cat'] ?? null;

    if ($cat != "") {
        where_or_and($is_first, $query_str);

        $query_str .= "category = {$cat}";
    }

    $type = $_GET['type'] ?? null;

    if ($type != "") {
        where_or_and($is_first, $query_str);

        $query_str .= "job_nature = {$type}";
    }

    $qua = $_GET['qua'] ?? null;

    if ($qua != "") {
        where_or_and($is_first, $query_str);

        $query_str .= "qualification  = {$qua}";
    }

    $sal = $_GET['sal'] ?? null;

    if ($sal != "") {
        $range = explode("-", $sal);


        where_or_and($is_first, $query_str);

        $query_str .= "salary_from >= {$range[0]} AND salary_to <= {$range[1]}";
    }

    $jobs = $db->query($query_str)->fetchAll(PDO::FETCH_ASSOC);

    function where_or_and(&$is_first, &$query_str) {
        if ($is_first) {
            $query_str .= " where ";
            $is_first = false;
        }
        else $query_str .= " AND ";
    }
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Job Board</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/gijgo.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/slicknav.css">

    <link rel="stylesheet" href="css/style.css">
    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="index.php">
                                        <img src="img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index.php">home</a></li>
                                            <li><a href="jobs.php">Browse Job</a></li>
                                            <li><a href="#">pages <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="candidate.html">Candidates </a></li>
                                                    <li><a href="job_details.html">job details </a></li>
                                                    <li><a href="elements.html">elements</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">blog <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="blog.html">blog</a></li>
                                                    <li><a href="single-blog.html">single-blog</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contact.html">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="Appointment">
                                    <div class="phone_num d-none d-xl-block">
                                        <a href="#">Log in</a>
                                    </div>
                                    <div class="d-none d-lg-block">
                                        <a class="boxed-btn3" href="#">Post a Job</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    <!-- bradcam_area  -->
    <div class="bradcam_area bradcam_bg_1">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text">
                        <h3><?=$jobs_listed['sum']?>+ Jobs Available</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->

    <!-- job_listing_area_start  -->
    <div class="job_listing_area plus_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="job_filter white-bg">
                        <div class="form_inner white-bg">
                            <h3>Filter</h3>
                            <form action="/www/jobs.php">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <input type="text" placeholder="Search keyword" name="keyword">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide" name="loc">
                                                <?php
                                                $parameters_cities = $db->query("
                                                        SELECT city.id, city.citys FROM jobs 
                                                        JOIN city ON city.id = jobs.city GROUP BY city")->fetchAll(PDO::FETCH_ASSOC);
                                                ?>
                                                    <option data-display="Location" value="">Location</option>
                                                <?php foreach ($parameters_cities as $item):?>
                                                    <option value="<?=$item['id']?>" <?php if ($item['id'] == $loc):?> selected <?php endif;?> ><?=$item['citys']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide" name="cat">
                                                <?php
                                                    $parameters_category = $db->query("
                                                        SELECT category.id, category.categories FROM jobs 
                                                        JOIN category ON category.id = jobs.category GROUP BY category")->fetchAll(PDO::FETCH_ASSOC);
                                                ?>
                                                <option data-display="Category" value="">Category</option>
                                                <?php foreach ($parameters_category as $item):?>
                                                    <option value="<?=$item['id']?>" <?php if ($item['id'] == $cat):?> selected <?php endif;?>><?=$item['categories']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide" name="type">
                                                <?php
                                                $parameters_job_type = $db->query("
                                                        SELECT job_nature.id, job_nature.job_natures FROM jobs 
                                                        JOIN job_nature ON job_nature.id = jobs.job_nature GROUP BY job_nature")->fetchAll(PDO::FETCH_ASSOC);
                                                ?>
                                                <option data-display="Job type" value="">Job type</option>
                                                <?php foreach ($parameters_job_type as $item):?>
                                                    <option value="<?=$item['id']?>" <?php if ($item['id'] == $type):?> selected <?php endif;?>><?=$item['job_natures']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="single_field">
                                            <select class="wide" name="qua">
                                                <?php
                                                $parameters_qualification = $db->query("
                                                        SELECT qualifications.id, qualifications.qualifications FROM jobs 
                                                        JOIN qualifications ON qualifications.id = jobs.qualification GROUP BY qualification")->fetchAll(PDO::FETCH_ASSOC);
                                                ?>
                                                <option data-display="Qualification" value="">Qualification</option>
                                                <?php foreach ($parameters_qualification as $item):?>
                                                    <option value="<?=$item['id']?>" <?php if ($item['id'] == $qua):?> selected <?php endif;?>><?=$item['qualifications']?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="range_wrap">
                                    <label for="amount">Price range:</label>
                                    <div id="slider-range"></div>
                                    <p>
                                        <span style="border:0; color:#7A838B; font-size: 14px; font-weight:400;" id="range-visible"></span>
                                        <input type="text" id="amount" name="sal" readonly style="display: none">
                                    </p>
                                </div>
                                <div class="reset_btn">
                                    <button  class="boxed-btn3 w-100" type="submit">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="recent_joblist_wrap">
                        <div class="recent_joblist white-bg ">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h4>Job Listing</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="serch_cat d-flex justify-content-end">
                                        <select>
                                            <option data-display="Most Recent">Most Recent</option>
                                            <option value="1">Marketer</option>
                                            <option value="2">Wordpress </option>
                                            <option value="4">Designer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="job_lists m-0">
                        <div class="row">
                            <?php foreach ($jobs as $job):?>
                                <?php require $_SERVER['DOCUMENT_ROOT'] . '/parts/job_list.php'?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- job_listing_area_end  -->

    <!-- footer start -->
    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".3s">
                            <div class="footer_logo">
                                <a href="#">
                                    <img src="img/logo.png" alt="">
                                </a>
                            </div>
                            <p>
                                finloan@support.com <br>
                                +10 873 672 6782 <br>
                                600/D, Green road, NewYork
                            </p>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.1s" data-wow-delay=".4s">
                            <h3 class="footer_title">
                                Company
                            </h3>
                            <ul>
                                <li><a href="#">About </a></li>
                                <li><a href="#"> Pricing</a></li>
                                <li><a href="#">Carrier Tips</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>

                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.2s" data-wow-delay=".5s">
                            <h3 class="footer_title">
                                Category
                            </h3>
                            <ul>
                                <li><a href="#">Design & Art</a></li>
                                <li><a href="#">Engineering</a></li>
                                <li><a href="#">Sales & Marketing</a></li>
                                <li><a href="#">Finance</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-4">
                        <div class="footer_widget wow fadeInUp" data-wow-duration="1.3s" data-wow-delay=".6s">
                            <h3 class="footer_title">
                                Subscribe
                            </h3>
                            <form action="#" class="newsletter_form">
                                <input type="text" placeholder="Enter your mail">
                                <button type="submit">Subscribe</button>
                            </form>
                            <p class="newsletter_text">Esteem spirit temper too say adieus who direct esteem esteems
                                luckily.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text wow fadeInUp" data-wow-duration="1.4s" data-wow-delay=".3s">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/ footer end  -->

    <!-- link that opens popup -->
    <!-- JS here -->
    <script src="js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="js/vendor/jquery-1.12.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/ajax-form.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/scrollIt.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/nice-select.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/plugins.js"></script>
    <!-- <script src="js/gijgo.min.js"></script> -->
    <script src="js/range.js"></script>



    <!--contact js-->
    <script src="js/contact.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/mail-script.js"></script>


    <script src="js/main.js"></script>


	<script>
        $( function() {
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 120000,
                values: [ 750, 120000 ],
                slide: function( event, ui ) {
                    $("#range-visible").text("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] +"/ Year");
                    $( "#amount" ).val( ui.values[ 0 ] + "-" + ui.values[ 1 ]);
                }
            });
            $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) + "-" + $( "#slider-range" ).slider( "values", 1 ));
            $( "#range-visible" ).text( "$" + $( "#slider-range" ).slider( "values", 0 ) +
                " - $" + $( "#slider-range" ).slider( "values", 1 ) + "/ Year");
        } );
        </script>
</body>

</html>