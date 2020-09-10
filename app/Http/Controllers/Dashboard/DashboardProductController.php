<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductGalleryRequest;
use App\Http\Requests\Admin\ProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Product;
use App\ProductGallery;
use Illuminate\Support\Facades\Storage;

class DashboardProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['galleries', 'category'])
                ->where('user_id', Auth::user()->id)->latest()->get();

        return view('pages.dashboard.dashboard-product',[
            'products' => $products
        ]);
    }

    public function detail(Request $request, $id)
    {
        $categories = Category::all();
        $product = Product::with(['galleries', 'category'])->findOrFail($id);

        return view('pages.dashboard.dashboard-product-detail',[
            'categories' => $categories,
            'product' => $product
        ]);
    }

    public function uploadGallery(Request $request)
    {
        $galleries = $request->file('photo');

        if($galleries){
            foreach ($galleries as $gallery) {
                $gallery = [
                    'product_id' => $request->product_id,
                    'photo' => $gallery->store('assets/product/gallery', 'public')
                ];
        
                ProductGallery::create($gallery);
            }
        }

        return redirect()->route('dashboard.products.detail', $request->product_id)->with('status', 'Gallery berhasil ditambahkan!');
    }

    public function deleteGallery($id)
    {
        $item = ProductGallery::findOrFail($id);

        Storage::disk('public')->delete($item->photo);

        $item->delete();

        return redirect()->route('dashboard.products.detail', $item->product_id)->with('status', 'Gallery berhasil dihapus!');
    }
    
    public function create()
    {
        $categories = Category::all();

        return view('pages.dashboard.dashboard-product-create',[
            'categories' => $categories
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        $galleries = $request->file('photo');

        if($galleries){
            foreach ($galleries as $gallery) {
                $gallery = [
                    'product_id' => $product->id,
                    'photo' => $gallery->store('assets/product/gallery', 'public')
                ];
        
                ProductGallery::create($gallery);
            }
        }

        return redirect()->route('dashboard.products')->with('status', 'Product berhasil ditambahkan!');
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        $item = Product::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard.products')->with('status', 'Product berhasil disunting!');
    }


}
