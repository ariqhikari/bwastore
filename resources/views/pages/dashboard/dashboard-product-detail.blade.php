@extends('layouts.dashboard')

@section('title', 'Store Dashboard Products Details')

@push('addon-style')
<link
    href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css"
    rel="stylesheet"
/>
@endpush

@section('content')
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                {{ $product->name }}
            </h2>
            <p class="dashboard-subtitle">
                Product Details
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    @if (Session::has('status'))
                        <div class="alert alert-success">{{ Session::get('status') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('dashboard.products.detail', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Product Name</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="name"
                                                aria-describedby="name"
                                                name="name"
                                                value="{{ $product->name }}"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input
                                                type="number"
                                                class="form-control"
                                                id="price"
                                                aria-describedby="price"
                                                name="price"
                                                value="{{ $product->price }}"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select
                                                name="category_id"
                                                id="category_id"
                                                class="form-control"
                                            >
                                                <option disabled>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ ($product->category_id == $category->id) ? "selected" : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea
                                                name="description"
                                                id="editor"
                                                class="form-control"
                                            >
                                                {{ $product->description }}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>  
                                <div class="row mt-2">
                                    <div class="col">
                                        <button
                                        type="submit"
                                        class="btn btn-success btn-block px-5"
                                        >
                                        Update Product
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($product->galleries as $gallery)
                                <div class="col-md-4">
                                    <div class="gallery-container">
                                        <img
                                        src="{{ Storage::url($gallery->photo) }}"
                                        alt=""
                                        class="w-100"
                                        style="max-height: 250px"
                                        />
                                        <form action="{{ route('dashboard.products.delete.gallery', $gallery->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="border-0 bg-transparent delete-gallery">
                                                <img src="/images/icon-delete.svg" alt="" />
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12 mt-3">
                                <form action="{{ route('dashboard.products.upload.gallery') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input
                                        type="file"
                                        id="file"
                                        class="d-none"
                                        name="photo[]"
                                        multiple
                                        onchange="form.submit()"
                                    />
                                    <button
                                        type="button"
                                        class="btn btn-secondary btn-block"
                                        onclick="thisFileUpload()"
                                    >
                                        Add Photo
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    function thisFileUpload() {
        document.getElementById("file").click();
    }
</script>
<script>
    $("#editor").summernote({
    tabsize: 2,
    height: 200,
    });
</script>
@endpush