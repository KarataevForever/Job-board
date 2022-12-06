<?php
    $db = require $_SERVER['DOCUMENT_ROOT'] . '/common/db.php';

?>

<div class="row cat_search">
    <div class="col-lg-3 col-md-4">
        <div class="single_input">
            <input type="text" placeholder="Search keyword">
        </div>
    </div>
    <div class="col-lg-3 col-md-4">
        <div class="single_input">
            <select class="wide" >
                <option data-display="Location">Location</option>
                <option value="1">Dhaka</option>
                <option value="2">Rangpur</option>
                <option value="4">Sylet</option>
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-4">
        <div class="single_input">
            <select class="wide">
                <option data-display="Category">Category</option>
                <option value="1">Category 1</option>
                <option value="2">Category 2</option>
                <option value="4">Category 3</option>
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-12">
        <div class="job_btn">
            <a href="#" class="boxed-btn3">Find Job</a>
        </div>
    </div>
</div>