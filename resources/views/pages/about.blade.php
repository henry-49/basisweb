@extends('layouts.master_home')

<!-- Define section ID -->
@section('home_content')

    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
      <div class="container" data-aos="fade-up">

        <div class="row content">
          <div class="col-lg-6 mt-5" data-aos="fade-right">
            <h2>{{$about_page->title}}</h2>
            <h3>{{$about_page->short_des}}</h3>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 mt-5" data-aos="fade-left">
            <p>
            {{$about_page->long_des}}
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequa</li>
              <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in</li>
            </ul>
            <p class="font-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    @endsection