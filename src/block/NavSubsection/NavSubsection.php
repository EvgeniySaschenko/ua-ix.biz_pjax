<nav class="NavSubsection">
	<div class="NavSubsection__title">Сортировать по:</div>	
	<ul	class="NavSubsection__list">
		<? foreach($navSubsection as $subsection): ?>
			<li	class="NavSubsection__item">
				<a class="NavSubsection__link" href="/ru/<?= $currentSection['link_section']; ?>/<?= $subsection['link']; ?>">
					#<?= $subsection['name']; ?>
				</a>
			</li>
		<? endforeach; ?>
	</ul>
</nav>