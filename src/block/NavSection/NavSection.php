<nav class="NavSection">
	<span class="NavSection__btn-burger fi-list" id="NavSection__btn-burger"></span>
	<ul	class="NavSection__list" id="NavSection__list">
		<? foreach($listNavSection as $navSection): ?>
			<? if( $navSection['id'] == $navSection['id_parent'] ): ?>
			<li	class="NavSection__item NavSection__item_<?= $navSection['link']; ?>">
				<a class="NavSection__link" href="/ru/<?= $navSection['link']; ?>">
					<?= $navSection['name']; ?>
				</a>
			</li>
			<? endif; ?>
		<? endforeach; ?>
	</ul>
</nav>