<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class UsersExport implements
    FromCollection,
    WithHeadings,
    WithEvents,
    WithTitle,
    ShouldAutoSize,
    WithMapping
{
    function __construct($from_date, $to_date)
    {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function collection()
    {
        $datas = User::select('id', 'name', 'email', 'created_at', 'updated_at')
            ->where('created_at', '>=', $this->from_date)
            ->where('created_at', '<=', $this->to_date)
            ->orderBy('id', 'desc')
            ->get();

            // if ($this->from_date != null) {
            //     $from_date = $this->from_date;
            // }
            // if ($this->to_date != null) {
            //     $to_date = $this->to_date;
            // }

            // if ($from_date > $to_date) {
            //     return Redirect::back()->withErrors([
            //         'msg' => 'To Date should be later than From Date!',
            //     ]);
            // }

        $rowindex = 0;
        foreach ($datas as $data) {
            $data->id = ++$rowindex;
            $data->created_at->format('Y-m-d H:i:s');
        }
        return $datas;
    }

    public function headings(): array
    {
        return [
            // ['Print Date:', $this->from_date.' to ' .$this->to_date],
            ['No.', 'Name', 'Email', 'Created Date', 'Updated Date'],
        ];
    }

    public function map($datas): array
    {
        return [
            $datas->id,
            $datas->name,
            $datas->email,
            $datas->created_at->format('Y-m-d H:i:s'),
            $datas->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function title(): string
    {
        return 'User update information report';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet
                    ->getDelegate()
                    ->getStyle('A1:E1')
                    ->getFont()
                    ->setBold(true);
            },
        ];
    }
}
