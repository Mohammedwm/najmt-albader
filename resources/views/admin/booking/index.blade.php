@extends('admin.layouts._main')

@section('title', 'الحجوزات')

@section('content')

<x-flash-message class="success" />

<div class="card card-flush">
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
        <div class="card-title">
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
        <div class="card-toolbar">
            <!--begin::Toolbar-->

            <!--end::Toolbar-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-0">

        <!--begin::Datatable-->
        <table id="kt_datatable_example_1" class="table align-middle table-row-dashed fs-6 gy-5 data-table">
            <thead>
            <tr class="text-start fw-bold fs-7 text-uppercase gs-0">
                <th>#</th>
                <th>اسم صاحب الحجز</th>
                <th>اسم العاملة</th>
                <th>رقم الجوال</th>
                <th>تاريخ الحجز</th>
                <th>حالة الحجز</th>
                <th class="min-w-100px">الإجراءات</th>
            </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
            </tbody>
        </table>
        <!--end::Datatable-->
    </div>
    <!--end::Card body-->
</div>

@endsection
@push('scripts')
<script>
    let table1;
    $(function () {
        table1 = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            destroy: true,
            language: {
                "url": "{{ asset('admin/assets/plugins/custom/datatables/ar.json') }}"
            },
            ajax: {
                url: "{{ route('bookings.index') }}",
                    data: function (d) {
                    d.search = $('#search').val();
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'worker_name', name: 'worker_name'},
                {data: 'phone',name:'phone'},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        $("#search").change(function () {
            table1.draw();
        });
    });
    // function changeStatus(id){
    //     let url ="1";
    //     $.ajax({
    //         url: url,
    //         type: "POST",
    //         data:{
    //             "_token": "{{ csrf_token() }}",
    //             id:id,
    //         },
    //         success: function(response) {
    //             table1.ajax.reload();
    //         },
    //         error: function(response) {
    //             alert("حصل خطأ ما حاول مرة أخرى.");
    //             console.log(response);
    //         },
    //     });
    // }
</script>
@endpush
