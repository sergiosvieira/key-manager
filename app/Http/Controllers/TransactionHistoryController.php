<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionHistoryController extends Controller
{
    private $transaction;
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
        $this->middleware('auth');
    }
    public function index()
    {
        $transactions = $this->transaction
            ->where('status', 'closed')
            ->join('transaction_keys as tk', 'transactions.id', '=', 'tk.transaction_id')
            ->join('keys as k', 'tk.key_id', '=', 'k.id')
            ->select('tk.id', 
                'transactions.gatekeeper_id',
                'transactions.user_id', 
                'transactions.status',
                'tk.created_at as tcreated',
                'tk.updated_at as tupdated',
                'tk.returned_key_user_id',
                'tk.key_id', 
                'k.name')
            // ->select('tk.*', 'k.name')
            // ->select('tk.id', 'tk.user_id', 'tk.created_at', 'tk.updated_at', 'tk.key_id', 'k.name')
            ->paginate(20); 
        // dd($transactions->toArray());
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
        return view('history.index', compact(['transactions', 'users', 'keys']));
    }    
}
