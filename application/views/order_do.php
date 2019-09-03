<?php
    $this->view('inc/header', array(
        'prefix' => $job->prefix,
        'id' => $job->id
    ));
?>

<div class="container" style="font-size: larger;">

    <div class="row">
        <div class="box">
            <table class="table" >
                <tbody>
                <tr>
                    <td style="border-top: 0;"><img class="img-responsive" src="<?=base_url('public/images/TimesPrinters-Logo.jpg')?>" alt="TP Logo" style="max-height: 150px"></td>
                    <td style="border-top: 0;"></td>
                    <td style="border-top: 0;"></td>
                </tr>
                </tbody>
            </table>

            <hr>
            <h2 class="intro-text text-center">
                Delivery Order
            </h2>
            <hr>

            <table class="table table-hover table-bordered">
                <tbody>
                <tr>
                    <td>DO No.: J <?=$job->prefix."-".$job->id?></td>
                    <td>Name: <strong><?=$job->name?></strong></td>
                    <td>Person in Charge: In-Source / DTP</td>
                </tr>

                <tr>
                    <td>PO No.: <strong><?=( empty($job->po_number) )?'-':$job->po_number?></strong></td>
                    <td>Email: <strong><?=$job->email?></strong></td>
                    <td>Order Date: <?=$job->order_date?></td>
                </tr>

                <tr>
                    <td>Entity: <strong><?=( empty($job->entity) )?'-':$job->entity?></strong></td>
                    <td>Contact No: <strong><?=$job->contact?></strong></td>
                    <td>Delivery Date: <?=$job->delivery_date?></td>
                </tr>

                <tr>
                    <td>Division: <strong><?=( empty($job->division) )?'-':$job->division?></strong></td>
                    <td>Module: <strong><?=( empty($job->module) )?'-':$job->module?></strong></td>
                    <td>Intake: <strong><?=( empty($job->intake) )?'-':$job->intake?></strong></td>
                </tr>
                </tbody>
            </table>


            <table class="table table-striped table-bordered" style="table-layout: auto;">
                <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Quantity</th>
                </tr>
                </thead>

                <tbody>
                <?php $jobNo = 1;
                foreach( unserialize($job->files) as $key => $value) { ?>
                    <tr>
                        <td><?=$jobNo?></td>
                        <td>
                            <?php if( isset($value['file_name']) ) { echo $value['file_name']."<br/>"; }?>
                            <?=( empty($value['remarks']) )? '' : $value['remarks']."<br/><br/>" ?>
                            <?=( empty($value['additional_items']) )? '' : 'Additional Items: <br/>'.implode(", ", $value['additional_items'])." ({$value['quantity']} SETS EACH)"?>
                            <?=( empty($value['handouts_remarks']) )? '' : $value['handouts_remarks']."<br/>" ?>
                        </td>
                        <td>
                            <?php if( !empty($value['quantity']) ) { echo 'Book: '.$value['quantity'].' SETS<br/>'; }?>
                            <?php if( !empty($value['handouts_quantity']) ) { echo 'Handouts: '.$value['handouts_quantity'].' SETS<br/>'; } ?>
                        </td>
                    </tr>
                <?php ++$jobNo; } ?>
                </tbody>
            </table>

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Attention To</th>
                    <th>Delivery Location</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?=$job->attention_to?></td>
                    <td><?=$job->delivery_location.'<br/>'.$job->delivery_location_secondary?></td>
                </tr>
                </tbody>
            </table>

            <table class="table table-bordered" style="">
                <tr>
                    <th colspan="2">
                        <small>This is a computer generated Delivery Order, no signature is required.</small>
                    </th>
                    <th class="text-center">Check & Accepted</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <br/>
                        <address>
                            <small>Times Printers Pte Ltd Co.Reg.No 196700328H<br/>
                                16 Tuas Ave 5 Singapore 639340<br/>
                                Tel (65) 6311 2888 Fax (65) 6862 1313<br/>
                                marketing@timeprinters.com<br/>
                                www.timesprinters.com<br/>
                                a member of Times Publishing Limited</small>
                        </address>
                        <img class="img-responsive" src="<?=base_url('public/images/TP-Standards.png')?>" alt="TP Logo" style="max-height: 60px">
                    </td>
                    <td class="text-center" style="vertical-align: bottom">__________________________<br/><small>(Stamp & Sign)</small></td>
                </tr>
            </table>


        </div>
    </div>


</div>



<?php $this->view('inc/footer') ?>
