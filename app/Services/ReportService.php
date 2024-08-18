<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportService
{

    public function lead_details_data_get_service($start, $end)
    {
        $startDate = $start . " 00:00:00";
        $endDate = $end . " 23:59:59";
        $data = DB::table('leads')
            ->select(
                'leads.id',
                'leads.creator_user_id',
                'leads.user_id',
                'leads.associate_user_id',
                'leads.lead_industry_id',
                'leads.lead_source_id',
                'leads.lead_pipeline_id',
                'leads.lead_rating_id',
                'leads.lead_area_id',
                'leads.district_id',
                'leads.phone_number',
                'leads.name',
                'leads.email',
                'leads.company_name',
                'leads.company_phone',
                'leads.company_email',
                'leads.address',
                'leads.created_at',
                DB::raw('(SELECT `name` FROM lead_pipelines WHERE lead_pipelines.id = leads.lead_pipeline_id) as pipelineName'),
                DB::raw('(SELECT `name` FROM users WHERE users.id = leads.creator_user_id) as creatorName'),
                DB::raw('(SELECT `name` FROM users WHERE users.id = leads.user_id) as assignName'),
                DB::raw('(SELECT `name` FROM users WHERE users.id = leads.associate_user_id) as associateName'),
                DB::raw('(SELECT `name` FROM industry_types WHERE industry_types.id = leads.lead_industry_id) as industryName'),
                DB::raw('(SELECT `name` FROM lead_sources WHERE lead_sources.id = leads.lead_source_id) as sourceName'),
                DB::raw('(SELECT `name` FROM lead_ratings WHERE lead_ratings.id = leads.lead_rating_id) as ratingName'),
                DB::raw('(SELECT `name` FROM lead_areas WHERE lead_areas.id = leads.lead_area_id) as areaName'),
                DB::raw('(SELECT `name` FROM districts WHERE districts.id = leads.district_id) as districtName'),
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('id', 'ASC');
        return $data;
    }
    public function lead_pipeline_stage_report_data_get_service($start, $end)
    {
        $startDate = $start . " 00:00:00";
        $endDate = $end . " 23:59:59";

        $data = DB::table('lead_pipeline_logs as lp')
            ->select('lp.lead_id', 'l.company_name as lead_name', 'l.phone_number', 'l.id', 'l.created_at')
            // ->selectRaw("GROUP_CONCAT(DISTINCT CONCAT(p.name, ' :', DATE_FORMAT(lp.pipeline_time, '%Y-%m-%d %H:%i:%s'), '')) as pipeline_history")
            ->selectRaw("GROUP_CONCAT(DISTINCT CONCAT(p.name, ' :', lp.pipeline_time, '')) as pipeline_history")
            ->selectRaw("GROUP_CONCAT(DISTINCT CONCAT(users.name)) as user_name")
            ->leftJoin('leads as l', 'lp.lead_id', '=', 'l.id')
            ->leftJoin('lead_pipelines as p', 'lp.pipeline_id', '=', 'p.id')
            ->leftJoin('users', 'lp.creator_user_id', '=', 'users.id')
            ->whereBetween('lp.created_at', [$startDate, $endDate])
            ->groupBy('lp.lead_id', 'l.name', 'l.phone_number')
            ->orderBy('lp.lead_id')
            ->get();

        return $data;
    }
    public function lead_funnel_stage_report_data_get_service($start, $end)
    {
        $startDate = $start . " 00:00:00";
        $endDate = $end . " 23:59:59";
        $data = DB::select('
        SELECT
            lf.name AS lead_funnel_name,
            lp.name AS lead_pipeline_name,
            COUNT(l.id) AS total_lead_count,
            (SELECT COUNT(`id`) FROM leads ) as totalLead
        FROM
            lead_funnels lf
        JOIN
            lead_funnel_pipelines lfp ON lf.id = lfp.lead_funnel_id
        JOIN
            lead_pipelines lp ON lfp.lead_pipeline_id = lp.id
        LEFT JOIN
            leads l ON lfp.lead_pipeline_id = l.lead_pipeline_id
            WHERE
            l.created_at BETWEEN :start_date AND :end_date
        GROUP BY
            lf.id, lf.name, lp.id, lp.name
        ORDER BY
        lf.id ASC, lp.id ASC
    ', [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);

        return $data;
    }
}
