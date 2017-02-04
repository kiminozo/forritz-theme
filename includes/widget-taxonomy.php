<?php
add_action( 'widgets_init', 'custom_load_widgets' );

function custom_load_widgets() {
	register_widget( 'Taxonomy_Widget' );
	register_widget( 'Bootsearch_Widget' );
}

class Taxonomy_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Taxonomy_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget-taxonomy-list', 
			'description' => __('A taxonomy list widget.', 'forritz') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'taxonomy-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'taxonomy-widget', __('Taxonomy Widget', 'forritz'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$taxonomy = $instance['taxonomy'];
		$parameter = $instance['parameter'];
		if($parameter)$parameter = '&'.$parameter;

		echo $before_widget;
		
		forritz_list_categories('taxonomy='.$taxonomy.$parameter.'&title_li=<h3 class="widget-title">'.$title.'</h3>');

		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['taxonomy'] = strip_tags( $new_instance['taxonomy'] );

		/* No need to strip tags for sex and show_sex. */
		$instance['parameter'] = $new_instance['parameter'];
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:80%;" />
		</p>

		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>"><?php _e('Taxonomy:', 'forritz'); ?></label>
			<!--			<input id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>" value="<?php echo $instance['taxonomy']; ?>" style="width:100%;" />-->
			<select id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>" class="widefat" style="width:80%;">
				<?php $taxonomies = get_taxonomies(array(),'objects');
				foreach($taxonomies as $taxonomy)
					if ( $taxonomy->name == $instance['taxonomy'])
						printf('<option value="%s" selected="selected">%s</option>',$taxonomy->name,$taxonomy->label);
					else
						printf('<option value="%s">%s</option>',$taxonomy->name,$taxonomy->label);
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id( 'parameter' ); ?>"><?php _e('parameter:', 'forritz'); ?></label>
				<input id="<?php echo $this->get_field_id( 'parameter' ); ?>" name="<?php echo $this->get_field_name( 'parameter' ); ?>" value="<?php echo $instance['parameter']; ?>" style="width:80%;" />
			</p>

			<?php
		}
	}




	class Bootsearch_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Bootsearch_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'bootsearch-widget', 
			'description' => __('A bootsearch widget.', 'forritz') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'bootsearch-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'bootsearch-widget', __('Bootsearch Widget', 'forritz'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		echo $before_widget;
		forritz_search_form();
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:80%;" />
		</p>

		

		<?php
	}
}
?>