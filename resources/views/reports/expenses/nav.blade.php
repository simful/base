<ul class="nav nav-pills">
	<li class="{{ Request::url() == url('reports/expenses/byCategory') ? 'active' : '' }}">
		<a href="{{ url('reports/expenses/byCategory') }}">by Category</a>
	</li>
	<li class="{{ Request::url() == url('reports/expenses/byDate') ? 'active' : '' }}">
		<a href="{{ url('reports/expenses/byDate') }}">by Date</a>
	</li>
	<li class="{{ Request::url() == url('reports/expenses/detail') ? 'active' : '' }}">
		<a href="{{ url('reports/expenses/detail') }}">Detailed</a>
	</li>
</ul>
