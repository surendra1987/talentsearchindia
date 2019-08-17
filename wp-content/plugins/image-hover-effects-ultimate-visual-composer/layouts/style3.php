<?php

if (!defined('ABSPATH'))
    exit;
oxilab_flip_box_user_capabilities();
echo '<div class="oxilab-flip-box-col-3">';
$styledata = Array('id' => 31, 'style_name' => 'style3', 'css' => ' oxilab-flip-type |oxilab-flip-box-flip oxilab-flip-box-flip-left-to-right| oxilab-flip-effects |easing_easeInOutCirc| front-background-color |rgba(232, 227, 227, 1)| front-icon-color |#008299| || front-heading-color |#555555| backend-background-color |rgba(0, 130, 153, 1)| backend-info-color |#ffffff| front-info-color |#555555| || || || || || || || || || || || || flip-col |oxilab-flip-box-col-1| flip-width |280| flip-height |250| margin-top |10| margin-left |10| flip-open-tabs || oxilab-animation || animation-duration |2| flip-boxshow-color |rgba(250, 245, 245, 1)| flip-boxshow-horizontal |0| flip-boxshow-vertical |2| flip-boxshow-blur |8| flip-boxshow-spread |0| front-padding-top |10| front-padding-left |10| front-icon-size |40| front-icon-width |60| front-icon-padding-top-bottom |8| front-icon-padding-left-right |8| front-icon-text-align |Center| front-heading-size |22| front-heading-family |Open+Sans| front-heding-style |normal| front-heding-weight |600| front-heding-text-align |Center| front-heding-padding-top |8| front-heding-padding-bottom |8| front-heding-padding-left |8| front-heding-padding-right |8| front-info-size |14| front-info-family |Open+Sans| front-info-style |normal| front-info-weight |300| front-info-text-align |Center| front-info-padding-top |6| front-info-padding-bottom |6| front-info-padding-left |6| front-info-padding-right |6| backend-padding-top |10| backend-padding-left |20| backend-info-size |14| backend-info-family |Open+Sans| backend-info-style |normal| backend-info-weight |300| backend-info-text-align |Center| backend-info-padding-top |10| backend-info-padding-bottom |10| backend-info-padding-left |10| backend-info-padding-right |10| flip-border-radius |5| custom-css |||');
$listdata = Array(
    0 => Array('id' => 1, 'styleid' => 31, 'title' => '',
        'files' => 'flip-box-front-title {#}|{#}Vokalia{#}|{#} flip-box-front-icons {#}|{#}'. FlipBoxesImageAdFAData('twitter').'{#}|{#} flip-box-image-upload-url-01 {#}|{#}{#}|{#} flip-box-backend-desc {#}|{#}Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live.{#}|{#} flip-box-backend-link {#}|{#}{#}|{#} flip-box-image-upload-url-02 {#}|{#}{#}|{#} flip-box-font-desc {#}|{#}Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live.{#}|{#}',
        ),
);
echo '<input type="hidden" name="oxilab-flip-box-data-3-' . $listdata[0]['id'] . '" id="oxilab-flip-box-data-3-' . $listdata[0]['id'] . '" value="' . $styledata['css'] . '">';
echo '<input type="hidden" name="oxilab-flip-box-files-3-' . $listdata[0]['id'] . '" id="oxilab-flip-box-files-3-' . $listdata[0]['id'] . '" value="' . $listdata[0]['files'] . '">';
echo oxilab_flipbox_admin_style_layouts($styledata, $listdata);
echo '</div>';

echo '<div class="oxilab-flip-box-col-3">';
$styledata = Array('id' => 32, 'style_name' => 'style3', 'css' => 'oxilab-flip-type |oxilab-flip-box-flip oxilab-flip-box-flip-bottom-to-top| oxilab-flip-effects |easing_easeInOutExpo| front-background-color |rgba(118, 0, 209, 0.51)| front-icon-color |#edf4f5| || front-heading-color |#ffffff| backend-background-color |rgba(0, 120, 153, 0.75)| backend-info-color |#ffffff| front-info-color |#f2efef| || || || || || || || || || || || || flip-col |oxilab-flip-box-col-1| flip-width |280| flip-height |250| margin-top |10| margin-left |10| flip-open-tabs || oxilab-animation || animation-duration |2| flip-boxshow-color |rgba(250, 245, 245, 1)| flip-boxshow-horizontal |0| flip-boxshow-vertical |2| flip-boxshow-blur |8| flip-boxshow-spread |0| front-padding-top |10| front-padding-left |10| front-icon-size |40| front-icon-width |60| front-icon-padding-top-bottom |8| front-icon-padding-left-right |8| front-icon-text-align |Center| front-heading-size |22| front-heading-family |Open+Sans| front-heding-style |normal| front-heding-weight |600| front-heding-text-align |Center| front-heding-padding-top |8| front-heding-padding-bottom |8| front-heding-padding-left |8| front-heding-padding-right |8| front-info-size |14| front-info-family |Open+Sans| front-info-style |normal| front-info-weight |300| front-info-text-align |Center| front-info-padding-top |6| front-info-padding-bottom |6| front-info-padding-left |6| front-info-padding-right |6| backend-padding-top |10| backend-padding-left |20| backend-info-size |14| backend-info-family |Open+Sans| backend-info-style |normal| backend-info-weight |300| backend-info-text-align |Center| backend-info-padding-top |10| backend-info-padding-bottom |10| backend-info-padding-left |10| backend-info-padding-right |10| flip-border-radius |5| custom-css |||');
$listdata = Array(
    0 => Array('id' => 2, 'styleid' => 32, 'title' => '',
        'files' => 'flip-box-front-title {#}|{#}WooCommerce{#}|{#} flip-box-front-icons {#}|{#}'. FlipBoxesImageAdFAData('fa-bandcamp').'{#}|{#} flip-box-image-upload-url-01 {#}|{#}{#}|{#} flip-box-backend-desc {#}|{#}A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy{#}|{#} flip-box-backend-link {#}|{#}{#}|{#} flip-box-image-upload-url-02 {#}|{#}{#}|{#} flip-box-font-desc {#}|{#}ar far away, behind the word mountains, far from the countries Vokalia and Consonantia..{#}|{#} ',
        ),
);
echo '<input type="hidden" name="oxilab-flip-box-data-3-' . $listdata[0]['id'] . '" id="oxilab-flip-box-data-3-' . $listdata[0]['id'] . '" value="' . $styledata['css'] . '">';
echo '<input type="hidden" name="oxilab-flip-box-files-3-' . $listdata[0]['id'] . '" id="oxilab-flip-box-files-3-' . $listdata[0]['id'] . '" value="' . $listdata[0]['files'] . '">';
echo oxilab_flipbox_admin_style_layouts($styledata, $listdata);


echo '</div>';
echo '<div class="oxilab-flip-box-col-3">';
$styledata = Array('id' => 33, 'style_name' => 'style3', 'css' => 'oxilab-flip-type |oxilab-flip-box-flip oxilab-flip-box-flip-top-to-bottom| oxilab-flip-effects |easing_easeOutBack| front-background-color |rgba(196, 0, 180, 0.67)| front-icon-color |#ffffff| || front-heading-color |#ffffff| backend-background-color |rgba(46, 98, 166, 0.51)| backend-info-color |#ffffff| front-info-color |#ffffff| || || || || || || || || || || || || flip-col |oxilab-flip-box-col-1| flip-width |280| flip-height |250| margin-top |10| margin-left |10| flip-open-tabs || oxilab-animation || animation-duration |2| flip-boxshow-color |rgba(250, 245, 245, 1)| flip-boxshow-horizontal |0| flip-boxshow-vertical |2| flip-boxshow-blur |8| flip-boxshow-spread |0| front-padding-top |10| front-padding-left |10| front-icon-size |40| front-icon-width |60| front-icon-padding-top-bottom |8| front-icon-padding-left-right |8| front-icon-text-align |Center| front-heading-size |22| front-heading-family |Open+Sans| front-heding-style |normal| front-heding-weight |600| front-heding-text-align |Center| front-heding-padding-top |8| front-heding-padding-bottom |8| front-heding-padding-left |8| front-heding-padding-right |8| front-info-size |14| front-info-family |Open+Sans| front-info-style |normal| front-info-weight |300| front-info-text-align |Center| front-info-padding-top |6| front-info-padding-bottom |6| front-info-padding-left |6| front-info-padding-right |6| backend-padding-top |10| backend-padding-left |20| backend-info-size |14| backend-info-family |Open+Sans| backend-info-style |normal| backend-info-weight |300| backend-info-text-align |Center| backend-info-padding-top |10| backend-info-padding-bottom |10| backend-info-padding-left |10| backend-info-padding-right |10| flip-border-radius |5| custom-css |||');
$listdata = Array(
    0 => Array('id' => 3, 'styleid' => 33, 'title' => '',
        'files' => ' flip-box-front-title {#}|{#}Consonantia{#}|{#} flip-box-front-icons {#}|{#}'. FlipBoxesImageAdFAData('fa-balance-scale').'{#}|{#} flip-box-image-upload-url-01 {#}|{#}{#}|{#} flip-box-backend-desc {#}|{#}But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born.{#}|{#} flip-box-backend-link {#}|{#}#{#}|{#} flip-box-image-upload-url-02 {#}|{#}' . oxilab_flip_box_admin_image('dog.jpg') . '{#}|{#} flip-box-font-desc {#}|{#}But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born.{#}|{#}',
        )
);
echo '<input type="hidden" name="oxilab-flip-box-data-3-' . $listdata[0]['id'] . '" id="oxilab-flip-box-data-3-' . $listdata[0]['id'] . '" value="' . $styledata['css'] . '">';
echo '<input type="hidden" name="oxilab-flip-box-files-3-' . $listdata[0]['id'] . '" id="oxilab-flip-box-files-3-' . $listdata[0]['id'] . '" value="' . $listdata[0]['files'] . '">';
echo oxilab_flipbox_admin_style_layouts($styledata, $listdata);
echo '</div>';

/*
  echo ' || || || || || || || || || || || || ';
 * 
 */
