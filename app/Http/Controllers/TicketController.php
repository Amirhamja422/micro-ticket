<?php

namespace App\Http\Controllers;
use App\Events\TicketNotification;
use App\Exports\TicketDataExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Models\Ticket;
use App\Models\TicketDetail;
use App\Models\TicketHistory;
use App\Models\Classification;
use App\Models\Department;
use App\Models\Category;
use App\Models\SubCategory;
use App\Jobs\TicketExportProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\TicketStoreRequest;
use Illuminate\Support\Facades\Bus;
use Maatwebsite\Excel\facades\Excell;
class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::where('is_active', '1')->get();
        $users = User::where('is_active', '1')->get();
        $statusList = _status_();
        return view('ticket.ticket', compact(['departments', 'statusList','users']))->render();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('is_active', '1')->get();
        $departments = Department::where('is_active', '1')->get();
        $statusList = _status_();
        $priorityList = _priority_();
        $categoryList = Category::where('is_active', '1')->get();

        return view('ticket.ticketCreate', compact(['users', 'departments', 'statusList', 'categoryList', 'priorityList']))->render();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function catChange(Request $request)
    {
        $id =  $request->id;
        $subcatlist = SubCategory::where('cat_id', $id)->get();
        return $subcatlist;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketStoreRequest $request)
    {


        $attachment = $request->file('attachment');
        if($attachment!=''){
            $request->validate([
                'attachment' => 'required|mimes:jpg,png|max:2048',  // Ensure file is a jpg or png and max size is 2MB
            ]);

            $disk = 'attachments';
            $directory = 'images';
            $attachment = $request->file('attachment');
            $new_name = rand() . '.' . $attachment->getClientOriginalExtension();

            if ($attachment->isValid()) {
                $attachment->storeAs($directory, $new_name, $disk);
            } else {
                // Handle invalid attachment case
                return response()->json(['error' => 'Invalid attachment'], 422);
            }
        }
        $user_id = Auth::user()->id;
        $description = $request->description;
        if ($description != '') {
            $description = $request->description;
        } else {
            $description = '';
        }

        $store = Ticket::create([
            // 'creator_user_id' => $user_id, $store->id,
            'department_id' => $request->department_id,
            'contact_name' => $request->contact_name,
            'status' => $request->status,
            'email' => $request->email,
            'description' => $description,

        ]);


        TicketDetail::create([
            'ticket_id' => $store->id,
            'ticket_owner' => $request->ticket_owner,
        ]);

        TicketHistory::create([
            'ticket_id' => $store->id,
            'from' => $user_id,
            'status' => $request->status,
            'description' => $description,
            'attachments' => $new_name ?? null,  // Use null if no attachment
        ]);


        // TicketOptional::create([
        //     'ticket_id' => $store->id,
        //     'phone' => $store->phone,
        //     'priority' => $store->priority,
        // ]);

        event(new TicketNotification($store));



        ## return message
        if ($store) {
            return response()->json(['status' => '200', 'msg' => 'Ticket Created!!']);
        }

    }

    /**
     * show data list
     *
     * @param Request $request
     * @return void
     */

     public function datatable(Request $request)
     {
         ## check ajax request found or not
         if ($request->ajax()) {
             ## query for result
             $user = Auth::user(); // Fetching the authenticated user

             // Fetching departments associated with the user
             $resultsJoinData = DB::table('departments')
                 ->join('user_depts', 'departments.id', '=', 'user_depts.department_id')
                 ->join('users', 'users.id', '=', 'user_depts.user_id')
                 ->select('departments.name', 'user_depts.user_id')
                 ->where('users.id', $user->id)
                 ->get();

             $userDepartments = [];
             foreach ($resultsJoinData as $deptDataGet) {
                 $userDepartments[$deptDataGet->user_id][] = $deptDataGet->name;
             }

            $searchData = $request->datas['ticketId'] ?? null;  // Use null coalescing operator to handle undefined or blank ticketId
            $deptData = $request->datas['department_idtest'] ?? null;  // Use null coalescing operator to handle undefined or blank ticketId
            $ticketOwnerData = $request->datas['ticket_owners'] ?? null;  // Use null coalescing operator to handle undefined or blank ticketId
            $statusData = $request->datas['statusTest'] ?? null;  // Use null coalescing operator to handle undefined or blank ticketId


            // Fetching tickets related to the user's departments
            $resultData = Ticket::with(['department_name', 'assign_user'])
                                ->whereIn('department_id', function($query) use ($user) {
                                    $query->select('department_id')
                                          ->from('user_depts')
                                          ->where('user_id', $user->id);
                                });

            // Add condition for ticketId if it's present
            if (!empty($searchData)) {
                $resultData = $resultData->where('id', $searchData);
            }else if(!empty($deptData)){
                $resultData = $resultData->where('department_id', $deptData);
            }else if(!empty($ticketOwnerData)){
                $ownerIds = TicketDetail::where('ticket_owner', $ticketOwnerData)->pluck('ticket_id');
                $resultData = $resultData->whereIn('id', $ownerIds);

            }else if(!empty($statusData)){
                $resultData = $resultData->where('status', $statusData);
            }else{

            }

            // Execute the query and get the results
            $resultData = $resultData->get();
             $users = User::where('is_active', '1')->get();
             $statusList = _status_();
             ## return data to datatable
             return DataTables::of($resultData)
                 ->addColumn('actions', function ($resultData) {
                     ## Edit button
                     $html = "<a href='javascript:void(0)' class='text-primary p-1' onclick='editModal(" . $resultData->id . ")' title='Edit'><i class='bi bi-pencil-square'></i></a>&nbsp;";
                     return $html;
                 })

                 ->addColumn('ticket_owner_id', function ($resultData) use ($users) {
                     $selectHtmlAssign = "<select class='custom-select form-control' onchange='handleSelectAssign(" . $resultData->id . ", this)' style='width:13rem;'>";
                     $selectHtmlAssign .= "<option selected>Select an assign person</option>";

                     foreach ($users as $user) {
                         $selected = $resultData->contact_name ==  $user->id ? 'selected' : '';

                         $selectHtmlAssign .= "<option value='" . $user->id . "' $selected>" . $user->name . "</option>";
                     }

                     $selectHtmlAssign .= "</select>";

                     return $selectHtmlAssign;
                 })

                 ->addColumn('status', function ($resultData) use ($statusList) {
                     $selectHtmlstatus = "<select class='custom-select form-control' onchange='handleSelectStatus(" . $resultData->id . ", this)' style='width:7rem;'>";
                     $selectHtmlstatus .= "<option selected>Select a status</option>";

                     foreach ($statusList as $status) {
                         $selected = $resultData->status == $status[0] ? 'selected' : '';
                         $selectHtmlstatus .= "<option value='" . $status[0] . "' $selected>" . $status[0] . "</option>";
                     }
                     $selectHtmlstatus .= "</select>";

                     return $selectHtmlstatus;
                 })

                 ->rawColumns(['actions', 'ticket_owner_id', 'status'])
                 ->make(true);
         }
     }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assign_update(Request $request, $id)
    {
        //
        $assign_person = $request->assign_person;
        $userId = Auth::id();
        $ticketData = TicketDetail::where('ticket_id', $id)
            ->update([
                'ticket_owner' => $assign_person,
            ]);

            TicketHistory::create([
                'ticket_id' => $id,
                'from' => $userId,
                ]);


        if ($ticketData) {
            return response()->json(['status' => '200', 'msg' => 'Assign updated success!!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status_update(Request $request, $id)
    {
        //
        $status = $request->status;
        $userId = Auth::id();
        $ticketData = Ticket::where('id', $id)
            ->update([
                'status' => $status,
            ]);

        TicketHistory::create([
            'ticket_id' => $id,
            'from' => $userId,
            'status' => $status,
        ]);


        if ($ticketData) {
            return response()->json(['status' => '200', 'msg' => 'Status updated success!!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $resultData = Ticket::find($id);
        $ticket_id = $resultData->id;
        $ticketHistoryData = TicketHistory::where('ticket_id', $id)->get();
        $ticketDetailsData = TicketDetail::where('ticket_id', $id)->latest()->first();
        $channel_list = $resultData->channel;
        $departments = Department::where('is_active', '1')->get();
        $statusList = _status_();
        $categoryList = Category::where('is_active', '1')->get();
        $users = User::where('is_active', '1')->get();
        $priorityList = _priority_();
        return view('ticket.ticketUpdate', compact(['priorityList', 'users', 'categoryList', 'statusList', 'resultData', 'departments','ticketDetailsData','ticketHistoryData']))->render();

    }

    /**
     * ticketReplay the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ticketReplay(Request $request)
    {
        //
        $user_id = Auth::user()->id;
        $ticket_id = $request->ticket_id;
        $department_id = $request->department_id;
        $contact_name = $request->contact_name;
        $status = $request->status;
        $email = $request->email;
        $ticket_owner = $request->ticket_owner;
        $phone = $request->phone;
        $priority = $request->priority;
        $attachment = $request->file('attachment');
        if($attachment!=''){
            $request->validate([
                'attachment' => 'required|mimes:jpg,png|max:2048',  // Ensure file is a jpg or png and max size is 2MB
            ]);

            $disk = 'attachments';
            $directory = 'images';
            $attachment = $request->file('attachment');
            $new_name = rand() . '.' . $attachment->getClientOriginalExtension();

            if ($attachment->isValid()) {
                $attachment->storeAs($directory, $new_name, $disk);
            } else {
                // Handle invalid attachment case
                return response()->json(['error' => 'Invalid attachment'], 422);
            }
        }

        $descriptions = $request->description;
        if ($descriptions != '') {
            $descriptions = $request->description;
        } else {
            $descriptions = '';
        }

        Ticket::where('id', $ticket_id)
            ->update([
                'department_id' => $department_id,
                'contact_name' => $contact_name,
                'status' => $status,
                'email' => $email,
                'description' => $descriptions,
            ]);


        TicketDetail::where('ticket_id', $ticket_id)
            ->update([
                'ticket_owner' => $ticket_owner,

            ]);

        $ticketHistoryData = TicketHistory::create([
            'ticket_id' => $request->ticket_id,
            'from' => $user_id,
            'status' => $status,
            'description' => $descriptions,
            'attachments' => $new_name ?? null,  // Use null if no attachment
        ]);


        if ($ticketHistoryData) {
            return response()->json(['status' => '200', 'msg' => 'Ticket updated success!!']);
        }
    }



    public function ticketDataDownload($start_date, $end_date) {
        if (!empty($start_date) && !empty($end_date)) {
            $start_date = covertDate(removeComma($start_date));
            $end_date = covertDate(removeComma($end_date));
            $file_name = 'tickets.xlsx';

            $batchLog = json_encode([
                'title' => 'Ticket Report',
                'file_name' => $file_name,
                'start' => $start_date,
                'end' => $end_date,
            ]);

            Bus::batch([
                new TicketExportProcess($start_date . ' 00:00:01', $end_date . ' 23:59:59', $file_name),
            ])->name($batchLog)->dispatch();
        }
    }

    public function exportExcelFile()
    {
        return Excel::download(new TicketDataExport, 'tickets.xlsx');

    }

    public function refresh()
    {
        $user = User::find(Auth::id()); // Fetching the user data
        $resultData = Ticket::with(['department_name', 'assign_user'])
            ->whereIn('department_id', function ($query) use ($user) {$query->select('department_id')
            ->from('user_depts')
            ->where('status', 'Open')
            ->where('user_id', $user->id);
            })->get()->count(); // Counting the data
        return $resultData;
    }

    function refreshNewTicket(){
        $user = User::find(Auth::id()); // Fetching the user data

        // Fetching tickets related to the user's departments
        $resultDataset = Ticket::with(['department_name', 'assign_user'])
            ->whereIn('department_id', function ($query) use ($user) {
                $query->select('department_id')
                      ->from('user_depts')
                      ->where('status', 'Open')
                      ->where('user_id', $user->id);
            })
            ->get();

        return response()->json($resultDataset); // Return JSON response
    }


    }
