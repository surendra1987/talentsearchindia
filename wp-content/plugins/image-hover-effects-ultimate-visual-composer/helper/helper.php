<?php
global $wpdb;
$table_name = $wpdb->prefix . 'oxi_div_style';
if (!empty($_REQUEST['_wpnonce'])) {
    $nonce = $_REQUEST['_wpnonce'];
    if (!empty($_POST['flipboxrenamechange']) && $_POST['flipboxrenamechange'] == 'Save') {
        if (!wp_verify_nonce($nonce, 'flipbox-oxi-rename-change')) {
            die('You do not have sufficient permissions to access this page.');
        } else {
            $styleid = (int) $_POST['flipboxrenameid'];
            $name = sanitize_text_field($_POST['flipboxrenametext']);
            $wpdb->query($wpdb->prepare("UPDATE $table_name SET name = %s WHERE id = %d", $name, $styleid));
        }
    }
}


function oxilab_flip_box_admin_shortcode($id) {
    echo '<div class="oxilab-shortcode">
                <div class="oxilab-shortcode-heading">
                    Shortcodes
                </div>
                <div class="oxilab-shortcode-body">
                    <em>Shortcode for posts/pages/plugins</em>
                    <p>Copy &amp; paste the shortcode directly into any WordPress post or page.</p>
                    <input type="text" class="form-control" onclick="this.setSelectionRange(0, this.value.length)" value="[oxilab_flip_box id=&quot;' . $id . '&quot;]">
                    <span></span>
                    <em>Shortcode for templates/themes</em>
                    <p>Copy &amp; paste this code into a template file to include the slideshow within your theme.</p>
                    <input type="text" class="form-control" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode(&#039;[oxilab_flip_box  id=&quot;' . $id . '&quot;]&#039;); ?&gt;">
                    <span></span>
                    <em>Apply on Visual Composer</em>
                    <p>Go on Visual Composer and get Our element on Content bar as Flip Box</p>
                </div>
            </div>
        <div class="oxilab-admin-item-panel" style="margin-bottom:10px">
            <div class="oxilab-shortcode-heading">
                Quick Tutorials
            </div>
            <a class="oxilab-admin-add-new-item oxi-addons-tutorials" youtubeid="OaLL0DNUHWA">
                <span>
                    ' . FlipBoxesImageAdFontAwesome('youtube') . '
                </span>
            </a>
        </div>    
        ';
}

function oxilab_flip_box_admin_rearrange() {
    echo '<div class="oxilab-admin-item-panel">
                <div class="oxilab-admin-add-new-headding">
                    Flip Rearrange
                </div>
                <div class="oxilab-admin-add-new-item" id="oxilab-drag-and-drop">
                    <span>
                        ' . FlipBoxesImageAdFontAwesome('cogs') . '
                    </span>

                </div>
            </div>';
}

function oxilab_flip_box_admin_rename($style) {
    ?>
    <div class="oxilab-shortcode">
        <div class="oxilab-shortcode-heading">
            Rename Flipbox
        </div>
        <div class="oxilab-shortcode-body">
            <form method="post">
                <div class="input-group mb-3" style="display: inline-flex;">
                    <input type="hidden" class="form-control" name="flipboxrenameid" value="<?php echo $style['id']; ?>">
                    <input type="text" class="form-control" style="width: calc(100% - 60px);" name="flipboxrenametext" value="<?php echo $style['name']; ?>">
                    <div class="input-group-append" style="margin-left:5px">
                        <input type="submit" class="btn btn-success" name="flipboxrenamechange" value="Save">
                    </div>
                </div>
                <?php echo wp_nonce_field('flipbox-oxi-rename-change'); ?>
            </form>
        </div>
    </div>
    <?php
}

function oxilab_flip_box_admin_support() {
    ?>
    <div class="ihewc-admin-style-settings-div-css">
        <div class="col-xs-12">                                           
            <a href="https://www.oxilab.org/docs/flip-boxes-and-image-overlay/getting-started/installing-for-the-first-time/" target="_blank">
                <div class="col-xs-support-ihewc">
                    <div class="ihewc-admin-support-icon">
                        <?php echo FlipBoxesImageAdFontAwesome('file'); ?>
                    </div>  
                    <div class="ihewc-admin-support-heading">
                        Read Our Docs
                    </div> 
                    <div class="ihewc-admin-support-info">
                        Learn how to set up and using Flipbox - Awesomes Flip Boxes Image Overlay
                    </div> 
                </div>
            </a>
            <a href="https://wordpress.org/support/plugin/image-hover-effects-ultimate-visual-composer" target="_blank">
                <div class="col-xs-support-ihewc">
                    <div class="ihewc-admin-support-icon">
                        <?php echo FlipBoxesImageAdFontAwesome('users'); ?>
                    </div>  
                    <div class="ihewc-admin-support-heading">
                        Support
                    </div> 
                    <div class="ihewc-admin-support-info">
                        Powered by WordPress.org, Issues resolved by Plugins Author.
                    </div> 
                </div>
            </a>
            <a href="https://www.youtube.com/watch?v=OaLL0DNUHWA" target="_blank">
                <div class="col-xs-support-ihewc">
                    <div class="ihewc-admin-support-icon">
                        <?php echo FlipBoxesImageAdFontAwesome('tickets'); ?>
                    </div>  
                    <div class="ihewc-admin-support-heading">
                        Video Tutorial 
                    </div> 
                    <div class="ihewc-admin-support-info">
                        Watch our Using Video Tutorial in Youtube.
                    </div> 
                </div>
            </a>
        </div>
    </div> 
    <?php
}

function oxilab_flip_box_admin_add_new() {
    echo '<div class="oxilab-admin-item-panel">
            <div class="oxilab-admin-add-new-headding">
                Add New
            </div>
            <div class="oxilab-admin-add-new-item" id="oxilab-admin-add-new-item">
                <span>
                    ' . FlipBoxesImageAdFontAwesome('plus') . '
                    Add new Flip
                </span>
            </div>
        </div>';
}

function oxilab_flip_box_admin_input_text($id, $value, $name, $title) {
    ?>
    <div class="form-group">
        <label for="<?php echo $id; ?>"><?php echo $name; ?></label>
        <input type="text "class="form-control" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo oxilab_flip_box_admin_special_charecter($value); ?>">
        <small class="form-text text-muted"><?php echo $title; ?></small>
    </div>
    <?php
}

function oxilab_flip_box_admin_input_text_area($id, $value, $name, $title) {
    ?>
    <div class="form-group">
        <label for="<?php echo $id; ?>"><?php echo $name; ?></label>
        <textarea class="form-control" rows="4" id="<?php echo $id; ?>" name="<?php echo $id; ?>"><?php echo oxilab_flip_box_admin_special_charecter($value); ?></textarea>
        <small class="form-text text-muted"><?php echo $title; ?></small>
    </div>
    <?php
}

function oxilab_flip_box_admin_number($id, $value, $step, $name, $title) {
    ?>
    <div class="form-group row form-group-sm">
        <label for="<?php echo $id; ?>" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-6">
            <input class="form-control" type="number" step="<?php echo $step; ?>" value="<?php echo $value; ?>" id="<?php echo $id; ?>" name="<?php echo $id; ?>">
        </div>
    </div>
    <?php
}

function oxilab_flip_box_admin_number_double($frist_id, $first_value, $second_id, $second_value, $name, $title) {
    ?>
    <div class="form-group row form-group-sm">
        <label for="<?php echo $frist_id; ?>" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-3">
            <input class="form-control" type="number"  min="0" value="<?php echo $first_value; ?>" id="<?php echo $frist_id; ?>" name="<?php echo $frist_id; ?>">
        </div>
        <div class="col-sm-3">
            <input class="form-control" type="number"  min="0" value="<?php echo $second_value; ?>" id="<?php echo $second_id; ?>" name="<?php echo $second_id; ?>">
        </div>
    </div>
    <?php
}

function oxilab_flip_box_admin_color($id, $value, $type, $name, $title, $exporttype, $exportid) {
    if ($type == 'rgba') {
        $colortype = 'data-format="rgb" data-opacity="true"';
    } else {
        $colortype = '';
    }
    ?>
    <div class="form-group row form-group-sm">
        <label for="<?php echo $id; ?>" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-6">
            <input type="text" <?php echo $colortype; ?> class="form-control oxilab-vendor-color" oxiexporttype="<?php echo $exporttype; ?>" oxiexportid="<?php echo $exportid; ?>" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $value; ?>">
        </div>
    </div>

    <?php
}

function oxilab_flip_box_admin_font_family($id, $value, $name, $title) {
    ?>
    <div class="form-group row form-group-sm">
        <label for="<?php echo $id; ?>" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-6">
            <input class="form-control oxilab-admin-font" type="text" value="<?php echo $value; ?>" id="<?php echo $id; ?>" name="<?php echo $id; ?>">
        </div>
    </div>
    <?php
}

function oxilab_flip_box_admin_true_false($id, $value, $fristname, $fristvalue, $Secondname, $Secondvalue, $name, $title) {
    ?>
    <div class="form-group row">
        <label class="col-sm-6 control-label"  data-toggle="tooltip" data-placement="top" title="<?php echo $title; ?>"><?php echo $name; ?></label>
        <div class="col-sm-6">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary <?php
                if ($fristvalue == $value) {
                    echo 'active';
                }
                ?>"> <input type="radio" <?php
                           if ($fristvalue == $value) {
                               echo 'checked';
                           }
                           ?> name="<?php echo $id; ?>" id="<?php echo $id; ?>-yes" autocomplete="off" value="<?php echo $fristvalue; ?>"><?php echo $fristname; ?></label>
                <label class="btn btn-primary <?php
                if ($Secondvalue == $value) {
                    echo 'active';
                }
                ?>"> <input type="radio" <?php
                           if ($Secondvalue == $value) {
                               echo 'checked';
                           }
                           ?> name="<?php echo $id; ?>" id="<?php echo $id; ?>-no"  autocomplete="off" value="<?php echo $Secondvalue; ?>"><?php echo $Secondname; ?> </label>
            </div>
        </div>
    </div>
    <?php
}

function oxilab_flip_box_admin_font_weight($id, $value, $name, $title) {
    ?>
    <div class="form-group row form-group-sm">
        <label for="<?php echo $id; ?>" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-6">
            <select class="form-control" id="<?php echo $id; ?>" name="<?php echo $id; ?>">
                <option value="100" <?php
                if ($value == '100') {
                    echo 'selected';
                };
                ?>>100</option>
                <option value="200" <?php
                if ($value == '200') {
                    echo 'selected';
                };
                ?>>200</option>
                <option value="300" <?php
                if ($value == '300') {
                    echo 'selected';
                };
                ?>>300</option>
                <option value="400" <?php
                if ($value == '400') {
                    echo 'selected';
                };
                ?>>400</option>
                <option value="500" <?php
                if ($value == '500') {
                    echo 'selected';
                };
                ?>>500</option>
                <option value="600" <?php
                if ($value == '600') {
                    echo 'selected';
                };
                ?>>600</option>
                <option value="700" <?php
                if ($value == '700') {
                    echo 'selected';
                };
                ?>>700</option>
                <option value="800" <?php
                if ($value == '800') {
                    echo 'selected';
                };
                ?>>800</option>
                <option value="900" <?php
                if ($value == '900') {
                    echo 'selected';
                };
                ?>>900</option>
                <option value="normal" <?php
                if ($value == 'normal') {
                    echo 'selected';
                };
                ?>>Normal</option>
                <option value="bold" <?php
                if ($value == 'bold') {
                    echo 'selected';
                };
                ?>>Bold</option>
                <option value="lighter" <?php
                if ($value == 'lighter') {
                    echo 'selected';
                };
                ?>>Lighter</option>
                <option value="initial" <?php
                if ($value == 'initial') {
                    echo 'selected';
                };
                ?>>Initial</option>
            </select>
        </div>
    </div>
    <?php
}

function oxilab_flip_box_admin_font_style($id, $value, $name, $title) {
    ?>
    <div class="form-group row form-group-sm">
        <label for="<?php echo $id; ?>" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-6">
            <select class="form-control" id="<?php echo $id; ?>" name="<?php echo $id; ?>">
                <option <?php
                if ($value == 'normal') {
                    echo 'selected';
                }
                ?> value="normal">Normal</option>
                <option <?php
                if ($value == 'italic') {
                    echo 'selected';
                }
                ?> value="italic">Italic</option>
                <option <?php
                if ($value == 'oblique') {
                    echo 'selected';
                }
                ?> value="oblique">Oblique</option>
                <option <?php
                if ($value == 'initial') {
                    echo 'selected';
                }
                ?> value="initial">Initial</option>
                <option <?php
                if ($value == 'inherit') {
                    echo 'selected';
                }
                ?> value="inherit">Inherit</option>
            </select>
        </div>
    </div>
    <?php
}

function oxilab_flip_box_admin_text_align($id, $value, $name, $title) {
    ?>
    <div class="form-group row form-group-sm">
        <label for="<?php echo $id; ?>" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-6">
            <select class="form-control" id="<?php echo $id; ?>" name="<?php echo $id; ?>">
                <option value="left" <?php
                if ($value == 'left') {
                    echo 'selected';
                }
                ?>>Left</option>
                <option value="Center" <?php
                if ($value == 'Center') {
                    echo 'selected';
                }
                ?>>Center</option>
                <option value="Right" <?php
                if ($value == 'Right') {
                    echo 'selected';
                }
                ?>>Right</option>
            </select>
        </div>
    </div>
    <?php
}

function oxilab_flip_box_admin_border($border_size, $border_size_value, $border_type, $border_type_value, $name, $title) {
    ?>
    <div class="form-group row form-group-sm">
        <label for="<?php echo $border_size; ?>" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-3">
            <input class="form-control" type="number"  min="0" value="<?php echo $border_size_value; ?>" id="<?php echo $border_size; ?>" name="<?php echo $border_size; ?>">
        </div>

        <div class="col-sm-3">
            <select class="form-control" id="<?php echo $border_type; ?>" name="<?php echo $border_type; ?>">
                <option value="dotted" <?php
                if ($border_type_value == 'dotted') {
                    echo 'selected';
                }
                ?>>Dotted</option>
                <option value="dashed" <?php
                if ($border_type_value == 'dashed') {
                    echo 'selected';
                }
                ?>>Dashed</option>
                <option value="solid" <?php
                if ($border_type_value == 'solid') {
                    echo 'selected';
                }
                ?>>Solid</option>
                <option value="double" <?php
                if ($border_type_value == 'double') {
                    echo 'selected';
                }
                ?>>Double</option>
                <option value="groove" <?php
                if ($border_type_value == 'groove') {
                    echo 'selected';
                }
                ?>>Groove</option>
                <option value="ridge" <?php
                if ($border_type_value == 'ridge') {
                    echo 'selected';
                }
                ?>>Ridge</option>
                <option value="inset" <?php
                if ($border_type_value == 'inset') {
                    echo 'selected';
                }
                ?>>Inset</option>
                <option value="outset" <?php
                if ($border_type_value == 'outset') {
                    echo 'selected';
                }
                ?>>Outset</option>
                <option value="dotted solid" <?php
                if ($border_type_value == 'dotted solid') {
                    echo 'selected';
                }
                ?>>Custom 1</option>
                <option value="dotted solid dashed" <?php
                if ($border_type_value == 'dotted solid dashed') {
                    echo 'selected';
                }
                ?>>Custom 2</option>
                <option value="dotted solid dashed double" <?php
                if ($border_type_value == 'dotted solid dashed double') {
                    echo 'selected';
                }
                ?>>Custom 3</option>
            </select>
        </div>

    </div>
    <?php
}

function oxilab_flip_box_admin_col_data($id, $value, $name, $title) {
    ?>
    <div class="form-group row form-group-sm">
        <label for="<?php echo $id; ?>" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="<?php echo $title; ?>" ><?php echo $name; ?> </label>
        <div class="col-sm-6">
            <select class="form-control" id="<?php echo $id; ?>" name="<?php echo $id; ?>">
                <option value="oxilab-flip-box-col-1" <?php
                if ($value == 'oxilab-flip-box-col-1') {
                    echo 'selected';
                }
                ?>>Single Item</option>
                <option value="oxilab-flip-box-col-2" <?php
                if ($value == 'oxilab-flip-box-col-2') {
                    echo 'selected';
                }
                ?>>2 Items</option>
                <option value="oxilab-flip-box-col-3" <?php
                if ($value == 'oxilab-flip-box-col-3') {
                    echo 'selected';
                }
                ?>>3 Items</option>
                <option value="oxilab-flip-box-col-4" <?php
                if ($value == 'oxilab-flip-box-col-4') {
                    echo 'selected';
                }
                ?>>4 Items</option>
                <option value="oxilab-flip-box-col-5" <?php
                if ($value == 'oxilab-flip-box-col-5') {
                    echo 'selected';
                }
                ?>>5 Items</option>
                <option value="oxilab-flip-box-col-6" <?php
                if ($value == 'oxilab-flip-box-col-6') {
                    echo 'selected';
                }
                ?>>6 Items</option>
            </select>
        </div>
    </div>
    <?php
}

function oxilab_flip_box_admin_animation_select($value) {
    ?>
    <div class="form-group row form-group-sm">
        <label for="oxilab-animation" class="col-sm-6 col-form-label"  data-toggle="tooltip" data-placement="top" title="Select your Viewing Animation" >Animation </label>
        <div class="col-sm-6">
            <select class="form-control" id="oxilab-animation" name="oxilab-animation">
                <optgroup label="No Animation">
                    <option value="" <?php
                    if ($value == '') {
                        echo 'selected';
                    }
                    ?>>No Animation</option>
                </optgroup>
                <optgroup label="Attention Seekers">
                    <option value="bounce" <?php
                    if ($value == 'bounce') {
                        echo 'selected';
                    }
                    ?>>bounce</option>
                    <option value="flash" <?php
                    if ($value == 'flash') {
                        echo 'selected';
                    }
                    ?>>flash</option>
                    <option value="pulse" <?php
                    if ($value == 'pulse') {
                        echo 'selected';
                    }
                    ?>>pulse</option>
                    <option value="rubberBand" <?php
                    if ($value == 'rubberBand') {
                        echo 'selected';
                    }
                    ?>>rubberBand</option>
                    <option value="shake" <?php
                    if ($value == 'shake') {
                        echo 'selected';
                    }
                    ?>>shake</option>
                    <option value="swing" <?php
                    if ($value == 'swing') {
                        echo 'selected';
                    }
                    ?>>swing</option>
                    <option value="tada" <?php
                    if ($value == 'tada') {
                        echo 'selected';
                    }
                    ?>>tada</option>
                    <option value="wobble" <?php
                    if ($value == 'wobble') {
                        echo 'selected';
                    }
                    ?>>wobble</option>
                    <option value="jello" <?php
                    if ($value == 'jello') {
                        echo 'selected';
                    }
                    ?>>jello</option>
                </optgroup>

                <optgroup label="Bouncing Entrances">
                    <option value="bounceIn" <?php
                    if ($value == 'bounceIn') {
                        echo 'selected';
                    }
                    ?>>bounceIn</option>
                    <option value="bounceInDown" <?php
                    if ($value == 'bounceInDown') {
                        echo 'selected';
                    }
                    ?>>bounceInDown</option>
                    <option value="bounceInLeft" <?php
                    if ($value == 'bounceInLeft') {
                        echo 'selected';
                    }
                    ?>>bounceInLeft</option>
                    <option value="bounceInRight" <?php
                    if ($value == 'bounceInRight') {
                        echo 'selected';
                    }
                    ?>>bounceInRight</option>
                    <option value="bounceInUp" <?php
                    if ($value == 'bounceInUp') {
                        echo 'selected';
                    }
                    ?>>bounceInUp</option>
                </optgroup>
                <optgroup label="Fading Entrances">
                    <option value="fadeIn" <?php
                    if ($value == 'fadeIn') {
                        echo 'selected';
                    }
                    ?>>fadeIn</option>
                    <option value="fadeInDown" <?php
                    if ($value == 'fadeInDown') {
                        echo 'selected';
                    }
                    ?>>fadeInDown</option>
                    <option value="fadeInDownBig" <?php
                    if ($value == 'fadeInDownBig') {
                        echo 'selected';
                    }
                    ?>>fadeInDownBig</option>
                    <option value="fadeInLeft" <?php
                    if ($value == 'fadeInLeft') {
                        echo 'selected';
                    }
                    ?>>fadeInLeft</option>
                    <option value="fadeInLeftBig" <?php
                    if ($value == 'fadeInLeftBig') {
                        echo 'selected';
                    }
                    ?>>fadeInLeftBig</option>
                    <option value="fadeInRight" <?php
                    if ($value == 'fadeInRight') {
                        echo 'selected';
                    }
                    ?>>fadeInRight</option>
                    <option value="fadeInRightBig" <?php
                    if ($value == 'fadeInRightBig') {
                        echo 'selected';
                    }
                    ?>>fadeInRightBig</option>
                    <option value="fadeInUp" <?php
                    if ($value == 'fadeInUp') {
                        echo 'selected';
                    }
                    ?>>fadeInUp</option>
                    <option value="fadeInUpBig" <?php
                    if ($value == 'fadeInUpBig') {
                        echo 'selected';
                    }
                    ?>>fadeInUpBig</option>
                </optgroup>

                <optgroup label="Fading Exits">
                    <option value="fadeOut" <?php
                    if ($value == 'fadeOut') {
                        echo 'selected';
                    }
                    ?>>fadeOut</option>
                    <option value="fadeOutDown" <?php
                    if ($value == 'fadeOutDown') {
                        echo 'selected';
                    }
                    ?>>fadeOutDown</option>
                    <option value="fadeOutDownBig" <?php
                    if ($value == 'fadeOutDownBig') {
                        echo 'selected';
                    }
                    ?>>fadeOutDownBig</option>
                    <option value="fadeOutLeft" <?php
                    if ($value == 'fadeOutLeft') {
                        echo 'selected';
                    }
                    ?>>fadeOutLeft</option>
                    <option value="fadeOutLeftBig" <?php
                    if ($value == 'fadeOutLeftBig') {
                        echo 'selected';
                    }
                    ?>>fadeOutLeftBig</option>
                    <option value="fadeOutRight" <?php
                    if ($value == 'fadeOutRight') {
                        echo 'selected';
                    }
                    ?>>fadeOutRight</option>
                    <option value="fadeOutRightBig" <?php
                    if ($value == 'fadeOutRightBig') {
                        echo 'selected';
                    }
                    ?>>fadeOutRightBig</option>
                    <option value="fadeOutUp" <?php
                    if ($value == 'fadeOutUp') {
                        echo 'selected';
                    }
                    ?>>fadeOutUp</option>
                    <option value="fadeOutUpBig" <?php
                    if ($value == 'fadeOutUpBig') {
                        echo 'selected';
                    }
                    ?>>fadeOutUpBig</option>
                </optgroup>

                <optgroup label="Flippers">
                    <option value="flip" <?php
                    if ($value == 'flip') {
                        echo 'selected';
                    }
                    ?>>flip</option>
                    <option value="flipInX" <?php
                    if ($value == 'flipInX') {
                        echo 'selected';
                    }
                    ?>>flipInX</option>
                    <option value="flipInY" <?php
                    if ($value == 'flipInY') {
                        echo 'selected';
                    }
                    ?>>flipInY</option>
                    <option value="flipOutX" <?php
                    if ($value == 'flipOutX') {
                        echo 'selected';
                    }
                    ?>>flipOutX</option>
                    <option value="flipOutY" <?php
                    if ($value == 'flipOutY') {
                        echo 'selected';
                    }
                    ?>>flipOutY</option>
                </optgroup>

                <optgroup label="Lightspeed">
                    <option value="lightSpeedIn" <?php
                    if ($value == 'lightSpeedIn') {
                        echo 'selected';
                    }
                    ?>>lightSpeedIn</option>
                    <option value="lightSpeedOut" <?php
                    if ($value == 'lightSpeedOut') {
                        echo 'selected';
                    }
                    ?>>lightSpeedOut</option>
                </optgroup>

                <optgroup label="Rotating Entrances">
                    <option value="rotateIn" <?php
                    if ($value == 'rotateIn') {
                        echo 'selected';
                    }
                    ?>>rotateIn</option>
                    <option value="rotateInDownLeft" <?php
                    if ($value == 'rotateInDownLeft') {
                        echo 'selected';
                    }
                    ?>>rotateInDownLeft</option>
                    <option value="rotateInDownRight" <?php
                    if ($value == 'rotateInDownRight') {
                        echo 'selected';
                    }
                    ?>>rotateInDownRight</option>
                    <option value="rotateInUpLeft" <?php
                    if ($value == 'rotateInUpLeft') {
                        echo 'selected';
                    }
                    ?>>rotateInUpLeft</option>
                    <option value="rotateInUpRight" <?php
                    if ($value == 'rotateInUpRight') {
                        echo 'selected';
                    }
                    ?>>rotateInUpRight</option>
                </optgroup>
                <optgroup label="Sliding Entrances">
                    <option value="slideInUp" <?php
                    if ($value == 'slideInUp') {
                        echo 'selected';
                    }
                    ?>>slideInUp</option>
                    <option value="slideInDown" <?php
                    if ($value == 'slideInDown') {
                        echo 'selected';
                    }
                    ?>>slideInDown</option>
                    <option value="slideInLeft" <?php
                    if ($value == 'slideInLeft') {
                        echo 'selected';
                    }
                    ?>>slideInLeft</option>
                    <option value="slideInRight" <?php
                    if ($value == 'slideInRight') {
                        echo 'selected';
                    }
                    ?>>slideInRight</option>
                </optgroup> 
                <optgroup label="Zoom Entrances">
                    <option value="zoomIn" <?php
                    if ($value == 'zoomIn') {
                        echo 'selected';
                    }
                    ?>>zoomIn</option>
                    <option value="zoomInDown" <?php
                    if ($value == 'zoomInDown') {
                        echo 'selected';
                    }
                    ?>>zoomInDown</option>
                    <option value="zoomInLeft" <?php
                    if ($value == 'zoomInLeft') {
                        echo 'selected';
                    }
                    ?>>zoomInLeft</option>
                    <option value="zoomInRight" <?php
                    if ($value == 'zoomInRight') {
                        echo 'selected';
                    }
                    ?>>zoomInRight</option>
                    <option value="zoomInUp" <?php
                    if ($value == 'zoomInUp') {
                        echo 'selected';
                    }
                    ?>>zoomInUp</option>
                </optgroup>
                <optgroup label="Specials">
                    <option value="hinge" <?php
                    if ($value == 'hinge') {
                        echo 'selected';
                    }
                    ?>>hinge</option>
                    <option value="jackInTheBox" <?php
                    if ($value == 'jackInTheBox') {
                        echo 'selected';
                    }
                    ?>>jackInTheBox</option>
                    <option value="rollIn" <?php
                    if ($value == 'rollIn') {
                        echo 'selected';
                    }
                    ?>>rollIn</option>
                </optgroup>
            </select>
        </div>
    </div>
    <?php
}

function oxilab_flip_box_admin_navigation($id, $value, $name, $title) {
    ?>
    <div class="form-group row form-group-sm">
        <label for="<?php echo $id; ?>" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="<?php echo $title; ?>"><?php echo $name; ?></label>
        <div class="col-sm-6">
            <div class="col-xs-4" style="margin-bottom: 5px;">
                <div  <?php
                if ($value == 'fa-arrow-left fa-arrow-right') {
                    echo 'style="color: #E00086"';
                }
                ?> class="oxilab-carousel-nev-style"><span class="fa fa-arrow-left"></span> <span class="fa fa-arrow-right"></span></div>
                <input <?php
                if ($value == 'fa-arrow-left fa-arrow-right') {
                    echo 'checked';
                }
                ?> type="radio" name="<?php echo $id; ?>" class="hidden" value='fa-arrow-left fa-arrow-right'>
            </div>
            <div class="col-xs-4" style="margin-bottom: 5px;">
                <div  <?php
                if ($value == 'fa-angle-double-left fa-angle-double-right') {
                    echo 'style="color: #E00086"';
                }
                ?> class="oxilab-carousel-nev-style"><span class="fa fa-angle-double-left"></span> <span class="fa fa-angle-double-right"></span></div>
                <input <?php
                if ($value == 'fa-angle-double-left fa-angle-double-right') {
                    echo 'checked';
                }
                ?> type="radio" name="<?php echo $id; ?>" class="hidden" value='fa-angle-double-left fa-angle-double-right'>
            </div>
            <div class="col-xs-4" style="margin-bottom: 5px;">
                <div  <?php
                if ($value == 'fa-angle-left fa-angle-right') {
                    echo 'style="color: #E00086"';
                }
                ?> class="oxilab-carousel-nev-style"><span class="fa fa-angle-left"></span> <span class="fa fa-angle-right"></span></div>
                <input <?php
                if ($value == 'fa-angle-left fa-angle-right') {
                    echo 'checked';
                }
                ?> type="radio" name="<?php echo $id; ?>" class="hidden" value='fa-angle-left fa-angle-right'>
            </div>  
            <div class="col-xs-4" style="margin-bottom: 5px;">
                <div  <?php
                if ($value == 'fa-arrow-circle-left fa-arrow-circle-right') {
                    echo 'style="color: #E00086"';
                }
                ?> class="oxilab-carousel-nev-style"><span class="fa fa-arrow-circle-left"></span> <span class="fa fa-arrow-circle-right"></span></div>
                <input <?php
                if ($value == 'fa-arrow-circle-left fa-arrow-circle-right') {
                    echo 'checked';
                }
                ?> type="radio" name="<?php echo $id; ?>" class="hidden" value='fa-arrow-circle-left fa-arrow-circle-right'>
            </div> 
            <div class="col-xs-4" style="margin-bottom: 5px;">
                <div  <?php
                if ($value == 'fa-caret-left fa-caret-right') {
                    echo 'style="color: #E00086"';
                }
                ?> class="oxilab-carousel-nev-style"><span class="fa fa-caret-left"></span> <span class="fa fa-caret-right"></span></div>
                <input <?php
                if ($value == 'fa-caret-left fa-caret-right') {
                    echo 'checked';
                }
                ?> type="radio" name="<?php echo $id; ?>" class="hidden" value='fa-caret-left fa-caret-right'>
            </div>
            <div class="col-xs-4" style="margin-bottom: 5px;">
                <div  <?php
                if ($value == 'fa-caret-square-o-left fa-caret-square-o-right') {
                    echo 'style="color: #E00086"';
                }
                ?> class="oxilab-carousel-nev-style"><span class="fa fa-caret-square-o-left"></span> <span class="fa fa-caret-square-o-right"></span></div>
                <input <?php
                if ($value == 'fa-caret-square-o-left fa-caret-square-o-right') {
                    echo 'checked';
                }
                ?> type="radio" name="<?php echo $id; ?>" class="hidden" value='fa-caret-square-o-left fa-caret-square-o-right'>
            </div>
            <div class="col-xs-4" style="margin-bottom: 5px;">
                <div  <?php
                if ($value == 'fa-chevron-circle-left fa-chevron-circle-right') {
                    echo 'style="color: #E00086"';
                }
                ?> class="oxilab-carousel-nev-style"><span class="fa fa-chevron-circle-left"></span> <span class="fa fa-chevron-circle-right"></span></div>
                <input <?php
                if ($value == 'fa-chevron-circle-left fa-chevron-circle-right') {
                    echo 'checked';
                }
                ?> type="radio" name="<?php echo $id; ?>" class="hidden" value='fa-chevron-circle-left fa-chevron-circle-right'>
            </div>
            <div class="col-xs-4" style="margin-bottom: 5px;">
                <div  <?php
                if ($value == 'fa-chevron-left fa-chevron-right') {
                    echo 'style="color: #E00086"';
                }
                ?> class="oxilab-carousel-nev-style"><span class="fa fa-chevron-left"></span> <span class="fa fa-chevron-right" ></span></div>
                <input <?php
                if ($value == 'fa-chevron-left fa-chevron-right') {
                    echo 'checked';
                }
                ?> type="radio" name="<?php echo $id; ?>" class="hidden" value='fa-chevron-left fa-chevron-right'>
            </div>
        </div>
        <style>
            .oxilab-carousel-nev-style{
                cursor: pointer;
                color: #B8B8B8;
                font-size: 20px;
            }                   
            .oxilab-carousel-nev-style:hover{
                color: #E00086;
            }
        </style>
        <?php
        wp_add_inline_script('oxilab-bootstrap', 'jQuery(".oxilab-carousel-nev-style").click(function (e) {
                                                        jQuery(".oxilab-carousel-nev-style").css("color", "#a7a7a7").siblings("input").prop("checked", false);
                                                        jQuery(this).css("color", "#E00086").siblings("input").prop("checked", true);
                                                    });');
        ?>
    </div>
    <?php
}

function oxilab_flip_box_admin_pagination($id, $value, $name, $title) {
    ?>
    <div class="form-group row form-group-sm">
        <label for="<?php echo $id; ?>" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="<?php echo $title; ?>"><?php echo $name; ?></label>
        <div class="col-sm-6">
            <select class="form-control" id="<?php echo $id; ?>" name="<?php echo $id; ?>">
                <option <?php
                if ($value == 'top left') {
                    echo 'selected';
                }
                ?> value="top left">Top Left</option>
                <option <?php
                if ($value == 'top center') {
                    echo 'selected';
                }
                ?> value="top center">Top Middle</option>
                <option <?php
                if ($value == 'top right') {
                    echo 'selected';
                }
                ?> value="top right">Top Right</option>
                <option <?php
                if ($value == 'bottom left') {
                    echo 'selected';
                }
                ?> value="bottom left">Bottom Left</option>
                <option <?php
                if ($value == 'bottom center') {
                    echo 'selected';
                }
                ?> value="bottom center">Bottom Middle</option>
                <option <?php
                if ($value == 'bottom right') {
                    echo 'selected';
                }
                ?> value="bottom right">Bottom Right</option>
            </select>
        </div>
    </div>
    <?php
}

function oxilab_flip_box_flip_type_effects_type($flip_type, $effects_Type) {
    ?>
    <div class="form-group row form-group-sm">
        <label for="oxilab-flip-type" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Select Flip Type to use into this Flip">Flip Type </label>
        <div class="col-sm-6">
            <select class="form-control" id="oxilab-flip-type" name="oxilab-flip-type">
                <option value="oxilab-flip-box-flip oxilab-flip-box-flip-top-to-bottom" <?php
                if ($flip_type == 'oxilab-flip-box-flip oxilab-flip-box-flip-top-to-bottom') {
                    echo 'selected';
                }
                ?>>Flip top to Bottom</option>
                <option value="oxilab-flip-box-flip oxilab-flip-box-flip-left-to-right" <?php
                if ($flip_type == 'oxilab-flip-box-flip oxilab-flip-box-flip-left-to-right') {
                    echo 'selected';
                }
                ?>>Flip Left to Right</option>
                <option value="oxilab-flip-box-flip oxilab-flip-box-flip-bottom-to-top" <?php
                if ($flip_type == 'oxilab-flip-box-flip oxilab-flip-box-flip-bottom-to-top') {
                    echo 'selected';
                }
                ?>>Flip Bottom to Top</option>
                <option value="oxilab-flip-box-flip oxilab-flip-box-flip-right-to-left" <?php
                if ($flip_type == 'oxilab-flip-box-flip oxilab-flip-box-flip-right-to-left') {
                    echo 'selected';
                }
                ?>>Flip Right to Left</option>
            </select>
        </div>
    </div>
    <div class="form-group row form-group-sm">
        <label for="oxilab-flip-effects" class="col-sm-6 col-form-label" data-toggle="tooltip" data-placement="top" title="Customize Your Fliping Effects">Flip Effects </label>
        <div class="col-sm-6">
            <select class="form-control" id="oxilab-flip-effects" name="oxilab-flip-effects">
                <option value="easing_easeInOutExpo" <?php
                if ($effects_Type == 'easing_easeInOutExpo') {
                    echo 'selected';
                }
                ?>>easing_easeInOutExpo</option>
                <option value="easing_easeInOutCirc" <?php
                if ($effects_Type == 'easing_easeInOutCirc') {
                    echo 'selected';
                }
                ?>>easing_easeInOutCirc</option>
                <option value="easing_easeOutBack" <?php
                if ($effects_Type == 'easing_easeOutBack') {
                    echo 'selected';
                }
                ?>>easing_easeOutBack</option>
            </select>
        </div>
    </div>
    <?php
}
