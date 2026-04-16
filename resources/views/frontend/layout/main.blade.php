<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Modern Business - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets-fe/assets/favicon.ico') }}" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('assets-fe/css/styles.css') }}" rel="stylesheet" />
</head>

<body class="d-flex flex-column">
    <main class="flex-shrink-0">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container px-5">
                <a class="navbar-brand" href="{{ route('home.index') }}">Web Berita</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{ route('home.index') }}">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('home.semuaBerita') }}">Semua Berita</a></li>

                        @isset($frontMenus)
                            @foreach ($frontMenus as $m)
                                @php
                                    $hasSub = $m->submenu && $m->submenu->count() > 0;
                                    $href = $m->jenis_menu === 'page'
                                        ? route('home.detailPage', $m->url_menu)
                                        : url($m->url_menu);
                                @endphp

                                @if ($hasSub)
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">{{ $m->nama_menu }}</a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @foreach ($m->submenu as $sm)
                                                @php
                                                    $subHref = $sm->jenis_menu === 'page'
                                                        ? route('home.detailPage', $sm->url_menu)
                                                        : url($sm->url_menu);
                                                @endphp
                                                <li>
                                                    <a class="dropdown-item" href="{{ $subHref }}" target="{{ $sm->target_menu }}">
                                                        {{ $sm->nama_menu }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ $href }}" target="{{ $m->target_menu }}">{{ $m->nama_menu }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endisset

                        <li class="nav-item"><a class="nav-link" href="{{ route('auth.index') }}">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content-->
        @yield('content')
    </main>

    <!-- Footer-->
    <footer class="bg-dark py-4 mt-auto">
        <div class="container px-5">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0 text-white">Copyright &copy; {{ date('Y') }}</div>
                </div>
                <div class="col-auto">
                    <a class="link-light small" href="{{ route('home.index') }}">Home</a>
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="{{ route('home.semuaBerita') }}">Berita</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('assets-fe/js/scripts.js') }}"></script>
</body>

</html>
