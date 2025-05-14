@extends('layouts.app')

@section('title', $service->title)

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Detalji usluge</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">Početna</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0"><a href="{{ route('services') }}">Usluge</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">{{ $service->title }}</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            @if($service->image)
                                <img class="w-100 h-100" src="{{ asset('images/' . $service->image) }}" alt="{{ $service->title }}">
                            @else
                                <img class="w-100 h-100" src="{{ asset('eshopper/img/product-1.jpg') }}" alt="{{ $service->title }}">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $service->title }}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(50 ocena)</small>
                </div>
                <h3 class="font-weight-semi-bold mb-4">{{ number_format($service->price, 2, ',', '.') }} RSD</h3>
                <p class="mb-4">{!! $service->description !!}</p>
                <div class="d-flex pt-2">
                    <a href="{{ route('consultations.create') }}" class="btn btn-primary px-3"><i class="fa fa-calendar mr-1"></i> Zakaži konsultaciju</a>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Opis</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Informacije</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Recenzije (0)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Opis usluge</h4>
                        <p>{!! $service->description !!}</p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <h4 class="mb-3">Dodatne informacije</h4>
                        <p>Kategorija: {{ $service->category->name }}</p>
                        <p>Trajanje: Oko 60 minuta</p>
                        <p>Online konsultacije: Dostupne</p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">1 recenzija za "{{ $service->title }}"</h4>
                                <div class="media mb-4">
                                    <img src="{{ asset('eshopper/img/user.jpg') }}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6>Petar Petrović<small> - <i>01 Jan 2023</i></small></h6>
                                        <div class="text-primary mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>Izuzetna usluga i veoma profesionalno osoblje. Preporučujem svima!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Ocenite ovu uslugu</h4>
                                <small>Vaša adresa e-pošte neće biti objavljena. Obavezna polja su označena *</small>
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">Vaša ocena * :</p>
                                    <div class="text-primary">
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                </div>
                                <form>
                                    <div class="form-group">
                                        <label for="message">Vaša recenzija *</label>
                                        <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Vaše ime *</label>
                                        <input type="text" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Vaš email *</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Pošalji recenziju" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Slične usluge</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach(\App\Models\Service::where('category_id', $service->category_id)->where('id', '!=', $service->id)->take(4)->get() as $relatedService)
                        <div class="card product-item border-0">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                @if($relatedService->image)
                                    <img class="img-fluid w-100" src="{{ asset('images/' . $relatedService->image) }}" alt="{{ $relatedService->title }}">
                                @else
                                    <img class="img-fluid w-100" src="{{ asset('eshopper/img/product-1.jpg') }}" alt="{{ $relatedService->title }}">
                                @endif
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{ $relatedService->title }}</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>{{ number_format($relatedService->price, 2, ',', '.') }} RSD</h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="{{ route('service.details', $relatedService->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Detaljnije</a>
                                <a href="{{ route('consultations.create') }}" class="btn btn-sm text-dark p-0"><i class="fas fa-calendar text-primary mr-1"></i>Zakaži</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $('.related-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                }
            }
        });
    });
</script>
@endsection