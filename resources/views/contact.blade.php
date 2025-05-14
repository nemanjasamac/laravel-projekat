@extends('layouts.app')

@section('title', 'Kontakt')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Kontaktirajte nas</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">Početna</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Kontakt</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Kontaktirajte nas za sve informacije</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">
                    <div id="success"></div>
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <input type="text" class="form-control" id="name" placeholder="Vaše ime"
                                required="required" data-validation-required-message="Molimo unesite vaše ime" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" placeholder="Vaš email"
                                required="required" data-validation-required-message="Molimo unesite vaš email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" id="subject" placeholder="Naslov"
                                required="required" data-validation-required-message="Molimo unesite naslov" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="6" id="message" placeholder="Poruka"
                                required="required"
                                data-validation-required-message="Molimo unesite vašu poruku"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Pošalji poruku</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">
                <h5 class="font-weight-semi-bold mb-3">Kontakt informacije</h5>
                <p>Nsamac je tu za vas. Dostupni smo za sva pitanja i konsultacije. Naš tim stručnjaka će vam pomoći da rešite sve vaše pravne probleme.</p>
                <div class="d-flex flex-column mb-3">
                    <h5 class="font-weight-semi-bold mb-3">Naša kancelarija</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Kneza Mihaila 6, Beograd 11000</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>nsamac6623it@raf.rs</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>011 3348079</p>
                </div>
                <div class="d-flex flex-column">
                    <h5 class="font-weight-semi-bold mb-3">Radno vreme</h5>
                    <p class="mb-2">Ponedeljak - Petak</p>
                    <p class="mb-2">08:00 - 17:00</p>
                    <p class="mb-2">Subota</p>
                    <p class="mb-2">09:00 - 14:00</p>
                    <p>Nedelja: Zatvoreno</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <!-- Map Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-12">
                <div class="mb-4">
                    <iframe style="width: 100%; height: 500px;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.3042862281295!2d20.457181576676543!3d44.81536527649491!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7ab26eb107e9%3A0x7fd51b4702d8675c!2z0KDQsNGH0YPQvdCw0YDRgdC60Lgg0YTQsNC60YPQu9GC0LXRgiDQo9C90LjQstC10YDQt9C40YLQtdGC0LAg0KPQvdC40L7QvQ!5e0!3m2!1ssr!2srs!4v1747053198848!5m2!1ssr!2srs"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- Map End -->
@endsection