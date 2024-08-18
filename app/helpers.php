<?php

use App\Models\Notice;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

## last X Days
if (!function_exists('_lastXDays')) {
    function _lastXDays($count)
    {
        if (!empty($count)) {
            $data['start'] = now()->subDays($count)->format('Y-m-d H:i:s');
            $data['end'] = now()->format('Y-m-d H:i:s');

            return $data;
        }
    }
}

## role view view
if (!function_exists('roleViewForUser')) {
    function roleViewForUser($data)
    {
        if (!empty($data)) {
            return implode(', ', $data->toArray());
        }
    }
}

## showPermissionsName view
if (!function_exists('showPermissionsName')) {
    function showPermissionsName($data)
    {
        $permissionsName = '';
        if (!empty($data)) {
            foreach ($data as $value) {
                $permissionsName .= '<span class="badge bg-info text-dark">' . $value . '</span>&nbsp;';
            }
        }

        return $permissionsName;
    }
}

## showName view
if (!function_exists('showName')) {
    function showName($data)
    {
        $showName = '';
        if (!empty($data)) {
            foreach ($data as $value) {
                $showName .= '<span class="badge bg-info text-dark">' . $value->name . '</span>&nbsp;';
            }
        }

        return $showName;
    }
}

function showDeptName()
{
    $user = Auth::user();
    $resultsJoinData = DB::table('departments')
    ->join('user_depts', 'departments.id', '=', 'user_depts.department_id')
    ->join('users', 'users.id', '=', 'user_depts.user_id')
    ->select('departments.name', 'user_depts.user_id')
    ->where('users.id', $user->id)
    ->get();

## Organize department names by user ID
$userDepartments = [];
foreach ($resultsJoinData as $deptDataGet) {
$userDepartments[$deptDataGet->user_id][] = $deptDataGet->name;
}

return implode(', ', $userDepartments[$user->id] ?? []);
}


function deptWiseTicketGet(){
    $user = User::find(Auth::id()); // Fetching the user data

    // Fetching tickets related to the user's departments
    $resultData = Ticket::with(['department_name', 'assign_user', 'ticket_mail_type'])
        ->whereIn('department_id', function ($query) use ($user) {$query->select('department_id')
        ->from('user_depts')
        ->where('status', 'Open')
        ->where('user_id', $user->id);
        })
        ->get();

     return $resultData;

    foreach ($resultData as $ticket){
        echo '<h6 class="msg-name">New Ticket<span class="msg-time float-end">' . $ticket->created_at->diffForHumans() . '</span></h6><p class="msg-name"><strong>Department ID:</strong> ' . $ticket->department_id . '</p><p class="msg-name"><strong>Subject:</strong> ' . $ticket->subject . '</p><p class="msg-name"><strong>Status:</strong> ' . $ticket->status . '</p>';
    }

    //ticketCountDeptWise()+1;

}

function ticketCountDeptWise(){
    $user = User::find(Auth::id()); // Fetching the user data
    // Fetching tickets related to the user's departments
    $resultData = Ticket::with(['department_name', 'assign_user', 'ticket_mail_type'])
        ->whereIn('department_id', function ($query) use ($user) {$query->select('department_id')
        ->from('user_depts')
        ->where('status', 'Open')
        ->where('user_id', $user->id);
        })->get()->count(); // Counting the data
    return $resultData;

}


## showImage view
if (!function_exists('showImage')) {
    function showImage($data)
    {
        $showImage = '';
        if (!empty($data)) {
            foreach ($data as $value) {
                $showImage .= '<span class="badge bg-info text-dark">' . $value->name . '</span>&nbsp;';
                $showImage .= '<span class="badge bg-info text-dark">' . $value->name . '</span>&nbsp;';
            }
        }

        return $showImage;
    }
}

## active/inactive status
if (!function_exists('status')) {
    function status($status)
    {
        $html = '';
        if ($status == '1') {
            $html = '<span class="badge bg-info text-dark">Active</span>';
        } else {
            $html = '<span class="badge bg-danger">Inactive</span>';
        }

        return $html;
    }
}

## Working status
if (!function_exists('_working_status_data')) {
    function _working_status_data($status)
    {
        $html = '';
        if ($status == 'New') {
            $html = "<span class='badge bg-danger text-dark'>" . $status . "</span>";
        } else if (($status != 'New') && $status != 'Solved') {
            $html = "<span class='badge bg-warning text-dark'>" . $status . "</span>";
        } else {
            $html = "<span class='badge bg-success text-dark'>" . $status . "</span>";
        }

        return $html;
    }
}

if (!function_exists('_workingStatus')) {
    function _workingStatus($status)
    {
        $html = '';
        if ($status == '1') {
            $html = '<span class="badge bg-info text-dark">Working</span>';
        } else {
            $html = '<span class="badge bg-success text-dark">Complete</span>';
        }

        return $html;
    }
}

## wordwrap
if (!function_exists('_wordWrap')) {
    function _wordWrap($data, $count)
    {
        if (!empty($data)) {
            return Str::substr($data, 0, $count) . "..";
        }
    }
}

if (!function_exists('_dateDiffInDays')) {
    function _dateDiffInDays($date1, $date2)
    {
        $diff = strtotime($date2) - strtotime($date1);
        return abs(round($diff / 86400));
    }
}

if (!function_exists('_date_format')) {
    function _date_format($date)
    {
        $format = "Y-m-d H:i:s";
        $date = date_create($date);
        $date = date_format($date, $format);

        return $date;
    }
}

## status list
if (!function_exists('_status_')) {
    function _status_()
    {
        $list = [
            ['Open'],
            ['Pending'],
            ['Working'],
            ['Solved'],
            ['Not Solved'],
            ['Cancelled']
        ];
        return $list;
    }
}




if (!function_exists('_assign_data_')) {
    function _assign_data_($associates)
    {
        $data = json_decode($associates, true);
        $userIds = array_map(function ($item) {
            return $item['pivot']['user_id'];
        }, $data);
        return $userIds;
    }
}

## priority
if (!function_exists('_priority_')) {
    function _priority_()
    {
        $list = [
            ['Low'],
            ['Medium'],
            ['High']
        ];
        return $list;
    }
}



## blank check function
if (!function_exists('_is_blank_')) {
    function _is_blank_()
    {
        $blank_value = [
            ['Data not found']
        ];
        return $blank_value;
    }
}


if (!function_exists('_date_format_ymd')) {
    function _date_format_ymd()
    {
        $date = date('Y-m-d');
        return $date;
    }
}


## formate date
if (!function_exists('covertDate')) {
    function covertDate($data)
    {
        if (!empty($data)) {
            return date('Y-m-d', strtotime($data));
        }
    }
}

## remove comma from string
if (!function_exists('removeComma')) {
    function removeComma($data)
    {
        if (!empty($data)) {
            return str_replace(',', '', $data);
        }
    }
}

/**
 * _colors method return list of colors
 * @param int $index, default is -1
 * @return mixed <string|array>
 * @author Sakil Jomadder <sakil.diu.cse@gmail.com>
 */
if (!function_exists('_colors')) {
    function _colors(int $index = -1)
    {
        $list = [
            ['Pink', '#FF1493'],
            ['Purple', '#800080'],
            ['Magenta', '#FF00FF'],
            ['Indigo', '#4B0082'],
            ['Red', '#FF0000'],
            ['Orange', '#FFA500'],
            ['Green', '#008000'],
            ['Teal', '#008080'],
            ['Blue', '#0000FF'],
            ['Chocolate', '#D2691E'],
            ['Tan', '#D2B48C'],
            ['Olive', '#808000'],
            ['Brown', '#A52A2A'],
            ['DimGray', '#696969'],
            ['Black', '#000000'],
            ['Salmon', '#FA8072'],
            ['Gold', '#FFD700'],
            ['Crimson', '#DC143C'],
            ['DarkKhaki', '#BDB76B'],
            ['LimeGreen', '#32CD32'],
            ['LightSeaGreen', '#20B2AA'],
            ['DodgerBlue', '#DEB887'],
            ['BurlyWood', '#FF1493'],
            ['DarkSlateGray', '#2F4F4F'],
            ['RebeccaPurple', '#663399'],
            ['DarkOrange', '#FF8C00'],
            ['MediumSpringGreen', '#00FA9A'],

        ];
        if (array_key_exists($index, $list)) {
            return $list[$index];
        }
        return $list;
    }
}
