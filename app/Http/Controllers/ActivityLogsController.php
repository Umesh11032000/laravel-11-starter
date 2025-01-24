<?php

namespace App\Http\Controllers;

use App\DataTables\ActivityLogDataTable;
use Illuminate\Http\Request;

class ActivityLogsController extends Controller
{
    public function index(ActivityLogDataTable $dataTable)
    {
        return $dataTable->render('admin.activitylog.index');
    }
}
