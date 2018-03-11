<ul class="SortSites">
	<li class="SortSites__item"> Сортировать по: </li>
	<li class="SortSites__item" onClick={ this.menuSortSites.bind(this) } data-id={ e.id } key={ e.id }>
		<i class={"SortSites__icon " + e.icon}></i>
		<span class="SortSites__name">{ e.name }</span>
	</li>
</ul>