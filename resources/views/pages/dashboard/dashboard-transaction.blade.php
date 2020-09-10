@extends('layouts.dashboard')

@section('title', 'Store Dashboard Transactions')

@section('content')
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                Transactions
            </h2>
            <p class="dashboard-subtitle">
                Big result start from the small one
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12 mt-2">
                    <ul
                        class="nav nav-pills mb-3"
                        id="pills-tab"
                        role="tablist"
                    >
                        <li class="nav-item" role="presentation">
                            <a
                                class="nav-link active"
                                id="pills-home-tab"
                                data-toggle="pill"
                                href="#pills-home"
                                role="tab"
                                aria-controls="pills-home"
                                aria-selected="true"
                                >Sell Product</a
                            >
                        </li>
                        <li class="nav-item" role="presentation">
                            <a
                                class="nav-link"
                                id="pills-profile-tab"
                                data-toggle="pill"
                                href="#pills-profile"
                                role="tab"
                                aria-controls="pills-profile"
                                aria-selected="false"
                                >Buy Product</a
                            >
                        </li>
                    </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div
                    class="tab-pane fade show active"
                    id="pills-home"
                    role="tabpanel"
                    aria-labelledby="pills-home-tab"
                    >
                        @foreach ($transaction_sell as $transaction)
                            <a
                            href="{{ route('dashboard.transactions.detail', $transaction->id) }}"
                            class="card card-list d-block text-decoration-none"
                            >
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-2">
                                            <img
                                                src="{{ Storage::url($transaction->product->galleries->first()->photo ?? '') }}"
                                                class="w-100"
                                            />
                                        </div>
                                        <div class="col-lg-3 mt-3 mt-lg-0">
                                            {{ $transaction->product->name ?? ''}}
                                        </div>
                                        <div class="col-lg-3">
                                            @if ($transaction->transaction->user_id !== Auth::user()->id)
                                                {{ $transaction->transaction->user->name ?? ''}}
                                                @else
                                                {{ $transaction->product->user->store_name ?? ''}}
                                            @endif
                                        </div>
                                        <div class="col-lg-3">
                                            {{ $transaction->created_at->diffForHumans() ?? ''}}
                                        </div>
                                        <div class="col-lg-1 d-none d-lg-block">
                                            <img
                                                src="/images/dashboard-arrow-right.svg"
                                                alt=""
                                            />
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div
                    class="tab-pane fade"
                    id="pills-profile"
                    role="tabpanel"
                    aria-labelledby="pills-profile-tab"
                    >
                        @foreach ($transaction_buy as $transaction)
                            <a
                            href="{{ route('dashboard.transactions.detail', $transaction->id) }}"
                            class="card card-list d-block text-decoration-none"
                            >
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-2">
                                            <img
                                                src="{{ Storage::url($transaction->product->galleries->first()->photo ?? '') }}"
                                                class="w-100"
                                            />
                                        </div>
                                        <div class="col-lg-3 mt-3 mt-lg-0">
                                            {{ $transaction->product->name ?? ''}}
                                        </div>
                                        <div class="col-lg-3">
                                            @if ($transaction->transaction->user_id !== Auth::user()->id)
                                                {{ $transaction->transaction->user->name ?? ''}}
                                                @else
                                                {{ $transaction->product->user->store_name ?? ''}}
                                            @endif
                                        </div>
                                        <div class="col-lg-3">
                                            {{ $transaction->created_at->diffForHumans() ?? ''}}
                                        </div>
                                        <div class="col-lg-1 d-none d-lg-block">
                                            <img
                                                src="/images/dashboard-arrow-right.svg"
                                                alt=""
                                            />
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection