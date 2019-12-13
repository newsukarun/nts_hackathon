<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="UTF-8">
	<title><?php echo get_bloginfo( 'title' ); ?></title>
	<?php wp_head(); ?>
</head>
<body>
<?php
if ( ! is_user_logged_in() ) {
	echo do_shortcode( '[wp_login_form]' );

	return;
}
?>
<form method="post">
	<input type="number" name="employee_id" />
	<input type="submit" name="submit" value="Submit" />
</form>
</body>
<?php wp_footer(); ?>
</html>