@extends('layouts.app')

@section('title', 'Usluge')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Naše Usluge</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">Početna</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Usluge</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Services Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Service Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Categories Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Kategorije</h5>
                    <form>
                        @foreach(\App\Models\Category::all() as $category)
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="category-{{ $category->id }}" name="category[]" value="{{ $category->id }}">
                            <label class="custom-control-label" for="category-{{ $category->id }}">{{ $category->name }}</label>
                            <span class="badge border font-weight-normal">{{ $category->services->count() }}</span>
                        </div>
                        @endforeach
                    </form>
                </div>
                <!-- Categories End -->

                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Cena</h5>
                    <form>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-all">
                            <label class="custom-control-label" for="price-all">Sve cene</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="price-1">0 - 5.000 RSD</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">5.000 - 10.000 RSD</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">10.000 - 20.000 RSD</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="price-4">
                            <label class="custom-control-label" for="price-4">20.000+ RSD</label>
                        </div>
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Service Sidebar End -->

            <!-- Service List Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Pretraži po imenu">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                            Sortiraj po
                                        </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Najnovije</a>
                                    <a class="dropdown-item" href="#">Popularnost</a>
                                    <a class="dropdown-item" href="#">Najbolja ocena</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach($services as $service)
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                @if($service->image)
                                    <img class="img-fluid w-100" src="{{ asset('images/' . $service->image) }}" alt="{{ $service->title }}">
                                @else
                                    <img class="img-fluid w-100" src="{{ asset('eshopper/img/product-1.jpg') }}" alt="{{ $service->title }}">
                                @endif
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{ $service->title }}</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>{{ number_format($service->price, 2, ',', '.') }} RSD</h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="{{ route('service.details', $service->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Detaljnije</a>
                                <a href="{{ route('consultations.create') }}" class="btn btn-sm text-dark p-0"><i class="fas fa-calendar text-primary mr-1"></i>Zakaži</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            {{ $services->links() }}
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Service List End -->
        </div>
    </div>
    <!-- Services End -->
@endsection