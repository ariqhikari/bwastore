@extends('layouts.app')

@section('title', 'Store Category Page')

@section('content')
<div class="page-content page-home">
    <section class="store-trend-categories">
        <div class="container">
            <div class="row">
            <div class="col-12" data-aos="fade-up">
                <h5>All Categories</h5>
            </div>
            </div>
            <div class="row">
                @forelse ($categories as $category)
                    <div
                        class="col-6 col-md-3 col-lg-2"
                        data-aos="fade-up"
                        data-aos-delay="{{ $loop->iteration }}00"
                    >
                    <a href="{{ route("categories.details", $category->slug) }}" class="component-categories d-block">
                        <div class="categories-image">
                            <img
                            src="{{ Storage::url($category->photo) }}"
                            alt="Categories {{ $category->name }}"
                            class="w-100"
                            />
                        </div>
                        <p class="categories-text">{{ $category->name }}</p>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5"
                        data-aos="fade-up"
                        data-aos-delay="100">   
                        No Categories Found
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <section class="store-new-products">
        <div class="container">
            <div class="row">
            <div class="col-12" data-aos="fade-up">
                <h5>{{ $category->name }} Products</h5>
            </div>
            </div>
            <div class="row">
                @forelse ($products as $product)
                    <div
                        class="col-6 col-md-4 col-lg-3"
                        data-aos="fade-up"
                        data-aos-delay="{{ $loop->iteration }}00"
                    >
                        <a href="{{ route("details", $product->slug) }}" class="component-products d-block">
                            <div class="products-thumbnail">
                                <div
                                class="products-image"
                                style="
                                    @if($product->galleries->count())
                                        background-image: url({{ Storage::url($product->galleries->first()->photo) }});
                                    @else
                                        background-color: #eee
                                    @endif
                                "
                                ></div>
                            </div>
                            <div class="products-text">
                                {{ $product->name }}
                            </div>
                            <div class="products-price">
                                ${{ number_format($product->price) }}
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12 text-center py-5"
                        data-aos="fade-up"
                        data-aos-delay="100">   
                        No Products Found
                    </div>
                @endforelse
            </div>
            <div class="row">
                <div class="col-12 mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
