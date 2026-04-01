@extends('layouts.app')

@section('title', 'Home')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Home</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        @can('show_total_stats')
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left text-white">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-primary">{{ format_currency($revenue) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Revenue</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-warning p-4 mfe-3 rounded-left text-white">
                            <i class="bi bi-arrow-return-left font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-warning">{{ format_currency($sale_returns) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Sales Return</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-success p-4 mfe-3 rounded-left text-white">
                            <i class="bi bi-arrow-return-right font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-success">{{ format_currency($purchase_returns) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Purchases Return</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-info p-4 mfe-3 rounded-left text-white">
                            <i class="bi bi-trophy font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-info">{{ format_currency($profit) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Profit</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('show_weekly_sales_purchases|show_month_overview')
        <div class="row mb-4">
            @can('show_weekly_sales_purchases')
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header font-weight-bold">
                        Sales & Purchases of Last 7 Days
                    </div>
                    <div class="card-body">
                        <div style="height: 300px;">
                            <canvas id="salesPurchasesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @endcan

            @can('show_month_overview')
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header font-weight-bold">
                        Overview of {{ now()->format('F, Y') }}
                    </div>
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <div style="width: 100%; height: 300px;">
                            <canvas id="currentMonthChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
        @endcan

        @can('show_monthly_cashflow')
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header font-weight-bold">
                        Monthly Cash Flow (Payment Sent & Received)
                    </div>
                    <div class="card-body">
                        <div style="height: 400px;">
                            <canvas id="paymentChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
@endsection

@section('third_party_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"></script>
@endsection

@push('page_scripts')
<script>
    $(document).ready(function () {
        // 1. Weekly Sales & Purchases
        let salesPurchasesCanvas = document.getElementById('salesPurchasesChart');
        if (salesPurchasesCanvas) {
            new Chart(salesPurchasesCanvas, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($dates ?? []) !!},
                    datasets: [{
                        label: 'Sales',
                        data: {!! json_encode($sales_chart_data ?? []) !!},
                        backgroundColor: '#6610f2',
                    }, {
                        label: 'Purchases',
                        data: {!! json_encode($purchase_chart_data ?? []) !!},
                        backgroundColor: '#fd7e14',
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    scales: { y: { beginAtZero: true } }
                }
            });
        }

        // 2. Monthly Donut Chart
        let currentMonthCanvas = document.getElementById('currentMonthChart');
        if (currentMonthCanvas) {
            $.get("{{ route('current-month-chart-data') }}", function (data) {
                new Chart(currentMonthCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: ['Sales', 'Purchases', 'Expenses'],
                        datasets: [{
                            data: [data.sales, data.purchases, data.expenses],
                            backgroundColor: ['#6610f2', '#fd7e14', '#f86c6b'],
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true
                    }
                });
            });
        }

        // 3. Monthly Cash Flow
        let paymentCanvas = document.getElementById('paymentChart');
        if (paymentCanvas) {
            $.get("{{ route('payment-chart-data') }}", function (data) {
                new Chart(paymentCanvas, {
                    type: 'line',
                    data: {
                        labels: data.months,
                        datasets: [{
                            label: 'Payment Sent',
                            data: data.payment_sent,
                            borderColor: '#f86c6b',
                            fill: false,
                            tension: 0.1
                        }, {
                            label: 'Payment Received',
                            data: data.payment_received,
                            borderColor: '#4dbd74',
                            fill: false,
                            tension: 0.1
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        scales: { y: { beginAtZero: true } }
                    }
                });
            });
        }
    });
</script>
@endpush