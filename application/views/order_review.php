<?php $this->view('inc/header') ?>

<div class="container">
    <div class="row">
        <div class="box">

            <div class="col-md-12">
                <hr>
                <h2 class="intro-text text-center">
                    Review Order
                </h2>
                <hr>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Name</strong> : <?=$session['name']?></li>
                    <li class="list-group-item"><strong>Email</strong> : <?=$session['email']?></li>
                    <li class="list-group-item"><strong>Contact No.</strong> : <?=$session['contact']?></li>
                    <li class="list-group-item"><strong>Division</strong> : <?=$session['division']?></li>
                    <?php if( !empty($session['intake']) && isset($session['intake']) ){ ?>
                        <li class="list-group-item"><strong>Intake</strong> : <?=$session['intake']?></li>
                    <?php } ?>
                    <?php if( !empty($session['module']) && isset($session['module']) ){ ?>
                        <li class="list-group-item"><strong>Module</strong> : <?=$session['module']?></li>
                    <?php } ?>
                    <li class="list-group-item"><strong>Attention To</strong> : <?=$session['attention_to']?></li>
                    <li class="list-group-item"><strong>Delivery Date</strong> : <?=$session['delivery_date']?></li>
                    <li class="list-group-item"><strong>Delivery Location</strong> : <?=$session['delivery_location']?></li>
                </ul>
                <div class="clearfix"></div>

                <?php foreach($session['files'] as $key => $value) { ?>
                    <div class="col-md-12">

                        <div class="panel panel-default">
                            <div class="panel-heading click-able">
                                <h3 class="panel-title"><strong>Folder : <?=$key?></strong></h3>
                                <span class="pull-right panel-collapsed"><i class="glyphicon glyphicon-chevron-down"></i></span>
                            </div>

                            <div class="panel-body" style="display: none;">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Content</th>
                                        <th>Cover</th>
                                        <th>Handouts</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Page Size:</td>
                                        <td><?=( empty($value['size']) )?'':$value['size']?></td>
                                        <td><?=( empty($value['cover_pp']) )?'':$value['size']?></td>
                                        <td><?=( empty($value['handouts_pp']) )?'':$value['handouts_size']?></td>
                                    </tr>
                                    <tr>
                                        <td>Pages:</td>
                                        <td><?=( empty($value['content_pp']) )?'':$value['content_pp']." Page(s)"?></td>
                                        <td><?=( empty($value['cover_pp']) )?'':$value['cover_pp']." Page(s)"?></td>
                                        <td><?=( empty($value['handouts_pp']) )?'':$value['handouts_pp']." Page(s)"?></td>
                                    </tr>
                                    <tr>
                                        <td>Colour:</td>
                                        <td><?=( empty($value['content_color']) )?'':$value['content_color']?></td>
                                        <td><?=( empty($value['cover_color']) )?'':$value['cover_color']?></td>
                                        <td><?=( empty($value['handouts_pp']) )?'':$value['handouts_color']?></td>
                                    </tr>

                                    <tr>
                                        <td>Side:</td>
                                        <td><?=( empty($value['content_side']) )?'':$value['content_side']?></td>
                                        <td><?=( empty($value['cover_side']) )?'':$value['cover_side']?></td>
                                        <td><?=( empty($value['handouts_side']) )?'':$value['handouts_side']?></td>
                                    </tr>
                                    <tr>
                                        <td>Binding:</td>
                                        <td><?=( empty($value['finishing']) )?'':$value['finishing']?></td>
                                        <td><?=( empty($value['cover_pp']) )?'':$value['finishing']?></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>Finishing:</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <?=( $value['handouts_punch_hole'] == 'none' )?'':'Punch Hole: '.$value['handouts_punch_hole']."<br/>"?>
                                            <?=( empty($value['handouts_pp']) )?'':'Staple: '.$value['handouts_staple']?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Copies:</td>
                                        <td><?=( empty($value['quantity']) )?'':$value['quantity']?></td>
                                        <td><?=( empty($value['cover_pp']) )?'':$value['quantity']?></td>
                                        <td><?=( empty($value['handouts_quantity']) )?'':$value['handouts_quantity']?></td>
                                    </tr>

                                    <tr>
                                        <td>Remarks:</td>
                                        <td colspan="2"><?=$value['remarks']?></td>
                                        <td><?=$value['handouts_remarks']?></td>
                                    </tr>
                                    <tr>
                                        <td>Files:</td>
                                        <td>
                                            <?php
                                            if( is_array($value['content']) ) {
                                                foreach($value['content'] as $fileKey => $fileValue ) { ?>
                                                    <br />File <?=++$fileKey?>: <strong><a href="<?=base_url()."files/{$this->session->userdata('job_session_id')}/$key/content/{$fileValue['content_name']}"?>" target="_blank"><?=$fileValue['content_name']?></a></strong>
                                                <?php  }
                                            } else { echo "<br />None"; }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if( is_array($value['cover']) ) {
                                                foreach($value['cover'] as $fileKey => $fileValue ) { ?>
                                                    <br />File <?=++$fileKey?>: <strong><a href="<?=base_url()."files/{$this->session->userdata('job_session_id')}/$key/cover/{$fileValue['cover_name']}"?>" target="_blank"><?=$fileValue['cover_name']?></a></strong>
                                                <?php  }
                                            } else { echo "<br />None"; }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            if( is_array($value['handouts']) ) {
                                                foreach($value['handouts'] as $fileKey => $fileValue ) { ?>
                                                    <br />File <?=++$fileKey?>: <strong><a href="<?=base_url()."files/{$this->session->userdata('job_session_id')}/$key/handouts/{$fileValue['handouts_name']}"?>" target="_blank"><?=$fileValue['handouts_name']?></a></strong>
                                                <?php    }
                                            } else { echo "<br />None"; }
                                            ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class='clearfix'></div>
                <?php } ?>

                <a href="<?=base_url('order/order_submit/')?>" class='btn btn-success submit_order'>Submit</a>
                <a href="<?=base_url('prints/files/')?>" class='btn btn-warning'>Edit Print Details</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

</div>

<?php $this->view('inc/footer') ?>
