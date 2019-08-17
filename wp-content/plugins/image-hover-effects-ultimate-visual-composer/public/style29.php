<?php
if (!defined('ABSPATH'))
    exit;

function oxilab_flip_box_shortcode_function_style29($styleid, $userdata, $styledata, $listdata) {
    ?>
    <div class="oxilab-flip-box-wrapper">
        <?php
        foreach ($listdata as $value) {
            if ($userdata == 'admin') {
                $admindata = 'oxilab-ab-id';
            } else {
                $admindata = '';
            }
            $filesdata = explode("{#}|{#}", $value['files']);
            ?>
            <div class="<?php echo $styledata[43]; ?> oxilab-flip-box-padding-<?php echo $styleid; ?> <?php echo $admindata; ?> oxilab-animation" oxilab-animation="<?php echo $styledata[55]; ?>">
                <div class="oxilab-flip-box-body-<?php echo $styleid; ?> oxilab-flip-box-body-<?php echo $styleid; ?>-<?php echo $value['id']; ?>">
                    <?php
                    if ($filesdata[9] == '' && $filesdata[11] != '') {
                        echo '<a href="' . $filesdata[11] . '" target="' . $styledata[53] . '">';
                        $fileslinkend = '</a>';
                    } else {
                        $fileslinkend = '';
                    }
                    ?>
                    <div class="oxilab-flip-box-body-absulote">
                        <div class="<?php echo $styledata[1]; ?>">
                            <div class="oxilab-flip-box-style-data <?php echo $styledata[3]; ?>">
                                <div class="oxilab-flip-box-style">
                                    <div class="oxilab-flip-box-front">
                                        <div class="oxilab-flip-box-<?php echo $styleid; ?>">
                                            <div class="oxilab-flip-box-<?php echo $styleid; ?>-data">                                            
                                                <div class="oxilab-image">
                                                    <img src="<?php echo $filesdata[5]; ?>">
                                                </div>
                                                <div class="oxilab-heading">
                                                    <?php echo oxilab_flip_box_special_charecter($filesdata[1]); ?>
                                                </div>                                                      
                                            </div>
                                        </div>
                                    </div>
                                    <div class="oxilab-flip-box-back">
                                        <div class="oxilab-flip-box-back-<?php echo $styleid; ?>">
                                            <div class="oxilab-flip-box-back-<?php echo $styleid; ?>-data">
                                                <div class="oxilab-heading">
                                                    <?php echo oxilab_flip_box_special_charecter($filesdata[17]); ?>
                                                </div>
                                                <div class="oxilab-info">
                                                    <?php echo oxilab_flip_box_special_charecter($filesdata[7]); ?>
                                                </div>
                                                <?php
                                                if ($filesdata[9] != '') {
                                                    echo '<a href="' . $filesdata[11] . '" target="' . $styledata[53] . '">';
                                                    echo '<div class="oxilab-button">
                                                                    <div class="oxilab-button-data">
                                                                    ' . oxilab_flip_box_special_charecter($filesdata[9]) . '
                                                                    </div>
                                                                </div>';
                                                    echo '</a>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $fileslinkend; ?>
                </div>
                <?php
                if ($userdata == 'admin') {
                    ?>
                    <div class="oxilab-admin-absulote">
                        <div class="oxilab-style-absulate-edit">
                            <form method="post"> 
                                <input type="hidden" name="item-id" value="<?php echo $value['id']; ?>">
                                <button class="btn btn-primary" type="submit" value="edit" name="edit" title="Edit">Edit</button>
                                <?php echo wp_nonce_field("oxilab_flip_box_edit_data"); ?>
                            </form>
                        </div>
                        <div class="oxilab-style-absulate-delete">
                            <form method="post">
                                <input type="hidden" name="item-id" value="<?php echo $value['id']; ?>">
                                <button class="btn btn-danger" type="submit" value="delete" name="delete" title="Delete">Delete</button>
                                <?php echo wp_nonce_field("oxilab_flip_box_delete_data"); ?>
                            </form>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
        
    <style>
        .oxilab-flip-box-padding-<?php echo $styleid; ?>{
            padding: <?php echo $styledata[49]; ?>px <?php echo $styledata[51]; ?>px;
            -webkit-transition:  opacity <?php echo $styledata[57]; ?>s linear;
            -moz-transition:  opacity <?php echo $styledata[57]; ?>s linear;
            -ms-transition:  opacity <?php echo $styledata[57]; ?>s linear;
            -o-transition:  opacity <?php echo $styledata[57]; ?>s linear;
            transition:  opacity <?php echo $styledata[57]; ?>s linear;
            -webkit-animation-duration: <?php echo $styledata[57]; ?>s;
            -moz-animation-duration: <?php echo $styledata[57]; ?>s;
            -ms-animation-duration: <?php echo $styledata[57]; ?>s;
            -o-animation-duration: <?php echo $styledata[57]; ?>s;
            animation-duration: <?php echo $styledata[57]; ?>s;
        }
        .oxilab-flip-box-body-<?php echo $styleid; ?>{
            max-width: <?php echo $styledata[45]; ?>px;
            width: 100%;
            margin: 0 auto;
            position: relative;   
        }
        .oxilab-flip-box-body-<?php echo $styleid; ?>:after {
            padding-bottom: <?php echo $styledata[47] / $styledata[45] * 100; ?>%;
            content: "";
            display: block;
        }
        .oxilab-flip-box-<?php echo $styleid; ?>{
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: <?php echo $styledata[5]; ?>;
            border-color:<?php echo $styledata[7]; ?>;
            border-width: <?php echo $styledata[163]; ?>px;
            border-style:<?php echo $styledata[165]; ?>; 
            display: block;
            -webkit-border-radius: <?php echo $styledata[153]; ?>px;
            -moz-border-radius: <?php echo $styledata[153]; ?>px;
            -ms-border-radius: <?php echo $styledata[153]; ?>px;
            -o-border-radius: <?php echo $styledata[153]; ?>px;
            border-radius: <?php echo $styledata[153]; ?>px;
            overflow: hidden;     
        }
        .oxilab-flip-box-<?php echo $styleid; ?>-data{           
            position: absolute;
            left: 0%;
            top: 0%;    
            right: 0;
            bottom: 0;
        }
        .oxilab-flip-box-<?php echo $styleid; ?>-data .oxilab-image{
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom:0;
            margin: <?php echo $styledata[71]; ?>px <?php echo $styledata[77]; ?>px <?php echo $styledata[73]; ?>px <?php echo $styledata[75]; ?>px;  
            display: block; 
        }
        .oxilab-flip-box-<?php echo $styleid; ?>-data .oxilab-image img{
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height:100%;
            display: block; 
        }
        .oxilab-flip-box-<?php echo $styleid; ?>-data .oxilab-heading{
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            margin-top: <?php echo $styledata[69]; ?>%;
            color: <?php echo $styledata[13]; ?>;
            background: <?php echo $styledata[5]; ?>;
            display: block;
            text-align: <?php echo $styledata[91]; ?>;            
            font-size: <?php echo $styledata[83]; ?>px;
            font-family: <?php echo oxilab_flip_box_font_familly_charecter($styledata[85]); ?>;
            font-weight: <?php echo $styledata[89]; ?>;
            font-style:<?php echo $styledata[87]; ?>;
            padding: <?php echo $styledata[93]; ?>px <?php echo $styledata[99]; ?>px <?php echo $styledata[95]; ?>px <?php echo $styledata[97]; ?>px;  
        }
        .oxilab-flip-box-back-<?php echo $styleid; ?>{
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: <?php echo $styledata[15]; ?>;
            border-color:<?php echo $styledata[9]; ?>;
            border-width: <?php echo $styledata[167]; ?>px;
            border-style:<?php echo $styledata[169]; ?>; 
            display: block;
            -webkit-border-radius: <?php echo $styledata[153]; ?>px;
            -moz-border-radius: <?php echo $styledata[153]; ?>px;
            -ms-border-radius: <?php echo $styledata[153]; ?>px;
            -o-border-radius: <?php echo $styledata[153]; ?>px;
            border-radius: <?php echo $styledata[153]; ?>px;
            overflow: hidden;     
            -webkit-box-shadow: <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
            -moz-box-shadow: <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
            -ms-box-shadow: <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
            -o-box-shadow: <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
            box-shadow: <?php echo $styledata[61]; ?>px <?php echo $styledata[63]; ?>px <?php echo $styledata[65]; ?>px <?php echo $styledata[67]; ?>px <?php echo $styledata[59]; ?>;
        }
        .oxilab-flip-box-back-<?php echo $styleid; ?>-data{           
            position: absolute;
            left: 0%;
            right: 0;
            top: 50%;            
            padding: <?php echo $styledata[101]; ?>px <?php echo $styledata[103]; ?>px;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -o-transform: translateY(-50%);
            transform: translateY(-50%);           
        }
        .oxilab-flip-box-back-<?php echo $styleid; ?>-data .oxilab-heading{
            display: block;
            color:  <?php echo $styledata[31]; ?>;
            text-align: <?php echo $styledata[189]; ?>;            
            font-size: <?php echo $styledata[181]; ?>px;          
            font-family: <?php echo oxilab_flip_box_font_familly_charecter($styledata[183]); ?>;
            font-weight: <?php echo $styledata[187]; ?>;
            font-style:<?php echo $styledata[185]; ?>;
            padding:<?php echo $styledata[191]; ?>px <?php echo $styledata[197]; ?>px <?php echo $styledata[193]; ?>px <?php echo $styledata[195]; ?>px;
        }
        .oxilab-flip-box-back-<?php echo $styleid; ?>-data .oxilab-info{
            display: block;
            color: <?php echo $styledata[19]; ?>;
            text-align: <?php echo $styledata[115]; ?>;            
            font-size: <?php echo $styledata[107]; ?>px;          
            font-family: <?php echo oxilab_flip_box_font_familly_charecter($styledata[109]); ?>;
            font-weight: <?php echo $styledata[113]; ?>;
            font-style:<?php echo $styledata[111]; ?>;
            padding:<?php echo $styledata[117]; ?>px <?php echo $styledata[123]; ?>px <?php echo $styledata[119]; ?>px <?php echo $styledata[121]; ?>px;           
        }
        .oxilab-flip-box-back-<?php echo $styleid; ?>-data .oxilab-button{
            display: block;
            text-align: <?php echo $styledata[139]; ?>; 
            padding: <?php echo $styledata[141]; ?>px <?php echo $styledata[147]; ?>px <?php echo $styledata[143]; ?>px <?php echo $styledata[145]; ?>px;  
        }
        .oxilab-flip-box-back-<?php echo $styleid; ?>-data .oxilab-button-data{
            display: inline-block;     
            color: <?php echo $styledata[21]; ?>;
            background-color:  <?php echo $styledata[23]; ?>;
            font-size: <?php echo $styledata[125]; ?>px;
            font-family: <?php echo oxilab_flip_box_font_familly_charecter($styledata[127]); ?>;
            font-weight: <?php echo $styledata[131]; ?>;
            font-style:<?php echo $styledata[129]; ?>;
            padding: <?php echo $styledata[133]; ?>px <?php echo $styledata[135]; ?>px;  
            -webkit-border-radius: <?php echo $styledata[137]; ?>px;
            -moz-border-radius: <?php echo $styledata[137]; ?>px;
            -ms-border-radius: <?php echo $styledata[137]; ?>px;
            -o-border-radius: <?php echo $styledata[137]; ?>px;
            border-radius: <?php echo $styledata[137]; ?>px;
        }
        .oxilab-flip-box-back-<?php echo $styleid; ?>-data .oxilab-button-data:hover{
            background-color: <?php echo $styledata[27]; ?>;
            color:  <?php echo $styledata[25]; ?>;
        }
        <?php echo $styledata[199]; ?>;
    </style>
    </div>

    <?php
}
