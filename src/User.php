<?php

namespace MJJ_LGJ;

/**
 * Handles the dummy user specific stuff.
 */
class User {

	/**
	 * The id of the dummy user.
	 *
	 * @var int
	 */
	public $dummy_user_id;

	/**
	 * The name of the option in which the dummy user is stored.
	 *
	 * @var string The option name.
	 */
	public $dummy_option_name;

	public function __construct() {
		$this->dummy_option_name = 'dummy_user_id';
		$this->_set_dummy_user();
	}

	/**
	 * This gets the set up dummy user and creates one if necessary.
	 *
	 * @return void
	 */
	private function _set_dummy_user() {
		// Ugh we're going to have to store it in options, aren't we.
		$uid = get_option( $this->dummy_option_name );

		if ( ! empty( $uid ) ) {
			$this->user_id = $uid;
			return;
		}

		$args           = [
			'user_login' => 'dummy-user',
			'user_email' => md5( time() ) . '@example.com', // This is not going to be real. We can reset the password in admin.
			'role'       => 'editor', // Editor is the narrowest role I can see out of the box.
			'user_pass'  => wp_generate_password( 20 ),
		];
		$new_dummy_user = wp_insert_user( $args );
		if ( ! is_wp_error( $new_dummy_user ) ) {
			update_option( $this->dummy_option_name, (int) $new_dummy_user, false );
			$this->user_id = $new_dummy_user;
			return;
		}

		$this->user_id = 0;
	}

	/**
	 * This is a convenience function so I remember what's going on by seeing the expiration of the token.
	 *
	 * @return string
	 */
	public function get_token_expiration() {
		$exp = get_user_meta( $this->user_id, 'dummy_token_exp', true );
		return $exp;
	}

}
