<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\User;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Export implements FromCollection, WithHeadings, WithEvents, WithTitle,ShouldAutoSize
{

    public function __construct($name,$email)
    {
        $this->name=$name;
        $this->email=$email;
    }

    /**
    * @return \Illuminate\Support\Collection
    */



    public function collection()
    {

        $user = User::select('id','name','email','created_at')
                                             ->orderBy('id','desc');

                if($this->name != null){
                    $user->where('name',$this->name);
                }

                if($this->email != null){
                    $user->where('email',$this->email);
                }

                $user = $user->get();

                $rowindex = 0;
                foreach($user as $data){
                $data->id = ++$rowindex;
                $data->created_at = Carbon::parse($data->created_at)->format('Y-m-d H:i:s');
                }

                return $user;

    }

    public function headings(): array
    {
        return [
            [
                'No',
                'Name',
                'Email',
                'Created Date'
            ]
        ];
    }

    public function columnFromats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function title(): string
    {
        return "admin report";
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){

                $event->sheet->getDelegate()->getStyle('A1:C1')
                            ->getFont()
                            ->getBold(true);
            },
        ];
    }
}
