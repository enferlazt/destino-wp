<?php
function ale_init_metaboxes()
{
	if (!function_exists('aletheme_metaboxes')) {
		return;
	}
	
	add_filter('ale_meta_boxes', 'aletheme_metaboxes' );
	
	$meta_boxes = array();
	$meta_boxes = apply_filters ( 'ale_meta_boxes' , $meta_boxes );
	foreach ( $meta_boxes as $meta_box ) {
		new Ale_Meta_Box( $meta_box );
	}
}
if (is_admin()) {
	add_action('init', 'ale_init_metaboxes');
}

/**
 * Validate value of meta fields
 * Define ALL validation methods inside this class and use the names of these 
 * methods in the definition of meta boxes (key 'validate_func' of each field)
 */
class ale_meta_box_validate {
	function check_text( $text ) {
		if ($text != 'hello') {
			return false;
		}
		return true;
	}
}

/**
 * Create meta boxes
 */
class Ale_Meta_Box {
	protected $_meta_box;

	function __construct( $meta_box ) {
		if ( !is_admin() ) return;

		$this->_meta_box = $meta_box;

		$upload = false;
		foreach ( $meta_box['fields'] as $field ) {
			if ( $field['type'] == 'file' || $field['type'] == 'file_list' ) {
				$upload = true;
				break;
			}
		}
		
		global $pagenow;		
		if ( $upload && in_array( $pagenow, array( 'page.php', 'page-new.php', 'post.php', 'post-new.php' ) ) ) {
			add_action( 'admin_head', array( &$this, 'add_post_enctype' ) );
		}

		add_action( 'admin_menu', array( &$this, 'add' ) );
		add_action( 'save_post', array( &$this, 'save' ) );

		add_filter( 'ale_show_on', array( &$this, 'add_for_id' ), 10, 2 );
		add_filter( 'ale_show_on', array( &$this, 'add_for_page_template' ), 10, 2 );
	}

	function add_post_enctype() {
		echo '
		<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#post").attr("enctype", "multipart/form-data");
			jQuery("#post").attr("encoding", "multipart/form-data");
		});
		</script>';
	}

	// Add metaboxes
	function add() {
		$this->_meta_box['context'] = empty($this->_meta_box['context']) ? 'normal' : $this->_meta_box['context'];
		$this->_meta_box['priority'] = empty($this->_meta_box['priority']) ? 'high' : $this->_meta_box['priority'];
		$this->_meta_box['show_on'] = empty( $this->_meta_box['show_on'] ) ? array('key' => false, 'value' => false) : $this->_meta_box['show_on'];
		
		foreach ( $this->_meta_box['pages'] as $page ) {
			if( apply_filters( 'ale_show_on', true, $this->_meta_box ) )
				add_meta_box( $this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']) ;
		}
	}
	
	/**
	 * Show On Filters
	 * Use the 'ale_show_on' filter to further refine the conditions under which a metabox is displayed.
	 * Below you can limit it by ID and page template
	 */
	 
	// Add for ID 
	function add_for_id( $display, $meta_box ) {
		if ( 'id' !== $meta_box['show_on']['key'] )
			return $display;

		// If we're showing it based on ID, get the current ID					
		if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
		elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
		if( !isset( $post_id ) )
			return false;
		
		// If value isn't an array, turn it into one	
		$meta_box['show_on']['value'] = !is_array( $meta_box['show_on']['value'] ) ? array( $meta_box['show_on']['value'] ) : $meta_box['show_on']['value'];
		
		// If current page id is in the included array, display the metabox

		if ( in_array( $post_id, $meta_box['show_on']['value'] ) )
			return true;
		else
			return false;
	}
	
	// Add for Page Template
	function add_for_page_template( $display, $meta_box ) {
		if( 'page-template' !== $meta_box['show_on']['key'] )
			return $display;
			
		// Get the current ID
		if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
		elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
		if( !( isset( $post_id ) || is_page() ) ) return false;
			
		// Get current template
		$current_template = get_post_meta( $post_id, '_wp_page_template', true );
		
		// If value isn't an array, turn it into one	
		$meta_box['show_on']['value'] = !is_array( $meta_box['show_on']['value'] ) ? array( $meta_box['show_on']['value'] ) : $meta_box['show_on']['value'];

		// See if there's a match
		if( in_array( $current_template, $meta_box['show_on']['value'] ) )
			return true;
		else
			return false;
	}
	
	// Show fields
	function show() {

		global $post;

		// Use nonce for verification
		echo '<input type="hidden" name="wp_meta_box_nonce" value="', wp_create_nonce( basename(__FILE__) ), '" />';
		echo '<table class="form-table ale_metabox">';

		foreach ( $this->_meta_box['fields'] as $field ) {
			// Set up blank or default values for empty ones
			if ( !isset( $field['name'] ) ) $field['name'] = '';
			if ( !isset( $field['desc'] ) ) $field['desc'] = '';
			if ( !isset( $field['std'] ) ) $field['std'] = '';
			if ( 'file' == $field['type'] && !isset( $field['allow'] ) ) $field['allow'] = array( 'url', 'attachment' );
			if ( 'file' == $field['type'] && !isset( $field['save_id'] ) )  $field['save_id']  = false;
			if ( 'multicheck' == $field['type'] ) $field['multiple'] = true;  
						
			$meta = get_post_meta( $post->ID, $field['id'], 'multicheck' != $field['type'] /* If multicheck this can be multiple values */ );

			echo '<tr>';
	
			if ( $field['type'] == "title" ) {
				echo '<td colspan="2">';
			} else {
				if( $this->_meta_box['show_names'] == true ) {
					echo '<th style="width:18%"><label for="', $field['id'], '">', $field['name'], '</label></th>';
				}			
				echo '<td>';
			}		
						
			switch ( $field['type'] ) {

				case 'text':
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? $meta : $field['std'], '" />','<p class="ale_metabox_description">', $field['desc'], '</p>';
					break;
				case 'text_int':
					echo '<input type="number" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? $meta : $field['std'], '" />','<p class="ale_metabox_description">', $field['desc'], '</p>';
					break;
				case 'text_small':
					echo '<input class="ale_text_small" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? $meta : $field['std'], '" /><span class="ale_metabox_description">', $field['desc'], '</span>';
					break;
				case 'text_medium':
					echo '<input class="ale_text_medium" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? $meta : $field['std'], '" /><span class="ale_metabox_description">', $field['desc'], '</span>';
					break;
				case 'text_date':
					echo '<input class="ale_text_small ale_datepicker" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? $meta : $field['std'], '" /><span class="ale_metabox_description">', $field['desc'], '</span>';
					break;
				case 'text_date_timestamp':
					echo '<input class="ale_text_small ale_datepicker" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? date( 'm\/d\/Y', $meta ) : $field['std'], '" /><span class="ale_metabox_description">', $field['desc'], '</span>';
					break;
				case 'text_datetime_timestamp':
					echo '<input class="ale_text_small ale_datepicker" type="text" name="', $field['id'], '[date]" id="', $field['id'], '_date" value="', '' !== $meta ? date( 'm\/d\/Y', $meta ) : $field['std'], '" />';
					echo '<input class="ale_timepicker text_time" type="text" name="', $field['id'], '[time]" id="', $field['id'], '_time" value="', '' !== $meta ? date( 'h:i A', $meta ) : $field['std'], '" /><span class="ale_metabox_description" >', $field['desc'], '</span>';
					break;
				case 'text_time':
					echo '<input class="ale_timepicker text_time" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? $meta : $field['std'], '" /><span class="ale_metabox_description">', $field['desc'], '</span>';
					break;					
				case 'text_money':
					echo '$ <input class="ale_text_money" type="text" name="', $field['id'], '" id="', $field['id'], '" value="', '' !== $meta ? $meta : $field['std'], '" /><span class="ale_metabox_description">', $field['desc'], '</span>';
					break;
				case 'colorpicker':
					echo '<div id="' . esc_attr( $field['id'] . '_picker' ) . '" class="colorSelector"><div style="' . esc_attr( 'background-color:' . ('' !== $meta ? $meta : $field['std']) ) . '"></div></div>';
					echo '<input class="ale_colorpicker ale_text_small" name="' . $field['id'] . '" id="' . esc_attr($field['id']) . '" type="text" value="', '' !== $meta ? $meta : $field['std'], '" />';
					break;
				case 'textarea':
					echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="10">', '' !== $meta ? $meta : $field['std'], '</textarea>','<p class="ale_metabox_description">', $field['desc'], '</p>';
					break;
				case 'textarea_small':
					echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4">', '' !== $meta ? $meta : $field['std'], '</textarea>','<p class="ale_metabox_description">', $field['desc'], '</p>';
					break;
				case 'textarea_code':
					echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="10" class="ale_textarea_code">', '' !== $meta ? $meta : $field['std'], '</textarea>','<p class="ale_metabox_description">', $field['desc'], '</p>';
					break;					
				case 'select':
					echo '<select name="', $field['id'], '" id="', $field['id'], '">';
					foreach ($field['options'] as $option) {
						echo '<option value="', $option['value'], '"', $meta == $option['value'] ? ' selected="selected"' : '', '>', $option['name'], '</option>';
					}
					echo '</select>';
					echo '<p class="ale_metabox_description">', $field['desc'], '</p>';
					break;
				case 'custom_post_select':
				    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				    echo '<option value="0"></option>';
				    $items = get_posts( array('post_type'=> $field['post_type'], 'numberposts' => -1) );
				                                       
				    foreach ( $items as $item ) {
                       echo '<option value="', $item->ID, '"', $meta == $item->ID ? ' selected="selected"' : '', '>', $item->post_title, '</option>';
				    }
				    echo '</select>';
				    echo '<p class="ale_metabox_description">', $field['desc'], '</p>';
				    break;					
				case 'radio_inline':
					if( empty( $meta ) && !empty( $field['std'] ) ) $meta = $field['std'];
					echo '<div class="ale_radio_inline">';
					$i = 1;
					foreach ($field['options'] as $option) {
						echo '<div class="ale_radio_inline_option"><input type="radio" name="', $field['id'], '" id="', $field['id'], $i, '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' /><label for="', $field['id'], $i, '">', $option['name'], '</label></div>';
						$i++;
					}
					echo '</div>';
					echo '<p class="ale_metabox_description">', $field['desc'], '</p>';
					break;
				case 'radio':
					if( empty( $meta ) && !empty( $field['std'] ) ) $meta = $field['std'];
					echo '<ul>';
					$i = 1;
					foreach ($field['options'] as $option) {
						echo '<li><input type="radio" name="', $field['id'], '" id="', $field['id'], $i,'" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' /><label for="', $field['id'], $i, '">', $option['name'].'</label></li>';
						$i++;
					}
					echo '</ul>';
					echo '<p class="ale_metabox_description">', $field['desc'], '</p>';
					break;
				case 'checkbox':
					echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
					echo '<span class="ale_metabox_description">', $field['desc'], '</span>';
					break;
				case 'multicheck':
					echo '<ul>';
					$i = 1;
					foreach ( $field['options'] as $value => $name ) {
						// Append `[]` to the name to get multiple values
						// Use in_array() to check whether the current option should be checked
						echo '<li><input type="checkbox" name="', $field['id'], '[]" id="', $field['id'], $i, '" value="', $value, '"', in_array( $value, $meta ) ? ' checked="checked"' : '', ' /><label for="', $field['id'], $i, '">', $name, '</label></li>';	
						$i++;
					}
					echo '</ul>';
					echo '<span class="ale_metabox_description">', $field['desc'], '</span>';					
					break;		
				case 'title':
					echo '<h5 class="ale_metabox_title">', $field['name'], '</h5>';
					echo '<p class="ale_metabox_description">', $field['desc'], '</p>';
					break;
				case 'wysiwyg':
					wp_editor( $meta ? $meta : $field['std'], $field['id'], isset( $field['options'] ) ? $field['options'] : array() );
			        echo '<p class="ale_metabox_description">', $field['desc'], '</p>';
					break;
				case 'taxonomy_select':
					echo '<select name="', $field['id'], '" id="', $field['id'], '">';
					$names= wp_get_object_terms( $post->ID, $field['taxonomy'] );
					$terms = get_terms( $field['taxonomy'], 'hide_empty=0' );
					foreach ( $terms as $term ) {
						if (!is_wp_error( $names ) && !empty( $names ) && !strcmp( $term->slug, $names[0]->slug ) ) {
							echo '<option value="' . $term->slug . '" selected>' . $term->name . '</option>';
						} else {
							echo '<option value="' . $term->slug . '  ' , $meta == $term->slug ? $meta : ' ' ,'  ">' . $term->name . '</option>';
						}
					}
					echo '</select>';
					echo '<p class="ale_metabox_description">', $field['desc'], '</p>';
					break;
				case 'taxonomy_radio':
					$names= wp_get_object_terms( $post->ID, $field['taxonomy'] );
					$terms = get_terms( $field['taxonomy'], 'hide_empty=0' );
					echo '<ul>';
					foreach ( $terms as $term ) {
						if ( !is_wp_error( $names ) && !empty( $names ) && !strcmp( $term->slug, $names[0]->slug ) ) {
							echo '<li><input type="radio" name="', $field['id'], '" value="'. $term->slug . '" checked>' . $term->name . '</li>';
						} else {
							echo '<li><input type="radio" name="', $field['id'], '" value="' . $term->slug . '  ' , $meta == $term->slug ? $meta : ' ' ,'  ">' . $term->name .'</li>';
						}
					}
					echo '</ul>';
					echo '<p class="ale_metabox_description">', $field['desc'], '</p>';
					break;
				case 'taxonomy_multicheck':
					echo '<ul>';
					$names = wp_get_object_terms( $post->ID, $field['taxonomy'] );
					$terms = get_terms( $field['taxonomy'], 'hide_empty=0' );
					foreach ($terms as $term) {
						echo '<li><input type="checkbox" name="', $field['id'], '[]" id="', $field['id'], '" value="', $term->name , '"'; 
						foreach ($names as $name) {
							if ( $term->slug == $name->slug ){ echo ' checked="checked" ';};
						}
						echo' /><label>', $term->name , '</label></li>';
					}
				break;
				case 'file_list':
					echo '<input class="ale_upload_file" type="text" size="36" name="', $field['id'], '" value="" />';
					echo '<input class="ale_upload_button button" type="button" value="Upload File" />';
					echo '<p class="ale_metabox_description">', $field['desc'], '</p>';
						$args = array(
								'post_type' => 'attachment',
								'numberposts' => null,
								'post_status' => null,
								'post_parent' => $post->ID
							);
							$attachments = get_posts($args);
							if ($attachments) {
								echo '<ul class="attach_list">';
								foreach ($attachments as $attachment) {
									echo '<li>'.wp_get_attachment_link($attachment->ID, 'thumbnail', 0, 0, 'Download');
									echo '<span>';
									echo apply_filters('the_title', '&nbsp;'.$attachment->post_title);
									echo '</span></li>';
								}
								echo '</ul>';
							}
						break;
				case 'gallery':
					echo 'test';
						break;
				case 'file':
					$input_type_url = "hidden";
					if ( 'url' == $field['allow'] || ( is_array( $field['allow'] ) && in_array( 'url', $field['allow'] ) ) )
						$input_type_url="text";
					echo '<input class="ale_upload_file" type="' . $input_type_url . '" size="45" id="', $field['id'], '" name="', $field['id'], '" value="', $meta, '" />';
					echo '<input class="ale_upload_button button" type="button" value="Upload File" />';
					echo '<input class="ale_upload_file_id" type="hidden" id="', $field['id'], '_id" name="', $field['id'], '_id" value="', get_post_meta( $post->ID, $field['id'] . "_id",true), '" />';					
					echo '<p class="ale_metabox_description">', $field['desc'], '</p>';
					echo '<div id="', $field['id'], '_status" class="ale_upload_status">';	
						if ( $meta != '' ) { 
							$check_image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $meta );
							if ( $check_image ) {
								echo '<div class="img_status">';
								echo '<img style="max-width: 500px; max-height: 500px" src="', $meta, '" alt="" />';
								echo '<a href="#" class="ale_remove_file_button" rel="', $field['id'], '">Remove Image</a>';
								echo '</div>';
							} else {
								$parts = explode( '/', $meta );
								for( $i = 0; $i < count( $parts ); ++$i ) {
									$title = $parts[$i];
								} 
								echo 'File: <strong>', $title, '</strong>&nbsp;&nbsp;&nbsp; (<a href="', $meta, '" target="_blank" rel="external">Download</a> / <a href="#" class="ale_remove_file_button" rel="', $field['id'], '">Remove</a>)';
							}	
						}
					echo '</div>'; 
				break;
				default:
					do_action('ale_render_' . $field['type'] , $field, $meta);
			}
			
			echo '</td>','</tr>';
		}
		echo '</table>';
	}

	// Save data from metabox
	function save( $post_id)  {

		// verify nonce
		if ( ! isset( $_POST['wp_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['wp_meta_box_nonce'], basename(__FILE__) ) ) {
			return $post_id;
		}

		// check autosave
		if ( defined('DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// check permissions
		if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		foreach ( $this->_meta_box['fields'] as $field ) {
			$name = $field['id'];			

			if ( ! isset( $field['multiple'] ) )
				$field['multiple'] = ( 'multicheck' == $field['type'] ) ? true : false;    
				  
			$old = get_post_meta( $post_id, $name, !$field['multiple'] /* If multicheck this can be multiple values */ );
			$new = isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : null;
			
			if ( in_array( $field['type'], array( 'taxonomy_select', 'taxonomy_radio', 'taxonomy_multicheck' ) ) )  {	
				$new = wp_set_object_terms( $post_id, $new, $field['taxonomy'] );	
			}
			
			if ( ($field['type'] == 'textarea') || ($field['type'] == 'textarea_small') ) {
				$new = htmlspecialchars( $new );
			}

			if ( ($field['type'] == 'textarea_code') ) {
				$new = htmlspecialchars_decode( $new );
			}
			
			if ( $field['type'] == 'text_date_timestamp' ) {
				$new = strtotime( $new );
			}

			if ( $field['type'] == 'text_datetime_timestamp' ) {
				$string = $new['date'] . ' ' . $new['time'];
				$new = strtotime( $string );
			}
			
			$new = apply_filters('ale_validate_' . $field['type'], $new, $post_id, $field);			
			
			// validate meta value
			if ( isset( $field['validate_func']) ) {
				$ok = call_user_func( array( 'ale_meta_box_validate', $field['validate_func']), $new );
				if ( $ok === false ) { // pass away when meta value is invalid
					continue;
				}
			} elseif ( $field['multiple'] ) {
				delete_post_meta( $post_id, $name );	
				if ( !empty( $new ) ) {
					foreach ( $new as $add_new ) {
						add_post_meta( $post_id, $name, $add_new, false );
					}
				}			
			} elseif ( '' !== $new && $new != $old  ) {
				update_post_meta( $post_id, $name, $new );
			} elseif ( '' == $new ) {
				delete_post_meta( $post_id, $name );
			}
			
			if ( 'file' == $field['type'] ) {
				$name = $field['id'] . "_id";
				$old = get_post_meta( $post_id, $name, !$field['multiple'] /* If multicheck this can be multiple values */ );
				if ( isset( $field['save_id'] ) && $field['save_id'] ) {
					$new = isset( $_POST[$name] ) ? $_POST[$name] : null;
				} else {
					$new = "";
				}

				if ( $new && $new != $old ) {
					update_post_meta( $post_id, $name, $new );
				} elseif ( '' == $new && $old ) {
					delete_post_meta( $post_id, $name, $old );
				}
			}			
		}
	}
}

function ale_editor_footer_scripts() { ?>
	<?php
	if ( isset( $_GET['ale_force_send'] ) && 'true' == $_GET['ale_force_send'] ) { 
		$label = $_GET['ale_send_label']; 
		if ( empty( $label ) ) $label="Select File";
		?>	
		<script type="text/javascript">
		jQuery(function($) {
			$('td.savesend input').val('<?php echo $label; ?>');
		});
		</script>
		<?php 
	}
}
add_action( 'admin_print_footer_scripts', 'ale_editor_footer_scripts', 99 );

// Force 'Insert into Post' button from Media Library 
add_filter( 'get_media_item_args', 'ale_force_send' );
function ale_force_send( $args ) {
		
	// if the Gallery tab is opened from a custom meta box field, add Insert Into Post button	
	if ( isset( $_GET['ale_force_send'] ) && 'true' == $_GET['ale_force_send'] )
		$args['send'] = true;
	
	// if the From Computer tab is opened AT ALL, add Insert Into Post button after an image is uploaded	
	if ( isset( $_POST['attachment_id'] ) && '' != $_POST["attachment_id"] ) {
		$args['send'] = true;
	}		
	
	// change the label of the button on the From Computer tab
	if ( isset( $_POST['attachment_id'] ) && '' != $_POST["attachment_id"] ) {

		echo '
			<script type="text/javascript">
				function cmbGetParameterByNameInline(name) {
					name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
					var regexS = "[\\?&]" + name + "=([^&#]*)";
					var regex = new RegExp(regexS);
					var results = regex.exec(window.location.href);
					if(results == null)
						return "";
					else
						return decodeURIComponent(results[1].replace(/\+/g, " "));
				}
							
				jQuery(function($) {
					if (cmbGetParameterByNameInline("ale_force_send")=="true") {
						var ale_send_label = cmbGetParameterByNameInline("ale_send_label");
						$("td.savesend input").val(ale_send_label);
					}
				});
			</script>
		';
	}
	 
    return $args;

}


/**
 * Add metabox for Top level pages only
 */
function ale_metabox_add_for_top_level_posts_only( $display, $meta_box ) {

	if ( 'parent-id' !== $meta_box['show_on']['key'] )
		return $display;

	// Get the post's ID so we can see if it has ancestors					
	if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
	elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
	if( !isset( $post_id ) )
		return false;

	// If the post doesn't have ancestors, show the box
	if ( !get_post_ancestors( $post_id ) )
		return $display;
        // Otherwise, it's not a top level post, so don't show it
	else
		return false;
}
add_filter( 'ale_show_on', 'ale_metabox_add_for_top_level_posts_only', 10, 2 );

/**
 * Add metabox for ancestor pages
 */
function ale_metabox_add_for_ancestors_posts_only( $display, $meta_box ) {

	if ( 'ancestor' !== $meta_box['show_on']['key'] )
		return $display;

	// Get the post's ID so we can see if it has ancestors					
	if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
	elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
	if( !isset( $post_id ) )
		return false;
	
	$post = get_post($post_id);
	
	// If the post doesn't have ancestors, show the box
	if ($post->post_parent)
		return $display;
        // Otherwise, it's not a top level post, so don't show it
	else
		return false;
}
add_filter( 'ale_show_on', 'ale_metabox_add_for_ancestors_posts_only', 10, 2 );





function aletheme_metaboxes($meta_boxes) {

	$meta_boxes = array();

	$prefix = "des_";

	$meta_boxes[] = array(
		'id'         => 'about_metaboxes',
		'title'      => __('Settings for About Page', 'aletheme'),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on'    => array( 'key' => 'page-template', 'value' => array('template-about.php'), ), // Specific post templates to display this metabox
		'fields' => array(
			array(
				'name' => __('Background','aletheme'),
				'desc' => __('Background Header for about page','aletheme'),
				'id'   => $prefix . 'background',			
				'std'  => '',
				'type' => 'file',
			),
			array(
				'name' => __('Title text','aletheme'),
				'desc' => __('Write title text for about page','aletheme'),
				'id'   => $prefix . 'title',
				'std'  => 'We are an award winning Agency',
				'type' => 'text',
			),
			array(
				'name' => __('Subtitle text','aletheme'),
				'desc' => __('Write subtitle text for about page','aletheme'),
				'id'   => $prefix . 'subtitle',
				'std'  => 'TAKE A LOOK AT OUR STORY',
				'type' => 'text',
			),
			array(
				'name' => __('Image','aletheme'),
				'desc' => __('Image for about','aletheme'),
				'id'   => $prefix . 'image',			
				'std'  => '',
				'type' => 'file',
			),
			array(
				'name' => __('Display Read More button?','aletheme'),
				'id'   => $prefix . 'read_more',
				'options'  => array(array('name' => __('Yes', 'aletheme'), 'value' => '0'), array('name' => __('No', 'aletheme'), 'value' => '1')),
				'type' => 'select',
			),
			array(
				'name' => __('Add new section with custom counters?','aletheme'),
				'id'   => $prefix . 'new_s1',
				'options'  => array(array('name' => __('Yes', 'aletheme'), 'value' => '0'), array('name' => __('No', 'aletheme'), 'value' => '1')),
				'type' => 'select',
			),
			array(
				'name' => __('Add new section with links?','aletheme'),
				'id'   => $prefix . 'new_s2',
				'options'  => array(array('name' => __('Yes', 'aletheme'), 'value' => '0'), array('name' => __('No', 'aletheme'), 'value' => '1')),
				'type' => 'select',
			),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'about_metaboxes_s1',
		'title'      => __('Setting for section with custom counters. (!) You can see changes after adding this section in Settings for About Page', 'aletheme'),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on'    => array( 'key' => 'page-template', 'value' => array('template-about.php'), ), // Specific post templates to display this metabox
		'fields' => array(
						array(
				'name' => __('Background image of this section','aletheme'),
				'id'   => $prefix . 'bg_s1',			
				'std'  => '',
				'type' => 'file',
			),
			array(
				'name' => __('Title of this section','aletheme'),
				'id'   => $prefix . 'title_s1',
				'std'  => 'Fun facts about our Agency',
				'type' => 'text',
			),
			array(
				'name' => __('Subtitle of this section','aletheme'),
				'id'   => $prefix . 'subtitle_s1',
				'std'  => 'take a look',
				'type' => 'text',
			),
			array(
				'name' => __('Content of this section','aletheme'),
				'id'   => $prefix . 'content_s1',
				'std'  => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce fringilla lectus nec diam auctor, ut fringilla diam sagittis. Quisque vel est id justo faucibus dapibus id a nibh',
				'type' => 'textarea',
			),
			array(
				'name' => __('Icon of first counter','aletheme'),
				'id'   => $prefix . 'i_counter1',
				'type' => 'file',
			),
			array(
				'name' => __('First counter','aletheme'),
				'desc' => __('Integers numbers in first counter','aletheme'),
				'id'   => $prefix . 'int_counter1',
				'std'  => '17',
				'type' => 'text_int',
			),
			array(
				'name' => __('Text under first counter','aletheme'),
				'id'   => $prefix . 'txt_counter1',
				'std'  => 'Mountains Climbed',
				'type' => 'text',
			),
			array(
				'name' => __('Icon of second counter','aletheme'),
				'id'   => $prefix . 'i_counter2',
				'type' => 'file',
			),
			array(
				'name' => __('Second counter','aletheme'),
				'desc' => __('Integers numbers in second counter','aletheme'),
				'id'   => $prefix . 'int_counter2',
				'std'  => '213',
				'type' => 'text_int',
			),
			array(
				'name' => __('Text under second counter','aletheme'),
				'id'   => $prefix . 'txt_counter2',
				'std'  => 'Islands Visited',
				'type' => 'text',
			),
			array(
				'name' => __('Icon of third counter','aletheme'),
				'id'   => $prefix . 'i_counter3',
				'type' => 'file',
			),
			array(
				'name' => __('Third counter','aletheme'),
				'desc' => __('Integers numbers in third counter','aletheme'),
				'id'   => $prefix . 'int_counter3',
				'std'  => '11923',
				'type' => 'text_int',
			),
			array(
				'name' => __('Text under third counter','aletheme'),
				'id'   => $prefix . 'txt_counter3',
				'std'  => 'Photos Taken',
				'type' => 'text',
			),
			array(
				'name' => __('Icon of fourth counter','aletheme'),
				'id'   => $prefix . 'i_counter4',
				'type' => 'file',
			),
			array(
				'name' => __('Fourth counter','aletheme'),
				'desc' => __('Integers numbers in fourth counter','aletheme'),
				'id'   => $prefix . 'int_counter4',
				'std'  => '15',
				'type' => 'text_int',
			),
			array(
				'name' => __('Text under fourth counter','aletheme'),
				'id'   => $prefix . 'txt_counter4',
				'std'  => 'Cruises Organized',
				'type' => 'text',
			),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'about_metaboxes_s2',
		'title'      => __('Setting for section with links. (!) You can see changes after adding this section in Settings for About Page', 'aletheme'),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on'    => array( 'key' => 'page-template', 'value' => array('template-about.php'), ), // Specific post templates to display this metabox
		'fields' => array(
			array(
				'name' => __('Title of this section','aletheme'),
				'id'   => $prefix . 'title_s2',
				'std'  => 'Popular services that we offer',
				'type' => 'text',
			),
			array(
				'name' => __('Subtitle of this section','aletheme'),
				'id'   => $prefix . 'subtitle_s2',
				'std'  => 'TAKE A LOOK AT THESE OFFERS',
				'type' => 'text',
			),
			array(
				'name' => __('Icon of first link','aletheme'),
				'id'   => $prefix . 'i_link1',
				'type' => 'file',
			),
			array(
				'name' => __('Title first link','aletheme'),
				'desc' => __('Title from description first link','aletheme'),
				'id'   => $prefix . 'title_link1',
				'std'  => 'Weekend trips',
				'type' => 'text',
			),
			array(
				'name' => __('Content first link','aletheme'),
				'desc' => __('Content from description first link','aletheme'),
				'id'   => $prefix . 'content_link1',
				'std'  => 'Lorem ipsum dolor sit amet, consectetur adip iscing elit. Fusce fringilla lectus nec diam auctor, ut fringilla diam sagittis.',
				'type' => 'text',
			),
			array(
				'name' => __('Icon of second link','aletheme'),
				'id'   => $prefix . 'i_link2',
				'type' => 'file',
			),
			array(
				'name' => __('Title second link','aletheme'),
				'desc' => __('Title from description second link','aletheme'),
				'id'   => $prefix . 'title_link2',
				'std'  => 'Fun leisure trips',
				'type' => 'text',
			),
			array(
				'name' => __('Content second link','aletheme'),
				'desc' => __('Content from description second link','aletheme'),
				'id'   => $prefix . 'content_link2',
				'std'  => 'Lorem ipsum dolor sit amet, consectetur adip iscing elit. Fusce fringilla lectus nec diam auctor, ut fringilla diam sagittis.',
				'type' => 'text',
			),
			array(
				'name' => __('Icon of third link','aletheme'),
				'id'   => $prefix . 'i_link3',
				'type' => 'file',
			),
			array(
				'name' => __('Title third link','aletheme'),
				'desc' => __('Title from description third link','aletheme'),
				'id'   => $prefix . 'title_link3',
				'std'  => 'Plane tickets',
				'type' => 'text',
			),
			array(
				'name' => __('Content third link','aletheme'),
				'desc' => __('Content from description third link','aletheme'),
				'id'   => $prefix . 'content_link3',
				'std'  => 'Lorem ipsum dolor sit amet, consectetur adip iscing elit. Fusce fringilla lectus nec diam auctor, ut fringilla diam sagittis.',
				'type' => 'text',
			),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'excursions_tax',
		'title'      => __('Settings for Excursions', 'aletheme'),
		'pages'      => array( 'excursions', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Price','aletheme'),
				'desc' => __('Price excursion from a ... $ for person','aletheme'),
				'id'   => $prefix . 'price',
				'std'  => '100',
				'type' => 'text_money',
			),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'offers_tax',
		'title'      => __('Settings for Offers', 'aletheme'),
		'pages'      => array( 'offers', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => __('Description','aletheme'),
				'desc' => __('Description of Hotel, e.g., number rooms, swimming pools, bars, etc','aletheme'),
				'id'   => $prefix . 'desc',			
				'std'  => '100 rooms / 2 swimming pools / 4 bars',
				'type' => 'text',
			),
			array(
				'name' => __('Price','aletheme'),
				'desc' => __('Price Hotel from a ... $ for night','aletheme'),
				'id'   => $prefix . 'price',			
				'std'  => '100',
				'type' => 'text_money',
			),
		)
	);

	$meta_boxes[] = array(
		'id'         => 'contact_metaboxes',
		'title'      => __('Settings for Contact Page', 'aletheme'),
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'show_on'    => array( 'key' => 'page-template', 'value' => array('template-contact.php'), ), // Specific post templates to display this metabox
		'fields' => array(
			array(
				'name' => __('Background','aletheme'),
				'desc' => __('Background Header for contact page','aletheme'),
				'id'   => $prefix . 'background',			
				'std'  => '',
				'type' => 'file',
			),
			array(
				'name' => __('Title text','aletheme'),
				'desc' => __('Write title text for contact page','aletheme'),
				'id'   => $prefix . 'title',
				'std'  => 'Get in touch',
				'type' => 'text',
			),
			array(
				'name' => __('Subtitle text','aletheme'),
				'desc' => __('Write subtitle text for contact page','aletheme'),
				'id'   => $prefix . 'subtitle',
				'std'  => 'SAY HELLO',
				'type' => 'text',
			),
			array(
				'name' => __('Address','aletheme'),
				'desc' => __('Addresses of your company','aletheme'),
				'id'   => $prefix . 'address',
				'std'  => '1481 Creekside Lane Avila Beach, CA 93424',
				'type' => 'text',
			),
			array(
				'name' => __('Phone','aletheme'),
				'desc' => __('All phones your company','aletheme'),
				'id'   => $prefix . 'phone',
				'std'  => '+53 345 7953 32453',
				'type' => 'text',
			),
			array(
				'name' => __('Email','aletheme'),
				'desc' => __('Paste your email','aletheme'),
				'id'   => $prefix . 'email',
				'std'  => 'miloThemes@gmail.com',
				'type' => 'text',
			),
			array(
				'name' => __('Form Shortcode','aletheme'),
				'desc' => __('Install CF7 Plugin. Create your form. And paste the shortcode here.','aletheme'),
				'id'   => $prefix . 'formcode',
				'std'  => '[contact-form-7 id="30" title="Contact form 1"]',
				'type' => 'textarea_code',
			),
		)
	);

	return $meta_boxes;
}