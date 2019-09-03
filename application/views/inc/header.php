<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="KAPLAN Print On Demand | Powered by JCS Digital Solutions">
    <meta name="author" content="INSEAD EDU">

    <title><?=( isset($prefix) && isset($id) )? $prefix.'-'.$id.' | KAPLAN Print On Demand': 'KAPLAN Print On Demand'?></title>
    <link rel="icon" type="image/icon" href="http://www.kaplan.com.sg/wp-content/themes/singapore/img/favicon.ico">
    <link rel="stylesheet" href="<?=base_url('public/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('public/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('public/css/bootstrap-datetimepicker.css')?>">
    <link rel="stylesheet" href="<?=base_url('public/sweetalerts/sweetalert.css')?>">
    <link rel="stylesheet" href="<?=base_url('public/css/style.css')?>">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="container">

    <div class="row hidden-print">
        <div class="box">
            <div class="col-md-12">
                <div class="col-lg-4 col-md-4 col-sm-12 text-center">
                    <img class="img-responsive img-center" src="<?=base_url('public/images/kaplan_Logo.png')?>" alt="KAPLAN Logo" style="padding: 15px; max-height: 150px">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 text-center">
                    <h2 class="" style="color: #202a86; font-weight: bold">KAPLAN Print On Demand</h2>
                    <hr class="tagline-divider">
                    <h2>
                        <small>By
                            <strong><a href="https://www.jcs.com.sg/" target="_blank">JCS Digital Solutions</a></strong>
                        </small>
                    </h2>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <?php
    $user = $this->session->userdata('user');
    if($user) { ?>
    <div class="row">
        <nav class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?=base_url('/')?>">Home</a>
                        </li>
                        <li>
                            <a href="<?=base_url('order/user/')?>">Order History</a>
                        </li>
                        <li>
                            <a href="<?=base_url('user/password')?>">Change Password <span class="badge">New</span></a>
                        </li>
                        <li>
                            <a href="<?=base_url('home/logout')?>">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <?php } ?>
    <div class="clearfix"></div>
</div>
