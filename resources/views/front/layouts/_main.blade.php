<!DOCTYPE html>

<html direction="rtl" dir="rtl" style="direction: rtl">
    <!--begin::Head-->
    @include('front.layouts._header')
    <!--end::Head-->
    <!--begin::Body-->

    <body>
        <nav class="navbar navbar-expand-lg sticky-top  ">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="{{ asset('front/imgs/Logo_Logo_H_Colored.png') }}" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main"
                    aria-controls="main" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="main">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mr-3 ">

                        <li class="nav-item">
                            <a class="nav-link" href="#we-section">من نحن</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link center" href="#ques">آراء العملاء</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#footer">تواصل معنا</a>
                        </li>
                    </ul>

                </div>
            </div>
            </div>
        </nav>
        <!-- End Navbar -->
        @yield('content')
        <!-- Start Footer -->
        <div class="footer pt-5 pb-3 text-center text-md-start text-white-50" id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="contact text-light text-end">
                            <h2 class="fs-3">تواصل معنا</h2>
                            <p>نسعد بتواصلكم عبر القنوات التالية</p>
                        </div>
                        <div class="media text-end d-flex ">
                            <span style="background-color: #DDE6FF;"></span>
                            <span class="d-flex justify-content-center align-items-center"
                                style="background-color: #DDE6FF; margin-right: 40px; margin-left: 40px;"><i
                                    class="fa-brands fa-twitter fs-4" style="color: #0078BB;"></i></span>
                            <span style="background-color: #4E7CFF;"></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3"></div>
                    <div class="col-md-6 col-lg-3">
                        <div class="contact text-light text-end">
                            <h2 class="fs-3">مكتب نجمة البدر للاستقدام</h2>
                            <p>الرياض، حي الملز، شارع آل شويعر </p>
                            <p>سجل تجاري: 1010855829</p>
                        </div>

                        <div class="col-md-6 col-lg-3"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Scrolltop-->
        @include('front.layouts._footer')
    </body>
    <!--end::Body-->

</html>
