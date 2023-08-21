@extends('admin.layouts._main')

@section('title', 'ثوابت النظام')
@section('toolbar')
<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
    <!--begin::Title-->
    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">ثوابت النظام</h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">الرئيسية</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">ثوابت النظام</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
</div>
<!--end::Page title-->
<!--begin::Actions-->
<div class="d-flex align-items-center gap-2 gap-lg-3">
    <!--begin::Primary button-->
    <a href="#" class="btn btn-sm fw-bold btn-primary" id="createNewConstant">إضافة الثابت</a>
    <!--end::Primary button-->
</div>
<!--end::Actions-->

@endsection
@section('content')

<x-flash-message class="info" />
<div class="row g-5 g-xl-10 mb-5 mb-xl-10">
    <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
        <!--begin::List widget 26-->
        <div class="card card-flush">
            <!--begin::Header-->
            <div class="card-header pt-5">
                <!--begin::Title-->
                <h3 class="card-title text-gray-800 fw-bold">الثوابت الرئيسية</h3>
                <!--end::Title-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                        <span class="svg-icon svg-icon-1 svg-icon-gray-300 me-n1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="4" fill="currentColor" />
                                <rect x="11" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                <rect x="15" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                                <rect x="7" y="11" width="2.6" height="2.6" rx="1.3" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </button>

                    <!--end::Menu-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-5">
                <!--begin::Item-->
                <div class="d-flex flex-stack">
                    <!--begin::Section-->
                    <a href="javascript:void(0)" class="text-primary fw-semibold fs-6 me-2" onclick="getConstantDtl(-1,'الدول')">الدول</a>
                    <!--end::Section-->
                </div>
                <!--begin::Separator-->
                <div class="separator separator-dashed my-3"></div>
                <!--end::Separator-->
                @foreach ($constants as $constant)
                <div class="d-flex flex-stack">
                    <!--begin::Section-->
                    <a href="javascript:void(0)" class="text-primary fw-semibold fs-6 me-2" onclick="getConstantDtl({{$constant->id}},'{{$constant->name}}')">{{$constant->name}}</a>
                    <!--end::Section-->
                </div>
                <!--begin::Separator-->
                <div class="separator separator-dashed my-3"></div>
                <!--end::Separator-->
                @endforeach
            </div>
            <!--end::Body-->
        </div>
        <!--end::LIst widget 26-->
    </div>
    <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-9 mb-md-7 mb-xl-10">
        <div class="card card-custom">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label"><label id="title_lbl"/></h3>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <input type="text"  id="search" data-kt-filemanager-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="بحث">
                    </div>
                </div>
            </div>

            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-bordered table-hover table-checkable data-table"
                    id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الثابت</th>
                        {{-- <th>يتبع ل</th> --}}
                        <th>الحالة</th>
                        <th>تاريخ الإضافة</th>
                        <th>الإجراءات</th>
                    </tr>
                    </thead>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
    </div>
</div>

<!--begin::Modal - Create App-->
<div class="modal fade" id="modal_create_constant" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2>بيانات ثابت</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body py-lg-10 px-lg-10">
                <!--begin::Stepper-->
                <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid" id="modal_create_constant">
                    <!--begin::Content-->
                    <div class="flex-row-fluid py-lg-5 px-lg-15">
                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" id="create_constant_form">
                            <!--begin::Input group-->
                            <input type="hidden" class="form-control" name="cons_id" id="cons_id"/>
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                    <span class="required">اسم الثابت</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify your unique app name"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-lg form-control-solid" name="name" id="name" value="" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                    <span class="required"> يتبع ل</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify your unique app name"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select class="form-select form-select-solid" data-control="select2" data-placeholder="اختر..."
                                    id="parent_id" name="parent_id">
                                    <option value="-1">الدول</option>
                                    @foreach ($constants as $constant)
                                        <option value="{{$constant->id}}">{{$constant->name}}</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="d-flex flex-stack pt-10">
                                <!--begin::Wrapper-->
                                <div>
                                    <button type="button" class="btn btn-lg btn-primary" id="saveBtn">
                                        <span class="indicator-label">حفظ
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                        <!--end::Svg Icon--></span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Stepper-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Create App-->

@endsection
@push('scripts')
<script>

    $(document).ready(function() {
        $('#parent_id').select2({
            dropdownParent: $('#modal_create_constant')
        });
        getConstantDtl(-1,'الدول');
       $('body').on('click', '.editConstant', function () {
            $('#cons_id').val($(this).data('id'));
            $('#parent_id').val($(this).data('parent')).change();
            $('#name').val($(this).data('name'));
            $('#modal_create_constant').modal('show');
        });
    });
    let table1;
    $("#search").change(function () {
        table1.draw();
    })
    $('#createNewConstant').click(function () {
        $('#saveBtn').val("حفظ البيانات");
        $('#cons_id').val('');
        $('#create_constant_form').trigger("reset");
        $('#modal_create_constant').modal('show');
    });
    $('#saveBtn').click(function (e) {
        e.preventDefault();
        $(this).html('جاري الحفظ..');

        var cons_id = $('#cons_id').val();
        var name = $('#name').val();
        var parent_id = $('#parent_id').val();
        $.ajax({
            data: {cons_id : cons_id,parent_id:parent_id , name:name},
            url: "{{ route('constants.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#create_constant_form').trigger("reset");
                $('#modal_create_constant').modal('hide');
                $('#saveBtn').val("حفظ");
                getConstantMain();
                //table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });
    });
    function getConstantMain()
    {
        var url = "{{route('constants.index')}}";
        $.ajax({
            url: url,
            type:'text',
            method: 'get',
        }).done(function (response) {
            $('#constan_main_id').html(response);
        }).always(function() {
            // blockUI.release();
        });
    }
    function getConstantDtl(cons_id,title) {
        $("#search").val('');
        var url = "{{ route('constants.getConstantDtl', ":cons_id") }}";
        url = url.replace(':cons_id', cons_id);
        $('#title_lbl').text(title);
        table1 = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            destroy: true,
            language: {
                "url": "{{ asset('admin/assets/plugins/custom/datatables/ar.json') }}"
            },
            ajax: {
                url: url,
                    data: function (d) {
                    d.search = $('#search').val();
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                // {data: 'parent_name'},
                {data: 'status',name:'status'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    }
    function changeStatus(id,parent_id){
        let url = "{{ route('constants.changeStatus') }}";
        $.ajax({
            url: url,
            type: "POST",
            data:{
                "_token": "{{ csrf_token() }}",
                id:id,parent_id:parent_id
            },
            success: function(response) {
                table1.ajax.reload();
            },
            error: function(response) {
                alert("حصل خطأ ما حاول مرة أخرى.");
                console.log(response);
            },
        });
    }
</script>
@endpush
