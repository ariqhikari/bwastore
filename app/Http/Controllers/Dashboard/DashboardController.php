<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\TransactionDetail;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
        $transaction_sell = TransactionDetail::with(['transaction', 'product'])
                        ->whereHas('product', function($product){
                            $product->where('user_id', Auth::user()->id);  
                        });
                        
        $transaction_buy = TransactionDetail::with(['transaction', 'product'])
                        ->whereHas('transaction', function($transaction){
                            $transaction->where('user_id', Auth::user()->id);  
                        });

        $transaction_count = $transaction_sell->count() + $transaction_buy->count();

        $transaction_data = collect($transaction_sell->reorder('updated_at', 'desc')->take(3)->get());
        $transaction_data = $transaction_data->merge($transaction_buy->reorder('updated_at', 'desc')->take(3)->get());
        $transaction_data = $transaction_data->sortByDesc('updated_at');


        $revenue = $transaction_sell->get()->reduce(function($carry, $item){
            return $carry + $item->price;
        });

        $customer = $transaction_sell->count();

        return view('pages.dashboard.dashboard',[
            'transaction_count' => $transaction_count,
            'transaction_data' => $transaction_data,
            'revenue' => $revenue,
            'customer' => $customer,
        ]);
    }
}
