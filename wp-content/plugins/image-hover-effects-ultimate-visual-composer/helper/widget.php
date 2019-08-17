<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Register and load the widget
function flipbox_oxilab_load_widget() {
    register_widget('flipbox_oxilab_widget');
}

add_action('widgets_init', 'flipbox_oxilab_load_widget');

// Creating the widget 
class flipbox_oxilab_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
// Base ID of your widget
                'flipbox_oxilab_widget',
// Widget name will appear in UI
                __('Flipbox - Image Overlay', 'flipbox_oxilab_widget_widget'),
// Widget description
                array('description' => __('Flipbox - Image Overlay Widget', 'flipbox_oxilab_widget_widget'),)
        );
    }

// Creating widget front-end

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);

// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        echo oxilab_flip_box_shortcode_function($title, 'user');
        echo $args['after_widget'];
    }

// Widget Backend 
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('1', 'flipbox_oxilab_widget_widget');
        }
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('ID:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

}

