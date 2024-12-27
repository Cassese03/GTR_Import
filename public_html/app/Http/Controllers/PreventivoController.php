<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Socialite;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class PreventivoController implements FromView, WithStyles
{

    // Excel data
    private $rows;

    public function __construct($rows)
    {
        $this->rows = $rows;
    }


    public function view(): View
    {
        $righe_documento = $this->rows;
        return view('exports.ftp', compact('righe_documento'));
    }

    public function styles(Worksheet $sheet)
    {

        $sheet->getStyle('A23:I24')->getAlignment()->setWrapText(true);
        $sheet->getStyle('E25:E60')->getAlignment()->setWrapText(true);
        //$sheet->getStyle('A1:P1')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'D9D9D9'],]);

    }


}
