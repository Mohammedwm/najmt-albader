@extends('admin.layouts._main')

@section('title', 'إضافة عاملة')

@section('content')

<link href="https://cdn.tutorialjinni.com/tagify/4.8.1/tagify.min.css" rel="stylesheet" type="text/css" />

<x-flash-error />
<form class="form d-flex flex-column flex-lg-row" action="{{ route('workers.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <!--begin::Aside column-->
    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
        <!--begin::Thumbnail settings-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>الصورة الشخصية</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body text-center pt-0">
                <!--begin::Image input-->
                <!--begin::Image input placeholder-->
                <style>
                    .image-input-placeholder {
                        background-image: url("{{ asset('admin/assets/media/svg/files/blank-image.svg') }}");
                    }

                    [data-theme="dark"] .image-input-placeholder {
                        background-image: url("{{ asset('admin/assets/media/svg/files/blank-image-dark.svg') }}");
                    }
                </style>
                <!--end::Image input placeholder-->
                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3"
                    data-kt-image-input="true">
                    <!--begin::Preview existing avatar-->
                    <div class="image-input-wrapper w-150px h-150px"></div>
                    <!--end::Preview existing avatar-->
                    <!--begin::Label-->
                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar"
                        data-kt-initialized="1">
                        <i class="bi bi-pencil-fill fs-7"></i>
                        <!--begin::Inputs-->
                        <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
                        <input type="hidden" name="avatar_remove">
                        <!--end::Inputs-->
                    </label>
                    <!--end::Label-->
                    <!--begin::Cancel-->
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar"
                        data-kt-initialized="1">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                    <!--end::Cancel-->
                    <!--begin::Remove-->
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar"
                        data-kt-initialized="1">
                        <i class="bi bi-x fs-2"></i>
                    </span>
                    <!--end::Remove-->
                </div>
                <!--end::Image input-->

            </div>
            <!--end::Card body-->
        </div>
        <!--end::Thumbnail settings-->
        <!--begin::Status-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>الحالة</h2>
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                </div>
                <!--begin::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Select2-->
                <select class="form-select mb-2" data-control="select2" data-hide-search="true"
                    data-placeholder="اختر الحالة" name="status">
                    <option value="1" @selected(old('status',$worker->status) == 'active')>فعال</option>
                    <option value="0" @selected(old('status',$worker->statusp) == 'inactive')>غير فعال</option>
                    <option value="2" @selected(old('status',$worker->status) == 'booked')>محجوزة</option>
                </select>
                <!--end::Select2-->
                <!--begin::Description-->
                <div class="text-muted fs-7">اختر حالة العاملة.</div>
                <!--end::Description-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Status-->
        <!--begin::Category & tags-->
        <div class="card card-flush py-4">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>المهنة</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Input group-->
                <!--begin::Select2-->
                <select class="form-select mb-2 select2-hidden-accessible" data-control="select2"
                        data-placeholder="اختر المهنة" name="work_id">
                    <option></option>
                    @foreach ($works as $item)
                        <option value="{{$item->id}}" @selected(old('work_id') == $item->id)>{{$item->name}}</option>
                    @endforeach
                </select>
                <!--end::Select2-->
                <!--begin::Description-->
                <div class="text-muted fs-7 mb-7">اختر المهنة.</div>
                <!--end::Description-->
                <!--end::Input group-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Category & tags-->
    </div>
    <!--end::Aside column-->
    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <!--begin::Tab pane-->
        <div class="d-flex flex-column gap-7 gap-lg-10">
            <!--begin::General options-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>بيانات شخصية</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">الاسم</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9">
                            <!--begin::Row-->
                            <!--begin::Col-->
                            <div class="fv-row fv-plugins-icon-container">
                                <input type="text" name="name" class="form-control form-control-lg mb-3 mb-lg-0"
                                    value="{{ old('name', $worker->name) }}" required>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">الجنسية</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9">
                            <!--begin::Row-->
                            <!--begin::Col-->
                            <div class="fv-row fv-plugins-icon-container">
                                <select id="country_id" class="form-select lh-1 py-3"
                                    name="country_id" data-placeholder="اختر الجنسية">
                                    <option></option>
                                    @foreach ($countries as $item)
                                    <option value="{{$item->id}}" data-capital="{{$item->capital}}"
                                        @selected(old('country_id') == $item->id)>{{$item->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">الديانة</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9">
                            <!--begin::Row-->
                            <!--begin::Col-->
                            <div class="fv-row fv-plugins-icon-container">
                                <select class="form-select mb-2 select2-hidden-accessible" name="religion_id"
                                    data-control="select2" data-placeholder="اختر الديانة">
                                    <option></option>
                                    @foreach ($religions as $religion)
                                        <option value="{{$religion->id}}" @selected(old('religion_id') == $religion->id)>{{$religion->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Col-->
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">سنة الميلاد</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9">
                            <!--begin::Row-->
                            <!--begin::Col-->
                            <div class="fv-row fv-plugins-icon-container">
                                <input type="number" name="year_of_birth"
                                    class="form-control form-control-lg mb-3 mb-lg-0" maxlength="4"
                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                    value="{{ old('year_of_birth', $worker->year_of_birth) }}" required>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">الطول</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9">
                            <!--begin::Row-->
                            <!--begin::Col-->
                            <div class="fv-row fv-plugins-icon-container">
                                <input type="number" name="height"
                                    class="form-control form-control-lg mb-3 mb-lg-0" maxlength="4"
                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                    value="{{ old('height', $worker->height) }}" required>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">الوزن</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9">
                            <!--begin::Row-->
                            <!--begin::Col-->
                            <div class="fv-row fv-plugins-icon-container">
                                <input type="text" name="weight"
                                    class="form-control form-control-lg mb-3 mb-lg-0" maxlength="4"
                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                    value="{{ old('weight', $worker->weight) }}" required>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">اللغة</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9">
                            <!--begin::Row-->
                            <!--begin::Col-->
                            <div class="fv-row fv-plugins-icon-container">
                                <input class="form-control" id="kt_tagify_6" name="language" value=''/>
                            </div>
                            <!--end::Col-->
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">التصنيفات</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9">
                            <!--begin::Row-->
                            <!--begin::Col-->
                            <select class="form-select mb-2 select2-hidden-accessible" name="categories[]" multiple
                                data-control="select2" data-placeholder="اختر التصنيفات" required>
                                <option></option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            <!--end::Col-->
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-3 col-form-label required fw-semibold fs-6">الخبرات</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-9">
                            <!--begin::Row-->
                            <!--begin::Col-->
                            <div class="fv-row fv-plugins-icon-container">
                                <input type="text" name="experiences"
                                    class="form-control form-control-lg mb-3 mb-lg-0">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                            <!--end::Row-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card header-->
            </div>
            <!--end::General options-->
            <!--begin::CV-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>السيرة الذاتية</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div class="fv-row mb-2">
                        <!--begin::Dropzone-->
                        <div class="dropzone" id="kt_ecommerce_add_product_media">
                            <!--begin::Message-->
                            <div class="dz-message needsclick">
                                <!--begin::Icon-->
                                <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                <!--end::Icon-->
                                <!--begin::Info-->
                                <div class="ms-4">
                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to
                                        upload.</h3>
                                    <span class="fs-7 fw-semibold text-gray-400">Upload up to 10 files</span>
                                </div>
                                <!--end::Info-->
                            </div>
                        </div>
                        <!--end::Dropzone-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set the product media gallery.</div>
                    <!--end::Description-->
                </div>
                <!--end::Card header-->
            </div>
            <!--end::CV-->
        </div>
        <!--end::Tab pane-->
        <div class="d-flex justify-content-end">
            <!--begin::Button-->
            <a href="{{ route('workers.index') }}" id="kt_ecommerce_add_product_cancel"
                class="btn btn-light me-5">إلغاء</a>
            <!--end::Button-->
            <!--begin::Button-->
            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                <span class="indicator-label">إضافة</span>
                <span class="indicator-progress">انتظر قليلاً...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!--end::Button-->
        </div>
    </div>
    <!--end::Main column-->
</form>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.17.8/jQuery.tagify.min.js"></script>

<script>
    function format(item) {
        if (!item.id) {
            return item.text;
        }
        var url = "{{ asset('admin/assets/media/flags/') }}";
        var img = $("<img>", {
            class: "img-flag",
            width: 26,
            src:"{{ asset('admin/assets/media/flags/') }}/" + item.element.dataset.capital + ".svg"
        });
        var span = $("<span>", {
            text: " " + item.text
        });
        span.prepend(img);
        console.log(span);
        return span;
    }
    $(document).ready(function() {
        $("#country_id").select2({
            templateResult: function(item) {
            return format(item);
            }
        });
        var input = document.querySelector("#kt_tagify_6");
        new Tagify(input, {
            whitelist:[
                @foreach($languages as $item)
                '{{$item}}',
                @endforeach
            ],
            maxTags: 10,
            dropdown: {
                maxItems: 20,           // <- mixumum allowed rendered suggestions
                classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0,             // <- show suggestions on focus
                closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
            }
        });
    });

</script>
@endpush
