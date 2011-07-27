<div id="login">
	<form action="<?=url('login')?>" method="post">
		<h1><?=i18n('admin.login.please_login')?></h1>
		<label for="login"><?=i18n('admin.login.your_login')?></label><input type="text" name="login" />
		<label for="password"><?=i18n('admin.login.your_password')?></label><input type="password" name="password" />
		<input type="submit" value="<?=i18n('admin.login.login_ok')?>" />
	</form>
</div>