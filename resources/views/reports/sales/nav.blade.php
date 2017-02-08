<ul class="nav nav-pills">
	<li class="{{ Request::url() == url('reports/sales/byDate') ? 'active' : '' }}">
		<a href="{{ url('reports/sales/byDate') }}">by Date</a>
	</li>
	<li class="{{ Request::url() == url('reports/sales/detail') ? 'active' : '' }}">
		<a href="{{ url('reports/sales/detail') }}">Detailed</a>
	</li>
</ul>
