<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Webmozart\Assert\Tests\StaticAnalysis\integer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all=invoices::sum('Total');
        if($all>0) {
            $paid_invoices = number_format((int)invoices::where('status_id', 1)
                        ->sum('Total') / (int)$all, 4) * 100;
            $paid_partial_invoices = number_format((int)invoices::where('status_id', 3)
                        ->sum('Total') / floatval($all), 4) * 100;
            $unpaid_invoices = number_format((int)invoices::where('status_id', 2)
                        ->sum('Total') / (int)$all, 4) * 100;
        }else{
            $paid_invoices=0;
            $paid_partial_invoices=0;
            $unpaid_invoices=0;
        }
        $num_paid_invoices=invoices::where('status_id',1)->count();
        $num_unpaid_invoices=invoices::where('status_id',2)->count();
        $num_paid_partial_invoices=invoices::where('status_id',3)->count();

        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels([ 'الفواتيرالمدفوعة','مدفوعة جزئيا','غير مدفوعة'])
            ->datasets([
                [
                    "label" => ["نسبة الفواتير"],
                    'backgroundColor' => ['#023020','#ff9900','rgba( 255, 99, 132, 1)'],
                    'data' => [$paid_invoices,$paid_partial_invoices,$unpaid_invoices]
                ]
            ])
            ->options(['scales' => [
                'yAxes' => [
                    [
                        'ticks' => [
                            'beginAtZero' => true,
                        ],
                    ],
                ],
            ],
                'legend' => [
//                'position' => 'right',
//                'align' => 'right',
                'display' => false
    ]]);

        $chartjs_pie = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة جزئيا','الفواتير مدفوعة'])
            ->datasets([
                [
                    'backgroundColor' => ['#FF6384','#ff9900' ,'#023010'],
                    'hoverBackgroundColor' => ['#FF6388', '#ff9910' ,'#023030'],
                    'data' => [$num_unpaid_invoices, $num_paid_partial_invoices,$num_paid_invoices]
                ]
            ])
            ->options([]);

        return view('home',compact('chartjs','chartjs_pie'));
    }
}
