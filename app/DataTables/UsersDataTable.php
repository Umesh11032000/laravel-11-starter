<?php

namespace App\DataTables;

use App\Enums\UserStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends BaseDataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('full_name', function ($q) {
                return $q->full_name;
            })
            ->editColumn('created_at', function ($q) {
                return $q->created_at->format('Y-m-d');
            })
            ->editColumn('updated_at', function ($q) {
                return $q->updated_at->format('Y-m-d');
            })
            ->editColumn('status', function ($q) {
                return $q->status->badgeHtml();
            })
            ->addColumn('role', function ($user) {
                return $user->roles()->first()->name;
            })
            ->addColumn('action', function ($user) {
                return view('admin.users.actions', compact('user'))->render();
            })
            ->setRowId('id')
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        $request = $this->request();
        $status = $request->get('status');
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');

        if ($startDate && $endDate) {
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();
        }

        $model = $model->when($status != '', function ($q) use ($status) {
            return $q->where('status', UserStatus::fromValue($status));
        })
        ->when($startDate != '' && $endDate != '', function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('created_at', [$startDate, $endDate]);
        })
        ->where('id', '!=', Auth::id());

        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->parameters($this->parameters)
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel')->addClass('btn-sm btn-warning')->text('<i class="bx bx-file"></i> Export to Excel'),
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->visible(false)->searchable(false)->exportable(false),
            Column::make('full_name')->title(__('module.user.full_name')),
            Column::make('email')->title(__('module.user.email')),
            Column::make('role')->title(__('module.user.role')),
            Column::make('status')->title(__('module.user.status')),
            Column::make('created_at')->title(__('module.user.created_at')),
            Column::make('updated_at')->title(__('module.user.updated_at')),
            Column::computed('action')->title(__('module.user.action'))
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
