<?php $this->view('inc/header') ?>

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.2/css/fixedHeader.bootstrap.min.css">

<div class="container">

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">
                    Orders
                </h2>
                <hr>

                <table class="table table-striped nowrap datatable" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>OC No:</th>
                        <th>Name</th>
                        <th>Order Date</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>D\O</th>
                        <th>View</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($orders as $job => $jobDetails) { ?>
                    <tr>
                        <td><?=$jobDetails['prefix']."-".$jobDetails['id']?></td>
                        <td><?=$jobDetails['name']?></td>
                        <td data-order="<?=strtotime($jobDetails['order_date'])?>">
                            <?=date("d/m/Y", strtotime( $jobDetails['order_date'] ) )?>
                        </td>
                        <td data-order="<?=strtotime( str_replace("-","",$jobDetails['delivery_date']) )?>">
                            <?=date("d/m/Y", strtotime( str_replace("-","",$jobDetails['delivery_date']) ) )?>
                        </td>
                        <td><?=$jobDetails['status']?></td>
                        <td><a href="<?=base_url()."order/do_generate/{$jobDetails['id']}/"?>" class="btn btn-primary">Generate</a></td>
                        <td><a href="<?=base_url()."order/index/{$jobDetails['id']}/"?>" class="btn btn-success">View Order</a></td>
                    </tr>
                    <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php $this->view('inc/footer') ?>

<script type="application/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script type="application/javascript" src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>

<script>
    $(document).ready(function(){
        var table = $('.datatable').DataTable({
            "paging":   false,
            responsive: true
        });
        table
            .column( '0:visible' )
            .order( 'desc' )
            .draw();

        new $.fn.dataTable.FixedHeader( table );
    });
</script>
