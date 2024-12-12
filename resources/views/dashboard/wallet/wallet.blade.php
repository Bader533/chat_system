<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
            <th class="min-w-125px">{{__('site.user_id')}}</th>
            <th class="min-w-125px">{{__('site.recipient')}}</th>
            <th class="min-w-125px">{{__('site.type')}}</th>
            <th class="min-w-125px">{{__('site.quantity')}}</th>
            <th class="min-w-125px">{{__('site.dollar')}}</th>
            <th class="min-w-125px">{{__('site.created_at')}}</th>
            {{-- <th class="text-end min-w-70px">{{__('site.actions')}}</th> --}}
        </tr>
        <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="fw-semibold text-gray-600" id="table_data">
        @if (!$contacts->isEmpty())

        @foreach ($contacts as $item)
        <tr>
            <!--begin::id=-->
            <td>
                <a class="text-gray-800 text-hover-primary mb-1">{{ $item->wallet->user->id }}</a>
            </td>
            <!--end::id=-->

            <!--begin::user name=-->
            <td>
                <a class="text-gray-800 text-hover-primary mb-1">{{ $item->wallet->user->name }}</a>
            </td>
            <!--end::user name=-->

            <!--begin::type=-->
            <td>
                @if ($item->asset == 'gold')
                <div class="badge badge-light-warning fw-bold">
                    {{$item->asset}}
                </div>
                @elseif($item->asset == 'diamonds')
                <div class="badge badge-light-info fw-bold">
                    {{$item->asset}}
                </div>
                @elseif($item->asset == 'silver')
                <div class="badge badge-light-primary fw-bold">
                    {{$item->asset}}
                </div>
                @endif
            </td>
            <!--end::type=-->

            <!--begin::quantity=-->
            <td>
                <a>{{$item->amount}}</a>
            </td>
            <!--end::quantity=-->

            <!--begin::dollar=-->
            <td>
                <a>{{$item->dollar}}</a>
            </td>
            <!--end::dollar=-->

            <!--begin::Date=-->
            <td>{{ date('m/d/Y', strtotime($item->created_at)) }}</td>
            <!--end::Date=-->
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
                        onclick="getWallets('{{ $contacts->currentPage() - 1 }}')">‹</a>
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
                <li class="page-item"><a class="page-link" onclick="getWallets(1)">1</a></li>
                @if ($startPage > 2)
                <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
                @endif

                <!-- عرض الصفحات الحالية -->
                @for ($i = $startPage; $i <= $endPage; $i++) <li
                    class="page-item {{ $i == $contacts->currentPage() ? 'active' : '' }}">
                    <a class="page-link" onclick="getWallets('{{ $i }}')">{{ $i }}</a>
                    </li>
                    @endfor

                    <!-- عرض الصفحة الأخيرة إذا كانت الصفحة الحالية ليست قريبة منها -->
                    @if ($endPage < $contacts->lastPage())
                        @if ($endPage < $contacts->lastPage() - 1)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                            <li class="page-item"><a class="page-link"
                                    onclick="getWallets('{{ $contacts->lastPage() }}')">{{
                                    $contacts->lastPage() }}</a></li>
                            @endif

                            <!-- زر الصفحة التالية -->
                            @if ($contacts->hasMorePages())
                            <li class="page-item"><a class="page-link"
                                    onclick="getWallets('{{ $contacts->currentPage() + 1 }}')">›</a></li>
                            @else
                            <li class="page-item disabled"><span class="page-link">›</span></li>
                            @endif
            </div>
        </div>
    </div>
</div>
