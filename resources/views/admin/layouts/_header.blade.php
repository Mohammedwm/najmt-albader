
<head>
    <meta charset="utf-8" />
    <title>{{config('app.name')}}</title>
    <link rel="shortcut icon" href="{{ asset('admin/assets/media/logos/logo.ico') }}" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
<!--begin::Vendor Stylesheets(used by this page)-->
<link href="{{ asset('admin/assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
<!--end::Vendor Stylesheets-->
<!--begin::Global Stylesheets Bundle(used by all pages)-->
<link href="{{ asset('admin/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

<!--end::Global Stylesheets Bundle-->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
var base_url = '{{URL::to('/')}}';
</script>

@stack('css')
</head>
