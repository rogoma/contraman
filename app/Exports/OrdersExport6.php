<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;


class OrdersExport6 implements FromView
{
    public function view(): view
    {
        $contracts = DB::table('vista_contracts_vctos')//vista que muestra los datos
        ->select(['iddncp','number_year','contratista','tipo_contrato','total_amount','fecha_tope_advance',
        'vcto_adv','dias_advance', 'llamado', 'polizas', 'number_policy', 'modalidad', 'comentarios'])
        ->where('dias_advance', '<=', 0)
        ->get();
        return view("contract.contracts.users", compact("contracts"));
    }
}
