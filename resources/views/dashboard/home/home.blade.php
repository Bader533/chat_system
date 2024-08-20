@extends('dashboard.parent')

@section('title','')

@section('page_name','')

@section('css')
@endsection

@section('bread_crumb')
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">Dashboards</li>
    <!--end::Item-->
</ul>
@endsection

@section('actions')
<div class="d-flex align-items-center gap-2 gap-lg-3">
    <!--begin::Secondary button-->
    <a href="#" class="btn btn-sm fw-bold bg-body btn-color-gray-700 btn-active-color-primary" data-bs-toggle="modal"
        data-bs-target="#kt_modal_create_app">Rollover</a>
    <!--end::Secondary button-->
    <!--begin::Primary button-->
    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">Add
        Target</a>
    <!--end::Primary button-->
</div>
@endsection

@section('content')

@endsection

@section('js')

@endsection
