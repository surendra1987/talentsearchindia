<?php
if (!defined('ABSPATH'))
    exit;
oxilab_flip_box_user_capabilities();
if (!empty($_REQUEST['_wpnonce'])) {
    $nonce = $_REQUEST['_wpnonce'];
}
global $wpdb;
$table_import = $wpdb->prefix . 'oxi_div_import';
$oxitype = 'flip';
if (!empty($_POST['oxilab-flip-box-import']) && $_POST['oxilab-flip-box-import'] != '') {
    if (!wp_verify_nonce($nonce, 'oxilab_flip_box_new_style_active')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        $oxilab_flip_box_import = (int) $_POST['oxilab-flip-box-import'];
        $wpdb->query($wpdb->prepare("INSERT INTO {$table_import} (name, type) VALUES ( %s, %s)", array($oxilab_flip_box_import, $oxitype)));
        $redirect_id = $wpdb->insert_id;
        if ($redirect_id == 0) {
            $url = admin_url("admin.php?page=oxilab-flip-box-admin-new");
        }
        if ($redirect_id != 0) {
            $url = admin_url("admin.php?page=oxilab-flip-box-admin-new#style$oxilab_flip_box_import");
        }
        echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
        exit;
    }
}
$status = get_option('oxilab_flip_box_license_status');
$importdata = $wpdb->get_results("SELECT * FROM $table_import WHERE type='flip' ORDER BY CAST($table_import.name AS UNSIGNED INTEGER) ASC", ARRAY_A);
?>
<div class="wrap">
    <?php echo oxilab_flip_box_admin_head();?>
    <div class="oxilab-admin-wrapper">
        <div class="oxilab-admin-row">
            <h1> Select Layouts</h1>
            <p> View our layouts and select from button with name</p>
        </div>
        <div class="oxilab-admin-row">
            <?php
            $directory = oxilab_flip_box_url . '/layouts/';
            $filecount = 0;
            $files = glob($directory . "*.{php}", GLOB_BRACE);
            if ($files) {
                $filecount = count($files);
            }
            $filecount = $filecount - 2;
            for ($i = 1; $i <= $filecount; $i++) {
                $importname = $i;
                $importstatus = '';
                foreach ($importdata as $value) {
                    if ($importname == $value['name']) {
                        $importstatus = 'true';
                    }
                }
                if ($importstatus != 'true') {
                    echo '<div class="oxilab-admin-style-preview">
                        <div class="oxilab-admin-style-preview-top">';
                    include oxilab_flip_box_url . 'layouts/style' . $i . '.php';
                    echo '</div>';
                    echo '<div class="oxilab-admin-style-preview-bottom">
                        <div class="oxilab-admin-style-preview-bottom-left-import">
                            Template ' . $i . '
                        </div>';
                    if($status != 'valid' & $i > 10){
                        echo '<div class="oxilab-admin-style-preview-bottom-right-import">
                                    <button type="button" class="btn btn-danger">Pro Only</button>
                              </div>';
                        
                    } else {
                        echo '<div class="oxilab-admin-style-preview-bottom-right-import">
                                    <input type="hidden" value="" id="oxilab-flip-box-data-' . $i . '">
                                    <button type="button" class="btn btn-success" id="oxilab-flip-box-style-active-' . $i . '">Active</button>
                              </div>';
                    }
                    echo ' </div> </div>
                        <script type="text/javascript">
                                jQuery(document).ready(function () {
                                    jQuery("#oxilab-flip-box-style-active-' . $i . '").click(function () {
                                        jQuery("#oxilab-flip-box-import").val("' . $i . '");
                                        jQuery("form#oxilab-flip-box-import-data").submit();
                                    });
                                });
                        </script>';
                }
            }
            ?>
        </div>
    </div>
    <form method="post" id="oxilab-flip-box-import-data">
        <input type="hidden" name="oxilab-flip-box-import" id="oxilab-flip-box-import" value="">
        <?php wp_nonce_field("oxilab_flip_box_new_style_active") ?>
    </form>
</div>