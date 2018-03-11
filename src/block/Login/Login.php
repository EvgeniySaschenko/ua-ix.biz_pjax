<div class="Login" id="Login">
	<? if( empty($_SESSION['user']['id']) ): ?>
		<!--
			<i class="Login__icon fi-lock"></i>
			<span class="Login__text_enter" id="Login__text_enter">Войти</span>
		-->
	<? else: ?>
		<i class="Login__icon fi-unlock"></i>
		<a class="Login__link Login__link_exit no_pjax" href="/controller/login.php">Выйти</a>
	<? endif; ?>
</div>