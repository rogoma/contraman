<?php

namespace App\Exports;

//use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;
use App\Models\User;

// muestra alertas de contracts


class OrdersExport6 implements FromView
{
    public function view(): view    
    {      
        $contracts = DB::table('vista_contracts_vctos')//vista que muestra los datos
        ->select(['iddncp','number_year','contratista','tipo_contrato','total_amount','fecha_tope_advance',
        'vcto_adv','dias_advance','fecha_tope_fidelity','vcto_fid','dias_fidelity','fecha_tope_accidents',
        'vcto_acc','dias_accidents','fecha_tope_risks','vcto_ris','dias_risks','fecha_tope_civil_resp',
        'vcto_civ','dias_civil_resp'])
        ->where('dias_advance', '<=', 0) 
        ->orWhere('dias_fidelity', '<=', 0)
        ->orWhere('dias_accidents', '<=', 0)
        ->orWhere('dias_risks', '<=', 0)
        ->orWhere('dias_civil_resp', '<=', 0)
        ->get();    

        return view("contract.contracts.users", compact("contracts"));
    }
}