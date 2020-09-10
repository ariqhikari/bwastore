@extends('layouts.dashboard')

@section('title', 'Store Dashboard Products Create')

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
                Create Products
            </h2>
            <p class="dashboard-subtitle">
                Create your own product
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
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
                                                value="{{ old('name') }}"
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
                                                value="{{ old('price') }}"
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
                                                    <option value="{{ $category->id }}" {{ (old("category_id") == $category->id) ? "selected" : '' }}>
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
                                                {{ old('description') }}
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="photo">Thumbnails</label>
                                            <input
                                                type="file"
                                                multiple=""
                                                class="form-control pt-1"
                                                id="photo"
                                                aria-describedby="photo"
                                                name="photo[]"
                                            />
                                            <small class="text-muted">
                                                Kamu dapat memilih lebih dari satu file
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <button
                                        type="submit"
                                        class="btn btn-success btn-block px-5"
                                        >
                                        Create Product
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $("#editor").summernote({
    tabsize: 2,
    height: 200,
    });
</script>
@endpush