<div class="row">
    <div class="box">
        <hr>
        <h2 class="intro-text text-center">
            Job Sheet / Delivery Order
        </h2>
        <hr>

        <table class="table table-hover table-bordered">
            <tbody>
            <tr>
                <td>OC No.: <?=$job->prefix."-".$job->id?></td>
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

        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th></th>
                <th>Cover</th>
                <th>Content</th>
                <th>Handouts</th>
            </tr>
            </thead>

            <tbody>