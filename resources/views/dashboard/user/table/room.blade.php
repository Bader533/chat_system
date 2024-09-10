<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
            <th class="min-w-125px">{{__('site.name')}}</th>
            <th class="min-w-125px">{{__('site.user')}}</th>
            <th class="min-w-125px">{{__('site.roomtype')}}</th>
            <th class="min-w-125px">{{__('site.status')}}</th>
            <th class="min-w-125px">{{__('site.home')}}</th>
            <th class="min-w-125px">{{__('site.favorite')}}</th>
            <th class="min-w-125px">{{__('site.created_at')}}</th>
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

            <!--begin::user=-->
            <td>
                <a class="text-gray-800 text-hover-primary mb-1">{{ $item->user->name }}</a>
            </td>
            <!--end::user=-->

            <!--begin::type=-->
            <td>
                <a class="text-gray-800 text-hover-primary mb-1">{{ $item->roomType->name }}</a>
            </td>
            <!--end::type=-->

            <!--begin::status=-->
            <td>
                <div class="checkbox-wrapper-10">
                    <input @if ($item->status == 1) checked value="1" @else value="0" @endif type="checkbox"
                    id="cb_{{$item->id}}"
                    class="tgl tgl-flip">
                    <label onclick="changeRoomStatus('{{$item->id}}')" for="cb_{{$item->id}}"
                        data-tg-on="{{__('site.active')}}" data-tg-off="{{__('site.non_active')}}"
                        class="tgl-btn"></label>
                </div>
            </td>
            <!--end::status=-->

            <!--begin::is_home=-->
            <td>
                <div class="checkbox-wrapper-10">
                    <input @if ($item->is_home == 1) checked value="1" @else value="0" @endif type="checkbox"
                    id="home_{{$item->id}}"
                    class="tgl tgl-flip">
                    <label onclick="changeIsHome('{{$item->id}}')" for="home_{{$item->id}}"
                        data-tg-on="{{__('site.yes')}}" data-tg-off="{{__('site.no')}}" class="tgl-btn"></label>
                </div>
            </td>
            <!--end::is_home=-->

            <!--begin::is_favorite=-->
            <td>
                <div class="checkbox-wrapper-10">
                    <input @if ($item->is_favorite == 1) checked value="1" @else value="0" @endif type="checkbox"
                    id="favorite_{{$item->id}}"
                    class="tgl tgl-flip">
                    <label onclick="changeIsFavorite('{{$item->id}}')" for="favorite_{{$item->id}}"
                        data-tg-on="{{__('site.yes')}}" data-tg-off="{{__('site.no')}}" class="tgl-btn"></label>
                </div>
            </td>
            <!--end::is_favorite=-->

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
                        onclick="getRooms('{{ $contacts->currentPage() - 1 }}')">‹</a>
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
                <li class="page-item"><a class="page-link" onclick="getRooms(1)">1</a></li>
                @if ($startPage > 2)
                <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
                @endif

                <!-- عرض الصفحات الحالية -->
                @for ($i = $startPage; $i <= $endPage; $i++) <li
                    class="page-item {{ $i == $contacts->currentPage() ? 'active' : '' }}">
                    <a class="page-link" onclick="getRooms('{{ $i }}')">{{ $i }}</a>
                    </li>
                    @endfor

                    <!-- عرض الصفحة الأخيرة إذا كانت الصفحة الحالية ليست قريبة منها -->
                    @if ($endPage < $contacts->lastPage())
                        @if ($endPage < $contacts->lastPage() - 1)
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                            <li class="page-item"><a class="page-link"
                                    onclick="getRooms('{{ $contacts->lastPage() }}')">{{
                                    $contacts->lastPage() }}</a></li>
                            @endif

                            <!-- زر الصفحة التالية -->
                            @if ($contacts->hasMorePages())
                            <li class="page-item"><a class="page-link"
                                    onclick="getRooms('{{ $contacts->currentPage() + 1 }}')">›</a></li>
                            @else
                            <li class="page-item disabled"><span class="page-link">›</span></li>
                            @endif
            </div>
        </div>
    </div>
</div>
