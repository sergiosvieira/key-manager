<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    private $transaction;
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = $this->transaction->where('status', 'open')->paginate(10);
        $users = \App\User::where('type', '!=', 'admin')->pluck('name', 'id');
        $keys = array();
        foreach ($transactions as $t) {
            $aux = DB::table('transaction_keys as tk')
                ->where('tk.transaction_id', $t->id)
                ->join('keys as k', 'tk.key_id', '=', 'k.id')
                ->select('tk.transaction_id', 'tk.key_id', 'k.name')
                ->get();
            foreach ($aux as $a) {
                $keys[$t->id] = [$a->key_id => $a->name];
            }
        }
        return view('transactions.index', compact(['transactions', 'users', 'keys']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gatekeepers = \App\User::all()->where('type', 'gatekeeper')->pluck('name', 'id');
        $users = \App\User::all()->where('type', 'user')->pluck('name', 'id');
        $aux = DB::table('keys as k')
            ->where('k.available', true)
            ->join('sectors_sub_sectors as sss', 'k.sector_sub_sector_id', '=', 'sss.id')
            ->join('sectors as sec', 'sss.sector_id', '=', 'sec.id')
            ->join('sub_sectors as sub', 'sss.sub_sector_id', '=', 'sub.id')
            ->select('k.id', 'k.name', 'sec.name as sec_name', 'sub.name as sub_name')
            ->get();
        $keys = [];
        foreach ($aux as $i) {
            $keys[$i->id] = $i->sec_name . " - " . $i->sub_name . " - " . $i->name;
        }
        return view('transactions.create', compact(['gatekeepers', 'users', 'keys']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $transaction = new Transaction([
                'gatekeeper_id' => $data['gatekeeper_id'],
                'user_id' => $data['user_id'],
                'status' => 'open',
            ]);
            $transaction->save();
            foreach ($data['keys'] as $key) {
                $transaction->transaction_keys()->save(
                    new \App\Models\TransactionKeys([
                        'transaction_id' => $transaction->id,
                        'key_id' => $key,
                    ])
                );
                \App\Models\Key::where('id', $key)
                    ->update(['available' => false]);
            }
            flash('Registro criado com sucesso')->success();
            return redirect()->route('transactions.index');
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                flash($e->getMessage())->warning();
                return redirect()->back();
            }

            flash('Ocorreu um erro ao tentar salvar o registro!')->warning();
            return redirect()->back();
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($request->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            \App\Models\Transaction::where('id', $id)
                ->update(['status' => 'closed']);
            foreach ($request->all()['keys'] as $k) {
                \App\Models\Key::where('id', $k)
                    ->update(['available' => true]);
                \App\Models\TransactionKeys::where([['transaction_id', $id], ['key_id', $k]])
                    ->update(['returned_key_user_id' => $request->all()['user']]);
            }
            flash('Chave(s) devolvidas')->success();
            return redirect()->route('transactions.index');            
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) {
                flash($e->getMessage())->warning();
                return redirect()->back();
            }

            flash('Ocorreu um erro ao tentar salvar o registro!')->warning();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->index();
    }
}
