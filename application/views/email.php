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
        <td><?=$session['name']?></td>
    </tr>
    <tr>
        <td><strong>Email</strong></td>
        <td><?=$session['email']?></td>
    </tr>
    <tr>
        <td><strong>Contact</strong></td>
        <td><?=$session['contact']?></td>
    </tr>
    <tr>
        <td><strong>Division</strong></td>
        <td><?=$session['division']?></td>
    </tr>
    <tr>
        <td><strong>Intake</strong></td>
        <td><?=$session['intake']?></td>
    </tr>
    <tr>
        <td><strong>Module</strong></td>
        <td><?=$session['module']?></td>
    </tr>
    <tr>
        <td><strong>Attention To</strong></td>
        <td><?=$session['attention_to']?></td>
    </tr>
    <tr>
        <td><strong>Delivery Date & Time</strong></td>
        <td><?=$session['delivery_date']?></td>
    </tr>
    <tr>
        <td><strong>Delivery Location</strong></td>
        <td><?=$session['delivery_location']?></td>
    </tr>
    <tr>
        <td><strong>Order Details</strong></td>
        <td><a href="<?=base_url().'order/index/'.$order_id?>" target="_blank" >Click Here</a></td>
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
foreach( $session['files'] as $key => $value) { ?>

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
