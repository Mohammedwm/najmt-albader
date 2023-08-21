@extends('front.layouts._main')
@section('content')
<!-- start follow  -->
<div class="follow">
    <div class="container">
        <div class="title">
            <h4>متابعة الطلب</h4>
            <p>رقم الطلب  : {{$booking->id}}</p>
        </div>
        <hr>
        <ul>
            <li class="lis-00">الحجز</li>
            <li class="lis-0">الدفع</li>
            <li class="lis-1">تقديم
                المستندات</li>
            <li class="lis-2">الاستقدام</li>
            <li class="lis-3">التسليم</li>
        </ul>
        <div class="imag">
            <img src="{{ asset('front/imgs/Abstract.jpg') }}" alt="">
        </div>
    </div>
</div>
<!-- end follow -->
@endsection
@push('scripts')
<script>

</script>
@endpush
