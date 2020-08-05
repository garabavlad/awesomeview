<?php
require_once get_template_directory() . '/includes/options-config.php';
	if( ! class_exists('Beautify_Customizer_API_Wrapper') ) {
		require_once get_template_directory() . '/admin/class.beautify-customizer-api-wrapper.php';
	}


Beautify_Customizer_API_Wrapper::getInstance($options);
