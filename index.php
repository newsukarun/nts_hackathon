<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="UTF-8">
    <title><?php echo get_bloginfo( 'title' ); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<?php wp_head(); ?>
    <style>
        .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        html, body {
            height: 100%;
        }

        #loginform {
            padding: 33px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 1px 1px #ccc;
        }

        #loginform label {
            width: 100%;
        }

        #loginform input {
            display: block;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="h-100 row align-items-center">
        <div class="col-md-12">
			<?php
			if ( ! is_user_logged_in() ) {
				echo "<h2 style=\"text-align: center\" >Login</h2>";
				echo do_shortcode( '[wp_login_form redirect="http://nts.wp-vip.com/qr/" ]' );

				return;
			}
			?>
            <h2>
                Welcome <?php echo ( is_user_logged_in() ) ? get_userdata( get_current_user_id() )->display_name : 'To Nts' ?></h2>
            <br><br>
            <p>To generate food coupon please enter employee id and click Submit button</p><br>
            <form class="ntsfoodcouponform" action="/">
                <div class="form-group">
                    <label for="email">Employee Id:</label>
                    <input
                            type="text" class="form-control" id="employee_id" placeholder="Enter employee id / Email Id"
                            name="message" autocomplete="off">
                </div>
                <button type="submit" class="btn btn-primary submitBtn">Submit</button>
                <a class="button button-primary" href="<?php echo home_url( '/qr' ); ?>">Get QR Code</a>
                <a class="button button-primary" href="<?php echo home_url( '/qrscan' ); ?>">Scan QR Code</a>
				<?php wp_nonce_field( 'requeest_coupon', 'requeest_coupon_msg' ); ?>
            </form>
        </div>
    </div>
</div>
</body>
<?php wp_footer(); ?>
</html>
