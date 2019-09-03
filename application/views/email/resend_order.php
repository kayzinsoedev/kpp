<!DOCTYPE html>
<html>
<head>
    <style>
    body{
        font-family: arial, sans-serif;
        min-width: 99%;
    }

    table {
        border-collapse: collapse;
        min-width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
    </style>
</head>
<body>
<p style="text-align: center;">Do Not Reply to this email.</p>
<hr>

<table border="1">
    <tr>
        <td><strong>Name</strong></td>
        <td><?=$job->name?></td>
    </tr>
    <tr>
        <td><strong>Email</strong></td>
        <td><?=$job->email?></td>
    </tr>
    <tr>
        <td><strong>Contact</strong></td>
        <td><?=$job->contact?></td>
    </tr>
    <tr>
        <td><strong>Division</strong></td>
        <td><?=$job->division?></td>
    </tr>
    <tr>
        <td><strong>Intake</strong></td>
        <td><?=$job->intake?></td>
    </tr>
    <tr>
        <td><strong>Module</strong></td>
        <td><?=$job->module?></td>
    </tr>
    <tr>
        <td><strong>Attention To</strong></td>
        <td><?=$job->attention_to?></td>
    </tr>
    <tr>
        <td><strong>Delivery Date & Time</strong></td>
        <td><?=$job->delivery_date?></td>
    </tr>
    <tr>
        <td><strong>Delivery Location</strong></td>
        <td><?=$job->delivery_location?></td>
    </tr>
    <tr>
        <td><strong>Order Details</strong></td>
        <td><a href="<?=base_url().'order/index/'.$job->id?>" target="_blank" >Click Here</a></td>
    </tr>

</table>

<br />

<table>
    <tr>
        <th>Job</th>
        <th>Content</th>
        <th>Cover</th>
        <th>Handouts</th>
    </tr>
<?php
$counter = 0;
echo "<pre>";
foreach( unserialize($job->files) as $key => $value) { ?>

    <tr>
        <td><?=++$counter?></td>
        <td>
            <?php
            if( is_array($value['content']) ) {
                foreach($value['content'] as $fileKey => $fileValue ) {
                    echo "<br />File ".++$fileKey.": <strong>".$fileValue['content_name']."</strong>";
                }
            } else { echo "<br />None"; }
            ?>
        </td>
        <td>
            <?php
            if( is_array($value['cover']) ) {
                foreach($value['cover'] as $fileKey => $fileValue ) {
                    echo "<br />File ".++$fileKey.": <strong>".$fileValue['cover_name']."</strong>";
                }
            } else { echo "<br />None"; }
            ?>
        </td>
        <td>
            <?php
            if( is_array($value['handouts']) ) {
                foreach($value['handouts'] as $fileKey => $fileValue ) {
                    echo "<br />File ".++$fileKey.": <strong>".$fileValue['handouts_name']."</strong>";
                }
            } else { echo "<br />None"; }
            ?>
        </td>
    </tr>
<?php } ?>
</table>

</body>
</html>
