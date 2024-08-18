<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DashboardGraphService
{
    /**
     * support data count
     *
     * @param array $inputs
     * @return mixed
     */
    public function task_status_count_graph(array $inputs = [])
    {
        $date = _lastXDays(30);

        $total_task_count_user = DB::table('users')
            ->select(
                'users.id',
                DB::raw('SUBSTRING_INDEX(users.name, " ", 1) as first_name'),
                DB::raw('COUNT(associatables.associatable_id) as total_task_count'),
                DB::raw('SUM(CASE WHEN tasks.status = "Solved" THEN 1 ELSE 0 END) as total_solved_task_count')
            )
            ->leftJoin('associatables', function ($join) {
                $join->on('users.id', '=', 'associatables.user_id')
                    ->where('associatables.associatable_type', '=', 'App\\Models\\Task');
            })
            ->leftJoin('tasks', function ($join) {
                $join->on('associatables.associatable_id', '=', 'tasks.id')
                    ->where('associatables.associatable_type', '=', 'App\\Models\\Task');
            })
            ->whereBetween('tasks.created_at', [$date['start'], $date['end']])
            ->groupBy('users.id', 'users.name')
            ->orderBy('first_name', 'ASC')
            ->get();


        return $total_task_count_user;
    }

    /**
     * task graph data process
     *
     * @param array $inputs
     * @return mixed
     */
    public function task_status_count_graph_data(array $inputs = [])
    {
        $task_data_count = $this->task_status_count_graph($inputs);

        $dataTotal = [];
        $dataSolved = [];
        $categories = [];
        foreach ($task_data_count as $key => $item) {
            $categories[] = $item->first_name;
            $dataTotal[] = $item->total_task_count;
            $dataSolved[] = $item->total_solved_task_count;
        }


        return ['dataTotal' => $dataTotal, 'dataSolved' => $dataSolved, 'categories' => $categories] ?? [];
    }

    /**
     * support data count
     *
     * @param array $inputs
     * @return mixed
     */
    public function support_status_count_graph(array $inputs = [])
    {
        $date = _lastXDays(30);

        $total_task_count_user = DB::table('users')
            ->select(
                'users.id',
                DB::raw('SUBSTRING_INDEX(users.name, " ", 1) as first_name'),
                DB::raw('COUNT(associatables.associatable_id) as total_support_count'),
                DB::raw('SUM(CASE WHEN supports.status = "Solved" THEN 1 ELSE 0 END) as total_solved_support_count')
            )
            ->leftJoin('associatables', function ($join) {
                $join->on('users.id', '=', 'associatables.user_id')
                    ->where('associatables.associatable_type', '=', 'App\\Models\\Support');
            })
            ->leftJoin('supports', function ($join) {
                $join->on('associatables.associatable_id', '=', 'supports.id')
                    ->where('associatables.associatable_type', '=', 'App\\Models\\Support');
            })
            ->whereBetween('supports.created_at', [$date['start'], $date['end']])
            ->groupBy('users.id', 'users.name')
            ->orderBy('first_name', 'ASC')
            ->get();


        return $total_task_count_user;
    }

    /**
     * support graph data process
     *
     * @param array $inputs
     * @return void
     */
    public function support_status_count_graph_data(array $inputs = [])
    {
        $task_data_count = $this->support_status_count_graph($inputs);

        $dataTotal = [];
        $dataSolved = [];
        $categories = [];
        foreach ($task_data_count as $key => $item) {
            $categories[] = $item->first_name;
            $dataTotal[] = $item->total_support_count;
            $dataSolved[] = $item->total_solved_support_count;
        }


        return ['dataTotal' => $dataTotal, 'dataSolved' => $dataSolved, 'categories' => $categories] ?? [];
    }
}
