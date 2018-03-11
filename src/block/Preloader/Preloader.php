<style>
	.Preloader{
		height: 100vh;
		width: 100%;
		background-color: rgb(36,111,176);
		color: #fff;
		font-size: 45px;
		font-family:  Arial, sans-serif;
		display: flex;
		align-items: center;
		justify-content: center;
		flex-direction: column;
		position: fixed;
		top: 0;
		left: 0;
		z-index: -1000;
		transition-duration: 1s;
		opacity: .5;
	}
	.Preloader.transition{
		z-index: 1000
	}

	.Preloader__text_1{
		font-size: 45px;
	}
	.Preloader__text_2{
		font-size: 20px;
	}
	.wrapper.noload{
		display: none;
	}
</style>
<script>
	document.addEventListener("DOMContentLoaded", function(){
		document.querySelector('.wrapper').classList.remove('noload');
	});
</script>
<div class="Preloader">
	<span class="Preloader__text_1">
		UA-IX.BIZ
	</span>
	<span class="Preloader__text_2">
		загрузка
	</span>
</div>