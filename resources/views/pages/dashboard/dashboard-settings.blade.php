@extends('layouts.dashboard')

@section('title', 'Store Dashboard Store Settings')

@section('content')
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                Store Settings
            </h2>
            <p class="dashboard-subtitle">
                Make store that profitable
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
                    <form action="{{ route('dashboard.settings.update', 'dashboard.settings.store') }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Store Name</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                name="store_name"
                                                value="{{ $user->store_name }}"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select
                                                name="category_id"
                                                id="category_id"
                                                class="form-control"
                                            >
                                                <option disabled>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ ($user->category_id == $category->id) ? "selected" : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Store Status</label>
                                            <p class="text-muted">
                                                Apakah saat ini toko Anda buka?
                                            </p>
                                            <div
                                                class="custom-control custom-radio custom-control-inline"
                                            >
                                                <input
                                                type="radio"
                                                class="custom-control-input"
                                                name="store_status"
                                                id="openStoreTrue"
                                                value="1"
                                                {{ $user->store_status == 1 ? 'checked' : '' }}
                                                />
                                                <label
                                                for="openStoreTrue"
                                                class="custom-control-label"
                                                >
                                                Buka
                                                </label>
                                            </div>
                                            <div
                                                class="custom-control custom-radio custom-control-inline"
                                            >
                                                <input
                                                type="radio"
                                                class="custom-control-input"
                                                name="store_status"
                                                id="openStoreFalse"
                                                value="0"
                                                {{ $user->store_status == 0 || $user->store_status == NULL ? 'checked' : '' }}
                                                />
                                                <label
                                                for="openStoreFalse"
                                                class="custom-control-label"
                                                >
                                                Sementara Tutup
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button
                                        type="submit"
                                        class="btn btn-success px-5"
                                        >
                                        Save Now
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