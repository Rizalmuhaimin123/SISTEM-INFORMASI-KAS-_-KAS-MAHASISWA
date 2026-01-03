<?php

namespace App\Http\Controllers\account;

use App\Debit;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // ===============================
        // SUMMARY (SUDAH ADA)
        // ===============================
        $uang_masuk_bulan_ini  = DB::table('debit')
            ->selectRaw('SUM(nominal) as nominal')
            ->whereYear('debit_date', now()->year)
            ->whereMonth('debit_date', now()->month)
            ->where('user_id', Auth::id())
            ->first();

        $uang_keluar_bulan_ini = DB::table('credit')
            ->selectRaw('SUM(nominal) as nominal')
            ->whereYear('credit_date', now()->year)
            ->whereMonth('credit_date', now()->month)
            ->where('user_id', Auth::id())
            ->first();

        $uang_masuk_bulan_lalu  = DB::table('debit')
            ->selectRaw('SUM(nominal) as nominal')
            ->whereYear('debit_date', now()->year)
            ->whereMonth('debit_date', now()->subMonth()->month)
            ->where('user_id', Auth::id())
            ->first();

        $uang_keluar_bulan_lalu = DB::table('credit')
            ->selectRaw('SUM(nominal) as nominal')
            ->whereYear('credit_date', now()->year)
            ->whereMonth('credit_date', now()->subMonth()->month)
            ->where('user_id', Auth::id())
            ->first();

        $uang_masuk_selama_ini  = DB::table('debit')
            ->selectRaw('SUM(nominal) as nominal')
            ->where('user_id', Auth::id())
            ->first();

        $uang_keluar_selama_ini = DB::table('credit')
            ->selectRaw('SUM(nominal) as nominal')
            ->where('user_id', Auth::id())
            ->first();

        $saldo_bulan_ini   = ($uang_masuk_bulan_ini->nominal ?? 0) - ($uang_keluar_bulan_ini->nominal ?? 0);
        $saldo_bulan_lalu  = ($uang_masuk_bulan_lalu->nominal ?? 0) - ($uang_keluar_bulan_lalu->nominal ?? 0);
        $saldo_selama_ini  = ($uang_masuk_selama_ini->nominal ?? 0) - ($uang_keluar_selama_ini->nominal ?? 0);

        // ===============================
        // CHART 1 TAHUN (BARU)
        // ===============================
        $year = now()->year;

        $credit = DB::table('credit')
            ->select(
                DB::raw('MONTH(credit_date) as month'),
                DB::raw('SUM(nominal) as total')
            )
            ->whereYear('credit_date', $year)
            ->where('user_id', Auth::id())
            ->groupBy(DB::raw('MONTH(credit_date)'))
            ->pluck('total', 'month');


        $debit = DB::table('debit')
            ->select(
                DB::raw('MONTH(debit_date) as month'),
                DB::raw('SUM(nominal) as total')
            )
            ->whereYear('debit_date', $year)
            ->where('user_id', Auth::id())
            ->groupBy(DB::raw('MONTH(debit_date)'))
            ->pluck('total', 'month');


        $creditData = [];
        $debitData  = [];

        for ($i = 1; $i <= 12; $i++) {
            $creditData[] = (int) ($credit[$i] ?? 0);
            $debitData[]  = (int) ($debit[$i] ?? 0);
        }

        return view('account.dashboard.index', compact(
            'saldo_selama_ini',
            'saldo_bulan_ini',
            'saldo_bulan_lalu',
            'creditData',
            'debitData',
            'year'
        ));
    }
}
