@extends('front.layouts._main')
@section('content')
<!-- Start Landing  -->
<div class="landing">
    <div class="container">
        <div class="text">
            <h3>احجزي عاملتك <br> وادفعي عن طريق مساند</h3>
            <p class=" fs-6"> بدون مشاوير ونت في بيتك وفرنا مجموعة عاملات محترفات <br> تتناسب مع شروطك وتلبي رغباتك</p>
            <a class="btn btn-primary  main-btn" href="reservations.html"> تصفحي الخيارات </a>
        </div>
        <img src="{{ asset('front/imgs/Abstract.png') }}" class="img-2" alt="">
    </div>
</div>
<!-- End Landing  -->
<!-- Strat Services  -->
<div class="services">
    <div class="container">
        <div class="main-title text-center">
            <h3>سهلناها عليك بضغطة زر عاملتك عندك</h3>
            <!-- <p>هذا النصهو مثال لنصيمكن أن يستبدل في نفسالمساحة، لقد تم توليد هذا النصمن مولد النصالعربى</p> -->
        </div>
        <div class="row">
            @foreach ($workers as $worker)
            <div class="card shadow-sm col-lg-4 col-md-6 col-sm-10  mb-5">
                <div class="title tit-1">#{{$worker->Categories[0]->name}}</div>
                <div class="se">{{$worker->country->name}}<span> </span>
                    <img src="{{ asset('admin/assets/media/flags/'.$worker->country->capital.'.svg') }}" alt="">
                </div>
                <div class="row g-0">
                    <div class="col-md-8 col-sm-10">
                        <div class="card-body text-end">
                            <h5 class="card-title mt-5">{{$worker->name}}</h5>
                            <p class="card-text">{{$worker->work->name}}</p>
                            <p class="card-text"></p>
                            <p class="card-text mb-0">العمر :<small class="text-body-secondary">
                                    {{$worker->age}}سنة</small></p>
                            <p class="card-text">الديانة :<small
                                    class="text-body-secondary">{{$worker->religion->name}}</small></p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-2">
                        <img src="{{$worker->image_path}}" class="img-fluid " alt="...">
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <a class="btn btn-primary  main-btn plus" href="reservations.html"> وعندنا زيادة </a>
        <div class="pa fs-3 mt-3 mb-5 text-center" style="color: #00263B; line-height: 1.6; ">ولو مالقيتي اللي تناسب
            شروطك ولا يهمك نوفرك لك <br> متواجدين لخدمتك راسلينا بالواتس<a href="#"> راسلينا بالواتس</a> وأبشري باللي
            يفهمك </div>
    </div>
</div>
<!-- End Services  -->
<!-- strat we-section -->
<div class="we-section" id="we-section">
    <div class="container">
        <div class="main-title text-center">
            <h3>من نحن</h3>
            <div class="para">
                <p><br>ثلاثين عام واحنا بخدمتكم نستقدم أفضل الأيدي العاملة حسب شروطكم ورغباتكم في مختلف المجالات ونوصلها
                    لكم بسرعة قياسية ،
                    لنا مسيرة طويلة نفخر فيها وكل هذا بفضل الله ثم ثقتكم عملائنا الغالين.</p>
                <p>إلتزامنا بنظام وزارة الموارد البشرية وتعونا مع شركائنا في مساند سهل تواصلنا وقربنا لبعض رغم بعد
                    المسافات<br>.
                    الآن في نجمة البدر نقدم خدماتنا الكترونيا بطريقة سهلة وبضغطة زر والسداد مضمون عن طريق مساند.
                </p>
            </div>
        </div>
        <p class="title-we text-center mt-5">مميزات نفخر فيها واسأل عنّا ..</p>
        <div class="row ">
            @foreach ($features as $item)
            <div class="col-lg-4 text-center shadow-sm p-3 mb-5 m-3 bg-body-tertiary rounded">
                <a href="#"><img src="{{$item->image_path}}" alt=""></a>
                <h4>{{$item->title}}</h4>
                <p>{{$item->description}}</p>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- end we-section -->
<!-- start slider  -->
<div class="slider">
    <div class="container">
        <div class="main-title text-center">
            <h3>آراء العملاء</h3>
        </div>
        <div class="wrapper">
            <i id="left" class="fa-solid fa-angle-left"></i>
            <ul class="carousel">
                @foreach ($comments as $comment)
                <li class="card">
                    <i class="fa-solid fa-quote-left"></i>
                    <hr>
                    <p>{{$comment->description}}</p>
                </li>
                @endforeach
            </ul>
            <i id="right" class="fa-solid fa-angle-right"></i>
        </div>
    </div>
</div>
<!-- end slider  -->
<!-- start section accordion  -->
<div class="ques" id="ques">
    <div class="container">
        <div class="main-title text-center">
            <h3>الأسئلة الشائعة</h3>
        </div>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        كيف استقدم من عندكم؟
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample"
                    style="line-height: 1.7;">
                    <div class="accordion-body">
                        الطريقة سهلة وسريعة خطوتين بس <br>
                        ١-اختيار السي في اللي يعجبك وارساله بالواتس <br>
                        ٢-السداد عن طريق مساند
                        .
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        كم يأخذ وقت وصول العاملة ؟
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample"
                    style="line-height: 1.7;">
                    <div class="accordion-body">
                        الطريقة سهلة وسريعة خطوتين بس <br>
                        ١-اختيار السي في اللي يعجبك وارساله بالواتس <br>
                        ٢-السداد عن طريق مساند
                        .
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        هل أقدر أطلب عاملة باسمها ؟
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample"
                    style="line-height: 1.7;">
                    <div class="accordion-body">
                        الطريقة سهلة وسريعة خطوتين بس <br>
                        ١-اختيار السي في اللي يعجبك وارساله بالواتس <br>
                        ٢-السداد عن طريق مساند
                        .
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseThree">
                        كيف أثق بالمكتب ؟
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        الطريقة سهلة وسريعة خطوتين بس <br>
                        ١-اختيار السي في اللي يعجبك وارساله بالواتس <br>
                        ٢-السداد عن طريق مساند
                        .
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end section accordion  -->
@endsection
