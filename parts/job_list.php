<div class="col-lg-12 col-md-12">
    <div class="single_jobs white-bg d-flex justify-content-between">
        <div class="jobs_left d-flex align-items-center">
            <div class="thumb">
                <img src="/www/img/svg_icon/1.svg" alt="">
            </div>
            <div class="jobs_conetent">
                <a href="job_details.php?id=<?=$job['jobs_id']?>"><h4><?=$job['title']?></h4></a>
                <div class="links_locat d-flex align-items-center">
                    <div class="location">
                        <p> <i class="fa fa-map-marker"></i> <?=$job['citys']?>, <?=$job['countries']?></p>
                    </div>
                    <div class="location">
                        <p> <i class="fa fa-clock-o"></i> <?=$job['job_natures']?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="jobs_right">
            <div class="apply_now">
                <a class="heart_mark" href="#"> <i class="ti-heart"></i> </a>
                <a href="job_details.php?id=<?=$job['jobs_id']?>" class="boxed-btn3">Apply Now</a>
            </div>
            <div class="date">
                <p>Date line: <?=date( "j F, Y" , strtotime($job['published']) )?></p>
            </div>
        </div>
    </div>
</div>