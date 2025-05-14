<!DOCTYPE html>
<html lang="sr">

<head>
    <meta charset="utf-8">
    <title>{{ config('app.name') }} - @yield('title', 'Rad adv kancelarije')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Profesionalne pravne usluge i konsultacije" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('eshopper/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('eshopper/css/style.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">  
    
    <!-- Additional styles -->
    @yield('styles')
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Pomoć</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <img src="{{ asset('images/logo-laravel.png') }}" alt="LARAVEL LOGO" class="img-fluid" style="max-height: 120px;">
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Pretraga usluga">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn border">
                        <i class="fas fa-user text-primary"></i>
                        <span class="badge">{{ auth()->user()->name }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn border">
                        <i class="fas fa-user text-primary"></i>
                        <span class="badge">Prijava</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Kategorije</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
                    <div class="navbar-nav w-100 overflow-hidden">
                        @php
                            $categories = App\Models\Category::all();
                        @endphp
                        @foreach($categories as $category)
                            <a href="" class="nav-item nav-link">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">P</span>nsamac</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Početna</a>
                            <a href="{{ route('services') }}" class="nav-item nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Usluge</a>
                            <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Kontakt</a>
                            @auth
                                <a href="{{ route('dashboard') }}" class="nav-item nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editor')
                                    <div class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Admin panel</a>
                                        <div class="dropdown-menu rounded-0 m-0">
                                            @if(auth()->user()->role === 'admin')
                                                <a href="{{ route('categories.index') }}" class="dropdown-item">Kategorije</a>
                                            @endif
                                            <a href="{{ route('services.index') }}" class="dropdown-item">Usluge</a>
                                            <a href="{{ route('admin.consultations.index') }}" class="dropdown-item">Konsultacije</a>
                                        </div>
                                    </div>
                                @endif
                            @endauth
                        </div>
                        @auth
                            <div class="navbar-nav ml-auto py-0">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn nav-item nav-link">Odjava</button>
                                </form>
                            </div>
                        @else
                            <div class="navbar-nav ml-auto py-0">
                                <a href="{{ route('login') }}" class="nav-item nav-link">Prijava</a>
                                <a href="{{ route('register') }}" class="nav-item nav-link">Registracija</a>
                            </div>
                        @endauth
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Main Content Start -->
    <main>
        @yield('content')
    </main>
    <!-- Main Content End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">P</span>nsamac</h1>
                </a>
                <p>Pružamo kompletnu pravnu pomoć fizičkim i pravnim licima. Naš tim pravnih stručnjaka je tu da vam pomogne u rešavanju vaših pravnih problema.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>VI, Kneza Mihaila 6, Beograd 11000</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>nsamac6623it@raf.rs</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>011 3348079</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Brzi linkovi</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-dark mb-2" href="{{ route('home') }}"><i class="fa fa-angle-right mr-2"></i>Početna</a>
                            <a class="text-dark mb-2" href="{{ route('services') }}"><i class="fa fa-angle-right mr-2"></i>Usluge</a>
                            <a class="text-dark mb-2" href="{{ route('contact') }}"><i class="fa fa-angle-right mr-2"></i>Kontakt</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Naše usluge</h5>
                        <div class="d-flex flex-column justify-content-start">
                            @php
                                $menuServices = App\Models\Service::take(5)->get();
                            @endphp
                            @foreach($menuServices as $service)
                                <a class="text-dark mb-2" href="{{ route('service.details', $service->id) }}">
                                    <i class="fa fa-angle-right mr-2"></i>{{ $service->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-dark mb-4">Newsletter</h5>
                        <form action="">
                            <div class="form-group">
                                <input type="text" class="form-control border-0 py-4" placeholder="Vaše ime" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control border-0 py-4" placeholder="Vaš email" required>
                            </div>
                            <div>
                                <button class="btn btn-primary btn-block border-0 py-3" type="submit">Pretplatite se</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">Nemanja Samac IT66/23</a>. Sva prava zadržana.
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{ asset('eshopper/img/payments.png') }}" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>  

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('eshopper/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('eshopper/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('eshopper/js/main.js') }}"></script>

    <!-- Additional scripts -->
    @yield('scripts')
</body>

</html>