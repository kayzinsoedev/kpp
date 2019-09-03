<?php $this->view('inc/header') ?>

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">
                    Orders
                </h2>
                <hr>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Job Name</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Details</th>
                        <th>Re-Order</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($orders as $job => $jobDetails) { ?>
                    <tr>
                        <td><a href="<?=base_url()."order/index/{$jobDetails['id']}/"?>"><?=$jobDetails['id']?></a></td>
                        <td><?=$jobDetails['job_name']?></td>
                        <td><?=date("d/m/Y", strtotime( $jobDetails['order_date'] )); ?></td>
                        <td><?=$jobDetails['status']?></td>
                        <td><a href="<?=base_url()."order/index/{$jobDetails['id']}/"?>" class="btn btn-success">View Details</a></td>
                        <td><a href="<?=base_url()."order/duplicate/{$jobDetails['id']}/"?>" class="btn btn-danger order-duplicate">Duplicate</a></td>
                    </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php $this->view('inc/footer') ?>
