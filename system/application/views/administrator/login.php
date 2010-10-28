<div id="login_box">
	<div id="login_dialog">
		<form action="/administrator/login" method="post">
			<label for="login">login</label>
			<input type="text" name="login" value=""/>
			<label for="password">password</label>
			<input type="password" name="password" value=""  />
			<br/>
			<input class="button" type="submit" name="submit" value="login"  />
		</form>
	</div>
	<div id="login_errors">
		<span class="error_message">
		<?php
			echo form_error('login');
			echo form_error('password');
			echo @$error_credentials;
		?>
		</span>
	</div>
</div>