<?php $this->load->view('inc/header'); ?>

		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/theme_light.css" type="text/css" id="skin_color">
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="login example1">
		<div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="logo"><img src="<?php echo base_url(); ?>assets/images/feci_logo.png" width="267px">
			</div>
			<!-- start: LOGIN BOX -->
			<div class="box-login">
				<h3>Sign in to your account Now</h3>
				<p>
					Please enter your user name and password to log in.
				</p>
				<?php echo form_open('authentication', array('class' => 'form-login')); ?>
					<div class="errorHandler alert alert-danger no-display">
						<i class="fa fa-remove-sign"></i> You have some form errors. Please check below.
					</div>
                    <?php if (isset($message) && !empty($message)): ?>
                        <div class="errorHandler alert alert-danger">
                            <i class="fa fa-remove-sign"></i> <?php echo $message; ?>
                        </div>
                    <?php endif; ?>

					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="username" placeholder="User Name">
								<i class="fa fa-user"></i> </span>
							<!-- To mark the incorrectly filled input, you must add the class "error" to the input -->
							<!-- example: <input type="text" class="login error" name="login" value="Username" /> -->
						</div>
						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" class="form-control password" name="password" placeholder="Password">
								<i class="fa fa-lock"></i>	
                            </span>
						</div>
						<div class="form-actions">
							
							<button type="submit" class="btn btn-bricky pull-right">
								Login <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
					</fieldset>
				<?php echo form_close(); ?>
			</div>
			<!-- end: LOGIN BOX -->
			<!-- start: COPYRIGHT -->
			<div class="copyright">
				2020 &copy; Fire Engineering Company Inc.
			</div>
			<!-- end: COPYRIGHT -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="<?php echo base_url(); ?>lib/jQuery-2.1.4/jquery-2.1.4.min.js"></script>
        <script src="<?php echo base_url(); ?>lib/Bootstrap-3.3.5/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>lib/PerfectScrollbar/src/perfect-scrollbar.js"></script>
        <!-- <script src="<?php echo base_url(); ?>lib/jQueryCookie-1.4.0/jquery.cookie.js"></script> -->
        <script src="<?php echo base_url(); ?>lib/JSUrl-2.0.2/url.min.js"></script>
        <!-- <script src="<?php echo base_url(); ?>assets/js/main.js"></script> -->

        <script src="<?php echo base_url(); ?>js/feci_globals.js"></script>
        <script>FECI.base_url = '<?php echo base_url(); ?>';</script>
        <script src="<?php echo base_url(); ?>js/tko.js"></script>
        <script src="<?php echo base_url(); ?>js/feci.js"></script>
        <!-- end: MAIN JAVASCRIPTS -->

		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo base_url(); ?>lib/jQueryValidation-1.11.1/jquery.validate.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/login.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				//Main.init();
				Login.init();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>