<?php

namespace App\Services;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class TicketCountService.
 */
class TicketCountService
{

    public function totalTickets($start_date, $end_date)
    {
        return DB::table('tickets')->whereBetween('created_at', [$start_date . ' 00:00:01', $end_date . ' 23:59:59'])->count();
    }
    // public function openTickets($start_date, $end_date)
    // {
    //     $user = User::find(Auth::id()); // Fetching the user data
    //     // Fetching tickets related to the user's departments
    //     return Ticket::with(['department_name', 'assign_user', 'ticket_mail_type'])
    //         ->whereIn('department_id', function ($query) use ($user) {
    //             $query->select('department_id')
    //                   ->from('user_depts')
    //                   ->where('user_id', $user->id);
    //         })
    //         ->whereBetween('created_at', [$start_date . ' 00:00:01', $end_date . ' 23:59:59']) // Adding date filter
    //         ->where('status', 'Open')
    //         ->where('channel', 'Email')
    //         ->count(); // Counting the data
    // }


    // public function solvedTickets($start_date, $end_date)
    // {
    //     $user = User::find(Auth::id()); // Fetching the user data
    //     // Fetching tickets related to the user's departments
    //     return Ticket::with(['department_name', 'assign_user', 'ticket_mail_type'])
    //         ->whereIn('department_id', function ($query) use ($user) {
    //             $query->select('department_id')
    //                   ->from('user_depts')
    //                   ->where('user_id', $user->id);
    //         })
    //         ->whereBetween('created_at', [$start_date . ' 00:00:01', $end_date . ' 23:59:59']) // Adding date filter
    //         ->where('status', 'Solved')
    //         ->where('channel', 'Email')
    //         ->count(); // Counting the data
    // }

    // public function workingTickets($start_date, $end_date)
    // {
    //     $user = User::find(Auth::id()); // Fetching the user data
    //     // Fetching tickets related to the user's departments
    //     return Ticket::with(['department_name', 'assign_user', 'ticket_mail_type'])
    //         ->whereIn('department_id', function ($query) use ($user) {
    //             $query->select('department_id')
    //                   ->from('user_depts')
    //                   ->where('user_id', $user->id);
    //         })
    //         ->whereBetween('created_at', [$start_date . ' 00:00:01', $end_date . ' 23:59:59']) // Adding date filter
    //         ->where('status', 'Working')
    //         ->where('channel', 'Email')
    //         ->count(); // Counting the data
    // }
    // public function pendingTickets($start_date, $end_date)
    // {
    //     $user = User::find(Auth::id()); // Fetching the user data
    //     // Fetching tickets related to the user's departments
    //     return Ticket::with(['department_name', 'assign_user', 'ticket_mail_type'])
    //         ->whereIn('department_id', function ($query) use ($user) {
    //             $query->select('department_id')
    //                   ->from('user_depts')
    //                   ->where('user_id', $user->id);
    //         })
    //         ->whereBetween('created_at', [$start_date . ' 00:00:01', $end_date . ' 23:59:59']) // Adding date filter
    //         ->where('status', 'Pending')
    //         ->where('channel', 'Email')
    //         ->count(); // Counting the data
    // }



    public function openManualTickets($start_date, $end_date)
    {
        $user = User::find(Auth::id()); // Fetching the user data
        // Fetching tickets related to the user's departments
        return Ticket::with(['department_name', 'assign_user', 'ticket_mail_type'])
            ->whereIn('department_id', function ($query) use ($user) {
            $query->select('department_id')
            ->from('user_depts')
            ->where('user_id', $user->id);
            })
            ->whereBetween('created_at', [$start_date . ' 00:00:01', $end_date . ' 23:59:59']) // Adding date filter
            ->where('status', 'Open')
            ->count(); // Counting the data
    }


    public function workingManualTickets($start_date, $end_date)
    {
        $user = User::find(Auth::id()); // Fetching the user data
        // Fetching tickets related to the user's departments
        return Ticket::with(['department_name', 'assign_user', 'ticket_mail_type'])
            ->whereIn('department_id', function ($query) use ($user) {
            $query->select('department_id')
            ->from('user_depts')
            ->where('user_id', $user->id);
            })
            ->whereBetween('created_at', [$start_date . ' 00:00:01', $end_date . ' 23:59:59']) // Adding date filter
            ->where('status', 'Working')
            ->count(); // Counting the data
    }
    public function pendingManualTickets($start_date, $end_date)
    {
        $user = User::find(Auth::id()); // Fetching the user data
        // Fetching tickets related to the user's departments
        return Ticket::with(['department_name', 'assign_user', 'ticket_mail_type'])
            ->whereIn('department_id', function ($query) use ($user) {
            $query->select('department_id')
            ->from('user_depts')
            ->where('user_id', $user->id);
            })
            ->whereBetween('created_at', [$start_date . ' 00:00:01', $end_date . ' 23:59:59']) // Adding date filter
            ->where('status', 'Pending')
            ->count(); // Counting the data
    }
    public function solvedManualTickets($start_date, $end_date)
    {
        $user = User::find(Auth::id()); // Fetching the user data
        // Fetching tickets related to the user's departments
        return Ticket::with(['department_name', 'assign_user', 'ticket_mail_type'])
            ->whereIn('department_id', function ($query) use ($user) {
            $query->select('department_id')
            ->from('user_depts')
            ->where('user_id', $user->id);
            })
            ->whereBetween('created_at', [$start_date . ' 00:00:01', $end_date . ' 23:59:59']) // Adding date filter
            ->where('status', 'Solved')
            ->count(); // Counting the data
    }





        /**
     * barChartService
     *
     * @return void
     */
//     public function barChartService()
//     {
//     $totalTicket = array();
//     $openTicket = array();
//     $workingTicket = array();
//     $pendingTicket = array();
//     $solvedTicket = array();

//     // Get count
//     $countData = DB::table('tickets')
//         ->select(
//             DB::raw('count(*) as ticket'),
//             DB::raw("(SELECT count(*) FROM tickets WHERE status='Open') as open_tickets"),
//             DB::raw("(SELECT count(*) FROM tickets WHERE status='Pending') as pending_tickets"),
//             DB::raw("(SELECT count(*) FROM tickets WHERE status='Working') as working_tickets"),
//             DB::raw("(SELECT count(*) FROM tickets WHERE status='Solved') as solve_tickets")
//         )
//         ->whereDate('created_at', '=', date('Y-m-d'))
//         ->get();

//     // Process array
//     foreach ($countData as $value) {
//         array_push($totalTicket, $value->ticket);
//         array_push($openTicket, $value->open_tickets); // Added count of open tickets
//         array_push($pendingTicket, $value->pending_tickets); // Added count of open tickets
//         array_push($workingTicket, $value->working_tickets); // Added count of open tickets
//         array_push($solvedTicket, $value->solve_tickets); // Added count of open tickets
//     }

//     // Put chart data
//     return array('totalTicket' => $totalTicket, 'openTicket' => $openTicket, 'solvedTicket' => $solvedTicket); // Corrected array key
// }
}
