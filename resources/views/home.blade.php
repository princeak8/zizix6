@extends('layouts.home')


@section('content')
      


    <!-- ***** Wellcome Area Start ***** -->
    <section class="wellcome_area clearfix" id="home" style="background-image: url('images/bg-img/welcome-bg.png')">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 col-md">
                    <div class="wellcome-heading">
                        <h2>Zizix6 Technologies</h2>
                        <h3>Z</h3>
                        <p>Powering ideas and interconnecting businesses</p>
                    </div>
                    <div class="get-start-area">
                        <!-- Form Start 
                        <form action="#" method="post" class="form-inline">
                            <input type="email" class="form-control email" placeholder="name@company.com">
                            <input type="submit" class="submit" value="Get Started">
                        </form>
                        <! Form End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Welcome thumb -->
        <div class="welcome-thumb wow fadeInDown" data-wow-delay="0.5s">
            <img src="{{asset('images/bg-img/welcome-img.png')}}" alt="">
        </div>
    </section>
    <!-- ***** Wellcome Area End ***** -->

    @include('about')

   @include('services')

   @include('works') 

   @include('contact')

    


@endsection



