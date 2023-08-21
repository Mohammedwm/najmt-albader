@extends('admin.layouts._main')
@section('title', 'إعدادات الحساب')
@section('content')
<x-flash-message class="info" />

<!--begin::Card-->
<div class="card card-custom">
    <!--begin::Content-->
    <div id="kt_account_settings_profile_details" class="collapse show">
        <!--begin::Form-->
        <form action="{{route('update_account')}}" method="post" class="form" >
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                @csrf
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-bold fs-6">اسم المستخدم</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <input type="text" name="name" value="{{ old('name', $admin->name) }}" required
                                class="form-control required @error('name') is-invalid @enderror">
                            @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-bold fs-6">الإيميل</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <input type="text" name="email" value="{{ old('email', $admin->email) }}" required
                            class="form-control required @error('email') is-invalid @enderror">
                            @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="submit" class="btn btn-primary">حفظ التعديل</button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>

<!--begin::Card-->
<div class="card card-custom">
    <!--begin::Content-->
    <div id="kt_account_settings_profile_details" class="collapse show">
        <!--begin::Form-->
        <form action="{{route('change_password')}}" method="post" class="form" >
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                @csrf
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-bold fs-6">كلمة المرور القديمة</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Row-->
                        <div class="row input-group">
                            <input type="password" id="old_password" name="old_password" value="{{ old('old_password') }}" required
                                class="form-control @error('old_password') is-invalid @enderror">
                            {{-- <div class="input-group-append" style="cursor: pointer">
                                <span class="input-group-text">
                                    <i class="icon-xl la la-eye" style="cursor: pointer" id="icon_old_password"></i>
                                </span>
                            </div> --}}
                            @error('old_password')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>

                <!--end::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-bold fs-6">كلمة السر جديد</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Row-->
                        <div class="row input-group">
                            <input type="password" id="new_password" name="new_password" value="{{ old('new_password') }}" required
                                class="form-control @error('new_password') is-invalid @enderror">
                            {{-- <div class="input-group-append" style="cursor: pointer">
                                <span class="input-group-text">
                                    <i class="icon-xl la la-eye" style="cursor: pointer" id="icon_new_password"></i>
                                </span>
                            </div> --}}
                            @error('new_password')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-3 col-form-label required fw-bold fs-6">تأكيد كلمة المرور الجديدة</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Row-->
                        <div class="row input-group">
                            <input type="password" id="new_password_conf" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}" required
                                class="form-control @error('new_password_confirmation') is-invalid @enderror">
                            {{-- <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="icon-xl la la-eye" style="cursor: pointer" id="icon_new_password_conf"></i>
                                </span>
                            </div> --}}
                            @error('new_password_confirmation')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="submit" class="btn btn-primary">حفظ التعديل</button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>

@endsection

@push('scripts')
<script>
    const old_password = document.querySelector("#old_password");
    $("#icon_old_password").click(function() {
        // toggle the type attribute
        const type = old_password.getAttribute("type") === "password" ? "text" : "password";
        old_password.setAttribute("type", type);
        // toggle the icon
        this.classList.toggle("la-eye-slash");
    });

    const new_password = document.querySelector("#new_password");
    $("#icon_new_password").click(function() {
        // toggle the type attribute
        const type = new_password.getAttribute("type") === "password" ? "text" : "password";
        new_password.setAttribute("type", type);
        // toggle the icon
        this.classList.toggle("la-eye-slash");
    });

    const new_password_conf = document.querySelector("#new_password_conf");
    $("#icon_new_password_conf").click(function() {
        // toggle the type attribute
        const type = new_password_conf.getAttribute("type") === "password" ? "text" : "password";
        new_password_conf.setAttribute("type", type);
        // toggle the icon
        this.classList.toggle("la-eye-slash");
    });

</script>
@endpush
