@extends('layouts.dashboard')

@section('title', 'Store Dashboard Products')

@section('content')
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                My Products
            </h2>
            <p class="dashboard-subtitle">
                Manage it well and get money
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <a
                    href="{{ route('dashboard.products.create') }}"
                    class="btn btn-success"
                    >
                    Add New Product
                    </a>
                    @if (Session::has('status'))
                        <div class="alert alert-success mt-3">{{ Session::get('status') }}</div>
                    @endif
                </div>
            </div>
            <div class="row mt-4">
                @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-md-4">
                        <a
                            href="{{ route('dashboard.products.detail', $product->id) }}"
                            class="card card-dashboard-product d-block text-decoration-none"
                        >
                            <div class="card-body">
                                <img
                                    src="{{ Storage::url($product->galleries->first()->photo) ?? ''}}"
                                    alt="product-card-1"
                                    class="w-100 mb-2"
                                    style="max-height: 250px"
                                />
                                <div class="product-title">
                                    {{ $product->name }}
                                </div>
                                <div class="product-category">
                                    {{ $product->category->name }}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
    