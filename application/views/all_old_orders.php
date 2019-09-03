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
                        <th>OC No:</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No.</th>
                        <th>Order Date</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>View Order</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($orders as $job => $jobDetails) { ?>
                    <tr>
                        <td><?=$jobDetails['prefix']."-".$jobDetails['id']?></td>
                        <td><?=$jobDetails['name']?></td>
                        <td><?=$jobDetails['email']?></td>
                        <td><?=$jobDetails['contact']?></td>
                        <td><?=date("d/m/Y", strtotime( $jobDetails['order_date'] )); ?></td>
                        <td></td>
                        <td><?=$jobDetails['status']?></td>
                        <td><a href="<?=base_url()."order/old_order/{$jobDetails['id']}/"?>" class="btn btn-success">View Order</a></td>
                    </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php $this->view('inc/footer') ?>
