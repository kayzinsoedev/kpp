<?php $this->view('inc/header') ?>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                        Key in your order details
                    </h2>
                    <hr>
                    <div class="col-md-12">
                        <div class="alert alert-info text-center" role="alert"><strong>Notice:</strong> To print complimentary (Free of Cost) material, kindly send the job via email. Print orders submit via portal are considered chargeable.</div>
                    </div>
                    <form name="print_details_form" class="print_details_form" method="POST" action="<?=base_url('prints/print_validation/')?>">

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">Name</div>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" autofocus value="<?=(isset( $session['name']) )?$session['name']:$session['user_name']?>">
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">Email (Multiple use , instead of ;)</div>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" aria-describedby="basic-addon2" value="<?=(isset( $session['email']) )?$session['email']:$session['user']?>">
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">Contact No.</div>
                                <input type="text" class="form-control" name="contact" id="contact" placeholder="Contact No." value="<?=(isset( $session['contact']) )?$session['contact']:''?>">
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">PO Number (If Required)</div>
                                <input type="text" class="form-control" name="po_number" id="po_number" placeholder="PO Number (If Required)" value="<?=(isset( $session['po_number']) )?$session['po_number']:''?>">
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">Entity</div>
                                <select title="entity" class="form-control" name="entity" id="entity">
                                    <option value="">Select Entity</option>
                                    <option value="KHEA" >KHEA</option>
                                    <option value="KHEI" >KHEI</option>
                                    <option value="KLI" >KLI</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">Division</div>
                                <select title="division" class="form-control" name="division" id="division" disabled>
                                    <option value="">Select Division</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">Intake (If Required)</div>
                                <input type="text" class="form-control" name="intake" id="intake" placeholder="Intake (If Required)" value="<?=(isset( $session['intake']) )?$session['intake']:''?>">
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">Module (If Required)</div>
                                <input type="text" class="form-control" name="module" id="module" placeholder="Module (If Required)" value="<?=(isset( $session['module']) )?$session['module']:''?>">
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">Job Name (If Required)</div>
                                <input type="text" class="form-control" name="job_name" id="job_name" placeholder="Job Name (If Required)" value="<?=(isset( $session['job_name']) )?$session['job_name']:''?>">
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <hr>
                        <h4 class="text-center">
                            Delivery Details
                        </h4>
                        <hr>

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">Attention To</div>
                                <input type="text" class="form-control" name="attention_to" id="attention_to" placeholder="Attention To" value="<?=(isset( $session['attention_to']) )?$session['attention_to']:''?>">
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="input-group date form_datetime" data-date="" data-date-format="dd MM yyyy - HH p" data-link-field="delivery_date" data-link-format="dd MM yyyy - HH p">
                                <span class="input-group-addon">Delivery Date</span>
                                <input title="fake" class="form-control" size="16" type="text" value="" readonly>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                            </div>
                            <input name="delivery_date" type="hidden" id="delivery_date" value="" />
                        </div>


                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon">Campus</div>
                                <select title="delivery_location" class="form-control" name="delivery_location" id="delivery_location">
                                    <option value="">Select Campus</option>
                                    <option value="KAPLAN Pomo Campus, 1 Selegie Road, Level 7 (S) 188306." >KAPLAN Pomo Campus, 1 Selegie Road, Level 7 (S) 188306.</option>
                                    <option value="KAPLAN City Campus, 8 Wilkie Road, Wilkie Edge (S) 228095." >KAPLAN City Campus, 8 Wilkie Road, Wilkie Edge (S) 228095.</option>
                                    <option value="KAPLAN Jurong East" >KAPLAN Jurong East</option>
                                    <option value="3rd Party" >3rd Party</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="input-group-addon">Delivery Location</div>
                                <textarea title="delivery_location_secondary" name="delivery_location_secondary" class="form-control" rows="4" style="resize: none;"  placeholder="Enter Campus Office or Level / 3rd Party Address"><?=(isset( $session['delivery_location_secondary']) )?$session['delivery_location_secondary']:''?></textarea>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-warning"><strong>Next Upload Files</strong> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </button>
                        </div>

                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>

    </div>

<?php $this->view('inc/footer') ?>
