<?php
/*
Plugin Name: WP Widget Name
Plugin URI: https://github.com/awhedbee22/
Description: A description of the wordpress widget plugin.
Version: 1.0
Author: Alex Whedbee
Author URI: http://alexwhedbee.com/
License: MIT.
*/

class widget_class extends WP_Widget {

    // Constructor
    function widget_class() {
        parent::WP_Widget(false, $name = __('Widget Name Here', 'Widget description goes here.') );
    }

    // Widget Customization
    function form($instance) { 
        //Check Values
        if( $instance) {
            $title = esc_attr($instance['title']);
        } else {
            $title = '';
        }
    ?>
        <!--###############
        Widget Menu Options
        ################-->
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
 
        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text:', 'wp_widget_plugin'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
        </p>
 
        <p>
            <label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Textarea:', 'wp_widget_plugin'); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
        </p>
    <?php
    }


    // Widget Update
    function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['text'] = strip_tags($new_instance['text']);
      $instance['textarea'] = strip_tags($new_instance['textarea']);
     return $instance;
}


    // Widget Display
    function widget($args, $instance) {
        //Call the css & js
        wp_enqueue_style( 'widget-style', plugins_url('wp-widget/wp-widget-template.css') );
        wp_enqueue_script( 'widget-script', plugins_url('wp-widget/wp-widget-template.js') );
        
        extract( $args );
        // Widget Option
        $title = apply_filters('widget_title', $instance['title']);
        $text = $instance['text'];
        $textarea = $instance['textarea'];
        echo $before_widget;
        // Display Widget

        echo '<div class="widget-text wp_widget_plugin_box">';

        // Check if title is set

        if ( $title ) {

          echo $before_title . $title . $after_title;

        }
        // Check if text is set
        if( $text ) {
          echo '<p class="wp_widget_plugin_text">'.$text.'</p>';
        }
       // Check if textarea is set
        if( $textarea ) {
         echo '<p class="wp_widget_plugin_textarea">'.$textarea.'</p>';
        }
        echo '</div>';
        echo $after_widget;
    }
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("widget_class");'));
?>
