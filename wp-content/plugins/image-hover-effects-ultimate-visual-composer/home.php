<?php
if (!defined('ABSPATH'))
    exit;
oxilab_flip_box_user_capabilities();
$oxitype = 'flip';
global $wpdb;
$table_name = $wpdb->prefix . 'oxi_div_style';
if (!empty($_REQUEST['_wpnonce'])) {
    $nonce = $_REQUEST['_wpnonce'];
}
if (!empty($_POST['export']) && is_numeric($_POST['id'])) {
    if (!wp_verify_nonce($nonce, 'oxilab_flip_box_home_export')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        global $wpdb;
        $id = (int) $_POST['id'];
        $table_name = $wpdb->prefix . 'oxi_div_style';
        $table_list = $wpdb->prefix . 'oxi_div_list';
        $style = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $id), ARRAY_A);
        $files = $wpdb->get_results("SELECT * FROM $table_list WHERE styleid = '$id' ORDER BY id ASC", ARRAY_A);
        $importdata = 'oxilab-flip-box-admin-newOxiAddonsImportAddons';
        $importdata .= $style['name'] . '|||OxiAddonsImport|||';
        $importdata .= $style['type'] . '|||OxiAddonsImport|||';
        $importdata .= $style['style_name'] . '|||OxiAddonsImport|||';
        $importdata .= $style['css'];
        $importdata .= 'OxiAddonsImportAddons';
        foreach ($files as $value) {
            $importdata .= $value['type'] . '|||OxiAddonsImport|||';
            $importdata .= $value['files'] . '|||OxiAddonsImport|||';
            $importdata .= $value['css'];
            $importdata .= '|||OxiAddonsImportFiles|||';
        }

        $jQuery = 'setTimeout(function () {
                       jQuery("#oxi-addons-style-export-data").modal("show"); 
                    }, 500);
                    jQuery(".OxiAddImportDatacontent").on("click", function () {
                        jQuery("#OxiAddImportDatacontent").select();
                        document.execCommand("copy"); 
                        alert("Your Style Data Copied")
                        jQuery("#oxi-addons-style-export-data").modal("hide"); 
                    })';
        wp_add_inline_script('oxilab-bootstrap-js', $jQuery);
        if (is_plugin_active('shortcode-addons/index.php')) {
            $addonsimport = '<div class="alert alert-success">
                                    Thank you, Import your data at <strong>Import Style</strong> menu.Paste your data and Saved it.
                              </div>';
        } else {
            $addonsimport = '<div class="alert alert-danger">
                                Kindly install <a href="https://wordpress.org/plugins/shortcode-addons/" target="_blank"><strong>Shortcode addons</strong></a> for import Flip Box data. At free version also works to import Style Data. You can also import style from demo layouts at Shortcode Addons Import Style..
                            </div>';
        }
        echo '<div class="modal fade" id="oxi-addons-style-export-data" >
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">      
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Export Data</h4>
                            </div>
                            <div class="modal-body">
                                 ' . $addonsimport . '
                                 <textarea style="width:100%; min-height:250px" id="OxiAddImportDatacontent" class="oxi-addons-export-data-code">' . $importdata . '</textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-info OxiAddImportDatacontent")">Copy</button>
                            </div>
                        </div>
                    </div>
                </div>';
    }
}
if (!empty($_POST['delete']) && is_numeric($_POST['id'])) {
    if (!wp_verify_nonce($nonce, 'oxilab_flip_box_home_delete')) {
        die('You do not have sufficient permissions to access this page.');
    } else {
        global $wpdb;
        $id = (int) $_POST['id'];
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %d", $id));
    }
}
$data = $wpdb->get_results("SELECT * FROM {$table_name} WHERE type='flip' ORDER BY id DESC", ARRAY_A);

wp_add_inline_script('oxilab-bootstrap-js', '
                                    jQuery(".oxilab-style-delete").submit(function () {
                                        var status = confirm("Do you Want to Delete?");
                                        if (status == false) {
                                            return false;
                                        } else {
                                            return true;
                                        }
                                    });')
?>
<div class="wrap">
    <?php echo oxilab_flip_box_admin_head(); ?>
    <div class="oxilab-admin-wrapper table-responsive">
        <div class="oxilab-admin-row">
            <h1>Flip boxes and image Overlay <a href="<?php echo admin_url("admin.php?page=oxilab-flip-box-admin-new"); ?>" class="btn btn-primary"> Add New</a></h1>
            <br>
            <?php
            if (count($data) == 0) {
                ?>
                <div class="oxilab-admin-style-preview">
                    <div class="oxilab-admin-style-preview-top">
                        <a href="<?php echo admin_url("admin.php?page=oxilab-flip-box-admin-new"); ?>">
                            <div class="oxilab-admin-add-new-item">
                                <span>
                                    <?php echo FlipBoxesImageAdFontAwesome('plus'); ?>
                                    Create Your First Flip
                                </span>
                            </div>
                        </a>
                    </div>
                </div>

                <?php
            } else {
                ?>
                <table class="table table-hover widefat " style="background-color: #fff; border: 1px solid #ccc">
                    <thead>
                        <tr>
                            <th style="width: 11%">ID</th>
                            <th style="width: 10%">Name</th>
                            <th style="width: 13%">Template</th>
                            <th style="width: 42%">Shortcode</th>
                            <th style="width: 25%">Edit Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $value) {
                            $id = $value['id'];
                            echo ' <tr>';
                            echo ' <td>' . $id . '</td>';
                            echo '  <td >' . $value['name'] . '</td>';
                            echo ' <td >' . str_replace("_", " ", $value['style_name']) . '</td>';
                            echo '<td ><span>Shortcode <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="[oxilab_flip_box id=&quot;' . $id . '&quot;]"></span>'
                            . '<br><span>Php Code <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode(&#039;[oxilab_flip_box  id=&quot;' . $id . '&quot;]&#039;); ?&gt;"></span></td>';
                            echo '<td >
                                    <form method="post">
                                        ' . wp_nonce_field("oxilab_flip_box_home_export") . '
                                        <input type="hidden" name="id" value="' . $id . '">
                                        <button class="btn btn-success" title="Export Style" style="float:left; margin-right: 5px; margin-left: 5px;"  type="submit" value="export" name="export">Export</button>
                                    </form>                                   
                                    <a href="' . admin_url("admin.php?page=oxilab-flip-box-admin-new&styleid=$id") . '"  title="Edit"  class="btn btn-info" style="float:left; margin-right: 5px; margin-left: 5px;">Edit</a>
                                    <form method="post" class="oxilab-style-delete">
                                            ' . wp_nonce_field("oxilab_flip_box_home_delete") . '
                                            <input type="hidden" name="id" value="' . $id . '">
                                            <button class="btn btn-danger" style="float:left"  title="Delete"  type="submit" value="delete" name="delete">Delete</button>  
                                    </form>
                                   
                             </td>';
                            echo ' </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

