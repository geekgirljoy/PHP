<!-- Sign In Component -->
<div class="well">
        
        <div class="row">
		<div class="col-md-12">
			<div class="row">
			
				<div class="col-md-4"></div>
				
				<div class="col-md-4">
				
				<h3>Sign In</h3>
				<p>Or, <a href="">Sign Up</a> instead.</p>
				<p>
				    <strong>Username:</strong>  guest
				    <br/>
				    <strong>Password:</strong>  guest 
				</p>
				
				<?php

					if($_SESSION['failedlogin'] == true ) { 
echo <<<WARNING

		<div class="alert alert-danger" role='alert'>
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<span class="sr-only">Error:</span>
		Invalid Username or Password
		</div>
WARNING;
}
				?>
				
				<form id="sign-in-form" id="sign-in-name" action="assets/api/ProcessSignIn.php" method="post">
				<div class="input-group">
           <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username here" />
         </div>
         <br />
         <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password here" />
         </div>
          <br />
         <a id="sign-in-btn" name="sign-in-btn" href="#" class="btn btn-lg btn-success btn-block">
            <span class="glyphicon glyphicon-log-in"></span> Sign In
         </a>
      		</form>		
				</div>
				<div class="col-md-4">	</div>
			</div>
		</div>
	</div>
         
</div>

<script src="assets/js/SignInComponent.js"></script>

<!-- / Sign In Component -->