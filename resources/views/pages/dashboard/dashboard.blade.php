@extends('layouts.dashboard')

@section('title', 'Store Dashboard')

@section('content')
<div
class="section-content section-dashboard-home"
data-aos="fade-up"
>
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">
                Dashboard
            </h2>
            <p class="dashboard-subtitle">
                Look what you have made today!
            </p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="dashboard-card-title">
                                Customer
                            </div>
                            <div class="dashboard-card-subtitle">
                                {{ number_format($customer) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-2">
                        <div class="card-body">
                        <div class="dashboard-card-title">
                            Revenue
                        </div>
                        <div class="dashboard-card-subtitle">
                            ${{ number_format($revenue) }}
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-2">
                        <div class="card-body">
                        <div class="dashboard-card-title">
                            Transaction (Buy & Sell)
                        </div>
                        <div class="dashboard-card-subtitle">
                            {{ number_format($transaction_count) }}
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 mt-2">
                    <h5 class="mb-3">
                    Recent Transactions
                    </h5>
                    @foreach ($transaction_data as $transaction)
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
@endsection
    