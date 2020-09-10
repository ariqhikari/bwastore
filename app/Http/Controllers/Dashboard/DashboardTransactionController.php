<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        $transaction_sell = TransactionDetail::with(['transaction', 'product'])
                        ->whereHas('product', function($product){
                            $product->where('user_id', Auth::user()->id);  
                        })->latest()->get();
                        
        $transaction_buy = TransactionDetail::with(['transaction', 'product'])
                        ->whereHas('transaction', function($transaction){
                            $transaction->where('user_id', Auth::user()->id);  
                        })->latest()->get();

        return view('pages.dashboard.dashboard-transaction',[
            'transaction_sell' => $transaction_sell,
            'transaction_buy' => $transaction_buy,
        ]);
    }

    public function detail(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['transaction', 'product'])->findOrFail($id);

        return view('pages.dashboard.dashboard-transaction-detail',[
            'transaction' => $transaction
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = TransactionDetail::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard.transactions.detail', $id)->with('status', 'Berhasil disunting!');
    }
}
