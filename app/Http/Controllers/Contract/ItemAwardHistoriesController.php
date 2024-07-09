<?php

// namespace App\Http\Controllers\contract;
namespace App\Http\Controllers\Contract;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Item;
use App\Models\ItemAwardHistory;
use App\Models\ItemAwardType;

class ItemAwardHistoriesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $index_permissions = ['admin.item_award_histories.index',
                            'contracts.item_award_histories.index',
                            'process_contracts.item_award_histories.index',
                            'derive_contracts.item_award_histories.index',
                            'plannings.item_award_histories.index'];
        $create_permissions = ['admin.item_award_histories.create',
                            'contracts.item_award_histories.create',
                            'plannings.item_award_histories.create'];
        $update_permissions = ['admin.item_award_histories.update',
                            'contracts.item_award_histories.update',
                            'plannings.item_award_histories.update'];

        $this->middleware('checkPermission:'.implode(',',$index_permissions))->only('index'); // Permiso para index
        $this->middleware('checkPermission:'.implode(',',$create_permissions))->only(['create', 'store']);   // Permiso para create
        $this->middleware('checkPermission:'.implode(',',$update_permissions))->only(['edit', 'update']);   // Permiso para update
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);

        // Chequeamos permisos del usuario en caso de no ser de la dependencia solicitante
        if(!$request->user()->hasPermission(['admin.item_award_histories.index','process_contracts.item_award_histories.index',
        'derive_contracts.item_award_histories.index','plannings.item_award_histories.index'])){
            return back()->with('error', 'No tiene los suficientes permisos para acceder a esta sección.');
        }

        // $item_award_histories = $item->itemAwardHistories;

        return view('contract.item_award_histories.index', compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);
        // $item_award_types = ItemAwardType::all();

        // Chequeamos permisos del usuario en caso de no ser de la dependencia solicitante
        if(!$request->user()->hasPermission(['admin.item_award_histories.create', 'contracts.item_award_histories.create']) &&
        $item->contract->dependency_id != $request->user()->dependency_id){
            // return back()->with('error', 'No tiene los suficientes permisos para acceder a esta sección.');
        }

        return view('contract.item_award_histories.create', compact('item'));
        return view('contract.item_award_histories.create', compact('item', 'item_award_types'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $item_id)
    {
        $rules = array(
            // 'policy_id' => 'numeric|required|max:2147483647|unique:items,policy_id',
            'number_policy' => 'string|required|unique:items,number_policy',
            'item_from' => 'date_format:d/m/Y',
            'item_to' => 'required|date_format:d/m/Y',
            'amount' => 'nullable|string|max:9223372036854775807',
            'comments' => 'nullable|max:300'
        );

        $validator =  Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $itemA = new ItemAwardHistory;
        $itemA->item_id = $item_id;
        // $item->policy_id = $request->input('policy_id');
        $itemA->number_policy = $request->input('number_policy');
        $itemA->item_from = date('Y-m-d', strtotime(str_replace("/", "-", $request->input('item_from'))));
        $itemA->item_to = date('Y-m-d', strtotime(str_replace("/", "-", $request->input('item_to'))));

        $amount = str_replace('.', '',($request->input('amount')));
        // monto de póliza del form create
        $amount_poliza = $request->input('tot');

        if ($amount === '' ) {
            $validator->errors()->add('amount', 'Ingrese Monto');
            return back()->withErrors($validator)->withInput();
        }

        if ($amount < 0 ) {
            $validator->errors()->add('amount', 'Monto no puede ser negativo');
            return back()->withErrors($validator)->withInput();
        }else{
            $itemA->amount = $amount;
        }

        // consulta si monto de endoso en mayor a monto de poliza
        // var_dump ($amount);
        // var_dump ($amount_poliza);
        // exit;


        if ($amount > $amount_poliza) {
            $validator->errors()->add('amount', 'Monto no puede ser mayor a monto póliza');
            return back()->withErrors($validator)->withInput();
        }else{
            $itemA->amount = $amount;
        }
        $itemA->comments = $request->input('comments');
        $itemA->state_id = 1;
        $itemA->creator_user_id = $request->user()->id;  // usuario logueado
        $itemA->save();
        return redirect()->route('items.item_award_histories.index', $item_id)->with('success', 'Endoso agregado correctamente'); // Caso usuario posee rol pedidos
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $item_id, $itemA_id)
    {
        // $item = ItemAwardHistory::findOrFail($item_id);

        $item = Item::findOrFail($item_id);

        // Chequeamos permisos del usuario en caso de no ser de la dependencia solicitante
        if(!$request->user()->hasPermission(['admin.item_award_histories.create', 'contracts.item_award_histories.create']) &&
        $item->contract->dependency_id != $request->user()->dependency_id){
            return back()->with('error', 'No tiene los suficientes permisos para acceder a esta sección.');
        }

        $itemA = ItemAwardHistory::findOrFail($itemA_id);

        return view('contract.item_award_histories.update', compact('item','itemA'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $item_id, $itemA_id)
    {
        $item = Item::findOrFail($item_id);
        $itemA = ItemAwardHistory::findOrFail($itemA_id);

        $rules = array(
            'number_policy' => 'string|required|unique:items,number_policy',
            'item_from' => 'date_format:d/m/Y',
            'item_to' => 'required|date_format:d/m/Y',
            'amount' => 'nullable|string|max:9223372036854775807',
            'comments' => 'nullable|max:300'
        );

        $validator =  Validator::make($request->input(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $itemA->number_policy = $request->input('number_policy');
        $itemA->item_from = date('Y-m-d', strtotime(str_replace("/", "-", $request->input('item_from'))));
        $itemA->item_to = date('Y-m-d', strtotime(str_replace("/", "-", $request->input('item_to'))));

        $amount = str_replace('.', '',($request->input('amount')));
        if ($amount === '' ) {
            $validator->errors()->add('amount', 'Ingrese Monto');
            return back()->withErrors($validator)->withInput();
        }

        if ($amount < 0 ) {
            $validator->errors()->add('amount', 'Monto no puede ser negativo');
            return back()->withErrors($validator)->withInput();
        }else{
            $itemA->amount = $amount;
        }
        $itemA->comments = $request->input('comments');
        $itemA->creator_user_id = $request->user()->id;  // usuario logueado
        $itemA->save();

        return redirect()->route('items.item_award_histories.index',$item_id)->with('success', 'Se ha modificado exitosamente el endoso de la póliza'); // Caso usuario posee rol pedidos
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $item_id, $itemA_id)
    {
        $item = Item::findOrFail($item_id);

        $itemA = ItemAwardHistory::findOrFail($itemA_id);

        // Chequeamos permisos del usuario en caso de no ser de la dependencia solicitante
        if(!$request->user()->hasPermission(['admin.item_award_histories.delete']) &&
        ($item->contract->dependency_id != $request->user()->dependency_id && $request->user()->hasPermission(['contracts.item_award_histories.delete'])) ){
            return response()->json(['status' => 'error', 'message' => 'No posee los suficientes permisos para realizar esta acción.', 'code' => 200], 200);
        }

        // Eliminamos en caso de no existir registros referenciando al item
        $itemA->delete();
        session()->flash('status', 'success');
        session()->flash('message', 'Se ha eliminado el endoso ' . $itemA->number_policy);

        return response()->json([
            'status' => 'success',
            'message' => 'Se ha eliminado el endoso'. $itemA->number_policy,
            'code' => 200
        ], 200);

        // $request->session()->flash('success', 'Se ha eliminado el endoso referencial a la póliza');
        // return response()->json(['status' => 'success', 'code' => 200], 200);
    }
}
