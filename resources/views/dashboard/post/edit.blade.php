@extends('dashboard.parent')

@section('title',__('site.post'))

@section('page_name',__('site.edit').' '.$post->title)

@section('css')
@endsection

@section('bread_crumb')
<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{route('home')}}" class="text-muted text-hover-primary">{{__('site.home')}}</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">{{__('site.post')}}</li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">{{__('site.edit')}}</li>
    <!--end::Item-->
</ul>
@endsection

@section('actions')

@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            {{-- form --}}
            @include('dashboard.post._form', ['post' => $post ,'function' => 'update'])
            {{-- end form --}}
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content container-->
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
<script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
<script src="{{asset('assets/plugins/custom/tinymce/tinymce.bundle.js')}}"></script>
<script>
    buttonSideBar()

    function buttonSideBar() {
        const button = document.getElementById('articles');
        button.classList.add('here', 'show');
    }

    var options = {selector: "#description_en", height : "480"};
    tinymce.init(options);

    var description_ar = {selector: "#description_ar", height : "480"};
    tinymce.init(description_ar);

    function update() {
        let formData = new FormData();

        formData.append("title_en", document.getElementById('title_en').value);
        formData.append("title_ar", document.getElementById('title_ar').value);
        formData.append("description_en", tinymce.get("description_en").getContent());
        formData.append("description_ar", tinymce.get("description_ar").getContent());
        formData.append("status", document.getElementById('status').value);
        formData.append("avatar", document.getElementById('avatar').files[0]);

        formData.append("_method", "PUT");
        axios.post('/post/{{$post->slug}}', formData)
        .then(function (response) {
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.success(response.data.message);
            window.location.href = '/post';
        }).catch(function (error) {
            // console.log(error);
            toastr.options = {
                positionClass: 'toast-top-left',
            };
            toastr.error(error.response.data.message);
        });
    }

</script>
@endsection
