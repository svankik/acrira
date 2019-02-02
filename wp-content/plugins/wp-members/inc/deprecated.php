<?php
/**
 * WP-Members Deprecated Functions
 *
 * These functions have been deprecated and are now obsolete.
 * Use alternative functions as these will be removed in a 
 * future release.
 * 
 * This file is part of the WP-Members plugin by Chad Butler
 * You can find out more about this plugin at https://rocketgeek.com
 * Copyright (c) 2006-2019  Chad Butler
 * WP-Members(tm) is a trademark of butlerblog.com
 *
 * @package   WP-Members
 * @author    Chad Butler 
 * @copyright 2006-2019
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! function_exists( 'wpmem_selected' ) ):
/**
 * Determines if a form field is selected (i.e. lists & checkboxes).
 *
 * @since 0.1.0
 * @deprecated 3.1.0 Use selected() or checked() instead.
 *
 * @param  string $value 
 * @param  string $valtochk
 * @param  string $type
 * @return string $issame
 */
function wpmem_selected( $value, $valtochk, $type = null ) {
	wpmem_write_log( "wpmem_selected() is deprecated as of WP-Members 3.1.0. Use selected() or checked() instead" );
	$issame = ( $type == 'select' ) ? ' selected' : ' checked';
	return ( $value == $valtochk ) ? $issame : '';
}
endif;

if ( ! function_exists( 'wpmem_shortcode' ) ):
/**
 * Executes various shortcodes.
 *
 * This function executes shortcodes for pages (settings, register, login, user-list,
 * and tos pages), as well as login status and field attributes when the wp-members tag
 * is used.  Also executes shortcodes for login status with the wpmem_logged_in tags
 * and fields when the wpmem_field tags are used.
 *
 * @since 2.4.0
 * @deprecated 3.1.2 
 *
 * @global object $wpmem The WP_Members object.
 *
 * @param  array  $attr {
 *     The shortcode attributes.
 *
 *     @type string $page
 *     @type string $url
 *     @type string $status
 *     @type string $msg
 *     @type string $field
 *     @type int    $id
 * }
 * @param  string $content
 * @param  string $tag
 * @return string Returns the result of wpmem_do_sc_pages|wpmem_list_users|wpmem_sc_expmessage|$content.
 */
function wpmem_shortcode( $attr, $content = null, $tag = 'wp-members' ) {
	
	$error = "wpmem_shortcode() is deprecated as of WP-Members 3.1.2. The [wp-members] shortcode tag should be replaced. ";
	$error.= 'See replacement shortcodes: http://rkt.bz/logsc ';
	$error.= "post ID: " . get_the_ID() . " ";
	$error.= "page url: " . wpmem_current_url();
	wpmem_write_log( $error );

	global $wpmem;

	// Set all default attributes to false.
	$defaults = array(
		'page'        => false,
		'redirect_to' => null,
		'url'         => false,
		'status'      => false,
		'msg'         => false,
		'field'       => false,
		'id'          => false,
		'underscores' => 'off',
	);

	// Merge defaults with $attr.
	$atts = shortcode_atts( $defaults, $attr, $tag );

	// Handles the 'page' attribute.
	if ( $atts['page'] ) {
		if ( $atts['page'] == 'user-list' ) {
			if ( function_exists( 'wpmem_list_users' ) ) {
				$content = do_shortcode( wpmem_list_users( $attr, $content ) );
			}
		} elseif ( $atts['page'] == 'tos' ) {
			return $atts['url'];
		} else {
			$content = do_shortcode( wpmem_do_sc_pages( $atts, $content, $tag ) );
		}

		// Resolve any texturize issues.
		if ( strstr( $content, '[wpmem_txt]' ) ) {
			// Fixes the wptexturize.
			remove_filter( 'the_content', 'wpautop' );
			remove_filter( 'the_content', 'wptexturize' );
			add_filter( 'the_content', 'wpmem_texturize', 999 );
		}
		return $content;
	}

	// Handles the 'status' attribute.
	if ( ( $atts['status'] ) || $tag == 'wpmem_logged_in' ) {
		return wpmem_sc_logged_in( $atts, $content, $tag );
	}

	// Handles the 'field' attribute.
	if ( $atts['field'] || $tag == 'wpmem_field' ) {
		return wpmem_sc_fields( $atts, $content, $tag );
	}

}
endif;

if ( ! function_exists( 'wpmem_do_sc_pages' ) ):
/**
 * Builds the shortcode pages (login, register, user-profile, user-edit, password).
 *
 * Some of the logic here is similar to the wpmem_securify() function. 
 * But where that function handles general content, this function 
 * handles building specific pages generated by shortcodes.
 *
 * @since 2.6.0
 * @deprecated 3.1.8 Use wpmem_sc_user_profile() or wpmem_sc_forms() instead.
 *
 * @global object $wpmem        The WP_Members object.
 * @global string $wpmem_themsg The WP-Members message container.
 * @global object $post         The WordPress post object.
 *
 * @param  string $atts {
 *     The shortcode attributes.
 *
 *     @type string $page
 *     @type string $redirect_to
 *     @type string $register
 * }
 * @param  string $content
 * @param  string $tag
 * @return string $content
 */
function wpmem_do_sc_pages( $atts, $content, $tag ) {
	
	$error = "wpmem_do_sc_pages() is deprecated as of WP-Members 3.1.8. ";
	$error.= "post ID: " . get_the_ID() . " ";
	$error.= "page url: " . wpmem_current_url();
	wpmem_write_log( $error );
	
	$page = ( isset( $atts['page'] ) ) ? $atts['page'] : $tag; 
	$redirect_to = ( isset( $atts['redirect_to'] ) ) ? $atts['redirect_to'] : null;
	$hide_register = ( isset( $atts['register'] ) && 'hide' == $atts['register'] ) ? true : false;

	global $wpmem, $wpmem_themsg, $post;
	include_once( WPMEM_PATH . 'inc/dialogs.php' );

	$content = '';

	// Deprecating members-area parameter to be replaced by user-profile.
	$page = ( $page == 'user-profile' ) ? 'members-area' : $page;

	if ( $page == 'members-area' || $page == 'register' ) {

		if ( $wpmem->regchk == "captcha" ) {
			global $wpmem_captcha_err;
			$wpmem_themsg = __( 'There was an error with the CAPTCHA form.' ) . '<br /><br />' . $wpmem_captcha_err;
		}

		if ( $wpmem->regchk == "loginfailed" ) {
			return wpmem_inc_loginfailed();
		}

		if ( ! is_user_logged_in() ) {
			if ( $wpmem->action == 'register' && ! $hide_register ) {

				switch( $wpmem->regchk ) {

				case "success":
					$content = wpmem_inc_regmessage( $wpmem->regchk,$wpmem_themsg );
					$content = $content . wpmem_inc_login();
					break;

				default:
					$content = wpmem_inc_regmessage( $wpmem->regchk,$wpmem_themsg );
					$content = $content . wpmem_inc_registration();
					break;
				}

			} elseif ( $wpmem->action == 'pwdreset' ) {

				$content = wpmem_page_pwd_reset( $wpmem->regchk, $content );

			} elseif( $wpmem->action == 'getusername' ) {
				
				$content = wpmem_page_forgot_username( $wpmem->regchk, $content );
				
			} else {

				$content = ( $page == 'members-area' ) ? $content . wpmem_inc_login( 'members' ) : $content;
				$content = ( ( $page == 'register' || $wpmem->show_reg[ $post->post_type ] != 0 ) && ! $hide_register ) ? $content . wpmem_inc_registration() : $content;
			}

		} elseif ( is_user_logged_in() && $page == 'members-area' ) {

			/**
			 * Filter the default heading in User Profile edit mode.
			 *
			 * @since 2.7.5
			 *
			 * @param string The default edit mode heading.
			 */
			$heading = apply_filters( 'wpmem_user_edit_heading', __( 'Edit Your Information', 'wp-members' ) );

			switch( $wpmem->action ) {

			case "edit":
				$content = $content . wpmem_inc_registration( 'edit', $heading );
				break;

			case "update":

				// Determine if there are any errors/empty fields.

				if ( $wpmem->regchk == "updaterr" || $wpmem->regchk == "email" ) {

					$content = $content . wpmem_inc_regmessage( $wpmem->regchk, $wpmem_themsg );
					$content = $content . wpmem_inc_registration( 'edit', $heading );

				} else {

					//Case "editsuccess".
					$content = $content . wpmem_inc_regmessage( $wpmem->regchk, $wpmem_themsg );
					$content = $content . wpmem_inc_memberlinks();

				}
				break;

			case "pwdchange":

				$content = wpmem_page_pwd_reset( $wpmem->regchk, $content );
				break;

			case "renew":
				$content = wpmem_renew();
				break;

			default:
				$content = wpmem_inc_memberlinks();
				break;
			}

		} elseif ( is_user_logged_in() && $page == 'register' ) {

			$content = $content . wpmem_inc_memberlinks( 'register' );

		}

	}

	if ( $page == 'login' ) {
		$content = ( $wpmem->regchk == "loginfailed" ) ? wpmem_inc_loginfailed() : $content;
		$content = ( ! is_user_logged_in() ) ? $content . wpmem_inc_login( 'login', $redirect_to ) : wpmem_inc_memberlinks( 'login' );
	}

	if ( $page == 'password' ) {
		$content = wpmem_page_pwd_reset( $wpmem->regchk, $content );
	}

	if ( $page == 'user-edit' ) {
		$content = wpmem_page_user_edit( $wpmem->regchk, $content );
	}

	return $content;
} // End wpmem_do_sc_pages.
endif;

/**
 * Add WP-Members fields to the WP user profile screen.
 *
 * @since 2.1
 * @deprecated 3.1.9
 *
 * @global array $current_screen The WordPress screen object
 * @global int   $user_ID The user ID
 */
function wpmem_admin_fields() {

	wpmem_write_log( "wpmem_admin_fields() is deprecated. No alternative function exists." );
	
	global $current_screen, $user_ID, $wpmem;
	$user_id = ( $current_screen->id == 'profile' ) ? $user_ID : $_REQUEST['user_id']; ?>

	<h3><?php
	/**
	 * Filter the heading for additional profile fields.
	 *
	 * @since 2.8.2
	 *
	 * @param string The default additional fields heading.
	 */
	echo apply_filters( 'wpmem_admin_profile_heading', __( 'WP-Members Additional Fields', 'wp-members' ) ); ?></h3>   
 	<table class="form-table">
		<?php
		// Get fields.
		$wpmem_fields = wpmem_fields( 'admin_profile' );
		// Get excluded meta.
		$exclude = wpmem_get_excluded_meta( 'admin-profile' );

		/**
		 * Fires at the beginning of generating the WP-Members fields in the user profile.
		 *
		 * @since 2.9.3
		 *
		 * @param int   $user_id      The user's ID.
		 * @param array $wpmem_fields The WP-Members fields.
		 */
		do_action( 'wpmem_admin_before_profile', $user_id, $wpmem_fields );

		// Assemble form rows array.
		$rows = array();
		foreach ( $wpmem_fields as $meta => $field ) {

			$valtochk = ''; $values = '';

			// Determine which fields to show in the additional fields area.
			$show = ( ! $field['native'] && ! in_array( $meta, $exclude ) ) ? true : false;
			$show = ( $field['label'] == 'TOS' && $field['register'] ) ? null : $show;

			if ( $show ) {

				$val = get_user_meta( $user_id, $meta, true );
				$val = ( $field['type'] == 'multiselect' || $field['type'] == 'multicheckbox' ) ? $val : htmlspecialchars( $val );
				if ( $field['type'] == 'checkbox' ) {
					$valtochk = $val;
					$val = $field['checked_value'];
				}
				
				if ( 'multicheckbox' == $field['type'] || 'select' == $field['type'] || 'multiselect' == $field['type'] || 'radio' == $field['type'] ) {
					$values = $field['values'];
					$valtochk = $val;
				}
				
				// Is this an image or a file?
				if ( 'file' == $field['type'] || 'image' == $field['type'] ) {
					$attachment_url = wp_get_attachment_url( $val );
					$empty_file = '<span class="description">' . __( 'None' ) . '</span>';
					if ( 'file' == $field['type'] ) {
						$input = ( $attachment_url ) ? '<a href="' . $attachment_url . '">' . $attachment_url . '</a>' : $empty_file;
					} else {
						$input = ( $attachment_url ) ? '<img src="' . $attachment_url . '">' : $empty_file;
					}
					$input.= '<br />' . $wpmem->get_text( 'profile_upload' ) . '<br />';
					$input.= wpmem_form_field( array(
						'name'    => $meta, 
						'type'    => $field['type'], 
						'value'   => $val, 
						'compare' => $valtochk,
					) );
				} else {
					if ( 'select' == $field['type'] || 'radio' == $field['type'] ) {
						$input = wpmem_create_formfield( $meta, $field['type'], $values, $valtochk );
					} elseif( 'multicheckbox' == $field['type'] || 'multiselect' == $field['type'] ) {
						$input = $wpmem->forms->create_form_field( array( 'name'=>$meta, 'type'=>$field['type'], 'value'=>$values, 'compare'=>$valtochk, 'delimiter'=>$field['delimiter'] ) );
					} else {
						$field['type'] = ( 'hidden' == $field['type'] ) ? 'text' : $field['type'];
						$input = wpmem_create_formfield( $meta, $field['type'], $val, $valtochk );
					}
				}
				
				// Is the field required?
				$req = ( $field['required'] ) ? ' <span class="description">' . __( '(required)' ) . '</span>' : '';
				$label = '<label>' . __( $field['label'], 'wp-members' ) . $req . '</label>';
				
				// Build the form rows for filtering.
				$rows[ $meta ] = array(
					'meta'         => $meta,
					'type'         => $field['type'],
					'value'        => $val,
					'values'       => $values,
					'label_text'   => __( $field['label'], 'wp-members' ),
					'row_before'   => '',
					'label'        => $label,
					'field_before' => '',
					'field'        => $input,
					'field_after'  => '',
					'row_after'    => '',
				);
			}
		}
		
		/**
		 * Filter for rows
		 *
		 * @since 3.1.0
		 * @since 3.1.6 Deprecated $order.
		 *
		 * @param array  $rows {
		 *     An array of the profile rows.
		 *
		 *     @type string $meta         The meta key.
		 *     @type string $type         The field type.
		 *     @type string $value        Value if set.
		 *     @type string $values       Possible values (select, multiselect, multicheckbox, radio).
		 *     @type string $label_text   Raw label text (no HTML).
		 *     @type string $row_before   HTML before the row.
		 *     @type string $label        HTML label.
		 *     @type string $field_before HTML before the field input tag.
		 *     @type string $field        HTML for field input.
		 *     @type string $field_after  HTML after the field.
		 *     @type string $row_after    HTML after the row.
		 * }
		 * @param string $toggle
		 */
		$rows = apply_filters( 'wpmem_register_form_rows_admin', $rows, 'adminprofile' );
		
		// Handle form rows display from array.
		foreach ( $rows as $row ) {
			$show_field = '
				<tr>
					<th>' . $row['label'] . '</th>
					<td>' . $row['field'] . '</td>
				</tr>';

			/**
			 * Filter the profile field.
			 * 
			 * @since 2.8.2
			 * @since 3.1.1 Added $user_id and $row
			 *
			 * @param string $show_field The HTML string for the additional profile field.
			 * @param string $user_id
			 * @param array  $row
			 */
			echo apply_filters( 'wpmem_admin_profile_field', $show_field, $user_id, $row );
		}

		/**
		 * Fires after generating the WP-Members fields in the user profile.
		 *
		 * @since 2.9.3
		 *
		 * @param int   $user_id      The user's ID.
		 * @param array $wpmem_fields The WP-Members fields.
		 */
		do_action( 'wpmem_admin_after_profile', $user_id, $wpmem_fields ); ?>

	</table><?php
}


/**
 * Updates WP-Members fields from the WP user profile screen.
 *
 * @since 2.1
 * @deprecated 3.1.9
 *
 * @global object $wpmem
 */
function wpmem_admin_update() {
	
	wpmem_write_log( "wpmem_admin_update() is deprecated. No alternative function exists." );

	$user_id = wpmem_get( 'user_id', false, 'request' ); //$_REQUEST['user_id'];
	
	if ( ! $user_id ) {
		// With no user id, no user can be updated.
		return;
	}
	
	global $wpmem;
	$wpmem_fields = wpmem_fields( 'admin_profile_update' );

	/**
	 * Fires before the user profile is updated.
	 *
	 * @since 2.9.2
	 *
	 * @param int   $user_id      The user ID.
	 * @param array $wpmem_fields Array of the custom fields.
	 */
	do_action( 'wpmem_admin_pre_user_update', $user_id, $wpmem_fields );

	$fields = array();
	$chk_pass = false;
	foreach ( $wpmem_fields as $meta => $field ) {
		if ( ! $field['native']
		  && $field['type'] != 'password' 
		  && $field['type'] != 'checkbox' 
		  && $field['type'] != 'multiselect' 
		  && $field['type'] != 'multicheckbox' 
		  && $field['type'] != 'file' 
		  && $field['type'] != 'image' ) {
			( isset( $_POST[ $meta ] ) ) ? $fields[ $meta ] = $_POST[ $meta ] : false;
		} elseif ( $meta == 'password' && $field['register'] ) {
			$chk_pass = true;
		} elseif ( $field['type'] == 'checkbox' ) {
			$fields[ $meta ] = ( isset( $_POST[ $meta ] ) ) ? $_POST[ $meta ] : '';
		} elseif ( $field['type'] == 'multiselect' || $field['type'] == 'multicheckbox' ) {
			$fields[ $meta ] = ( isset( $_POST[ $meta ] ) ) ? implode( $field['delimiter'], $_POST[ $meta ] ) : '';
		}
	}
	
	/**
	 * Filter the submitted field values for backend profile update.
	 *
	 * @since 2.8.2
	 *
	 * @param array $fields An array of the posted form values.
	 * @param int   $user_id The ID of the user being updated.
	 */
	$fields = apply_filters( 'wpmem_admin_profile_update', $fields, $user_id );

	// Get any excluded meta fields.
	$exclude = wpmem_get_excluded_meta( 'admin-profile' );
	foreach ( $fields as $key => $val ) {
		if ( ! in_array( $key, $exclude ) ) {
			update_user_meta( $user_id, $key, $val );
		}
	}
	
	if ( ! empty( $_FILES ) ) {
		$wpmem->user->upload_user_files( $user_id, $wpmem->fields );
	}	

	if ( $wpmem->mod_reg == 1 ) {

		$wpmem_activate_user = ( isset( $_POST['activate_user'] ) == '' ) ? -1 : $_POST['activate_user'];
		
		if ( $wpmem_activate_user == 1 ) {
			wpmem_a_activate_user( $user_id, $chk_pass );
		} elseif ( $wpmem_activate_user == 0 ) {
			wpmem_a_deactivate_user( $user_id );
		}
	}

	if ( defined( 'WPMEM_EXP_MODULE' ) && $wpmem->use_exp == 1 ) {
		if ( function_exists( 'wpmem_a_extenduser' ) ) {
			wpmem_a_extend_user( $user_id );
		}
	}

	/**
	 * Fires after the user profile is updated.
	 *
	 * @since 2.9.2
	 *
	 * @param int $user_id The user ID.
	 */
	do_action( 'wpmem_admin_after_user_update', $user_id );

	return;
}

if ( ! function_exists( 'wpmem_user_profile' ) ):
/**
 * add WP-Members fields to the WP user profile screen.
 *
 * @since 2.6.5
 * @deprecated 3.1.9
 *
 * @global int $user_id
 */
function wpmem_user_profile() {
	
	wpmem_write_log( "wpmem_user_profile() is deprecated. No alternative function exists." );

	global $wpmem, $user_id, $current_screen;
	/**
	 * Filter the heading for the user profile additional fields.
	 *
	 * @since 2.9.1
	 *
	 * @param string The default heading.
	 */?>
	<h3><?php echo apply_filters( 'wpmem_user_profile_heading', __( 'Additional Information', 'wp-members' ) ); ?></h3>
	<table class="form-table">
		<?php
		// Get fields.
		$wpmem_fields = wpmem_fields( 'dashboard_profile' );
		// Get excluded meta.
		$exclude = wpmem_get_excluded_meta( 'user-profile' );

		$rows = array();
		foreach ( $wpmem_fields as $meta => $field ) {

			$valtochk = ''; $values = '';
			
			// Do we exclude the row?
			$chk_pass = ( in_array( $meta, $exclude ) ) ? false : true;

			if ( $field['register'] && ! $field['native'] && $chk_pass ) {
				
				$val = get_user_meta( $user_id, $meta, true );

				if ( $field['type'] == 'checkbox' ) {
					$valtochk = $val; 
					$val = $field['checked_value'];
				}
				
				if ( 'multicheckbox' == $field['type'] || 'select' == $field['type'] || 'multiselect' == $field['type'] || 'radio' == $field['type'] ) {
					$values = $field['values'];
					$valtochk = $val;
				}

				// Is this an image or a file?
				if ( 'file' == $field['type'] || 'image' == $field['type'] ) {
					$attachment_url = wp_get_attachment_url( $val );
					$empty_file = '<span class="description">' . __( 'None' ) . '</span>';
					if ( 'file' == $field['type'] ) {
						$input = ( $attachment_url ) ? '<a href="' . $attachment_url . '">' . $attachment_url . '</a>' : $empty_file;
					} else {
						$input = ( $attachment_url ) ? '<img src="' . $attachment_url . '">' : $empty_file;
					}
					$input.= '<br />' . $wpmem->get_text( 'profile_upload' ) . '<br />';
					$input.= wpmem_form_field( array(
						'name'    => $meta, 
						'type'    => $field['type'], 
						'value'   => $val, 
						'compare' => $valtochk,
					) );
				} else {
					if ( $meta == 'tos' && $val == 'agree' ) {
						$input = wpmem_create_formfield( $meta, 'hidden', $val );
					} elseif ( 'multicheckbox' == $field['type'] || 'select' == $field['type'] || 'multiselect' == $field['type'] || 'radio' == $field['type'] ) {
						$input = wpmem_create_formfield( $meta, $field['type'], $values, $valtochk );
					} else {
						$input = wpmem_create_formfield( $meta, $field['type'], $val, $valtochk );
					}
				}

				// If there are any required fields.
				$req = ( $field['required'] ) ? ' <span class="description">' . __( '(required)' ) . '</span>' : '';
				$label = '<label>' . __( $field['label'], 'wp-members' ) . $req . '</label>';
				
				// Build the form rows for filtering.
				$rows[ $meta ] = array(
					'type'         => $field['type'],
					'value'        => $val,
					'values'       => $values,
					'label_text'   => __( $field['label'], 'wp-members' ),
					'row_before'   => '',
					'label'        => $label,
					'field_before' => '',
					'field'        => $input,
					'field_after'  => '',
					'row_after'    => '',
				);
			}
		}
				
		/**
		 * Filter for rows
		 *
		 * @since 3.1.0
		 * @since 3.1.6 Deprecated $order and $meta.
		 *
		 * @param array  $rows {
		 *     An array of the profile rows.
		 *
		 *     @type string $type         The field type.
		 *     @type string $value        Value if set.
		 *     @type string $values       Possible values (select, multiselect, multicheckbox, radio).
		 *     @type string $label_text   Raw label text (no HTML).
		 *     @type string $row_before   HTML before the row.
		 *     @type string $label        HTML label.
		 *     @type string $field_before HTML before the field input tag.
		 *     @type string $field        HTML for field input.
		 *     @type string $field_after  HTML after the field.
		 *     @type string $row_after    HTML after the row.
		 * }
		 * @param string $toggle
		 */
		$rows = apply_filters( 'wpmem_register_form_rows_profile', $rows, 'userprofile' );
		
		foreach ( $rows as $row ) {
				
			$show_field = '
				<tr>
					<th>' . $row['label'] . '</th>
					<td>' . $row['field'] . '</td>
				</tr>';

			/**
			 * Filter the field for user profile additional fields.
			 *
			 * @since 2.9.1
			 * @since 3.1.1 Added $user_id and $row.
			 *
			 * @param string $show_field The HTML string of the additional field.
			 * @param int    $user_id
			 * @param array  $rows
			 */
			echo apply_filters( 'wpmem_user_profile_field', $show_field, $user_id, $row );
			
		} ?>
	</table><?php
}
endif;


/**
 * updates WP-Members fields from the WP user profile screen.
 *
 * @since 2.6.5
 * @deprecated 3.1.9
 *
 * @global int $user_id
 */
function wpmem_profile_update() {
	
	wpmem_write_log( "wpmem_profile_update() is deprecated. No alternative function exists." );

	global $wpmem, $user_id;
	// Get the fields.
	$wpmem_fields = wpmem_fields( 'dashboard_profile_update' );
	// Get any excluded meta fields.
	$exclude = wpmem_get_excluded_meta( 'user-profile' );
	foreach ( $wpmem_fields as $meta => $field ) {
		// If this is not an excluded meta field.
		if ( ! in_array( $meta, $exclude ) ) {
			// If the field is user editable.
			if ( $field['register'] 
			  && $field['type'] != 'password' 
			  && $field['type'] != 'file' 
			  && $field['type'] != 'image' 
			  && ! $field['native'] ) {

				// Check for required fields.
				$chk = '';
				if ( ! $field['required'] ) {
					$chk = 'ok';
				}
				if ( $field['required'] && $_POST[ $meta ] != '' ) {
					$chk = 'ok';
				}

				// Check for field value.
				if ( $field['type'] == 'multiselect' || $field['type'] == 'multicheckbox' ) {
					$field_val = ( isset( $_POST[ $meta ] ) ) ? implode( '|', $_POST[ $meta ] ) : '';
				} else {
					$field_val = ( isset( $_POST[ $meta ] ) ) ? $_POST[ $meta ] : '';
				}

				if ( $chk == 'ok' ) {
					update_user_meta( $user_id, $meta, $field_val );
				}
			}
		}
	}
	
	if ( ! empty( $_FILES ) ) {
		$wpmem->user->upload_user_files( $user_id, $wpmem_fields );
	}	
}

if ( ! function_exists( 'wpmem_inc_status' ) ):
/**
 * Generate users login status if logged in and gives logout link.
 *
 * @since 1.8
 * @deprecated 3.2.0
 *
 * @global        $user_login
 * @global object $wpmem
 * @return string $status
 */
function wpmem_inc_status() {
	
	wpmem_write_log( "wpmem_inc_status() is deprecated in WP-Members 3.2.0. Use wpmem_login_status() instead." );
	
	global $user_login, $wpmem;
	
	/** This filter is documented in wp-members/inc/dialogs.php */
	$logout = apply_filters( 'wpmem_logout_link', $url . '/?a=logout' );

	$status = '<p>' . sprintf( $wpmem->get_text( 'sb_login_status' ), $user_login )
		. ' | <a href="' . $logout . '">' . $wpmem->get_text( 'sb_logout_link' ) . '</a></p>';

	return $status;
}
endif;

if ( ! function_exists( 'wpmem_do_sidebar' ) ):
/**
 * Creates the sidebar login form and status.
 *
 * This function determines if the user is logged in and displays either
 * a login form, or the user's login status. Typically used for a sidebar.		
 * You can call this directly, or with the widget.
 *
 * @since 2.4.0
 * @since 3.0.0 Added $post_to argument.
 * @since 3.1.0 Changed $post_to to $redirect_to.
 * @deprecated 3.2.0 Use widget_wpmemwidget::do_sidebar() instead.
 *
 * @param  string $redirect_to  A URL to redirect to upon login, default null.
 * @global string $wpmem_regchk
 * @global string $user_login
 */
function wpmem_do_sidebar( $redirect_to = null ) {
	wpmem_write_log( "wpmem_do_sidebar() is deprecated in WP-Members 3.2.0. Use wpmem_login_status() instead." );
	widget_wpmemwidget::do_sidebar( $redirect_to );
}
endif;

if ( ! function_exists( 'wpmem_create_formfield' ) ):
/**
 * Creates form fields
 *
 * Creates various form fields and returns them as a string.
 *
 * @since 1.8.0
 * @since 3.1.0 Converted to wrapper for create_form_field() in utlities object.
 * @deprecated 3.2.0 Use wpmem_form_field() instead.
 *
 * @global object $wpmem    The WP_Members object class.
 * @param  string $name     The name of the field.
 * @param  string $type     The field type.
 * @param  string $value    The default value for the field.
 * @param  string $valtochk Optional for comparing the default value of the field.
 * @param  string $class    Optional for setting a specific CSS class for the field.
 * @return string $str      The field returned as a string.
 */
function wpmem_create_formfield( $name, $type, $value, $valtochk=null, $class='textbox' ) {
	global $wpmem;
	$args = array(
		'name'     => $name,
		'type'     => $type,
		'value'    => $value,
		'compare'  => $valtochk,
		'class'    => $class,
	);
	return $wpmem->forms->create_form_field( $args );
}
endif;

/**
 * Adds the successful registration message on the login page if reg_nonce validates.
 *
 * @since 3.1.7
 * @deprecated 3.2.0 Use $wpmem->reg_securify() instead.
 *
 * @param  string $content
 * @return string $content
 */
function wpmem_reg_securify( $content ) {
	global $wpmem, $wpmem_themsg;
	$nonce = wpmem_get( 'reg_nonce', false, 'get' );
	if ( $nonce && wp_verify_nonce( $nonce, 'register_redirect' ) ) {
		$content = wpmem_inc_regmessage( 'success', $wpmem_themsg );
		$content = $content . wpmem_inc_login();
	}
	return $content;
}

/**
 * Enqueues the admin javascript and css files.
 *
 * Replaces wpmem_admin_enqueue_scripts().
 * Only loads the js and css on admin screens that use them.
 *
 * @since 3.1.7
 * @deprecated 3.2.0 Use $wpmem->admin->dashboard_enqueue_script() instead.
 *
 * @param str $hook The admin screen hook being loaded.
 */
function wpmem_dashboard_enqueue_scripts( $hook ) {
	if ( $hook == 'edit.php' || $hook == 'settings_page_wpmem-settings' ) {
		wp_enqueue_style( 'wpmem-admin', WPMEM_DIR . 'admin/css/admin.css', '', WPMEM_VERSION );
	}
	if ( $hook == 'settings_page_wpmem-settings' ) {
		wp_enqueue_script( 'wpmem-admin', WPMEM_DIR . 'admin/js/admin.js', '', WPMEM_VERSION );
	}
}

/**
 * Function for forms called by shortcode.
 *
 * @since 3.0.0
 * @since 3.1.3 Added forgot_username shortcode.
 * @since 3.2.0 Now a wrapper for WP_Members_Shortcodes::forms()
 *
 * @global object $wpmem The WP_Members object.
 *
 * @param  array  $attr
 * @param  string $content
 * @param  string $tag
 * @return string $content
 */
function wpmem_sc_forms( $atts, $content = null, $tag = 'wpmem_form' ) {
	global $wpmem;
	return $wpmem->shortcodes->forms( $atts, $content, $tag );
}

/**
 * Handles the logged in status shortcodes.
 *
 * There are two shortcodes to display content based on a user being logged
 * in - [wp-members status=in] and [wpmem_logged_in] (status=in is a legacy
 * shortcode, but will still function). There are several attributes that
 * can be used with the shortcode: in|out, sub for subscription only info,
 * id, and role. IDs and roles can be comma separated values for multiple
 * users and roles. Additionally, status=out can be used to display content
 * only to logged out users or visitors.
 *
 * @since 3.0.0
 * @since 3.2.0 Now a wrapper for WP_Members_Shortcodes::forms()
 *
 * @global object $wpmem The WP_Members object.
 * @param  array  $atts {
 *     The shortcode attributes.
 *
 *     @type string $status
 *     @type int    $id
 *     @type string $role
 *     @type string $sub
 * }
 * @param  string $content
 * @param  string $tag
 * @return string $content
 */
function wpmem_sc_logged_in( $atts, $content = null, $tag = 'wpmem_logged_in' ) {
	global $wpmem;
	return $wpmem->shortcodes->logged_in( $atts, $content, $tag );
}

/**
 * Handles the [wpmem_logged_out] shortcode.
 *
 * @since 3.0.0
 * @since 3.2.0 Now a wrapper for WP_Members_Shortcodes::logged_out()
 *
 * @global object $wpmem The WP_Members object.
 * @param  array  $atts
 * @param  string $content
 * @param  string $tag
 * @return string $content
 */
function wpmem_sc_logged_out( $atts, $content = null, $tag ) {
	global $wpmem;
	return $wpmem->shortcodes->logged_out( $atts, $content, $tag );
}

/**
 * User count shortcode [wpmem_show_count].
 *
 * User count displays a total user count or a count of users by specific
 * role (role="some_role").  It also accepts attributes for counting users
 * by a meta field (key="meta_key" value="meta_value").  A label can be 
 * displayed using the attribute label (label="Some label:").
 *
 * @since 3.0.0
 * @since 3.1.5 Added total user count features.
 * @since 3.2.0 Now a wrapper for WP_Members_Shortcodes::user_count()
 *
 * @global object $wpmem The WP_Members object.
 * @param  string $content The shortcode content.
 * @return string $content
 */
function wpmem_sc_user_count( $atts, $content = null ) {
	global $wpmem;
	return $wpmem->shortcodes->user_count( $atts, $content, $tag );
}

/**
 * Creates the user profile dashboard area [wpmem_profile].
 *
 * @since 3.1.0
 * @since 3.1.2 Added function arguments.
 * @since 3.2.0 Now a wrapper for WP_Members_Shortcodes::user_profile()
 *
 * @global object $wpmem The WP_Members object.
 * @param  string $atts {
 *     The shortcode attributes.
 *
 *     @type string $redirect_to
 * }
 * @param  string $content
 * @param  string $tag
 * @return string $content
 */
function wpmem_sc_user_profile( $atts, $content, $tag ) {
	global $wpmem;
	return $wpmem->shortcodes->user_profile( $atts, $content, $tag );
}

/**
 * Log in/out shortcode [wpmem_loginout].
 *
 * @since 3.1.1
 * @since 3.1.6 Uses wpmem_loginout().
 * @since 3.2.0 Now a wrapper for WP_Members_Shortcodes::loginout()
 *
 * @global object $wpmem The WP_Members object.
 * @param  array  $atts {
 *     The shortcode attributes.
 *
 *     @type string  $login_redirect_to  The url to redirect to after login (optional).
 *     @type string  $logout_redirect_to The url to redirect to after logout (optional).
 *     @type string  $login_text         Text for the login link (optional).
 *     @type string  $logout_text        Text for the logout link (optional).
 * }
 * @param  string $content
 * @param  string $tag
 * @return string $content
 */
function wpmem_sc_loginout( $atts, $content, $tag ) {
	global $wpmem;
	return $wpmem->shortcodes->loginout( $atts, $content, $tag );
}

/**
 * Function to handle field shortcodes [wpmem_field].
 *
 * Shortcode to display the data for a given user field. Requires
 * that a field meta key be passed as an attribute.  Can either of
 * the following:
 * - [wpmem_field field="meta_key"]
 * - [wpmem_field meta_key] 
 *
 * Other attributes:
 *
 * - id (numeric user ID or "get" to retrieve uid from query string.
 * - underscores="true" strips underscores from the displayed value.
 * - display="raw" displays the stored value for dropdowns, radios, files.
 * - size(thumbnail|medium|large|full|w,h): image field only.
 *
 * @since 3.1.2
 * @since 3.1.4 Changed to display value rather than stored value for dropdown/multicheck/radio.
 * @since 3.1.5 Added display attribute, meta key as a direct attribute, and image/file display.
 * @since 3.2.0 Now a wrapper for WP_Members_Shortcodes::fields()
 *
 * @global object $wpmem The WP_Members object.
 * @param  array  $atts {
 *     The shortcode attributes.
 *
 *     @type string {meta_key}
 *     @type string $field
 *     @type int    $id
 *     @type string $underscores
 *     @type string $display
 *     @type string size
 * }
 * @param  string $content Any content passed with the shortcode (default:null).
 * @param  string $tag     The shortcode tag (wpmem_form).
 * @return string $content Content to return.
 */
function wpmem_sc_fields( $atts, $content = null, $tag ) {
	global $wpmem;
	return $wpmem->shortcodes->fields( $atts, $content, $tag );
}

/**
 * Logout link shortcode [wpmem_logout].
 *
 * @since 3.1.2
 * @deprecated 3.2.0 Use WP_Members_Shortcodes::logout() instead.
 *
 * @global object $wpmem The WP_Members object.
 * @param  array  $atts {
 *     The shortcode attributes.
 *
 *     @type string $url
 * }
 * @param  string $content
 * @param  string $tag
 * @retrun string $content
 */
function wpmem_sc_logout( $atts, $content, $tag ) {
	global $wpmem;
	return $wpmem->shortcodes->logout( $atts, $content, $tag );
}

/**
 * TOS shortcode [wpmem_tos].
 *
 * @since 3.1.2
 * @deprecated 3.2.0 Use WP_Members_Shortcodes::tos() instead.
 *
 * @global object $wpmem The WP_Members object.
 * @param  array  $atts {
 *     The shortcode attributes.
 *
 *     @type string $url
 * }
 * @param  string $content
 * @param  string $tag
 * @retrun string $content
 */
function wpmem_sc_tos( $atts, $content, $tag ) {
	global $wpmem;
	return $wpmem->shortcodes->tos( $atts, $content, $tag );
}

/**
 * Display user avatar.
 *
 * @since 3.1.7
 * @deprecated 3.2.0 Use WP_Members_Shortcodes::avatar() instead.
 *
 * @global object $wpmem The WP_Members object.
 * @param  array  $atts {
 *     The shortcode attributes.
 *
 *     @type string $id   The user email or id.
 *     @type int    $size Avatar size (square) in pixels.
 * }
 * @param  string $content
 * @param  string $tag
 * @retrun string $content
 */
function wpmem_sc_avatar( $atts, $content, $tag ) {
	global $wpmem;
	return $wpmem->shortcodes->avatar( $atts, $content, $tag );
}

/**
 * Generates a login link with a return url.
 *
 * @since 3.1.7
 * @deprecated 3.2.0 Use WP_Members_Shortcodes::login_link() instead.
 *
 * @global object $wpmem The WP_Members object.
 * @param  array  $atts {
 *     The shortcode attributes.
 * }
 * @param  string $content
 * @param  string $tag
 * @retrun string $content
 */
function wpmem_sc_link( $atts, $content, $tag ) {
	global $wpmem;
	return $wpmem->shortcodes->login_link( $atts, $content, $tag );
}

if ( ! function_exists( 'wpmem_inc_regemail' ) ):
/**
 * Builds emails for the user.
 *
 * @since 1.8.0
 * @since 2.7.4 Added wpmem_email_headers and individual body/subject filters.
 * @since 2.9.7 Major overhaul, added wpmem_email_filter filter.
 * @since 3.1.0 Can filter in custom shortcodes with wpmem_email_shortcodes.
 * @since 3.1.1 Added $custom argument for custom emails.
 * @deprecated 3.2.0 Use WP_Members_Email::to_user() instead.
 *
 * @global object $wpmem                The WP_Members object.
 * @global string $wpmem_mail_from      The email from address.
 * @global string $wpmem_mail_from_name The email from name.
 * @param  int    $user_ID              The User's ID.
 * @param  string $password             Password from the registration process.
 * @param  string $toggle               Toggle indicating the email being sent (newreg|newmod|appmod|repass|getuser).
 * @param  array  $wpmem_fields         Array of the WP-Members fields (defaults to null).
 * @param  array  $fields               Array of the registration data (defaults to null).
 * @param  array  $custom               Array of custom email information (defaults to null).
 */
function wpmem_inc_regemail( $user_id, $password, $toggle, $wpmem_fields = null, $field_data = null, $custom = null ) {
	global $wpmem;
	wpmem_write_log( "wpmem_inc_regemail() is deprecated since WP-Members 3.2.0. Use $ wpmem->email->to_user() instead" );
	$wpmem->email->to_user( $user_id, $password, $toggle, $wpmem_fields, $field_data, $custom );
	return;
}
endif;

if ( ! function_exists( 'wpmem_check_activated' ) ):
/**
 * Checks if a user is activated.
 *
 * @since 2.7.1
 * @deprecated 3.2.2 Use wpmem_is_user_activated() instead.
 *
 * @param  object $user     The WordPress User object.
 * @param  string $username The user's username (user_login).
 * @param  string $password The user's password.
 * @return object $user     The WordPress User object.
 */ 
function wpmem_check_activated( $user, $username, $password ) {
	wpmem_write_log( "wpmem_check_activated() is deprecated since WP-Members 3.2.2. Use wpmem_is_user_activated() instead" );
	global $wpmem;
	$user = $wpmem->user->check_activated( $user, $username, $password );
	return $user;
}
endif;

/**
 * Activates a user.
 *
 * If registration is moderated, sets the activated flag 
 * in the usermeta. Flag prevents login when $wpmem->mod_reg
 * is true (1). Function is fired from bulk user edit or
 * user profile update.
 *
 * @since 2.4
 * @since 3.1.6 Dependencies now loaded by object.
 * @deprecated 3.2.4 Use wpmem_activate_user().
 *
 * @param int   $user_id
 * @param bool  $chk_pass
 * @uses  $wpdb WordPress Database object.
 */
function wpmem_a_activate_user( $user_id, $chk_pass = false ) {
	wpmem_write_log( "wpmem_a_activate_user() is deprecated as of WP-Members 3.2.4. Use wpmem_activate_user instead" );
	wpmem_activate_user( $user_id, $chk_pass );
}

/**
 * Deactivates a user.
 *
 * Reverses the active flag from the activation process
 * preventing login when registration is moderated.
 *
 * @since 2.7.1
 * @depreacted 3.2.4 Use wpmem_deactivate_user().
 *
 * @param int $user_id
 */
function wpmem_a_deactivate_user( $user_id ) {
	wpmem_write_log( "wpmem_a_deactivate_user() is deprecated as of WP-Members 3.2.4. Use wpmem_deactivate_user instead" );
	wpmem_deactivate_user( $user_id );
}