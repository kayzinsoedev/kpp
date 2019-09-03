<?php
    $this->view('inc/header', array(
        'prefix' => $job->prefix,
        'id' => $job->id
    ));
?>
<?php if($job->status != 'Cancelled') { ?>
    <div class="container hidden-print" style="font-size: larger;">
        <?php $this->view('order_job_sheet_segments/order_job_sheet_header', array('job'=>$job)) ?>
        <?php
        $jobNo = 0;
        if(is_array(@unserialize($job->files)))
        foreach( @unserialize($job->files) as $key => $value) {
            $this->view('order_job_sheet_segments/order_job_sheet_body', array('job' => $job, 'jobNo' => ++$jobNo, 'key' => $key, 'value' => $value));
        } ?>
        <?php $this->view('order_job_sheet_segments/order_job_sheet_footer', array('job'=>$job)) ?>
    </div>

    <?php
    $jobNo = 0;
    if(is_array(@unserialize($job->files)))
    foreach( @unserialize($job->files) as $key => $value) { ?>
    <div class="container visible-print" style="font-size: 19px;">
        <?php $this->view('order_job_sheet_segments/order_job_sheet_header', array('job'=>$job)) ?>
        <?php $this->view('order_job_sheet_segments/order_job_sheet_body', array('job'=>$job, 'jobNo'=>++$jobNo, 'key'=>$key, 'value'=>$value)) ?>
        <?php $this->view('order_job_sheet_segments/order_job_sheet_footer', array('job'=>$job)) ?>
    </div>
    <div class="" style="page-break-after: always;"></div>
  <?php } ?>
<?php } else { ?>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                        <strong>This job is Cancelled</strong>
                    </h2>
                    <hr>
                </div>
            </div>
        </div>
        <div class="push"></div>

    </div>

<?php } ?>

<?php $this->view('inc/footer') ?>
