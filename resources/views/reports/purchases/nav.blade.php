<ul class="nav nav-pills">
	<li class="{{ Request::url() == url('reports/purchases/byDate') ? 'active' : '' }}">
		<a href="{{ url('reports/purchases/byDate') }}">by Date</a>
	</li>
	<li class="{{ Request::url() == url('reports/purchases/detail') ? 'active' : '' }}">
		<a href="{{ url('reports/purchases/detail') }}">Detailed</a>
	</li>
</ul>
