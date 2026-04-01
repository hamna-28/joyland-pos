<?php

namespace Modules\Reports\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Modules\Sales\Entities\Sale;
use Modules\Purchases\Entities\Purchase;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index() {
        // Fetching data for the last 7 days chart
        $sales_chart_data = [];
        $purchase_chart_data = [];
        $dates = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = Carbon::now()->subDays($i)->format('d M');

            // Sum of Sales for the day
            $sales_chart_data[] = Sale::whereDate('date', $date)->sum('total_amount') / 100;
            
            // Sum of Purchases for the day
            $purchase_chart_data[] = Purchase::whereDate('date', $date)->sum('total_amount') / 100;
        }

        return view('home', compact('sales_chart_data', 'purchase_chart_data', 'dates'));
    }

    public function profitLossReport() {
        abort_if(Gate::denies('access_reports'), 403);
        return view('reports::profit-loss.index');
    }

    public function paymentsReport() {
        abort_if(Gate::denies('access_reports'), 403);
        return view('reports::payments.index');
    }

    public function salesReport() {
        abort_if(Gate::denies('access_reports'), 403);
        return view('reports::sales.index');
    }

    public function purchasesReport() {
        abort_if(Gate::denies('access_reports'), 403);
        return view('reports::purchases.index');
    }

    public function salesReturnReport() {
        abort_if(Gate::denies('access_reports'), 403);
        return view('reports::sales-return.index');
    }

    public function purchasesReturnReport() {
        abort_if(Gate::denies('access_reports'), 403);
        return view('reports::purchases-return.index');
    }
}