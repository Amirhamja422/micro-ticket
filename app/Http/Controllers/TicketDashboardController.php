<?php

namespace App\Http\Controllers;

use App\Services\TicketCountService;
use Illuminate\Http\Request;

class TicketDashboardController extends Controller
{
    public function index(TicketCountService $TicketCountService)
    {
        // Define variable
        $date = date('Y-m-d');
        //Only for email ticket Count today's data
        // $allTicket = $TicketCountService->totalTickets($date, $date);
        // $openTicket = $TicketCountService->openTickets($date, $date);
        // $solveTicket = $TicketCountService->solvedTickets($date, $date);
        // $workingTicket = $TicketCountService->workingTickets($date, $date);
        // $pendingTicket = $TicketCountService->pendingTickets($date, $date);


        //Only for ticket Count today's data
        // $allTicket = $TicketCountService->totalTickets($date, $date);
        $openManualTickets = $TicketCountService->openManualTickets($date, $date);
        $workingManualTickets = $TicketCountService->workingManualTickets($date, $date);
        $pendingManualTickets = $TicketCountService->pendingManualTickets($date, $date);
        $solvedManualTickets = $TicketCountService->solvedManualTickets($date, $date);


        // Bar chart data
        // $chart = $TicketCountService->barChartService();

        // Put data
        $data = [
            // 'total' => $allTicket,
            // 'openTicket' => $openTicket,
            // 'workingTicket' => $workingTicket,
            // 'pendingTicket' => $pendingTicket,
            // 'solveTicket' => $solveTicket,
            // 'chart' => $chart
            'openManualTickets' => $openManualTickets,
            'workingManualTickets' => $workingManualTickets,
            'pendingManualTickets' => $pendingManualTickets,
            'solvedManualTickets' => $solvedManualTickets

        ];

        return view('dashboardTicket', compact('data'));
    }
}
