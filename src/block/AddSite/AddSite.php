<div class="AddSite">
	<h1 class="TitlePage"> Добавить сайт </h1>

	<p> В какталог добавляются сайты кторые соответсвуют одной из категорий, решение о добавлении сайта принимает администратор каталога </p>

	<? if( empty($_SESSION['user']['id']) ): ?>
		<div class="AddSite__box_ulogin">
			<div class="AddSite__text_ulogin">Чтобы добавить сайт авторизуйтесь</div>
			<div class="AddSite__btn_ulogin" id="uLogin_c6202137" data-uloginid="c6202137"></div>
		</div>
	<? endif; ?>


	<form class="AddSite__form" enctype="multipart/form-data" method="post">

		<div class="Notice Notice_warning">Такой сайт уже есть в каталоге</div>
		<div class="Notice Notice_error">Ошибка</div>
		<div class="Notice Notice_success">Сайт отправлен на проверку</div>

		<!--Адрес сайта-->
		<label class="AddSite__label" for="AddSite__site">Введите адрес сайта</label>
		<input class="AddSite__input AddSite__input_site" id="AddSite__site" type="text" name="link" required="required">

		<!--mail-->
		<label class="AddSite__label" for="AddSite__mail">E-mail</label>
		<input class="AddSite__input AddSite__input_mail" id="AddSite__mail" type="text" name="mail" required="required">

		<!--Раздел-->
		<label class="AddSite__label" for="AddSite__section">Выберете раздел</label>
		<select required="required" class="AddSite__select AddSite__select_section" name="id_section" id="AddSite__select_section">
		<option	class="AddSite__option"></option>
			<? foreach($listNavSection as $navSection): ?>
				<? if($navSection["id"] == $navSection["id_parent"]): ?>
						<option	class="AddSite__option"
										value="<?= $navSection["id"]; ?>" 
										data-id-section="<?= $navSection["id"]; ?>">
										<?= $navSection["name"]; ?>
						</option>
				<? endif; ?>
			<? endforeach; ?>
		</select>
		<!--Подраздел-->
		<label class="AddSite__label" for="AddSite__subsection">Выберете подраздел</label>
		<select required="required" class="AddSite__select AddSite__select_subsection" name="id_subsection" id="AddSite__subsection">
			<option	class="AddSite__option AddSite__option_first"></option>
			<? foreach($listNavSection as $navSection): ?>
				<? if($navSection["id"] != $navSection["id_parent"]): ?>
					<option	class="AddSite__option AddSite__option_item"
									value="<?= $navSection["id"]; ?>"
					 				data-id-section="<?= $navSection["id_parent"]; ?>">
									<?= $navSection["name"]; ?>
					</option>
				<? endif; ?>
			<? endforeach; ?>
		</select>
		<!--Типы-->
		<label class="AddSite__label" for="AddSite__type">Выберете тип</label>
		<select required="required" class="AddSite__select AddSite__select_type" name="id_type" id="AddSite__type">
			<option	class="AddSite__option AddSite__option_first"></option>
			<? foreach($typesSite as $type): ?>
				<option	class="AddSite__option AddSite__option_item"
								value="<?= $type["id"]; ?>"
								data-id-section="<?= $type["id_section"]; ?>">
								<?= $type["name"]; ?>
				</option>
			<? endforeach; ?>
		</select>
		<!--Comment-->
		<label class="AddSite__label" for="AddSite__comment">Комментарий</label>
		<textarea class="AddSite__textarea_comment" id="AddSite__comment"></textarea>
		<!--Загрузить изображение
		<label class="AddSite__label" for="AddSite__upload-logo">Логотип сайта</label>
		<input required="required" class="AddSite__upload-logo" id="AddSite__upload-logo" type="file" name="logo" required="required">
		<p class="AddSite__notice">Допустимые расшырения JPG, PNG, GIF. Вес файла не более 30 Кб. Рекомендуемый размер 150х50.</p>
		-->
		<input class="AddSite__btn-send" type="submit" value="Добавить сайт">
	</form>
</div>