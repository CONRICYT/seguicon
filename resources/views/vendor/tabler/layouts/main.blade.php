<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? $title . ' | ' . config('tabler.suffix') : config('tabler.suffix') }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <link href="{{ asset('admin/assets/css/dashboard.css') }}" rel="stylesheet"/>
    <link href="{{ asset('admin/assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet"/>
    @stack('styles')
    <script src="{{ asset('admin/assets/js/require.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dialogs.js') }}"></script>
    <script>
        requirejs.config({
            baseUrl: '/admin'
        });
    </script>
    <script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>
    @stack('scripts')
</head>
<body>
<div class="page">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content"></div>
	    </div>
	</div>
    <div class="modal fade" id="myBigModal" tabindex="-1" role="dialog" aria-labelledby="myBigModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-lg">
	        <div class="modal-content"></div>
	    </div>
	</div>
    <div class="modal fade" id="divAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-sm">
	        <div class="modal-content">
	            <div class="modal-header bg-danger">
	                <h4 class="modal-title"></h4>
	            </div>
	            <div class="modal-body"></div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	            </div>
	        </div>
	    </div>
	</div>
    <div class="modal fade" id="divSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-sm">
	        <div class="modal-content">
	            <div class="modal-header bg-info">
	                <h4 class="modal-title"></h4>
	            </div>
	            <div class="modal-body"></div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	            </div>
	        </div>
	    </div>
	</div>
    <div class="modal fade" id="divConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog modal-sm">
	        <div class="modal-content">
	            <div class="modal-header bg-primary">
	                <h4 class="modal-title"></h4>
	            </div>
	            <div class="modal-body"></div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
	            </div>
	        </div>
	    </div>
	</div>
    <div class="modal fade" id="divLoader" tabindex="-1" role="dialog" aria-labelledby="myLoaderLabel" aria-hidden="true" style="display: none;">
	    <div class="modal-dialog modal-sm">
	        <div class="modal-content">
	            <div class="modal-header bg-primary">
	                <h4 class="modal-title">Espera un momento...</h4>
	            </div>
	            <div class="modal-body">
	                <div class="progress progress-striped active">
	                    <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
	                        <span class="sr-only">80% Complete</span>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

    <div class="page-main">
        <div class="header py-4">
            <div class="container">
                <div class="d-flex">
                    <a class="header-brand" href="{!! url(config('tabler.urls.homepage', '/')) !!}">
                        <img src="{!! config('tabler.logo') !!}" class="header-brand-img" alt="Logo">
                    </a>
                    <div class="d-flex order-lg-2 ml-auto">
                        @if(Auth::check())
                            @include('tabler::_partials.user')
                        @endif
                    </div>
                    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse"
                       data-target="#headerMenuCollapse">
                        <span class="header-toggler-icon"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
            <div class="container">
                <div class="row align-items-center">
                    @if(config('tabler.support.search'))
                        <div class="col-lg-3 ml-auto">
                            <form class="input-icon my-3 my-lg-0" action="{!! config('tabler.urls.searchUrl') !!}"
                                  method="GET">
                                <input type="search" class="form-control header-search" placeholder="Search&hellip;"
                                       tabindex="1" name="keywords">
                                <div class="input-icon-addon">
                                    <i class="fe fe-search"></i>
                                </div>
                            </form>
                        </div>
                    @endif
                    <div class="col-lg order-lg-first">
                        @if(Menu::exists('primary'))
                            @include('tabler::_partials.primary-menu')
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="m-4">
            @yield('content')
        </div>
    </div>
    @if(config('tabler.support.footer-menu'))
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            @if(Menu::exists('footer'))
                                @include('tabler::_partials.footer-menu')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    {!! config('tabler.footer') !!}
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
