<?php
/**
 * Rest Api End-point.
 */
require_once __DIR__ . '/inc/class-employee-info.php';
require_once __DIR__ . '/inc/class-sms-sender.php';
require_once __DIR__ . '/inc/rest-api/sms/sms-verify.php';

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	show_admin_bar( false );
}
