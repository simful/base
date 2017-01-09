<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Simful Business</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/lib/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/lib/selectize/dist/css/selectize.bootstrap3.css">
    <link rel="stylesheet" href="/lib/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" id="main-menu">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="/img/simful-logo.png" class="brand">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-shopping-basket"></i>Store <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li class="dropdown-header">Stock</li>

                                    <li>
                                        <a href="{{ url('products') }}">Products</a>
                                    </li>

                                    <li>
                                        <a href="{{ url('stock') }}">Stock</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-exchange"></i>
                                    Transactions <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li class="dropdown-header">Sales & Purchases</li>

                                    <li>
                                        <a href="{{ url('invoices') }}">Sales</a>
                                    </li>

                                    <li>
                                        <a href="{{ url('purchases') }}">Purchases</a>
                                    </li>

                                    <li>
                                        <a href="{{ url('expenses') }}">Expenses</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-money"></i>
                                    Accounting <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('accounts') }}">General Ledger</a>
                                    </li>

                                    <li>
                                        <a href="{{ url('transactions') }}">Journal</a>
                                    </li>

                                    <li class="divider">

                                    <li>
                                        <a href="{{ url('taxes') }}">Tax</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-line-chart"></i>
                                    Reports <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('reports/sales') }}">Sales Report</a>
                                    </li>

                                    <li>
                                        <a href="{{ url('reports/purchase') }}">Purchase Report</a>
                                    </li>

                                    <li>
                                        <a href="{{ url('reports/stock') }}">Stock Report</a>
                                    </li>

                                    <li class="divider"></li>

                                    <li>
                                        <a href="{{ url('reports/receivables') }}">Receivables Report</a>
                                    </li>

                                    <li>
                                        <a href="{{ url('reports/payables') }}">Payables Report</a>
                                    </li>

                                    <li class="divider"></li>

                                    <li>
                                        <a href="{{ url('reports/income-statement') }}">Income Statement</a>
                                    </li>

                                    <li>
                                        <a href="{{ url('reports/trial-balance') }}">Balance Report</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="{{ url('settings') }}">
                                    <i class="fa fa-cog"></i>
                                    Settings
                                </a>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('profile') }}">Profile</a>
                                    </li>

                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/lib/selectize/dist/js/standalone/selectize.min.js"></script>
    <script src="/lib/moment/min/moment.min.js"></script>
    <script src="/lib/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.selectize-single').selectize();
            $('.datepicker').datetimepicker({
                format: 'YYYY-MM-DD'
            });
		});
	</script>
    @yield('scripts')
</body>
</html>
