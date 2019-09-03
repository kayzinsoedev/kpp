    <tr>
        <td colspan="4" style="border: 2px solid grey;" ><strong>Job No: <?=$jobNo?> <?=( isset($value['file_name']) )? ' | Job Name: '.$value['file_name'] : ''?></strong></td>
    </tr>
    <tr>
        <td colspan="4" ><strong>Folder Name: <?=$key?></strong></td>
    </tr>
    <tr>
        <td>Trim Size:</td>
        <td colspan="2" class="text-center"><?=( empty($value['content_pp']) )?'':$value['size']?></td>
        <td><?=( empty($value['handouts_size']) )?'':$value['handouts_size']?></td>
    </tr>

    <tr>
        <td>Extent:</td>
        <td><?=( empty($value['cover_pp']) )?'':$value['cover_pp']." PP"?></td>
        <td><?=( empty($value['content_pp']) )?'':$value['content_pp']." PP"?></td>
        <td><?=( empty($value['handouts_pp']) )?'':$value['handouts_pp']." PP"?></td>
    </tr>

    <tr>
        <td>Colour:</td>
        <td><?=( empty($value['cover_pp']) )?'':$value['cover_color']?></td>
        <td><?=( empty($value['content_pp']) )?'':$value['content_color']?></td>
        <td><?=( empty($value['handouts_pp']) )?'':$value['handouts_color']?></td>
    </tr>

    <tr>
        <td>Side:</td>
        <td><?=( empty($value['cover_pp']) )? '' : $value['cover_side']?></td>
        <td>
            <?php
            if ( !empty($value['content_pp']) ) {
                echo ($value['content_side'] == "Single") ? '1C X 0C' : '1C X 1C';
            }else { echo ''; }
            ?>
        </td>
        <td>
            <?php
            if ( !empty($value['handouts_pp']) ) {
                echo ($value['handouts_side'] == "Single")?'1C X 0C':'1C X 1C';
            }else { echo ''; }
            ?>
        </td>
    </tr>

    <tr>
        <td>Material:</td>
        <td><?=( empty($value['cover_pp']) )?'':"260 Artcard"?></td>
        <td><?=( empty($value['content_pp']) )?'':"70 Woodfree"?></td>
        <td><?=( empty($value['handouts_pp']) )?'':"70 Woodfree"?></td>
    </tr>

    <tr>
        <td>Binding:</td>
        <td colspan="2" class="text-center"><?=( empty($value['finishing']) )?'':$value['finishing']?></td>
        <td></td>
    </tr>

    <tr>
        <td>Finishing:</td>
        <td colspan="2" class="text-center">
            <?=( $value['finishing'] == 'Wire Bind' )?'Transparent Plastic Sheet for Front & Back Cover':''?>
            <?=( $value['finishing'] == 'Book Bind (P-B)' )?'Single Side Gloss Lamination':''?>
        </td>
        <td>
            <?=( $value['handouts_punch_hole'] == 'none' )?'':'Punch Hole: '.$value['handouts_punch_hole'].'<br/>'?>
            <?=( empty($value['handouts_size']) )?'':$value['handouts_staple']?>
        </td>
    </tr>

    <tr>
        <td>Copies:</td>
        <td colspan="2" class="text-center"><?=( empty($value['quantity']) )?'':$value['quantity'].' CPS'?></td>
        <td><?=( empty($value['handouts_quantity']) )?'':$value['handouts_quantity'].' CPS'?></td>
    </tr>

    <tr>
        <td>Additional Items:</td>
        <td colspan="2" class="text-center">
            <?php
            if( !empty($value['additional_items'])) {
                echo implode(", ", $value['additional_items']);
            }
            ?>
        </td>
        <td></td>
    </tr>

    <tr>
        <td>Remarks:</td>
        <td colspan="2"><?=$value['remarks']?></td>
        <td><?=$value['handouts_remarks']?></td>
    </tr>

    <tr>
        <td>Packaging:</td>
        <td colspan="2" class="text-center"><?=( empty($value['content_pp']) )?'':'Paper Wrap'?></td>
        <td><?=( empty($value['handouts_quantity']) )?'':'Paper Wrap'?></td>
    </tr>
