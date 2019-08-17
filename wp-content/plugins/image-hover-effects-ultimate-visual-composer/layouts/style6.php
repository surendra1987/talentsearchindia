<?php

if (!defined('ABSPATH'))
    exit;
oxilab_flip_box_user_capabilities();
echo '<div class="oxilab-flip-box-col-3">';
$styledata = Array('id' => 61, 'style_name' => 'style6', 'css' => 'oxilab-flip-type |oxilab-flip-box-flip oxilab-flip-box-flip-left-to-right| oxilab-flip-effects |easing_easeInOutCirc| front-background-color |rgba(255, 255, 255, 0)| front-border-color |#858585| || || || backend-background-color |rgba(237, 237, 237, 1)| backend-border-color |#858585| backend-info-color |#454040| || || || || || backend-title-color |#454040| || || || || || flip-col |oxilab-flip-box-col-1| flip-width |280| flip-height |160| margin-top |10| margin-left |10| flip-open-tabs || oxilab-animation || animation-duration |2| flip-boxshow-color |rgba(232, 227, 227, 1)| flip-boxshow-horizontal |0| flip-boxshow-vertical |2| flip-boxshow-blur |8| flip-boxshow-spread |0| flip-font-border-size|1| flip-font-border-style|solid| || || || || || || || || || || || || flip-backend-border-size|1| flip-backend-border-style|solid| backend-padding-top |10| backend-padding-left |10| || backend-info-size |16| backend-info-family |Open+Sans| backend-info-style |normal| backend-info-weight |300| backend-info-text-align |Center| backend-info-padding-top |8| backend-info-padding-bottom |8| backend-info-padding-left |8| backend-info-padding-right |8| || || || || || || || || || || || || || || flip-border-radius |3| || || || || || || || || || || || || || backend-heading-size |24| backend-heading-family |Open+Sans| backend-heading-style |normal| backend-heading-weight |600| backend-heading-text-align |Center| backend-heading-padding-top |10| backend-heading-padding-bottom |10| backend-heading-padding-left |10| backend-heading-padding-right |10| custom-css |||');
$listdata = Array(
    0 => Array('id' => 1, 'styleid' => 61, 'title' => '',
        'files' => '{#}|{#}{#}|{#} {#}|{#}{#}|{#} flip-box-image-upload-url-01 {#}|{#}' . oxilab_flip_box_admin_image('google.png') . '{#}|{#} flip-box-backend-desc {#}|{#}A wonderful serenity has taken possession of my entire soul.{#}|{#} {#}|{#}{#}|{#} flip-box-backend-link {#}|{#}#{#}|{#} flip-box-image-upload-url-02 {#}|{#}{#}|{#} {#}|{#}{#}|{#} flip-box-backend-title {#}|{#}Google{#}|{#}',
        ),
);
echo '<input type="hidden" name="oxilab-flip-box-data-6-' . $listdata[0]['id'] . '" id="oxilab-flip-box-data-6-' . $listdata[0]['id'] . '" value="' . $styledata['css'] . '">';
echo '<input type="hidden" name="oxilab-flip-box-files-6-' . $listdata[0]['id'] . '" id="oxilab-flip-box-files-6-' . $listdata[0]['id'] . '" value="' . $listdata[0]['files'] . '">';
echo oxilab_flipbox_admin_style_layouts($styledata, $listdata);
echo '</div>';

echo '<div class="oxilab-flip-box-col-3">';
$styledata = Array('id' => 62, 'style_name' => 'style6', 'css' => 'oxilab-flip-type |oxilab-flip-box-flip oxilab-flip-box-flip-top-to-bottom| oxilab-flip-effects |easing_easeOutBack| front-background-color |rgba(255, 255, 255, 0)| front-border-color |#858585| || || || backend-background-color |rgba(202, 0, 209, 1)| backend-border-color |#ffffff| backend-info-color |#ffffff| || || || || || backend-title-color |#ffffff||| || || || || flip-col |oxilab-flip-box-col-1| flip-width |280| flip-height |160| margin-top |10| margin-left |10| flip-open-tabs || oxilab-animation || animation-duration |2| flip-boxshow-color |rgba(232, 227, 227, 1)| flip-boxshow-horizontal |0| flip-boxshow-vertical |2| flip-boxshow-blur |8| flip-boxshow-spread |0| flip-font-border-size|1| flip-font-border-style|solid| || || || || || || || || || || || || flip-backend-border-size|1| flip-backend-border-style|solid| backend-padding-top |10| backend-padding-left |10| || backend-info-size |16| backend-info-family |Open+Sans| backend-info-style |normal| backend-info-weight |300| backend-info-text-align |Center| backend-info-padding-top |8| backend-info-padding-bottom |8| backend-info-padding-left |8| backend-info-padding-right |8| || || || || || || || || || || || || || || flip-border-radius |3| || || || || || || || || || || || || || backend-heading-size |24| backend-heading-family |Open+Sans| backend-heading-style |normal| backend-heading-weight |600| backend-heading-text-align |Center| backend-heading-padding-top |10| backend-heading-padding-bottom |10| backend-heading-padding-left |10| backend-heading-padding-right |10| custom-css |||');
$listdata = Array(
    0 => Array('id' => 2, 'styleid' => 62, 'title' => '',
        'files' => '{#}|{#}{#}|{#} {#}|{#}{#}|{#} flip-box-image-upload-url-01 {#}|{#}' . oxilab_flip_box_admin_image('ebay.png') . '{#}|{#} flip-box-backend-desc {#}|{#}A wonderful serenity has taken possession of my entire soul{#}|{#} {#}|{#}{#}|{#} flip-box-backend-link {#}|{#}#{#}|{#} flip-box-image-upload-url-02 {#}|{#}{#}|{#} {#}|{#}{#}|{#} flip-box-backend-title {#}|{#}Ebay{#}|{#}',
        ),
);
echo '<input type="hidden" name="oxilab-flip-box-data-6-' . $listdata[0]['id'] . '" id="oxilab-flip-box-data-6-' . $listdata[0]['id'] . '" value="' . $styledata['css'] . '">';
echo '<input type="hidden" name="oxilab-flip-box-files-6-' . $listdata[0]['id'] . '" id="oxilab-flip-box-files-6-' . $listdata[0]['id'] . '" value="' . $listdata[0]['files'] . '">';
echo oxilab_flipbox_admin_style_layouts($styledata, $listdata);

echo '</div>';
echo '<div class="oxilab-flip-box-col-3">';
$styledata = Array('id' => 63, 'style_name' => 'style6', 'css' => ' oxilab-flip-type |oxilab-flip-box-flip oxilab-flip-box-flip-left-to-right| oxilab-flip-effects |easing_easeInOutCirc| front-background-color |rgba(255, 255, 255, 0)| front-border-color |#858585| || || || backend-background-color |rgba(127, 11, 189, 1)| backend-border-color |#ffffff| backend-info-color |#ffffff| || || || || || backend-title-color |#ffffff| || || || || || flip-col |oxilab-flip-box-col-1| flip-width |280| flip-height |160| margin-top |10| margin-left |10| flip-open-tabs || oxilab-animation || animation-duration |2| flip-boxshow-color |rgba(232, 227, 227, 1)| flip-boxshow-horizontal |0| flip-boxshow-vertical |2| flip-boxshow-blur |8| flip-boxshow-spread |0| flip-font-border-size|1| flip-font-border-style|solid| || || || || || || || || || || || || flip-backend-border-size|1| flip-backend-border-style|solid| backend-padding-top |10| backend-padding-left |10| || backend-info-size |16| backend-info-family |Open+Sans| backend-info-style |normal| backend-info-weight |300| backend-info-text-align |Center| backend-info-padding-top |8| backend-info-padding-bottom |8| backend-info-padding-left |8| backend-info-padding-right |8| || || || || || || || || || || || || || || flip-border-radius |3| || || || || || || || || || || || || || backend-heading-size |24| backend-heading-family |Open+Sans| backend-heading-style |normal| backend-heading-weight |600| backend-heading-text-align |Center| backend-heading-padding-top |10| backend-heading-padding-bottom |10| backend-heading-padding-left |10| backend-heading-padding-right |10| custom-css |||');
$listdata = Array(
    0 => Array('id' => 3, 'styleid' => 63, 'title' => '',
        'files' => '{#}|{#}{#}|{#} {#}|{#}{#}|{#} flip-box-image-upload-url-01 {#}|{#}' . oxilab_flip_box_admin_image('adobe.png') . '{#}|{#} flip-box-backend-desc {#}|{#}A wonderful serenity has taken possession of my entire soul{#}|{#} {#}|{#}{#}|{#} flip-box-backend-link {#}|{#}#{#}|{#} flip-box-image-upload-url-02 {#}|{#}{#}|{#} {#}|{#}{#}|{#} flip-box-backend-title {#}|{#}Adobe{#}|{#}',
        )
);
echo '<input type="hidden" name="oxilab-flip-box-data-6-' . $listdata[0]['id'] . '" id="oxilab-flip-box-data-6-' . $listdata[0]['id'] . '" value="' . $styledata['css'] . '">';
echo '<input type="hidden" name="oxilab-flip-box-files-6-' . $listdata[0]['id'] . '" id="oxilab-flip-box-files-6-' . $listdata[0]['id'] . '" value="' . $listdata[0]['files'] . '">';
echo oxilab_flipbox_admin_style_layouts($styledata, $listdata);
echo '</div>';

/*
  echo ' || || || || || ';
 * 
 */