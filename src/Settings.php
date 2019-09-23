<?php

namespace MJJ_LGJ;

use MJJ_LGJ\User;

class Settings {

	/**
	 * Adds the settings to use for this plugin.
	 *
	 * @return void
	 */
	public function add_settings() {
		// add the Dummy User settings page.
		$title = 'Dummy GraphQL user info';
		$cmb   = new_cmb2_box(
			[
				'id'           => 'mjj_dummy_jwt_settings',
				'title'        => $title,
				'object_types' => [ 'options-page' ],
				'option_key'   => 'mjj_dummy_jwt_settings',
				'parent_slug'  => 'options-general.php', // Change this when I can figure out how to hook it correctly so that the theme settings page is there.
			]
		);

		$user                 = new User();
		$dummy_user_token_exp = date( 'l, j M Y H:i', (int) $user->get_token_expiration() );
		$user_obj             = ( ! empty( $user ) ) ? get_user_by( 'id', $user->user_id ) : false;
		$user_name            = ( $user_obj ) ? esc_html( $user_obj->user_login ) : 'No user';
		$user_link            = esc_url( get_edit_user_link( $user->user_id ) );
		$user_meta            = get_userdata( $user->user_id );
		$user_roles           = $user_meta->roles; // array of roles the user is part of.

		$user_role_text = '';
		foreach ( $user_roles as $user_role ) {
			$user_role_text .= $user_role . ', ';
		}
		$user_role_text = rtrim( $user_role_text, ', ' );

		$cmb->add_field(
			[
				'name' => 'Dummy user.',
				'id'   => 'user',
				'desc' => "<a href='$user_link'>$user_name</a>",
				'type' => 'title',
			]
		);
		$cmb->add_field(
			[
				'name' => 'Roles. Change role in their profile.',
				'id'   => 'roles',
				'desc' => esc_html( $user_role_text ),
				'type' => 'title',
			]
		);
		$cmb->add_field(
			[
				'name' => 'Token expiration date (no check to see if it exists, if not the date is 0).',
				'id'   => 'exp_date',
				'desc' => esc_html( $dummy_user_token_exp ),
				'type' => 'title',
			]
		);
	}
}
