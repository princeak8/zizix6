 <!-- ***** Awesome Features Start ***** -->
    <section class="awesome-feature-area bg-white section_padding_0_50 clearfix" id="features">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Heading Text -->
                    <div class="section-heading text-center">
                        <h2>Our Services</h2>
                        <div class="line-shape"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                    <!-- Single Feature Start -->
                @if(isset($services) && $services->count() > 0)
                    @foreach($services as $service)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-feature">
                                <i class="ti-desktop"></i>
                                <h5>{{$service->name}}</h5>
                                <p>
                                    {{$service->description}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif

                
                
            </div>

        </div>
    </section>
    <!-- ***** Awesome Features End ***** -->
