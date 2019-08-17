<?php
if (!defined('ABSPATH'))
    exit;
oxilab_flip_box_user_capabilities();
$styleid = (int) $_GET['styleid'];
global $wpdb;
$table_list = $wpdb->prefix . 'oxi_div_list';
$table_name = $wpdb->prefix . 'oxi_div_style';
$editdata = array('', '', '', '', '', '', '', 'fab fa-facebook', '', 'fab fa-facebook',);
$itemid = '';
$value = '';
if (!empty($_REQUEST['_wpnonce'])) {
    $nonce = $_REQUEST['_wpnonce'];
}
if (!empty($_POST['submit']) && $_POST['submit'] == 'submit') {
    if (!wp_verify_nonce($nonce, 'oxilab_flip_box_new_data')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $data = ' flip-box-image-upload-url-01 {#}|{#}' . sanitize_text_field($_POST['flip-box-image-upload-url-01']) . '{#}|{#}'
                . ' flip-box-backend-link {#}|{#}' . sanitize_text_field($_POST['flip-box-backend-link']) . '{#}|{#}'
                . ' flip-box-image-upload-url-02 {#}|{#}' . sanitize_text_field($_POST['flip-box-image-upload-url-02']) . '{#}|{#}'
                . ' flip-box-front-icons {#}|{#}' . sanitize_text_field($_POST['flip-box-front-icons']) . '{#}|{#}'
                . ' flip-box-backend-icons {#}|{#}' . sanitize_text_field($_POST['flip-box-backend-icons']) . '{#}|{#}';

        if ($_POST['item-id'] == '') {
            $wpdb->query($wpdb->prepare("INSERT INTO {$table_list} (styleid, files) VALUES ( %d, %s)", array($styleid, $data)));
        }
        if ($_POST['item-id'] != '' && is_numeric($_POST['item-id'])) {
            $item_id = (int) $_POST['item-id'];
            $data = $wpdb->update("$table_list", array("files" => $data), array('id' => $item_id), array('%s'), array('%d'));
        }
    }
}

if (!empty($_POST['data-submit']) && $_POST['data-submit'] == 'Save') {
    if (!wp_verify_nonce($nonce, 'oxilab_flip_box_style_css')) {
        die('You do not have sufficient permissions to access this page.');
    } else {

        $data = 'oxilab-flip-type |' . sanitize_text_field($_POST['oxilab-flip-type']) . '|'
                . ' oxilab-flip-effects |' . sanitize_text_field($_POST['oxilab-flip-effects']) . '|'
                . ' front-background-color |' . sanitize_text_field($_POST['front-background-color']) . '|'
                . ' front-border-color |' . sanitize_hex_color($_POST['front-border-color']) . '| '
                . ' backend-background-color |' . sanitize_text_field($_POST['backend-background-color']) . '|'
                . ' backend-border-color |' . sanitize_hex_color($_POST['backend-border-color']) . '|'
                . ' front-icon-color |' . sanitize_hex_color($_POST['front-icon-color']) . '|'
                . ' backend-icon-color |' . sanitize_hex_color($_POST['backend-icon-color']) . '|'
                . ' ||'
                . ' ||'
                . ' ||'
                . ' ||'
                . ' ||'
                . ' ||'
                . ' ||'
                . ' ||'
                . ' ||'
                . ' ||'
                . ' ||'
                . ' ||'
                . ' ||'
                . ' flip-col |' . sanitize_text_field($_POST['flip-col']) . '|'
                . ' flip-width |' . sanitize_text_field($_POST['flip-width']) . '|'
                . ' flip-height |' . sanitize_text_field($_POST['flip-height']) . '|'
                . ' margin-top |' . sanitize_text_field($_POST['margin-top']) . '|'
                . ' margin-left |' . sanitize_text_field($_POST['margin-left']) . '|'
                . ' flip-open-tabs |' . sanitize_text_field($_POST['flip-open-tabs']) . '|'
                . ' oxilab-animation |' . sanitize_text_field($_POST['oxilab-animation']) . '|'
                . ' animation-duration |' . sanitize_text_field($_POST['animation-duration']) . '|'
                . ' flip-boxshow-color |' . sanitize_text_field($_POST['flip-boxshow-color']) . '|'
                . ' flip-boxshow-horizontal |' . sanitize_text_field($_POST['flip-boxshow-horizontal']) . '|'
                . ' flip-boxshow-vertical |' . sanitize_text_field($_POST['flip-boxshow-vertical']) . '|'
                . ' flip-boxshow-blur |' . sanitize_text_field($_POST['flip-boxshow-blur']) . '|'
                . ' flip-boxshow-spread |' . sanitize_text_field($_POST['flip-boxshow-spread']) . '|'
                . ' flip-font-border-size|' . sanitize_text_field($_POST['flip-font-border-size']) . '|'
                . ' flip-font-border-style|' . sanitize_text_field($_POST['flip-font-border-style']) . '|'
                . ' flip-backend-border-size|' . sanitize_text_field($_POST['flip-backend-border-size']) . '|'
                . ' flip-backend-border-style|' . sanitize_text_field($_POST['flip-backend-border-style']) . '|'
                . ' front-icon-size |' . sanitize_text_field($_POST['front-icon-size']) . '|'
                . ' front-icon-width |' . sanitize_text_field($_POST['front-icon-width']) . '|'
                . ' front-icon-padding-top-bottom |' . sanitize_text_field($_POST['front-icon-padding-top-bottom']) . '|'
                . ' front-icon-padding-left-right |' . sanitize_text_field($_POST['front-icon-padding-left-right']) . '|'
                . ' backend-icon-size |' . sanitize_text_field($_POST['backend-icon-size']) . '|'
                . ' backend-icon-width |' . sanitize_text_field($_POST['backend-icon-width']) . '|'
                . ' backend-icon-padding-top-bottom |' . sanitize_text_field($_POST['backend-icon-padding-top-bottom']) . '|'
                . ' backend-icon-padding-left-right |' . sanitize_text_field($_POST['backend-icon-padding-left-right']) . '|'
                . ' flip-border-radius |' . sanitize_text_field($_POST['flip-border-radius']) . '|'
                . ' custom-css |' . sanitize_text_field($_POST['custom-css']) . '|'
                . '|';
        $data = sanitize_text_field($data);
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET css = %s WHERE id = %d", $data, $styleid));
    }
}
if (!empty($_POST['edit']) && is_numeric($_POST['item-id'])) {
    if (!wp_verify_nonce($nonce, 'oxilab_flip_box_edit_data')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $item_id = (int) $_POST['item-id'];
        $data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_list WHERE id = %d ", $item_id), ARRAY_A);
        $editdata = explode('{#}|{#}', $data['files']);
        $itemid = $data['id'];
        echo '<script type="text/javascript"> jQuery(document).ready(function () {setTimeout(function() { jQuery("#oxilab-flip-box-add-new-data").modal("show")  }, 500); });</script>';
    }
}
if (!empty($_POST['delete']) && is_numeric($_POST['item-id'])) {
    if (!wp_verify_nonce($nonce, 'oxilab_flip_box_delete_data')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $item_id = (int) $_POST['item-id'];
        $wpdb->query($wpdb->prepare("DELETE FROM {$table_list} WHERE id = %d ", $item_id));
    }
}
$listdata = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_list WHERE styleid = %d ORDER by id ASC ", $styleid), ARRAY_A);
$style = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $styleid), ARRAY_A);
$styledata = $style['css'];
$styledata = explode('|', $styledata);
?>
<div class="wrap">
    <?php echo oxilab_flip_box_admin_head($styleid); ?>    
    <div class="oxilab-admin-wrapper">
        <div class="oxilab-admin-row">
            <div class="oxilab-admin-style-panel-left">
                <div class="oxilab-admin-style-panel-left-settings">
                    <div class="oxilab-admin-style-panel-left-settings-row">
                        <form method="post" id="oxi-addons-flip-style">
                            <div class="oxilab-tabs-wrapper">
                                <ul class="oxilab-tabs-ul">
                                    <li ref="#oxilab-tabs-id-5" class="">
                                        General
                                    </li>
                                    <li ref="#oxilab-tabs-id-4" class="">
                                        Front
                                    </li>
                                    <li ref="#oxilab-tabs-id-3" class="">
                                        Backend
                                    </li>                                     
                                    <li ref="#oxilab-tabs-id-2" class="">
                                        Custom CSS
                                    </li>
                                    <li ref="#oxilab-tabs-id-1">
                                        Support
                                    </li>
                                </ul>
                                <div class="oxilab-tabs-content">
                                    <div class="oxilab-tabs-content-tabs" id="oxilab-tabs-id-5">
                                        <div class="oxilab-tabs-content-div-half">
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    General Settings
                                                </div> 
                                                <?php
                                                echo oxilab_flip_box_flip_type_effects_type($styledata[1], $styledata[3]);
                                                echo oxilab_flip_box_admin_col_data('flip-col', $styledata[43], 'Item per Rows', 'How many item shows in single Rows');
                                                echo oxilab_flip_box_admin_number('flip-width', $styledata[45], '1', 'Width', 'Give your Filp Width');
                                                echo oxilab_flip_box_admin_number('flip-height', $styledata[47], '1', 'Height', 'Give your Flip Height');
                                                echo oxilab_flip_box_admin_number('flip-border-radius', $styledata[93], '1', 'Border Radius', 'Set your flip Border Radius');
                                                ?>    
                                            </div> 
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Optional Settings
                                                </div>  
                                                <?php
                                                echo oxilab_flip_box_admin_number_double('margin-top', $styledata[49], 'margin-left', $styledata[51], 'Margin', 'Set your Margin top bottom and left right');
                                                echo oxilab_flip_box_admin_true_false('flip-open-tabs', $styledata[53], 'New tabs', '_blank', 'Normal', '', 'Link Open', 'Dow you want to open link at same Tabs or new Windows');
                                                ?> 
                                            </div>
                                        </div>
                                        <div class="oxilab-tabs-content-div-half">
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Animation
                                                </div>
                                                <?php
                                                echo oxilab_flip_box_admin_animation_select($styledata[55]);
                                                echo oxilab_flip_box_admin_number('animation-duration', $styledata[57], '0.1', 'Animation Duration', 'Give your Animation Duration into Second');
                                                ?> 
                                            </div> 
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Box Shadow
                                                </div>
                                                <?php
                                                echo oxilab_flip_box_admin_color('flip-boxshow-color', $styledata[59], 'rgba', 'Color', 'Give your Box Shadow Color', '', '');
                                                echo oxilab_flip_box_admin_number_double('flip-boxshow-horizontal', $styledata[61], 'flip-boxshow-vertical', $styledata[63], 'Shadow Length', 'Giveyour Box Shadow lenth as horizontal and vertical');
                                                echo oxilab_flip_box_admin_number_double('flip-boxshow-blur', $styledata[65], 'flip-boxshow-spread', $styledata[67], 'Shadow Radius', 'Giveyour Box Shadow Radius as Blur and Spread');
                                                ?> 
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="oxilab-tabs-content-tabs" id="oxilab-tabs-id-4">
                                        <div class="oxilab-tabs-content-div-half">
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    General Settings
                                                </div> 
                                                <?php
                                                echo oxilab_flip_box_admin_color('front-background-color', $styledata[5], 'rgba', 'Background Color', 'Set your Front Background Color', 'background-color', '.oxilab-flip-box-' . $styleid . '');
                                                echo oxilab_flip_box_admin_color('front-border-color', $styledata[7], '', 'Border Color', 'Set your Border Color', 'border-color', '.oxilab-flip-box-' . $styleid . '');
                                                echo oxilab_flip_box_admin_border('flip-font-border-size', $styledata[69], 'flip-font-border-style', $styledata[71], 'Border Size', 'Set your front border size with different style');
                                                ?>    
                                            </div> 
                                        </div>
                                        <div class="oxilab-tabs-content-div-half">
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Icon Settings
                                                </div>  
                                                <?php
                                                echo oxilab_flip_box_admin_number('front-icon-size', $styledata[77], '1', 'Icon Size', 'Set your Icon Font Size');
                                                echo oxilab_flip_box_admin_color('front-icon-color', $styledata[13], '', 'Icon Color', 'Set your Icon Color', 'color', '.oxilab-flip-box-' . $styleid . '-data .oxilab-icon-data [class^=\'fa\']');
                                                echo oxilab_flip_box_admin_number('front-icon-width', $styledata[79], '1', 'Icon width', 'Set your Icon Width and Height Size.');
                                                echo oxilab_flip_box_admin_number_double('front-icon-padding-top-bottom', $styledata[81], 'front-icon-padding-left-right', $styledata[83], 'Icon Padding', 'Set your Icon Padding as Top Bottom and Left Right');
                                                ?> 
                                            </div>                                                                                   
                                        </div>
                                    </div>
                                    <div class="oxilab-tabs-content-tabs" id="oxilab-tabs-id-3">
                                        <div class="oxilab-tabs-content-div-half">
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    General Settings
                                                </div> 
                                                <?php
                                                echo oxilab_flip_box_admin_color('backend-background-color', $styledata[9], 'rgba', 'Background Color', 'Set your Backend Background Color', 'background-color', '.oxilab-flip-box-back-' . $styleid . '');
                                                echo oxilab_flip_box_admin_color('backend-border-color', $styledata[11], '', 'Border Color', 'Set your Border Color', 'border-color', '.oxilab-flip-box-back-' . $styleid . '');
                                                echo oxilab_flip_box_admin_border('flip-backend-border-size', $styledata[73], 'flip-backend-border-style', $styledata[75], 'Border Size', 'Set your front border size with different style');
                                                ?>    
                                            </div> 
                                        </div>
                                        <div class="oxilab-tabs-content-div-half">
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Icon Settings
                                                </div>  
                                                <?php
                                                echo oxilab_flip_box_admin_number('backend-icon-size', $styledata[85], '1', 'Icon Size', 'Set your Icon Font Size');
                                                echo oxilab_flip_box_admin_color('backend-icon-color', $styledata[15], '', 'Icon Color', 'Set your Icon Color', 'color', '.oxilab-flip-box-back-' . $styleid . ' .oxilab-icon-data [class^=\'fa\']');
                                                echo oxilab_flip_box_admin_number('backend-icon-width', $styledata[87], '1', 'Icon width', 'Set your Icon Width and Height Size.');
                                                echo oxilab_flip_box_admin_number_double('backend-icon-padding-top-bottom', $styledata[89], 'backend-icon-padding-left-right', $styledata[91], 'Icon Padding', 'Set your Icon Padding as Top Bottom and Left Right');
                                                ?> 
                                            </div>                                                                                   
                                        </div>
                                    </div>                                
                                    <div class="oxilab-tabs-content-tabs" id="oxilab-tabs-id-2">
                                        <br>
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="custom-css" class="custom-css">Custom CSS:</label>
                                                <textarea class="form-control" rows="4" id="custom-css" name="custom-css"><?php echo $styledata[95]; ?></textarea>
                                                <small class="form-text text-muted">Add Your Custom CSS Unless make it blank.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="oxilab-tabs-content-tabs" id="oxilab-tabs-id-1">
                                        <?php
                                        echo oxilab_flip_box_admin_support();
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class = "oxilab-setting-save">
                                <input type="hidden" id="style-id" name="style-id" value="<?php echo $styleid; ?>">
                                <button type = "button" class = "btn btn-danger" data-dismiss = "modal">Close</button>
                                <input type = "submit" class = "btn btn-primary" name = "data-submit" value = "Save">
                                <?php wp_nonce_field("oxilab_flip_box_style_css")
                                ?>
                            </div>
                        </form>                       
                    </div>
                </div>
                <div class="oxilab-admin-style-panel-left-preview">
                    <div class="oxilab-admin-style-panel-left-preview-heading">
                        <div class="oxilab-admin-style-panel-left-preview-heading-left">
                            Preview
                        </div>
                        <div class="oxilab-admin-style-panel-left-preview-heading-right">
                            <input type="text" class="form-control oxilab-vendor-color"  data-format="rgb" data-opacity="true"  id="oxilab-preview-data-background" value="rgba(255, 255, 255, 1)">
                        </div>
                    </div>
                    <div class="oxilab-preview-data" id="oxilab-preview-data">
                        <?php oxilab_flip_box_shortcode_function($styleid, 'admin') ?>
                    </div>
                </div>
            </div>
            <div class="oxilab-admin-style-panel-right">
                <?php
                echo oxilab_flip_box_admin_add_new();
                echo oxilab_flip_box_admin_rename($style);
                echo oxilab_flip_box_admin_shortcode($styleid);
                echo oxilab_flip_box_admin_rearrange();
                ?>   
                <div id="oxilab-drag-and-drop-file" class="modal fade bd-example-modal-sm" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <form id="oxilab-drag-and-drop-submit">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Re-arrange Flip</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert text-center" id="oxilab-drag-saving">
                                        <i class="fa fa-spinner fa-spin"></i>
                                    </div>
                                    <?php
                                    echo ' <ul class="list-group" id="oxilab-drag-drop">';
                                    foreach ($listdata as $value) {
                                        $data = explode('{#}|{#}', $value['files']);
                                        echo '<li class="list-group-item" id ="' . $value['id'] . '"><i class="fa ' . $data[7] . '"></i></li>';
                                    }
                                    echo '</ul>';
                                    ?>
                                </div>
                                <div class="modal-footer">    
                                    <input type="hidden" name="oxilab-flipbox-ajax-nonce" id="oxilab-flipbox-ajax-nonce" value="<?php echo wp_create_nonce("oxilab_flipbox_ajax_data"); ?>"/>
                                    <button type="button" id="oxilab-flipbox-drag-close" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    <input type="submit" id="oxilab-flipbox-drag-submit" class="btn btn-primary" value="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>   
            </div>
            <div id="oxilab-flip-box-add-new-data" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
                    <form method="POST">
                        <div class="modal-content">                            
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Flip Settings</h4>
                            </div>                            
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Front Settings</h4>
                            </div>
                            <div class="modal-body"> 
                                <?php
                                echo oxilab_flip_box_admin_input_text('flip-box-front-icons', $editdata[7], 'Front Icon', 'Add your front icon, Use Font-Awesome class name. As example fab fa-facebook');
                                ?>                               
                                <div class="form-group">
                                    <label for="flip-box-image-upload-url-01"> Front Background Image</label>
                                    <div class="col-xs-12-div">
                                        <div class="col-md-8 col-xs-6" style="padding-left: 0px;">
                                            <input type="text "class="form-control" name="flip-box-image-upload-url-01" id="flip-box-image-upload-url-01"  value="<?php echo $editdata[1]; ?>">
                                        </div>
                                        <div class="col-md-4 col-xs-6">
                                            <button type="button" id="flip-box-image-upload-button-01" class="btn btn-default">Upload Image</button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Add or modify your front Background Image unless make it Blank.</small>
                                </div>                                 
                            </div>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Backend Settings</h4>
                            </div>
                            <div class="modal-body">
                                <?Php
                                echo oxilab_flip_box_admin_input_text('flip-box-backend-icons', $editdata[9], 'Backend Icon', 'Add your front icon, Use Font-Awesome class name. As example fab fa-facebook');
                                echo oxilab_flip_box_admin_input_text('flip-box-backend-link', $editdata[3], 'Link', 'Add your desire link or url unless make it blank');
                                ?>  
                                <div class="form-group">
                                    <label for="flip-box-image-upload-url-02"> Backend Background Image</label>
                                    <div class="col-xs-12-div">
                                        <div class="col-md-8 col-xs-6" style="padding-left: 0px;">
                                            <input type="text "class="form-control" name="flip-box-image-upload-url-02" id="flip-box-image-upload-url-02"  value="<?php echo $editdata[5]; ?>">
                                        </div>
                                        <div class="col-md-4 col-xs-6">
                                            <button type="button" id="flip-box-image-upload-button-02" class="btn btn-default">Upload Image</button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Add or Modify Your Backend Background Image. Unless make it blank.</small>
                                </div>                                                                
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="item-id" name="item-id" value="<?php echo $itemid ?>">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" id="item-submit" name="submit" value="submit">
                            </div>
                        </div>
                        <?php wp_nonce_field("oxilab_flip_box_new_data") ?>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>