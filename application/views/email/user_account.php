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
<hr>
<p style="text-align: center;">Kindly do not disclose the following credentials to anyone.</p>
<p style="text-align: center;">If you face any issues or have any doubts kindly email to <a href="mailto:vaibhav.sidapara@timesprinters.com" target="_blank">vaibhav.sidapara@timesprinters.com</a></p>
<hr>
<table border="1">
    <tr>
        <td><strong>Name</strong></td>
        <td><?=$details['name']?></td>
    </tr>
    <tr>
        <td><strong>Email (Used for login)</strong></td>
        <td><?=$details['email']?></td>
    </tr>
    <tr>
        <td><strong>Password</strong></td>
        <td><?=$details['password']?></td>
    </tr>
    <tr>
        <td><strong>Department</strong></td>
        <td><?=$details['department']?></td>
    </tr>
    <tr>
        <td><strong>Portal URL</strong></td>
        <td><?=base_url()?></td>
    </tr>

</table>

<br />

<p style="text-align: center;">
    ***** Email confidentiality notice *****<br/>
This message is private and confidential. If you have received this message in error, please notify us and remove it from your system.
</p>


</body>
</html>
