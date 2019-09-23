<?php

namespace MJJ_LGJ;

use MJJ_LGJ\User;

/**
 * Handles everything to do with the tokens.
 */
class Auth {

	public function extend_exp_for_dummy_user( $token ) {
		// The default expiration is 300 seconds so let's add a whole year to it.
		$uid  = $token['data']['user']['id'];
		$exp  = $token['exp'];
		$user = new User();

		if ( (int) $user->user_id === (int) $uid ) {
			$exp         += YEAR_IN_SECONDS;
			$token['exp'] = $exp;
			update_user_meta( $uid, 'dummy_token_exp', $exp ); // This is not good to do in a filter but I don't have a hook for it :( .
		}
		return $token;
	}
}
