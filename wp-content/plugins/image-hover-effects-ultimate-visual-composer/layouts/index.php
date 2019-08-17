<?php
if (!defined('ABSPATH'))
    exit;
oxilab_flip_box_user_capabilities();
if (!empty($_REQUEST['_wpnonce'])) {
    $nonce = $_REQUEST['_wpnonce'];
}
global $wpdb;
$table_name = $wpdb->prefix . 'oxi_div_style';
$table_import = $wpdb->prefix . 'oxi_div_import';
$table_list = $wpdb->prefix . 'oxi_div_list';
$oxitype = 'flip';

if (!empty($_POST['oxilab-flip-box-import']) && $_POST['oxilab-flip-box-import'] != '') {
    if (!wp_verify_nonce($nonce, 'oxilab_flip_box_new_style_deactive')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $oxitabsimport = sanitize_text_field($_POST['oxilab-flip-box-import']);
        $wpdb->query($wpdb->prepare("DELETE FROM {$table_import} WHERE name = %d ", $oxitabsimport));
    }
}

if (!empty($_POST['submit']) && $_POST['submit'] == 'Save') {
    if (!wp_verify_nonce($nonce, 'oxilab_flip_box_new_style_select')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $oxilab_flip_box_style = sanitize_text_field($_POST['oxilab-flip-box-style']);
        $oxilab_flip_box_name = sanitize_text_field($_POST['style-name']);
        $oxilab_flip_box_data = sanitize_text_field($_POST['oxilab-flip-box-data']);
        $wpdb->query($wpdb->prepare("INSERT INTO {$table_name} (name, style_name, type, css) VALUES ( %s, %s, %s, %s )", array($oxilab_flip_box_name, $oxilab_flip_box_style, $oxitype, $oxilab_flip_box_data)));
        $redirect_id = $wpdb->insert_id;
        if ($redirect_id == 0) {
            $url = admin_url("admin.php?page=oxilab-flip-box-admin-new");
        }
        if ($redirect_id != 0) {
            $oxilabflipboxfiles = sanitize_text_field($_POST['oxilab-flip-box-files']);
            $wpdb->query($wpdb->prepare("INSERT INTO {$table_list} (styleid, files) VALUES ( %d, %s)", array($redirect_id, $oxilabflipboxfiles)));
            $url = admin_url("admin.php?page=oxilab-flip-box-admin-new&styleid=$redirect_id");
        }
        echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
        exit;
    }
}


$importdata = $wpdb->get_results("SELECT * FROM $table_import WHERE type='flip' ORDER BY CAST($table_import.name AS UNSIGNED INTEGER) ASC", ARRAY_A);
?>
<div class="wrap">
    <?php echo oxilab_flip_box_admin_head(); ?>
    <div class="oxilab-admin-wrapper">
        <div class="oxilab-admin-row">
            <h1> Select Layouts</h1>
            <p> View our layouts and select from button with name</p>
        </div>
        <div class="oxilab-admin-row">
            <?php
            foreach ($importdata as $value) {
                $importvalye[$value['name']] = $value['name'];
            }
            foreach ($importvalye as $value) {
                $stylesrtid = $value;
                echo '<div class="oxilab-admin-style-preview" id="style' . $value . '">
                        <div class="oxilab-admin-style-preview-top">';
                include oxilab_flip_box_url . 'layouts/style' . $value . '.php';
                echo '</div>';
                echo '<div class="oxilab-admin-style-preview-bottom">
                        <div class="oxilab-admin-style-preview-bottom-left">
                            Template ' . $stylesrtid . '
                        </div>        
                        <div class="oxilab-admin-style-preview-bottom-right">
                              <button type="button" class="btn btn-warning oxilab-flip-box-style-deactive" flipid="' . $stylesrtid . '">Deactive</button>
                              <button type="button" class="btn btn-success oxilab-flip-box-style-create" flipid="' . $stylesrtid . '">Create New</button>
                        </div>
                     </div>';
                echo ' </div>';
            }
            ?>
            <div class="oxilab-admin-style-preview">
                <div class="oxilab-admin-style-preview-top">
                    <a href="<?php echo admin_url("admin.php?page=oxilab-flip-box-admin-import"); ?>">
                        <div class="oxilab-admin-add-new-item">
                            <span>
                                <?php echo FlipBoxesImageAdFontAwesome('plus'); ?>
                                Add More Templates
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
    wp_add_inline_script('oxilab-bootstrap', 'jQuery(\'[data-toggle="tooltip"]\').tooltip();');
    wp_add_inline_script('oxilab-bootstrap', 'jQuery(".oxilab-flip-box-style-deactive").click(function () {
                                                                    var status = confirm("Do you Want to Deactive?");
                                                                    if (status == false) {
                                                                        return false;
                                                                    } else {
                                                                        var data = jQuery(this).attr("flipid");
                                                                        jQuery("#oxilab-flip-box-import").val(data);
                                                                        jQuery("form#oxilab-flip-box-import-data").submit();
                                                                    }                                
                                                            });
                                                            jQuery(".oxilab-flip-box-style-create").on("click", function () {
                                                                 var id = jQuery(this).attr("flipid");
                                                                 jQuery("#oxilab-flip-box-style-id").val(id);
                                                                 jQuery("#style-name").val("");      
                                                                 jQuery("#oxilab-flip-box-files-id").val(1);  
                                                                 jQuery("#style-files-id .btn").removeClass("active");
                                                                 jQuery("#style-files-id .btn:first-child").addClass("active");                                                                 
                                                                 jQuery("#oxilab-flip-box-style").val("style"+id);
                                                                 jQuery("#oxilab-flip-box-style-model").modal("show")                                                                 
                                                             });
                                                             jQuery("#oxilab-flip-box-create-submit").submit(function (){
                                                                    var id = jQuery("#oxilab-flip-box-style-id").val();
                                                                    var dataid = jQuery("#oxilab-flip-box-files-id").val();
                                                                    if (id !== "") {
                                                                        var styledata = jQuery("#oxilab-flip-box-data-" + id + "-" + dataid + "").val();
                                                                        var listdata = jQuery("#oxilab-flip-box-files-" + id + "-" + dataid + "").val();
                                                                       jQuery("#oxilab-flip-box-data").val(styledata);
                                                                        jQuery("#oxilab-flip-box-files").val(listdata);   
                                                                    } else {
                                                                        return false;
                                                                    }
                                                                });
                                                                jQuery("#style-files-id input[type=radio]").change(function () {
                                                                    jQuery("#oxilab-flip-box-files-id").val(jQuery(this).val());
                                                                })');
    ?>
    <form method="post" id="oxilab-flip-box-import-data">
        <input type="hidden" name="oxilab-flip-box-import" id="oxilab-flip-box-import" value="">
        <?php wp_nonce_field("oxilab_flip_box_new_style_deactive") ?>
    </form>
    <div class="modal fade" id="oxilab-flip-box-style-model" >
        <form method="post" id="oxilab-flip-box-create-submit">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Flip Settings</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row form-group-sm">
                            <label for="style" class="col-sm-6 col-form-label"  data-toggle="tooltip" class="tooltipLink" data-original-title="Give Your Template Name">Name</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" value="" id='style-name'  name="style-name">
                            </div>
                        </div>
                        <div class="form-group row form-group-sm">
                            <label for="style" class="col-sm-6 col-form-label"  data-toggle="tooltip" class="tooltipLink" data-original-title="Select Demo Data">Layouts Data</label>
                            <div class="col-sm-6">
                                <div class="btn-group" id="style-files-id" data-toggle="buttons">
                                    <label class="btn btn-cyan active form-check-label">
                                        <input name="style-files-id" value="1" class="form-check-input" type="radio" checked autocomplete="off"> 1st
                                    </label>
                                    <label class="btn btn-cyan form-check-label">
                                        <input name="style-files-id" value="2" class="form-check-input" type="radio" autocomplete="off"> 2nd
                                    </label>
                                    <label class="btn btn-cyan form-check-label">
                                        <input name="style-files-id" value="3" class="form-check-input" type="radio" autocomplete="off"> 3rd
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">                        
                        <input type="hidden" name="oxilab-flip-box-style-id" id="oxilab-flip-box-style-id" value="">
                        <input type="hidden" name="oxilab-flip-box-files-id" id="oxilab-flip-box-files-id" value="">
                        <input type="hidden" name="oxilab-flip-box-style" id="oxilab-flip-box-style" value="">
                        <input type="hidden" name="oxilab-flip-box-data" id="oxilab-flip-box-data" value="">
                        <input type="hidden" name="oxilab-flip-box-files" id="oxilab-flip-box-files" value="">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="submit" value="Save">
                        <?php wp_nonce_field("oxilab_flip_box_new_style_select") ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>