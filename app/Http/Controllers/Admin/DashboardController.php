<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected RoleService $roleService;
    protected UserService $userService;

    public function __construct(RoleService $roleService, UserService $userService)
    {
        $this->roleService = $roleService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleService->all(['users'], ['users']);
        $usersCounts = $this->userService->totalCounts();
        return view('admin.dashboard.index', compact('roles', 'usersCounts'));
    }

    public function userRegistrations(Request $request)
    {
        $startDate = $request->startDate;
        $endDate = $request->endDate;

        if ($startDate && $endDate) {
            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate);
        } else {
            $startDate = Carbon::now()->subDays(30)->startOfDay();
            $endDate = Carbon::now();
        }

        // Check range from start date to end date means is today, last 7 days or last 30 days
        $filterBy = Helper::labelFromDateRanges($startDate, $endDate);

        $funName = isset($filterBy['label']) && $filterBy['label'] ? 'getRegistrations' . $filterBy['label'] : 'Custom';

        if ($funName != 'Custom' && method_exists($this, $funName)) {
            $data = $this->{$funName}($filterBy['labels'] ?? []);
        } else {
            $data = $this->getRegistrationsCustom($startDate, $endDate);
        }


        return response()->json($data);
    }

    public function getRegistrationsYesterday($labels = [])
    {
        $registrations = User::query()
            ->whereBetween('created_at', [Carbon::yesterday()->startOfDay(), Carbon::yesterday()->endOfDay()])
            ->selectRaw('TIME_FORMAT(created_at, "%H") as category, COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('category')
            ->get()
            ->keyBy('category')
            ->toArray();

        foreach ($labels as $key => $label) {
            $hour = Carbon::createFromFormat('H', $key)->format('h');
            $labels[$key]['count'] = $registrations[$hour]['count'] ?? 0;
            $labels[$key]['category'] = Carbon::createFromFormat('H', $key)->format('h');
        }

        return $labels;
    }

    public function getRegistrationsToday($labels = [])
    {
        $registrations = User::query()
            ->whereBetween('created_at', [Carbon::today()->startOfDay(), Carbon::today()->endOfDay()])
            ->selectRaw('DATE_FORMAT(created_at, "%H") as category, COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('category')
            ->get()
            ->keyBy('category')
            ->toArray();

        foreach ($labels as $key => $label) {
            $hour = Carbon::createFromFormat('H', $key)->format('h');
            $labels[$key]['count'] = $registrations[$hour]['count'] ?? 0;
            $labels[$key]['category'] = Carbon::createFromFormat('H', $key)->format('h');
        }

        return $labels;
    }

    public function getRegistrationsLast7Days($labels = [])
    {
        $registrations = User::query()
            ->whereBetween('created_at', [Carbon::now()->subDays(6)->startOfDay(), Carbon::now()->endOfDay()])
            ->selectRaw('DATE_FORMAT(created_at, "%d") as category, COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('category')
            ->get()
            ->keyBy('category')
            ->toArray();

        foreach ($labels as $key => $label) {
            $day = $label['category'];
            $labels[$key]['count'] = $registrations[$day]['count'] ?? 0;
            $labels[$key]['category'] = Carbon::createFromFormat('d', $key)->format('Y-m-d');
        }

        $labels = array_reverse($labels);

        return $labels;
    }

    public function getRegistrationsLast30Days($labels = [])
    {
        $registrations = User::query()
            ->whereBetween('created_at', [Carbon::now()->subDays(30)->startOfDay(), Carbon::now()->endOfDay()])
            ->selectRaw('DATE_FORMAT(created_at, "%d") as category, COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('category')
            ->get()
            ->keyBy('category')
            ->toArray();

        foreach ($labels as $key => $label) {
            $day = $label['category'];
            $labels[$key]['count'] = $registrations[$day]['count'] ?? 0;
            $labels[$key]['category'] = Carbon::createFromFormat('d', $day)->format('Y-m-d');
        }

        $labels = array_reverse($labels);

        return $labels;
    }

    public function getRegistrationsThisMonth($labels = [])
    {
        $registrations = User::query()
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->selectRaw('DATE_FORMAT(created_at, "%d") as category, COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('category')
            ->get()
            ->keyBy('category')
            ->toArray();

        foreach ($labels as $key => $label) {
            $day = Carbon::createFromFormat('d', $key)->format('d');
            $labels[$key]['count'] = $registrations[$day]['count'] ?? 0;
            $labels[$key]['category'] = Carbon::createFromFormat('d', $key)->format('Y-m-d');
        }

        $labels = array_values($labels);

        return $labels;
    }

    public function getRegistrationsLastMonth($labels = [])
    {
        $registrations = User::query()
            ->whereBetween('created_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])
            ->selectRaw('DATE_FORMAT(created_at, "%d") as category, COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('category')
            ->get()
            ->keyBy('category')
            ->toArray();

        foreach ($labels as $key => $label) {
            $day = Carbon::createFromFormat('d', $key)->format('d');
            $labels[$key]['count'] = $registrations[$day]['count'] ?? 0;
            $labels[$key]['category'] = Carbon::createFromFormat('d', $key)->format('Y-m-d');
        }

        $labels = array_values($labels);

        return $labels;
    }

    public function getRegistrationsCustom($from, $to)
    {
        $registrations = User::query()
            ->whereBetween('created_at', [$from, $to])
            ->selectRaw('DATE_FORMAT(created_at, "%d-%m-%Y") as category, COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('category')
            ->get()
            ->keyBy('category')
            ->toArray();

        $registrations = array_values($registrations);

        return $registrations;
    }
}
