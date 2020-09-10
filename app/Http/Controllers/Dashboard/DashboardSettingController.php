<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSettingController extends Controller
{
    public function store()
    {
        $user = Auth::user();
        $categories = Category::all();

        return view('pages.dashboard.dashboard-settings',[
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function account()
    {
        return view('pages.dashboard.dashboard-account');
    }

    public function update(Request $request, $redirect)
    {
        $data = $request->all();
        $item = Auth::user();

        $item->update($data);

        return redirect()->route($redirect)->with('status', 'Berhasil disunting!');
    }

}
