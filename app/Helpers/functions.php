<?php
if (!function_exists('get_paginator_meta_data')) {
    function get_paginator_meta_data($paginator): array
    {
        return [
            'count' => $paginator->total(),
            'per_page' => $paginator->perPage(),
            'current_page' => $paginator->currentPage(),
            'next_page' => $paginator->appends(request()->all())->nextPageUrl(),
            'has_more_pages' => $paginator->hasMorePages(),
            'next_page_url' => $paginator->appends(request()->all())->nextPageUrl(),
            'previous_page_url' => $paginator->previousPageUrl()
        ];
    }
}
