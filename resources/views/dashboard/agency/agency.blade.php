<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
            <th class="min-w-125px">{{__('site.name')}}</th>
            <th class="min-w-125px">{{__('site.status')}}</th>
            <th class="min-w-125px">{{__('site.is_home')}}</th>
            <th class="min-w-125px">{{__('site.created_at')}}</th>
            <th class="text-end min-w-70px">{{__('site.actions')}}</th>
        </tr>
        <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="fw-semibold text-gray-600" id="table_data">
        @if (!$contacts->isEmpty())

        @foreach ($contacts as $item)
        <tr>
            <!--begin::Name=-->
            <td>
                <a class="text-gray-800 text-hover-primary mb-1">{{ $item->name }}</a>
            </td>
            <!--end::Name=-->

            <!--begin::status=-->
            <td>
                @if ($item->status == 1)
                <div class="badge badge-light-success fw-bold">
                    {{__('site.active')}}
                </div>
                @else
                <div class="badge badge-light-danger fw-bold">
                    {{__('site.non_active')}}
                </div>
                @endif
            </td>
            <!--end::status=-->

            <!--begin::is_home=-->
            <td>
                @if ($item->is_home == 1)
                <div class="badge badge-light-success fw-bold">
                    {{__('site.yes')}}
                </div>
                @else
                <div class="badge badge-light-danger fw-bold">
                    {{__('site.no')}}
                </div>
                @endif
            </td>
            <!--end::is_home=-->

            <!--begin::Date=-->
            <td>{{ date('m/d/Y', strtotime($item->created_at)) }}</td>
            <!--end::Date=-->
            <!--begin::Action=-->

            <td class="text-end">

                <!--begin::Edit-->

                <a href="{{route('agency.edit',$item->slug)}}"
                    class="btn btn-icon btn-active-light-primary w-30px h-30px me-3">
                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="{{ __('site.edit') }}">
                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.3"
                                    d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                    fill="currentColor" />
                                <path
                                    d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                </a>

                <!--end::Edit-->

                <!--begin::Delete-->
                {{-- <a onclick="confirmDelete('{{$item->id}}',this)"
                    class="btn btn-icon btn-active-light-danger w-30px h-30px me-3" data-bs-toggle="tooltip"
                    title="Delete" data-kt-customer-payment-method="delete">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                    <span class="svg-icon svg-icon-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                fill="currentColor" />
                            <path opacity="0.5"
                                d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                fill="currentColor" />
                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </a> --}}
                <!--end::Delete-->

            </td>

            <!--end::Action=-->
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="5" align="center">No Data Found</td>
        </tr>

        @endif
    </tbody>
    <tbody class="fw-semibold text-gray-600" id="table_search_data">

    </tbody>
    <!--end::Table body-->
</table>

<div class="container">
    <div class="row">
        <div class="col-sm">
            <div class="pagination">
                <!-- زر الصفحة السابقة -->
                @if ($contacts->onFirstPage())
                <li class="page-item disabled"><span class="page-link">‹</span></li>
                @else
                <li class="page-item"><a class="page-link"
                        onclick="getAgencies('{{ $contacts->currentPage() - 1 }}')">‹</a>
                </li>
                @endif
                @php
                use App\Helpers\Helper;

                $pagination = Helper::getPagination($contacts->currentPage(), $contacts->lastPage());
                @endphp
                @php
                $startPage = $pagination['startPage'];
                $endPage = $pagination['endPage'];
                @endphp

                <!-- عرض الصفحة الأولى إذا كانت الصفحة الحالية ليست قريبة منها -->
                @if ($startPage > 1)
                <li class="page-item"><a class="page-link" onclick="getAgencies(1)">1</a></li>
                @if ($startPage > 2)
                <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
                @endif

                <!-- عرض الصفحات الحالية -->
                @for ($i = $startPage; $i <= $endPage; $i++) <li
                    class="page-item {{ $i == $contacts->currentPage() ? 'active' : '' }}">
                    <a class="page-link" onclick="getAgencies('{{ $i }}')">{{ $i }}</a>
                    </li>
                    @endfor

                    <!-- عرض الصفحة الأخيرة إذا كانت الصفحة الحالية ليست قريبة منها -->
                    @if ($endPage < $contacts->lastPage())
                        @if ($endPage < $contacts->lastPage() - 1)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                            <li class="page-item"><a class="page-link"
                                    onclick="getAgencies('{{ $contacts->lastPage() }}')">{{
                                    $contacts->lastPage() }}</a></li>
                            @endif

                            <!-- زر الصفحة التالية -->
                            @if ($contacts->hasMorePages())
                            <li class="page-item"><a class="page-link"
                                    onclick="getAgencies('{{ $contacts->currentPage() + 1 }}')">›</a></li>
                            @else
                            <li class="page-item disabled"><span class="page-link">›</span></li>
                            @endif
            </div>
        </div>
    </div>
</div>