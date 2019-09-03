</tbody>
</table>

<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th>Attention To</th>
        <th>Delivery Location</th>
        <th class="hidden-print">Download Files</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?=$job->attention_to?></td>
        <td><?=$job->delivery_location.'<br/>'.$job->delivery_location_secondary?></td>
        <?php
            if(isset($destination)){ ?>
                <td class="hidden-print"><a href="<?=$destination?>" target="_blank">Click Here</a></td>
        <?php }  else  { ?>
              <td>  No Files to download </td>
        <?php } ?>


        <!-- <td class="hidden-print"><a href="<?=base_url()."order/file_download/$job->job_session_id/$job->id"?>" target="">Click Here</a></td> -->
    </tr>
    </tbody>
</table>
<div class="visible-print">
    <table class="table table-bordered" style="">
        <tr>
            <th colspan="2">
                <small>This is a computer generated Delivery Order, no signature is required.</small>
            </th>
            <th class="text-center">Check & Accepted</th>
        </tr>
        <tr>
            <td colspan="2">
                <br/>
                <address>
                    <small>Times Printers Pte Ltd Co.Reg.No 196700328H<br/>
                        16 Tuas Ave 5 Singapore 639340<br/>
                        Tel (65) 6311 2888 Fax (65) 6862 1313<br/>
                        marketing@timeprinters.com<br/>
                        www.timesprinters.com<br/>
                        a member of Times Publishing Limited</small>
                </address>
            </td>
            <td class="text-center" style="vertical-align: bottom">__________________________<br/><small>(Stamp & Sign)</small></td>
        </tr>
    </table>
</div>
</div>
</div>
</div>
