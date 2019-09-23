<?php

namespace MJJ_LGJ;

use MJJ_LGJ\Auth;
use MJJ_LGJ\Settings;

/**
 * All the hooks in one place so I can find them later.
 */
class Hooks {

	public function add() {
		$auth     = new Auth();
		$settings = new Settings();
		// Extend the expiration date for the Netlify user.
		add_filter( 'graphql_jwt_auth_token_before_sign', [ $auth, 'extend_exp_for_dummy_user' ], 10, 1 );
		// Add in the settings page.
		add_action( 'cmb2_admin_init', [ $settings, 'add_settings' ], 10000 );
	}
}
