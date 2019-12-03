<?php

namespace wp_gdpr\controller;

use wp_gdpr\lib\Gdpr_Log_Interface;

/**
 *  * Controller_Site-Health is used to extend on the site health feature in WP core
 *
 * @since 2.1.2
 */

class Controller_Site_Health extends Gdpr_Log_Interface {

	public function __construct() {
		parent::__construct();
		add_filter( 'site_status_tests', array( $this, 'remove_site_health_rest_test_from_tests' ) );
	}

	public function remove_site_health_rest_test_from_tests( $tests ) {
	    unset( $tests['direct']['rest_availability'] );
	    unset( $tests['async']['loopback_requests'] );

	    return $tests;
    }
}
