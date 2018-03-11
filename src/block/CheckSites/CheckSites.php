<? if( $_SESSION['user']['permission'] == 1 ): ?>
	<div class="CheckSites">
		<? foreach($listSiteHiden as $key => $siteHiden): ?>
			<div class="CheckSites__item">
					<div class="Notice Notice_success">Изменения внесены</div>
					<!--Раздел-->
					<? foreach($listNavSection as $navSection): ?>
							<? if($navSection["id"] == $siteHiden["id_section_parent"]): ?>
								<div class="CheckSitesForm__name-section"><?= $navSection["name"]; ?></div>
							<? endif; ?>
					<? endforeach; ?>

				<div class="CheckSites__date"><?= $siteHiden['date_create']; ?></div>
				<a class="CheckSites__link no_pjax" target="_blank" href="controller/siteClick.php?id_site=<?= $siteHiden['id']; ?>&link=<?= $siteHiden['link']; ?>">
					<img class="CheckSites__img" src="/img/site/<?= $siteHiden['id']; ?>.jpg?<?=time();?>"/>
					<br>
					<span class="CheckSites__name"><?= $siteHiden['link']; ?></span>
				</a>
				<p class="CheckSites__comment"><?= $siteHiden['comment']; ?></p>

				<form class="CheckSitesForm" enctype="multipart/form-data" method="post">
					<input type="hidden" name="id_site" value="<?= $siteHiden['id']; ?>">
					<!--Подраздел-->
					<label class="CheckSitesForm__label" for="CheckSitesForm__subsection">Подраздел</label>
					<select 
									required="required" 
									class="CheckSitesForm__select CheckSitesForm__select_subsection" 
									name="id_section">
						<? foreach($listNavSection as $navSection): ?>
							<? if($navSection["id"] != $navSection["id_parent"] and $navSection["id_parent"] == $siteHiden["id_section_parent"]): ?>
								<option	class="CheckSitesForm__option"
												value="<?= $navSection["id"]; ?>"
												data-id-subsection-initial="<?= $siteHiden['id_section']; ?>"
												data-id-subsection="<?= $navSection["id"]; ?>"
												<? if( $siteHiden['id_section'] == $navSection["id"] ) { echo "selected"; }; ?>>
												<?= $navSection["name"]; ?>
								</option>
							<? endif; ?>
						<? endforeach; ?>
					</select>

					<!--Типы-->
					<label class="CheckSitesForm__label" for="CheckSitesForm__type">Выберете подраздел</label>
					<select 
									required="required" 
									class="CheckSitesForm__select CheckSitesForm__select_type" 
									name="id_type" id="CheckSitesForm__type">
						<? foreach($typesSite as $type): ?>
							<? if($type["id_section"] == $siteHiden["id_section_parent"]): ?>
								<option	class="CheckSitesForm__option"
												value="<?= $type["id"]; ?>"
												data-id-type-initial="<?= $siteHiden['id_type']; ?>"
												data-id-type="<?= $type["id"]; ?>"
												<? if( $siteHiden['id_type'] == $type["id"] ) { echo "selected"; }; ?>>
												<?= $type["name"]; ?>
								</option>
								<? endif; ?>
						<? endforeach; ?>
					</select>

					<!--Загрузить изображение	-->
					<label class="CheckSitesForm__label" for="AddSite__upload-logo">Логотип сайта</label>
					<input class="CheckSitesForm__upload-logo" type="file" name="logo">
					<p class="CheckSitesForm__notice">размер 150х50.</p>

					<!--Рейтинг-->
					<label class="CheckSitesForm__label">Рейтинг</label>
					<div><?= $siteHiden['alexa_rank']; ?></div>
					<input class="CheckSitesForm__alexa-rank" type="text" name="alexa_rank" value="<?= $siteHiden['alexa_rank']; ?>">

					<!--Ссылка-->
					<label class="CheckSitesForm__label">Ссылка</label>
					<input class="CheckSitesForm__link" type="text" name="link" value="<?= $siteHiden['link']; ?>">

					<div class="CheckSitesForm__status">
						<p><input class="CheckSitesForm__delete" name="hide" type="radio" value="2"><i class="fi-trash"></i> удалить</p>
						<p><input class="CheckSitesForm__hidden" name="hide" type="radio" value="0" checked> <i class="fi-check"></i> разместить в каталоге </p>
						<p><input class="CheckSitesForm__approve" name="hide" type="radio" value="1" checked> <i class="fi-marker"></i> оставить на проверке </p>
					</div>

					<input class="CheckSitesForm__btn-send" type="submit" value="Добавить сайт">
				</form>

			</div>
		<? endforeach; ?>
	</div>
<? endif; ?>