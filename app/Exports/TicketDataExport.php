<?php

namespace App\Exports;

/* use Maatwebsite\Excel\Concerns\FromCollection;
 */
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TicketDataExport implements FromView{

    public function view(): View
    {
        $data = DB::table('tickets')->get();
        return view('exports.tickets', [
            'tickets' => $data
        ]);
    }
}
