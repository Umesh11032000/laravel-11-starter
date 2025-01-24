<?php

namespace App\Helpers;

use App\Models\User;
use Carbon\Carbon;

class Helper
{
    public static function labelFromDateRanges($from, $to)
    {
        // Detect the today, yesterday, last_7_days, last_30_days, this_month, last_month from $from and $to
        if (!$from instanceof Carbon) {
            $from = Carbon::parse($from);
        }

        if (!$to instanceof Carbon) {
            $to = Carbon::parse($to);
        }

        $filters = [
            'today' => [
                'label' => 'Today',
                'from' => Carbon::now()->startOfDay(),
                'to' => Carbon::now()->endOfDay(),
                'labels' => array_combine(
                    range(0, 23),
                    array_map(
                        fn($hour) => [
                            'count' => 0,
                            'category' => $hour . ':00',
                        ],
                        range(0, 23)
                    )
                )
            ],

            'yesterday' => [
                'label' => 'Yesterday',
                'from' => Carbon::now()->subDay()->startOfDay(),
                'to' => Carbon::now()->subDay()->endOfDay(),
                'labels' => array_combine(
                    range(0, 23),
                    array_map(
                        fn($hour) => [
                            'count' => 0,
                            'category' => $hour . ':00',
                        ],
                        range(0, 23)
                    )
                )
            ],

            'last_7_days' => [
                'label' => 'last7days',
                'from' => Carbon::now()->subDays(7)->startOfDay(),
                'to' => Carbon::now()->endOfDay(),
                'labels' => array_combine(
                    range(0, 6),
                    array_map(
                        fn($day) => [
                            'count' => 0,
                            'category' => Carbon::now()->subDays($day)->format('d'),
                        ],
                        range(0, 6)
                    )
                )
            ],

            'last_30_days' => [
                'label' => 'last30days',
                'from' => Carbon::now()->subDays(30)->startOfDay(),
                'to' => Carbon::now()->endOfDay(),
                'labels' => array_combine(
                    range(0, 30),
                    array_map(
                        fn($day) => [
                            'count' => 0,
                            'category' => Carbon::now()->subDays($day)->format('d'),
                        ],
                        range(0, 30)
                    )
                )
            ],

            'this_month' => [
                'label' => 'thisMonth',
                'from' => Carbon::now()->startOfMonth(),
                'to' => Carbon::now()->endOfMonth(),
                'labels' => array_combine(
                    range(1, Carbon::now()->daysInMonth),
                    array_map(
                        fn($day) => [
                            'count' => 0,
                            'category' => $day,
                        ],
                        range(1, Carbon::now()->daysInMonth)
                    )
                )
            ],

            'last_month' => [
                'label' => 'lastMonth',
                'from' => Carbon::now()->subMonth()->startOfMonth(),
                'to' => Carbon::now()->subMonth()->endOfMonth(),
                'labels' => array_combine(
                    range(1, Carbon::now()->subMonth()->daysInMonth),
                    array_map(
                        fn($day) => [
                            'count' => 0,
                            'category' => $day,
                        ],
                        range(1, Carbon::now()->subMonth()->daysInMonth)
                    )
                )
            ],
        ];

        // Now check if the $from and $to is matching any of the filters
        foreach ($filters as $filter) {
            if ($from->isSameDay($filter['from']) && $to->isSameDay($filter['to'])) {
                return $filter;
            }
        }

        return null;
     }

     public static function moduleNameByModelClass($modelClassName) : string {
        $module = '';

        switch ($modelClassName) {
            case User::class:
                $module = 'user';
                break;
            
            default:
                $module = '';
                break;
        }

        return $module;
     }
}