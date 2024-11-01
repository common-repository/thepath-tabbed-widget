<?php   
/**
 * @package ThePath_Tabbed_Widget
 * @version 1.2.1
 */
	/*
	Plugin Name: ThePath Tabbed Widget  
	Plugin URI: http://www.thepathwebdesign.com/articles/thepath-tabbed-widget-plugin/205/ 
	Description: Plugin for displaying Recent Posts, Popular Posts and Featured Posts. This plugin is great if you have limited space in your sidebar (or widget area). Requires WordPress.com Popular Posts and Yet Another Featured Posts Plugin to display the Popular and Featured posts respectively.
	Author: ThePath 
	Version: 1.2.1
	Author URI: http://www.thepathwebdesign.com 
	*/  
class thepath_tabbed_widget extends WP_Widget {
	function thepath_tabbed_widget() {
        $widget_ops = array('classname' => 'widget_thepath_tabbed', 'description' => __( "ThePath Tabbed Widget displays recent, popular and featured posts in a tabbed format in your sidebar") );
		$this->WP_Widget('thepath_tabbed_widget', __('ThePath Tabbed Widget'), $widget_ops);
    }

	function widget($args, $instance) {
		extract($args);

		echo '<!--/ThePath Tabbed Widget by www.thepathwebdesign.com-->
		<div id="thepathtab">
			<ul class="tabnav">  
				<li><a href="#recent">Recent</a></li> 
				<li><a href="#popular">Popular</a></li>   
				<li><a href="#featured">Featured</a></li>  
			</ul>
			
			<div id="recent" class="tabdiv">
				 <ul>';
				  wp_get_archives('type=postbypost&limit=10');
			echo'</ul>
			</div>
			
			<div id="popular" class="tabdiv">';
				  if (function_exists('WPPP_show_popular_posts')){ WPPP_show_popular_posts();}
			echo'</div>
		
			<div id="featured" class="tabdiv">
				 <ul>';
				  if (function_exists('get_featured_posts')){ get_featured_posts();}
			echo'</ul>
			</div>
		</div>';
	}
	
	function update($new_instance, $old_instance){
	return $new_instance;
	}
	function form($instance){
	
	}
}
add_action('widgets_init', create_function('', 'return register_widget("thepath_tabbed_widget");'));

if ( !is_admin() ) {
	function thepath_files() {
		wp_enqueue_script('jquery');
		wp_register_script('thepathjs', WP_PLUGIN_URL . '/thepath-tabbed-widget/thepath.js');
		wp_enqueue_script('thepathjs');
		wp_register_script('jquery-ui', WP_PLUGIN_URL . '/thepath-tabbed-widget/jquery-ui.min-1.8.14.js');
		wp_enqueue_script('jquery-ui');
		wp_register_style('thepathcss', WP_PLUGIN_URL . '/thepath-tabbed-widget/thepath.css');
		wp_enqueue_style('thepathcss');
	}
	add_action('init', 'thepath_files');
}
?>