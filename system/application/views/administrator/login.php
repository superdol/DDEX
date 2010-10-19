<?php
echo form_open('administrator/login');
	echo form_label('login','login');
	echo form_input('login',set_value('login'));
	echo form_label('password','password');
	echo form_password('password');
	echo form_submit('submit','login');
echo form_close();
echo form_error('login');
echo form_error('password');
echo @$error_credentials;
?>