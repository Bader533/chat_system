<?php

namespace App\Helpers;

class Helper
{
    public static function getPagination($currentPage, $totalPages, $maxPagesToShow = 5)
    {
        $startPage = max(1, $currentPage - floor($maxPagesToShow / 2));
        $endPage = min($totalPages, $currentPage + floor($maxPagesToShow / 2));

        // تعديل النطاق لعرض نقاط الفصل إذا كان هناك أكثر من مجموعة من الصفحات
        if ($startPage > 2) {
            $startPage = $currentPage - floor($maxPagesToShow / 2) + 1;
        }
        if ($endPage < $totalPages - 1) {
            $endPage = $currentPage + floor($maxPagesToShow / 2) - 1;
        }

        return [
            'startPage' => $startPage,
            'endPage' => $endPage
        ];
    }
}
