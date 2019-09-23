<?php
/**
 * Plugin Name:     MJJ Long Lived GraphQL JWT
 * Plugin URI:      https://tharshetests.netlify.com
 * Description:     Extend JWT for WPGraphQL for dummy user for use in services which require reading raw content from posts.
 * Author:          JJ
 * Author URI:      https://tharshetests.netlify.com
 * Text Domain:     mjj-lgj
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         MJJ_LGJ
 */

namespace MJJ_LGJ;

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

// For the autoloader.
 require_once __DIR__ . '/vendor/autoload.php';

$hooks = new Hooks();
$hooks->add();



