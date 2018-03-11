<div class="ListSites">
	<div class="ListSites__list">
		<? foreach($listSite as $key => $site): ?>
				<div class="ListSites__item">
					<div class="ListSites__row ListSites__row_1">
						<span class="ListSites__rating">
							<i class="fi-graph-bar"></i>
							<?= $key + 1; ?>
						</span>
						<i class="ListSites__type-icon <?= $site['type_icon']; ?>"></i>
					</div>

					<?
						if( !empty($site['link_ref']) )
							$link= $site['link_ref'];
						else
							$link= $site['link'];
					?>

					<div class="ListSites__row ListSites__row_2">
						<span class="ListSites__type"><?= $site['type_name']; ?></span>
						<a class="ListSites__link no_pjax" target="_blank" href="controller/siteClick.php?id_site=<?= $site['id']; ?>&link=<?= $link; ?>">
							<img class="ListSites__img" src="/img/site/<?= $site['id']; ?>.jpg" alt="<?= $site['link']; ?>">
							<span class="ListSites__name"><?= $site['link']; ?></span>
						</a>
					</div>
					
					<div class="ListSites__row ListSites__row_3">

						<? if($_SESSION['user']['permission'] == 1): ?>
							<!--Редактирование-->
							<div class="ListSites__edit-panel">
								<span class="ListSites__edit-item fi-pencil" data-id="<?= $site['id']; ?>" data-hide="1"></span>
								<span class="ListSites__alexa-rank"><?= $site['alexa_rank']; ?></span>
								<span class="ListSites__edit-item fi-trash" data-id="<?= $site['id']; ?>" data-hide="2"></span>
							</div>
						<? endif; ?>
						<!-- <a class="ListSites__more" href="#">...</a> -->
					</div>
				</div>
		<? endforeach; ?>
		<div class="ListSites__item-fill"></div>
	</div>
</div>