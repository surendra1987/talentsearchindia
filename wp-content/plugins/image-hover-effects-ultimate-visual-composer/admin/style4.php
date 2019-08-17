<?php
if (!defined('ABSPATH'))
    exit;
oxilab_flip_box_user_capabilities();
$styleid = (int) $_GET['styleid'];
global $wpdb;
$table_list = $wpdb->prefix . 'oxi_div_list';
$table_name = $wpdb->prefix . 'oxi_div_style';
$editdata = array('', 'Give Your Font Title', '', 'fab fa-facebook', '', '', '', 'Add backend Info text unless make it blank.', '', '', '', '', '', '', '', 'Add font info text unless make it blank.', '', 'Give Your Backend Title',);
$itemid = '';
$value = '';
if (!empty($_REQUEST['_wpnonce'])) {
    $nonce = $_REQUEST['_wpnonce'];
}
if (!empty($_POST['submit']) && $_POST['submit'] == 'submit') {
    if (!wp_verify_nonce($nonce, 'oxilab_flip_box_new_data')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $data = ' flip-box-front-title {#}|{#}' . oxilab_flip_box_admin_special_charecter($_POST['flip-box-front-title']) . '{#}|{#}'
                . ' flip-box-front-icons {#}|{#}' . sanitize_text_field($_POST['flip-box-front-icons']) . '{#}|{#}'
                . ' flip-box-image-upload-url-01 {#}|{#}' . sanitize_text_field($_POST['flip-box-image-upload-url-01']) . '{#}|{#}'
                . ' flip-box-backend-desc {#}|{#}' . oxilab_flip_box_admin_special_charecter($_POST['flip-box-backend-desc']) . '{#}|{#}'
                . ' flip-box-backend-button-text {#}|{#}' . oxilab_flip_box_admin_special_charecter($_POST['flip-box-backend-button-text']) . '{#}|{#}'
                . ' flip-box-backend-link {#}|{#}' . sanitize_text_field($_POST['flip-box-backend-link']) . '{#}|{#}'
                . ' flip-box-image-upload-url-02 {#}|{#}' . sanitize_text_field($_POST['flip-box-image-upload-url-02']) . '{#}|{#}'
                . ' flip-box-font-desc {#}|{#}' . oxilab_flip_box_admin_special_charecter($_POST['flip-box-font-desc']) . '{#}|{#}'
                . ' flip-box-backend-title {#}|{#}' . oxilab_flip_box_admin_special_charecter($_POST['flip-box-backend-title']) . '{#}|{#}';
        if ($_POST['item-id'] == '') {
            $wpdb->query($wpdb->prepare("INSERT INTO {$table_list} (styleid, files) VALUES ( %d, %s)", array($styleid, $data)));
        }
        if ($_POST['item-id'] != '' && is_numeric($_POST['item-id'])) {
            $item_id = (int) $_POST['item-id'];
            $data = $wpdb->update("$table_list", array("files" => $data), array('id' => $item_id), array('%s'), array('%d'));
        }
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
if (!empty($_POST['data-submit']) && $_POST['data-submit'] == 'Save') {
    if (!wp_verify_nonce($nonce, 'oxilab_flip_box_style_css')) {
        die('You do not have sufficient permissions to access this page.');
    } else {

        $data = 'oxilab-flip-type |' . sanitize_text_field($_POST['oxilab-flip-type']) . '|'
                . ' oxilab-flip-effects |' . sanitize_text_field($_POST['oxilab-flip-effects']) . '|'
                . ' front-background-color |' . sanitize_text_field($_POST['front-background-color']) . '|'
                . ' || '
                . ' front-icon-color |' . sanitize_hex_color($_POST['front-icon-color']) . '|'
                . ' ||'
                . ' front-heading-color |' . sanitize_hex_color($_POST['front-heading-color']) . '|'
                . ' backend-background-color |' . sanitize_text_field($_POST['backend-background-color']) . '|'
                . ' ||'
                . ' backend-info-color |' . sanitize_hex_color($_POST['backend-info-color']) . '|'
                . ' backend-button-color |' . sanitize_hex_color($_POST['backend-button-color']) . '|'
                . ' backend-button-background |' . sanitize_text_field($_POST['backend-button-background']) . '|'
                . ' backend-button-hover-color |' . sanitize_hex_color($_POST['backend-button-hover-color']) . '|'
                . ' backend-button-hover-background |' . sanitize_text_field($_POST['backend-button-hover-background']) . '|'
                . ' front-info-color |' . sanitize_hex_color($_POST['front-info-color']) . '|'
                . ' backend-title-color |' . sanitize_hex_color($_POST['backend-title-color']) . '|'
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
                . '  ||'
                . ' front-padding-top |' . sanitize_text_field($_POST['front-padding-top']) . '|'
                . ' front-padding-left |' . sanitize_text_field($_POST['front-padding-left']) . '|'
                . ' ||'
                . ' front-icon-size |' . sanitize_text_field($_POST['front-icon-size']) . '|'
                . ' front-icon-width |' . sanitize_text_field($_POST['front-icon-width']) . '|'
                . ' ||'
                . ' front-heading-size |' . sanitize_text_field($_POST['front-heading-size']) . '|'
                . ' front-heading-family |' . sanitize_text_field($_POST['front-heading-family']) . '|'
                . ' front-heding-style |' . sanitize_text_field($_POST['front-heding-style']) . '|'
                . ' front-heding-weight |' . sanitize_text_field($_POST['front-heding-weight']) . '|'
                . ' front-heding-text-align |' . sanitize_text_field($_POST['front-heding-text-align']) . '|'
                . ' front-heding-padding-top |' . sanitize_text_field($_POST['front-heding-padding-top']) . '|'
                . ' front-heding-padding-bottom |' . sanitize_text_field($_POST['front-heding-padding-bottom']) . '|'
                . ' front-heding-padding-left |' . sanitize_text_field($_POST['front-heding-padding-left']) . '|'
                . ' front-heding-padding-right |' . sanitize_text_field($_POST['front-heding-padding-right']) . '|'
                . ' backend-padding-top |' . sanitize_text_field($_POST['backend-padding-top']) . '|'
                . ' backend-padding-left |' . sanitize_text_field($_POST['backend-padding-left']) . '|'
                . ' ||'
                . ' backend-info-size |' . sanitize_text_field($_POST['backend-info-size']) . '|'
                . ' backend-info-family |' . sanitize_text_field($_POST['backend-info-family']) . '|'
                . ' backend-info-style |' . sanitize_text_field($_POST['backend-info-style']) . '|'
                . ' backend-info-weight |' . sanitize_text_field($_POST['backend-info-weight']) . '|'
                . ' backend-info-text-align |' . sanitize_text_field($_POST['backend-info-text-align']) . '|'
                . ' backend-info-padding-top |' . sanitize_text_field($_POST['backend-info-padding-top']) . '|'
                . ' backend-info-padding-bottom |' . sanitize_text_field($_POST['backend-info-padding-bottom']) . '|'
                . ' backend-info-padding-left |' . sanitize_text_field($_POST['backend-info-padding-left']) . '|'
                . ' backend-info-padding-right |' . sanitize_text_field($_POST['backend-info-padding-right']) . '|'
                . ' backend-button-size |' . sanitize_text_field($_POST['backend-button-size']) . '|'
                . ' backend-button-family |' . sanitize_text_field($_POST['backend-button-family']) . '|'
                . ' backend-button-style |' . sanitize_text_field($_POST['backend-button-style']) . '|'
                . ' backend-button-weight |' . sanitize_text_field($_POST['backend-button-weight']) . '|'
                . ' backend-button-info-padding-top|' . sanitize_text_field($_POST['backend-button-info-padding-top']) . '|'
                . ' backend-button-info-padding-left |' . sanitize_text_field($_POST['backend-button-info-padding-left']) . '|'
                . ' backend-button-border-radius |' . sanitize_text_field($_POST['backend-button-border-radius']) . '|'
                . ' backend-button-text-align |' . sanitize_text_field($_POST['backend-button-text-align']) . '|'
                . ' backend-info-margin-top |' . sanitize_text_field($_POST['backend-info-margin-top']) . '|'
                . ' backend-info-margin-bottom |' . sanitize_text_field($_POST['backend-info-margin-bottom']) . '|'
                . ' backend-info-margin-left |' . sanitize_text_field($_POST['backend-info-margin-left']) . '|'
                . ' backend-info-margin-right |' . sanitize_text_field($_POST['backend-info-margin-right']) . '|'
                . '  ||'
                . '  ||'
                . ' flip-border-radius |' . sanitize_text_field($_POST['flip-border-radius']) . '|'
                . '  ||'
                . '  ||'
                . ' front-icon-padding-top-bottom |' . sanitize_text_field($_POST['front-icon-padding-top-bottom']) . '|'
                . ' front-icon-padding-left-right |' . sanitize_text_field($_POST['front-icon-padding-left-right']) . '|'
                . ' front-info-size |' . sanitize_text_field($_POST['front-info-size']) . '|'
                . ' front-info-family |' . sanitize_text_field($_POST['front-info-family']) . '|'
                . ' front-info-style |' . sanitize_text_field($_POST['front-info-style']) . '|'
                . ' front-info-weight |' . sanitize_text_field($_POST['front-info-weight']) . '|'
                . ' front-info-text-align |' . sanitize_text_field($_POST['front-info-text-align']) . '|'
                . ' front-info-padding-top |' . sanitize_text_field($_POST['front-info-padding-top']) . '|'
                . ' front-info-padding-bottom |' . sanitize_text_field($_POST['front-info-padding-bottom']) . '|'
                . ' front-info-padding-left |' . sanitize_text_field($_POST['front-info-padding-left']) . '|'
                . ' front-info-padding-right |' . sanitize_text_field($_POST['front-info-padding-right']) . '|'
                . ' backend-heading-size |' . sanitize_text_field($_POST['backend-heading-size']) . '|'
                . ' backend-heading-family |' . sanitize_text_field($_POST['backend-heading-family']) . '|'
                . ' backend-heading-style |' . sanitize_text_field($_POST['backend-heading-style']) . '|'
                . ' backend-heading-weight |' . sanitize_text_field($_POST['backend-heading-weight']) . '|'
                . ' backend-heading-text-align |' . sanitize_text_field($_POST['backend-heading-text-align']) . '|'
                . ' backend-heading-padding-top |' . sanitize_text_field($_POST['backend-heading-padding-top']) . '|'
                . ' backend-heading-padding-bottom |' . sanitize_text_field($_POST['backend-heading-padding-bottom']) . '|'
                . ' backend-heading-padding-left |' . sanitize_text_field($_POST['backend-heading-padding-left']) . '|'
                . ' backend-heading-padding-right |' . sanitize_text_field($_POST['backend-heading-padding-right']) . '|'
                . ' custom-css |' . sanitize_text_field($_POST['custom-css']) . '|'
                . '|';
        $data = sanitize_text_field($data);
        $wpdb->query($wpdb->prepare("UPDATE $table_name SET css = %s WHERE id = %d", $data, $styleid));
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
                                                echo oxilab_flip_box_admin_number('flip-border-radius', $styledata[153], '1', 'Border Radius', 'Set your flip Border Radius');
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
                                                echo oxilab_flip_box_admin_color('front-background-color', $styledata[5], 'rgba', 'Background Color', 'Set your Front Background Color', 'background-color', '.oxilab-flip-box-'.$styleid.'');
                                                echo oxilab_flip_box_admin_number_double('front-padding-top', $styledata[71], 'front-padding-left', $styledata[73], 'Padding', 'Set your Front Padding as Top Bottom and Left Right');
                                                ?>    
                                            </div> 
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Icon Settings
                                                </div>  
                                                <?php
                                                echo oxilab_flip_box_admin_number('front-icon-size', $styledata[77], '1', 'Icon Size', 'Set your Icon Font Size');
                                                echo oxilab_flip_box_admin_color('front-icon-color', $styledata[9], '', 'Icon Color', 'Set your Icon Color', 'color', '.oxilab-flip-box-'.$styleid.'-data .oxilab-icon-data [class^=\'fa\']');
                                                echo oxilab_flip_box_admin_number('front-icon-width', $styledata[79], '1', 'Icon width', 'Set your Icon Width and Height Size.');
                                                echo oxilab_flip_box_admin_number_double('front-icon-padding-top-bottom', $styledata[159], 'front-icon-padding-left-right', $styledata[161], 'Icon Padding', 'Set your Icon Padding as Top Bottom and Left Right');
                                                ?> 
                                            </div>
                                        </div>
                                        <div class="oxilab-tabs-content-div-half">
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Heading Settings
                                                </div>
                                                <?php
                                                echo oxilab_flip_box_admin_number('front-heading-size', $styledata[83], '1', 'Font Size', 'Set your front Heading Font Size');
                                                echo oxilab_flip_box_admin_color('front-heading-color', $styledata[13], '', 'Title Color', 'Set your Front Heading Color', 'color', '.oxilab-flip-box-'.$styleid.'-data .oxilab-heading');
                                                echo oxilab_flip_box_admin_font_family('front-heading-family', $styledata[85], 'Font Family', 'Give your Prepared Font from our Google Font List');
                                                echo oxilab_flip_box_admin_font_style('front-heding-style', $styledata[87], 'Font Style', 'Set your Heading Font Style');
                                                echo oxilab_flip_box_admin_font_weight('front-heding-weight', $styledata[89], 'Font Weight', 'Give your Front Heading Font Weight');
                                                echo oxilab_flip_box_admin_text_align('front-heding-text-align', $styledata[91], 'Text Align', 'Give your Heading Text Align');
                                                echo oxilab_flip_box_admin_number_double('front-heding-padding-top', $styledata[93], 'front-heding-padding-bottom', $styledata[95], 'Padding Top Bottom', 'Set Your Heading  Padding Top and Bottom');
                                                echo oxilab_flip_box_admin_number_double('front-heding-padding-left', $styledata[97], 'front-heding-padding-right', $styledata[99], 'Padding Left Right', 'Set Your Heading  Padding Left and Right');
                                                ?> 
                                            </div>
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Information Settings
                                                </div>
                                                <?php
                                                echo oxilab_flip_box_admin_number('front-info-size', $styledata[163], '1', 'Font Size', 'Set your front Info Font Size');
                                                echo oxilab_flip_box_admin_color('front-info-color', $styledata[29], '', 'Text Color', 'Set your Front Heading Color', 'color', '.oxilab-flip-box-'.$styleid.'-data .oxilab-info');
                                                echo oxilab_flip_box_admin_font_family('front-info-family', $styledata[165], 'Font Family', 'Give your Prepared Font from our Google Font List');
                                                echo oxilab_flip_box_admin_font_style('front-info-style', $styledata[167], 'Font Style', 'Set your Info Font Style');
                                                echo oxilab_flip_box_admin_font_weight('front-info-weight', $styledata[169], 'Font Weight', 'Give your Front Info Font Weight');
                                                echo oxilab_flip_box_admin_text_align('front-info-text-align', $styledata[171], 'Text Align', 'Give your Info Text Align');
                                                echo oxilab_flip_box_admin_number_double('front-info-padding-top', $styledata[173], 'front-info-padding-bottom', $styledata[175], 'Padding Top Bottom', 'Set Your Info  Padding Top and Bottom');
                                                echo oxilab_flip_box_admin_number_double('front-info-padding-left', $styledata[177], 'front-info-padding-right', $styledata[179], 'Padding Left Right', 'Set Your Info  Padding Left and Right');
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
                                                echo oxilab_flip_box_admin_color('backend-background-color', $styledata[15], 'rgba', 'Background Color', 'Set your Backend Background Color', 'background-color', '.oxilab-flip-box-back-'.$styleid.'');
                                                echo oxilab_flip_box_admin_number_double('backend-padding-top', $styledata[101], 'backend-padding-left', $styledata[103], 'Padding', 'Set your Backend Padding as Top Bottom and Left Right');
                                                ?>    
                                            </div> 
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Heading Settings
                                                </div>
                                                <?php
                                                echo oxilab_flip_box_admin_number('backend-heading-size', $styledata[181], '1', 'Font Size', 'Set your backend Heading Font Size');
                                                echo oxilab_flip_box_admin_color('backend-title-color', $styledata[31], '', 'Title Color', 'Set your Backend title Color', 'color', '.oxilab-flip-box-back-'.$styleid.'-data .oxilab-heading');
                                                echo oxilab_flip_box_admin_font_family('backend-heading-family', $styledata[183], 'Font Family', 'Give your Prepared Font from our Google Font List');
                                                echo oxilab_flip_box_admin_font_style('backend-heading-style', $styledata[185], 'Font Style', 'Set your Heading Font Style');
                                                echo oxilab_flip_box_admin_font_weight('backend-heading-weight', $styledata[187], 'Font Weight', 'Give your backend Heading Font Weight');
                                                echo oxilab_flip_box_admin_text_align('backend-heading-text-align', $styledata[189], 'Text Align', 'Give your Heading Text Align');
                                                echo oxilab_flip_box_admin_number_double('backend-heading-padding-top', $styledata[191], 'backend-heading-padding-bottom', $styledata[193], 'Padding Top Bottom', 'Set Your backend Heading  Padding Top and Bottom');
                                                echo oxilab_flip_box_admin_number_double('backend-heading-padding-left', $styledata[195], 'backend-heading-padding-right', $styledata[197], 'Padding Left Right', 'Set Your backend Heading  Padding Left and Right');
                                                ?> 
                                            </div>
                                        </div>
                                        <div class="oxilab-tabs-content-div-half">
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Backend Info
                                                </div>  
                                                <?php
                                                echo oxilab_flip_box_admin_number('backend-info-size', $styledata[107], '1', 'Font Size', 'Set your Backend Info Font Size');
                                                echo oxilab_flip_box_admin_color('backend-info-color', $styledata[19], '', 'Text Color', 'Set your Backend Info Color', 'color', '.oxilab-flip-box-back-'.$styleid.'-data .oxilab-info');
                                                echo oxilab_flip_box_admin_font_family('backend-info-family', $styledata[109], 'Font Family', 'Give your Prepared Font from our Google Font List');
                                                echo oxilab_flip_box_admin_font_style('backend-info-style', $styledata[111], 'Font Style', 'Set your Backend Info Font Style');
                                                echo oxilab_flip_box_admin_font_weight('backend-info-weight', $styledata[113], 'Font Weight', 'Give your Backend Info Font Weight');
                                                echo oxilab_flip_box_admin_text_align('backend-info-text-align', $styledata[115], 'Text Align', 'Give your Backend Info Text Align');
                                                echo oxilab_flip_box_admin_number_double('backend-info-padding-top', $styledata[117], 'backend-info-padding-bottom', $styledata[119], 'Padding Top Bottom', 'Set Your Backend Info  Padding Top and Bottom');
                                                echo oxilab_flip_box_admin_number_double('backend-info-padding-left', $styledata[121], 'backend-info-padding-right', $styledata[123], 'Padding Left Right', 'Set Your Backend Info  Padding Left and Right');
                                                ?> 
                                            </div>
                                            <div class="oxilab-tabs-content-div">
                                                <div class="head-oxi">
                                                    Button Settings
                                                </div>
                                                <?php
                                                echo oxilab_flip_box_admin_number('backend-button-size', $styledata[125], '1', 'Font Size', 'Set your Backend Button Font Size');
                                                echo oxilab_flip_box_admin_color('backend-button-color', $styledata[21], '', 'Button Color', 'Set your Backend Button Color', 'color', '.oxilab-flip-box-back-'.$styleid.'-data .oxilab-button-data');
                                                echo oxilab_flip_box_admin_color('backend-button-background', $styledata[23], 'rgba', 'Buton Background', 'Set your Backend Button Background Color', 'background-color', '.oxilab-flip-box-back-'.$styleid.'-data .oxilab-button-data');
                                                echo oxilab_flip_box_admin_color('backend-button-hover-color', $styledata[25], '', 'Button Hover', 'Set your Backend Button Hover Color', 'color', '.oxilab-flip-box-back-'.$styleid.'-data .oxilab-button-data:hover');
                                                echo oxilab_flip_box_admin_color('backend-button-hover-background', $styledata[27], 'rgba', 'Button Hover Background', 'Set your Backend Button Hover Background Color', 'background-color', '.oxilab-flip-box-back-'.$styleid.'-data .oxilab-button-data:hover');
                                                echo oxilab_flip_box_admin_font_family('backend-button-family', $styledata[127], 'Font Family', 'Give your Prepared Font from our Google Font List');
                                                echo oxilab_flip_box_admin_font_style('backend-button-style', $styledata[129], 'Font Style', 'Set your Backend Button Font Style');
                                                echo oxilab_flip_box_admin_font_weight('backend-button-weight', $styledata[131], 'Font Weight', 'Give your Backend Button Font Weight');
                                                echo oxilab_flip_box_admin_number_double('backend-button-info-padding-top', $styledata[133], 'backend-button-info-padding-left', $styledata[135], 'Padding', 'Set Your Backend Button Padding Top Bottom and left Right');
                                                echo oxilab_flip_box_admin_number('backend-button-border-radius', $styledata[137], '1', 'Border Radius', 'Set your Backend Button Border Radius');
                                                echo oxilab_flip_box_admin_text_align('backend-button-text-align', $styledata[139], 'Text Align', 'Give your Backend Button Text Align');
                                                echo oxilab_flip_box_admin_number_double('backend-info-margin-top', $styledata[141], 'backend-info-margin-bottom', $styledata[143], 'Margin Top Bottom', 'Set Your Backend Info Margin Top and Bottom');
                                                echo oxilab_flip_box_admin_number_double('backend-info-margin-left', $styledata[145], 'backend-info-margin-right', $styledata[147], 'Margin Left Right', 'Set Your Backend Info Margin Left and Right');
                                                ?> 
                                            </div>                                                                                       
                                        </div>
                                    </div>
                                    <div class="oxilab-tabs-content-tabs" id="oxilab-tabs-id-2">
                                        <br>
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label for="custom-css" class="custom-css">Custom CSS:</label>
                                                <textarea class="form-control" rows="4" id="custom-css" name="custom-css"><?php echo $styledata[199]; ?></textarea>
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
                                        echo '<li class="list-group-item" id ="' . $value['id'] . '">' . $data[1] . '</li>';
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
                                echo oxilab_flip_box_admin_input_text('flip-box-front-title', $editdata[1], 'Front Title', 'Add your flip front title.');
                                echo oxilab_flip_box_admin_input_text_area('flip-box-font-desc', $editdata[15], 'Font Info:', 'Add font Info text unless make it blank.');
                                echo oxilab_flip_box_admin_input_text('flip-box-front-icons', $editdata[3], 'Front Icon', 'Add your front icon, Use Font-Awesome class name. As example fab fa-facebook');
                                ?>
                                <div class="form-group">
                                    <label for="flip-box-image-upload-url-01"> Front Background Image</label>
                                    <div class="col-xs-12-div">
                                        <div class="col-md-8 col-xs-6" style="padding-left: 0px;">
                                            <input type="text "class="form-control" name="flip-box-image-upload-url-01" id="flip-box-image-upload-url-01"  value="<?php echo $editdata[5]; ?>">
                                        </div>
                                        <div class="col-md-4 col-xs-6">
                                            <button type="button" id="flip-box-image-upload-button-01" class="btn btn-default">Upload Image</button>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Add or modify your front Background Image Unless make it blank.</small>
                                </div>                                  
                            </div>
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Backend Settings</h4>
                            </div>
                            <div class="modal-body">
                                <?Php
                                echo oxilab_flip_box_admin_input_text('flip-box-backend-title', $editdata[17], 'Backend Title', 'Add your flip backend title.');
                                echo oxilab_flip_box_admin_input_text_area('flip-box-backend-desc', $editdata[7], 'Backend Info:', 'Add backend Info text unless make it blank.');
                                echo oxilab_flip_box_admin_input_text('flip-box-backend-button-text', $editdata[9], 'Backend Button Text', 'Add your backend button text.');
                                echo oxilab_flip_box_admin_input_text('flip-box-backend-link', $editdata[11], 'Link', 'Add your desire link or url unless make it blank');
                                ?>  
                                <div class="form-group">
                                    <label for="flip-box-image-upload-url-02"> Backend Background Image</label>
                                    <div class="col-xs-12-div">
                                        <div class="col-md-8 col-xs-6" style="padding-left: 0px;">
                                            <input type="text "class="form-control" name="flip-box-image-upload-url-02" id="flip-box-image-upload-url-02"  value="<?php echo $editdata[13]; ?>">
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