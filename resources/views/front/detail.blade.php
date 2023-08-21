@extends('front.layouts._main')
@section('content')
<!-- start details  -->
<div class="details">
    <div class="container">
        <h4>تفاصيل المعلمة</h4>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="image person">
                    <img src="{{$worker->image_path}}" alt="">
                </div>
                <div class="name">
                    <p class="mb-1 fs-5">{{$worker->name}}</p>
                    <p>{{$worker->work->name}}</p>
                </div>
                <div class="detal shadow-sm">
                    <div class="data d-flex">
                        <p class="nam">العمر</p>
                        <p> : {{$worker->age}} سنة</p>
                    </div>
                    <div class="data d-flex">
                        <p class="nam">الجنسية
                        </p>
                        <p> : {{$worker->country->name}}
                        </p>
                    </div>
                    <div class="data d-flex">
                        <p class="nam">الديانة</p>
                        <p> : {{$worker->religion->name}}</p>
                    </div>
                    <div class="data d-flex">
                        <p class="nam">الوزن</p>
                        <p> : {{$worker->weight}} كم
                        </p>
                    </div>
                    <div class="data d-flex">
                        <p class="nam">الطول</p>
                        <p> : {{$worker->height}} سم
                        </p>
                    </div>
                    <div class="data d-flex">
                        <p class="nam">اللغة</p>
                        <p> :
                            @foreach ($worker->language_array as $item)
                                {{$item['value']}}
                                @if (!$loop->last)
                                  ،
                                @endif
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="experience d-flex shadow-sm">
                    <p>الخبرات السابقة</p>
                    <p style="margin-right: 60px;">:{{$worker->experiences}}</p>
                </div>
            </div>
            <div class="col-lg-1 col-md-6"></div>
            <div class="col-lg-2 col-md-6">
                <p>الترشيحات المناسبة</p>
                @foreach ($worker->Categories as $item)

                    <div class="nomination" style="background-color:{{$item->color}}">
                        <h5 class="text-center"># {{$item->name}}</h5>
                        <p class="text-center">{{$item->description}}</p>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-1 col-md-6"></div>
            <div class="col-lg-4 col-md-6">
                <p class="text-center">للاطلاع على السيرة الذاتية للعاملة</p>
                <div class="image cv">
                    <img src="{{ asset('front/imgs/685cf47a430dc5415405c53abdef7c83.png') }}" alt="">
                </div>
                <!-- Button trigger modal -->
                <div class="btt">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        حجز العاملة
                    </button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <p class="modal-title fs-5" id="exampleModalLabel">حجز عاملة رقم</p>
                                <p class="modal-title para fs-5" id="exampleModalLabel">123456</p>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="alert alert-danger" style="display:none;margin: 10px"></div>
                            <form id="BookingForm">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form">
                                                <input type="hidden" id="worker_id" value="{{$worker->id}}">
                                                <label for="" class="d-block mb-2">الاسم</label>
                                                <input type="text" class="d-block mb-2" id="name" required>
                                            </div>
                                            <div class="form">
                                                <label for="" class="d-block mb-2">رقم الجوال ( يجب توفر واتس )</label>
                                                <input type="number" class="d-block mb-2" placeholder="5678901234" id="phone"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form">
                                                <label for="" class="d-block mb-2">اشتراطاتكم بالخادمة المطلوبة</label>
                                                <textarea name="" id="description" cols="25"
                                                    rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary d-none" data-bs-dismiss="modal"></button>
                                    <button type="submit" class="btn btn-primary justify-content-center" onclick="">حجز معاملة</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="imag back">
            <img src="{{ asset('front/imgs/Abstract.jpg') }}" alt="">
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function(){
	$("#BookingForm").submit(function(event){
		submitForm();
		return false;
	});
});
function submitForm(){
   var worker_id = $('#worker_id').val();
   var name = $('#name').val();
   var phone = $('#phone').val();
   var description = $('#description').val();
   $.ajax({
		type: "POST",
		url: "{{ route('booking-worker') }}",
		data: {"_token": "{{ csrf_token() }}",
            worker_id:worker_id,name:name,phone:phone,description:description
        },
		success: function(response){
            jQuery('.alert-danger').empty();
            jQuery('.alert-danger').hide();
            if(response.status == 1){
                Swal.fire({
                    title: response.message,
                    text: 'رقم الحجز  '+response.booking_id,
                    icon: "success",
                    confirmButtonText: 'موافق'
                });
            }else{
                jQuery.each(response.errors, function(key, value){
                    jQuery('.alert-danger').show();
                    jQuery('.alert-danger').append('<p>'+value+'</p>');
                });
            }

		},
		error: function(){
			alert("Error");
		}
	});
}
</script>
@endpush
