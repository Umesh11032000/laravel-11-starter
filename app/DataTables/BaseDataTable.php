<?php

namespace App\DataTables;

use App\Models\Language;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;

class BaseDataTable extends DataTable
{
    /**
     * @var array
     */
    protected array $parameters = [
        'dom' => '<"row"<"col-12"B>><"row"<"col-md-6"l><"col-md-6"f>>r<"col-12 mt-3 table-responsive"t><"row mt-3"<"col-md-6"i><"col-md-6"p>>',
        'initComplete' => 'function(settings, json) {$(this).removeClass("table-striped");}',
        'select' => [
            'style' => 'multi',
            'selector' => 'td:first-child',
        ],
        'drawCallback' => 'function() {
            initializeTooltips();
            $(this).closest(".dataTables_wrapper").find(".dataTables_paginate ").addClass("pagination-style-1");
        }',
        'preDrawCallback' => 'function() {
            $(this).closest(".dataTables_wrapper").find(".dataTables_paginate ").addClass("pagination-style-1");
            $(this).closest(".dataTables_wrapper").find(".dt-buttons").removeClass("btn-group").addClass("btn-group-sm");
            $(this).closest(".dataTables_wrapper").find(".dt-buttons").prependTo(".btn-canvas").addClass("me-1");
        }',
    ];

    public function __construct()
    {
        $currentLocale = app()->getLocale();
        
        $language = Cache::rememberForever('current_language', function () use ($currentLocale) {
            return Language::where('code', $currentLocale)->first();
        });

        $this->parameters = array_merge($this->parameters, [
            'language' => [
                'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/' . Str::title($language->name) . '.json',
            ],
        ]);
    }

}