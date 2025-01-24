<?php

namespace App\DataTables;

use App\Helpers\App;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Spatie\Activitylog\Models\Activity as ActivityLog;

class ActivityLogDataTable extends BaseDataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('causer', function ($q) {
                return $q->causer->full_name ?? 'N/A';
            })
            ->addColumn('old_properties', function ($q) {
                $properties = json_decode($q->properties ?? '', true) ?? [];
                return view('admin.activitylog.old_properties', compact('properties'))->render();
            })
            ->addColumn('new_properties', function ($q) {
                $properties = json_decode($q->properties ?? '', true) ?? [];
                return view('admin.activitylog.new_properties', compact('properties'))->render();
            })
            ->addColumn('description', function ($q) {
                return view('admin.activitylog.description', compact('q'))->render();
            })
            ->editColumn('created_at', function ($q) {
                return $q->created_at->format('Y-m-d');
            })
            ->rawColumns(['old_properties', 'new_properties', 'description'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ActivityLog $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('activitylog-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters($this->parameters)
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->visible(false)->searchable(false)->exportable(false),
            Column::make('causer')->title(__('module.activitylog.causer')),
            Column::make('description')->title(__('module.activitylog.description')),
            Column::make('old_properties')->title(__('module.activitylog.old_properties')),
            Column::make('new_properties')->title(__('module.activitylog.new_properties')),
            Column::make('created_at')->title(__('module.activitylog.activity_at')),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ActivityLog_' . date('YmdHis');
    }
}
