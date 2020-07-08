<?php
/*
Plugin Name: Last comments VK widget
Plugin URI: none
Description: Widget last comments VK
Version: 1.0
Author: Somonator
Author URI: none
*/

/*  Copyright 2016  Alexsandr (email: somonator@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


class Lcv_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'lcv_widget', 
			'Last comments VK',
			array( 'description' => 'Widget last comments VK', /*'classname' => 'my_widget',*/ )
		);
	}
	function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    $appid =@ $instance['appid']; 
    $limit =@ $instance['limit']; 
    $width =@ $instance['width']; 

    echo $args['before_widget'];
    if ( ! empty( $title ) ) {
      echo $args['before_title'] . $title . $args['after_title'];
    }
    echo '<div id="vk_comments1"></div>
<script type="text/javascript">
window.onload = function () {
 VK.init({apiId: '.$appid.', onlyWidgets: false});
 VK.Widgets.CommentsBrowse("vk_comments1", {width: "'.$width.'", limit: '.$limit.', mini: 0});
}
</script>' ;
    echo $args['after_widget'];
  }

	function form( $instance ) {
		$title = @ $instance['title'] ?: '';
		$appid = @ $instance['appid'] ?: '111';
		$width = @ $instance['width'] ?: 'auto';
		$limit = @ $instance['limit'] ?: '5';

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'appid' ); ?>"><?php _e( 'App id VK:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'appid' ); ?>" name="<?php echo $this->get_field_name( 'appid' ); ?>" type="text" value="<?php echo esc_attr( $appid ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e( 'Width:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo esc_attr( $width ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>">
		</p>
		<?php 
	}


	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['appid'] = ( ! empty( $new_instance['appid'] ) ) ? strip_tags( $new_instance['appid'] ) : '';
		$instance['width'] = ( ! empty( $new_instance['width'] ) ) ? strip_tags( $new_instance['width'] ) : '';
		$instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? strip_tags( $new_instance['limit'] ) : '';

		return $instance;
	}

} 

function register_lcv_widget() {
	register_widget( 'Lcv_Widget' );
}
add_action( 'widgets_init', 'register_lcv_widget' );