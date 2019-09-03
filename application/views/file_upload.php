<?php $this->view('inc/header') ?>

    <div class="container">
        <div class="row">

            <?php if( isset($files) ) { ?>

                <div class="box showAddedFiles">
                    <div class="col-md-12">
                        <hr>
                        <h2 class="intro-text text-center">
                            Uploaded File
                        </h2>
                        <hr>
                        <?php
                        foreach($files as $key => $value) { ?>
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
                                                <th>Content</th>
                                                <th>Cover</th>
                                                <th>Handouts</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
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
                                        <a href='<?=base_url('prints/delete/'.$key)?>' class='btn btn-danger delete-job'><strong>Delete Job</strong> <i class='fa fa-minus-circle' aria-hidden='true'></i> </a>
                                    </div>
                                </div>
                            </div>
                            <div class='clearfix'></div>
                        <?php } ?>
                        <div class="col-md-12">
                            <a href='<?=base_url('order/review/')?>' class='btn btn-success'><strong>Review Order</strong> <i class='fa fa-arrow-circle-o-right' aria-hidden='true'></i> </a>
                            <a href="<?=base_url('prints/')?>" class='btn btn-warning'>Edit Delivery Info</a>
                            <div class='small bs-callout bs-callout-info' id='callout-progress-animation-css3'>
                                <p class='text-info'>You Can Upload More Jobs From Filling up the Form again.</p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            <?php } ?>


            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                        Upload Files
                    </h2>
                    <hr>

                    <form class="file_upload_form" method="POST" action="<?=base_url('prints/file_validation/')?>" enctype="multipart/form-data">

                        <input type="hidden" name="redirectURL" value="<?=base_url('prints/files/')?>">
                        <input type="hidden" name="counter" value="<?=(isset($session['counter']))?++$session['counter'] : '1'?>">

                        <!--Content-->
                        <div class="col-md-6" style="border-right: dashed">

                            <div class="col-lg-12">
                                <div class="small bs-callout bs-callout-success" id="callout-progress-animation-css3">
                                    <p class="text-info">Upload Files ( Content / Cover ) for Book & Binding Related Jobs</p>
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                <div class="well well-sm">
                                    <strong>Content</strong>
                                    <br/><small>You can now upload multiple files from different folders in one go. <a href="<?=base_url("user/learn_file_upload")?>" target="_blank">Click here for tutorial.</a></small>
                                    <br/><br/>
                                    <input class="form-control file multi" type="file" id="content_file" name="content_file[]" multiple="multiple">
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                <div class="checkbox">
                                    <label><input type="checkbox" class="cover_included" value="yes" name="cover_included" checked>Cover Included in Content Files (Uncheck to upload Cover)</label>
                                </div>
                            </div>
                            <!--End Content-->

                            <!--Cover-->
                            <div class="form-group col-md-12 col-sm-12 cover_div hidden">
                                <div class="input-group">
                                    <div class="input-group-addon"><strong>Cover&nbsp;&nbsp;&nbsp;</strong></div>
                                    <input class="form-control file" type="file" id="cover_file" name="cover_file[]" multiple>
                                </div>
                                <p class="help-block small">Upload Cover only if they are in separate files.</p>
                            </div>
                            <!--End Cover-->

                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon">Side</div>
                                    <select title="Content Side" class="form-control" name="content_side" id="content_side">
                                        <option value="">Print Side</option>
                                        <option value="Single" >Single</option>
                                        <option value="Double" >Double Sided</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-addon">Binding</div>
                                    <select title="finishing" class="form-control" name="finishing" id="finishing">
                                        <option value="">Select Finishing</option>
                                        <option value="Wire Bind" >Wire Bind (Wire-O)</option>
                                        <option value="Book Bind (P-B)" >Book Bind (Perfect Bind)</option>
                                        <option value="Ring Bind (P-C)" >Ring Bind (Plastic Comb)</option>
                                    </select>
                                </div>
                            </div>

                            <!--<div class="form-group col-md-12">-->
                            <!--    <div class="input-group">-->
                            <!--        <div class="input-group-addon">Paper Size</div>-->
                            <!--        <select title="size" class="form-control" name="size" id="size">-->
                            <!--            <option value="">Select Paper Size</option>-->
                            <!--            <option value="A3" >A3</option>-->
                            <!--            <option value="A4" >A4</option>-->
                            <!--            <option value="A5" >A5</option>-->
                            <!--            <option value="Letter" >Letter</option>-->
                            <!--        </select>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon">Quantity / Copies</div>
                                    <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity / Copies" value="">
                                </div>
                            </div>

                            <?php if($this->session->userdata('entity') == 'KLI') { ?>
                                <div class="form-group col-md-12">
                                    <label>Additional Items (Optional)</label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="additional_items[]" value="Inclusive Tentcards">Inclusive Tentcards
                                        </label>
                                        <label>
                                            <input type="checkbox" name="additional_items[]" value="Evaluation Form">Evaluation Form
                                        </label>
                                        <label>
                                            <input type="checkbox" name="additional_items[]" value="SOA Form">SOA Form
                                        </label>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="form-group col-md-12 col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon">Remarks</div>
                                    <textarea title="remarks" name="remarks" class="form-control" rows="4" style="resize: none;"></textarea>
                                </div>
                            </div>
                        </div>

                        <!--Handouts-->
                        <div class="col-md-6">

                            <div class="col-lg-12">
                                <div class="small bs-callout bs-callout-success" id="callout-progress-animation-css3">
                                    <p class="text-info">Upload Files for Loose / Staple Handouts Related Jobs</p>
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                <div class="well well-sm">
                                    <strong>Handouts</strong>
                                    <br/><br/>
                                    <input class="form-control file multi" type="file" id="handouts_file" name="handouts_file[]" multiple="multiple">
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-addon">Side</div>
                                    <select title="handouts_side" class="form-control" name="handouts_side" id="handouts_side">
                                        <option value="">Select Print Side</option>
                                        <option value="Single" >Single</option>
                                        <option value="Double" >Double Sided</option>
                                    </select>
                                </div>
                            </div>

                            <!--<div class="form-group col-md-12 col-sm-12">-->
                            <!--    <div class="input-group">-->
                            <!--        <div class="input-group-addon">Paper Size</div>-->
                            <!--        <select title="handouts_size" class="form-control" name="handouts_size" id="handouts_size">-->
                            <!--            <option value="">Select Paper Size</option>-->
                            <!--            <option value="A3" >A3</option>-->
                            <!--            <option value="A4" >A4</option>-->
                            <!--            <option value="A5" >A5</option>-->
                            <!--            <option value="Letter" >Letter</option>-->
                            <!--        </select>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <div class="form-group col-md-12 col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-addon">Punch Hole</div>
                                    <select title="handouts_punch_hole" class="form-control" name="handouts_punch_hole" id="handouts_punch_hole">
                                        <option value="none">None</option>
                                        <option value="1" >1 Punch Hole</option>
                                        <option value="2" >2 Punch Hole</option>
                                        <option value="3" >3 Punch Hole</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-addon">Staple</div>
                                    <select title="handouts_staple" class="form-control" name="handouts_staple" id="handouts_staple">
                                        <option value="Loose">Loose (None)</option>
                                        <option value="Staple (Top Left Corner)" >Staple (Top Left Corner)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-addon">Quantity / Copies</div>
                                    <input type="number" class="form-control" name="handouts_quantity" id="handouts_quantity" placeholder="Quantity / Copies (Handouts)" value="">
                                </div>
                            </div>


                            <div class="form-group col-md-12 col-sm-12">
                                <div class="input-group">
                                    <div class="input-group-addon">Remarks</div>
                                    <textarea title="handouts_remarks" name="handouts_remarks" class="form-control" rows="4" style="resize: none;"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <br />

                        <div class="col-md-12">
                            <div class="form-group col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon">File Name</div>
                                    <input type="text" class="form-control" name="file_name" id="file_name" placeholder="File Name (To Represent on Delivery Order)" value="">
                                </div>
                            </div>

                            <div class="form-group col-md-12 col-sm-12">
                                <button type="submit" class="btn btn-info"><strong>Upload & Save Files</strong> <i class="fa fa-upload" aria-hidden="true"></i> </button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $this->view('inc/footer') ?>
