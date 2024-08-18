<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TicketsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public $start_date;
    public $end_date;

    /**
     * Constructor to initialize date range.
     *
     * @param string $start_date
     * @param string $end_date
     */
    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * Custom query to retrieve data from 'tickets' table within the specified date range.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return DB::table('tickets')
            ->whereBetween('created_at', [$this->start_date, $this->end_date])
            ->select('id', 'contact_name')
            ->orderBy('id', 'asc');
    }

    /**
     * Map data for export.
     *
     * @param \stdClass $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->id,
            $row->contact_name,
        ];
    }

    /**
     * Define headings for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return ['ID', 'Contact Name'];
    }
}
