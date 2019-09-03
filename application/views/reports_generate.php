<?php $this->view('inc/header') ?>

<div class="container">
    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr>
                <h2 class="intro-text text-center">
                    Generate Report
                </h2>
                <hr>
                <form name="generate_report" class="generate_report" method="POST" action="<?=base_url('reports/generate')?>" >

                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <div class="input-group-addon">Entity</div>
                            <select title="entity" class="form-control" name="entity" id="report_entity">
                                <option value="">Select Entity</option>
                                <option value="KHEA" >KHEA</option>
                                <option value="KHEI" >KHEI</option>
                                <option value="KLI" >KLI</option>
                                <option value="All" >All</option>
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

                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <div class="input-group-addon">Select Delivery Month</div>
                            <select title="month" class="form-control" name="month" id="month">
                                <option value="">Select Month</option>
                                <option value='1'>January</option>
                                <option value='2'>February</option>
                                <option value='3'>March</option>
                                <option value='4'>April</option>
                                <option value='5'>May</option>
                                <option value='6'>June</option>
                                <option value='7'>July</option>
                                <option value='8'>August</option>
                                <option value='9'>September</option>
                                <option value='10'>October</option>
                                <option value='11'>November</option>
                                <option value='12'>December</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <div class="input-group-addon">Select Delivery Year</div>
                            <select title="year" class="form-control" name="year" id="year">
                                <option value="">Select Year</option>
                                <?php
                                for($x = date('Y') - 1; $x <= date('Y') + 1; $x++) {
                                    echo "<option value='$x'>$x</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <input type="submit" class="btn btn-primary" value="Generate Report" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="push"></div>
<div class="push"></div>
<?php $this->view('inc/footer') ?>
