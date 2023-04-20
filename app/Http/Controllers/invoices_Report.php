<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\invoices;
use Illuminate\Http\Request;

class invoices_Report extends Controller
{

    public function index(){

        return view('reports.invoices_report');

    }

    public function Search_invoices(Request $request){

        $rdio = $request->rdio;


        // في حالة البحث بنوع الفاتورة

        if ($rdio == 1) {


            // في حالة عدم تحديد تاريخ
            if ($request->type=='1' && $request->start_at =='' && $request->end_at =='') {

                $invoices = invoices::select('*')->get();
                $type = '1';
                return view('reports.invoices_report',compact('type'))->withDetails($invoices);
            }
            elseif ($request->type=='1' && $request->start_at !='' && $request->end_at !='') {

                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->get();
                $type = '1';
                return view('reports.invoices_report',compact('type','end_at','start_at'))->withDetails($invoices);
            }
            elseif ($request->type && $request->start_at =='' && $request->end_at =='') {

                $invoices = invoices::select('*')->where('Status','=',$request->type)->get();
                $type = $request->type;
                return view('reports.invoices_report',compact('type'))->withDetails($invoices);
            }

            // في حالة تحديد تاريخ استحقاق
            else {

                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                $type = $request->type;

                $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
                return view('reports.invoices_report',compact('type','start_at','end_at'))->withDetails($invoices);

            }



        }

//====================================================================

// في البحث برقم الفاتورة
        else {

            $invoices = invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
            $type=1;
            return view('reports.invoices_report',compact('type'))->withDetails($invoices);

        }



    }

}
