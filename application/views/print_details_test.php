<? $this->view('inc/header') ?>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">
                        Key in your order details
                    </h2>
                    <hr>

                    <form name="print_details_form" class="print_details_form" method="POST" action="<?=base_url('prints/print_validation/')?>">

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">Requester Name</div>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" autofocus value="<?=(isset( $session['name']) )?$session['name']:$session['user_name']?>">
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">Email</div>
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

                        <div class="form-group col-md-12 col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">Location</div>
                                <select title="entity" class="form-control" name="location" id="location">
                                    <option value="">Select Location</option>
                                    <!--<option value="KHEA" >KAPLAN POMO CAMPUS, 1 SELEGIE ROAD, LEVEL 7 (S) 188306. ATTN: SITI NURLINA (T: 6500 4295-EXT 1295)</option>-->
                                    <!--<option value="KHEA" >KAPLAN POMO CAMPUS, 1 SELEGIE ROAD, LEVEL 7 (S) 188306. ATTN: FACILITIES OFFICE (LEVEL 8) (T: 6411 4338 / 6411 4359)</option>-->
                                    <!--<option value="KHEA" >KAPLAN POMO CAMPUS, 1 SELEGIE ROAD, LEVEL 7 (S) 188306. ATTN: MATERIAL COLLECTION ROOM</option>-->
                                    <!--<option value="KHEA" >KAPLAN CITY CAMPUS, 8 WILKIE ROAD, WILKIE EDGE (S) 228095. ATTN: FACILITIES OFFICE (LEVEL 5) (T: 6496 5981)</option>-->
                                    <!--<option value="KHEA" >KAPLAN CITY CAMPUS, 8 WILKIE ROAD, #02-01, WILKIE EDGE (S) 228095. ATTN: MATERIAL COLLECTION ROOM (ROOM 208)</option>-->
                                    <option>POMO</option>
                                    <option>CITY</option>
                                    <option>JURONG</option>
                                    <option>3rd Party</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-12 col-sm-12">
                            <div class="input-group">
                                <div class="input-group-addon">Delivery Location</div>
                                <textarea title="delivery_location" name="delivery_location" class="form-control" rows="4" style="resize: none;"><?=(isset( $session['delivery_location']) )?$session['delivery_location']:''?></textarea>
                            </div>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-warning"><strong>Next Upload Files</strong> <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

<? $this->view('inc/footer') ?>
