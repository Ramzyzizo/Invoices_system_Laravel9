<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\sections;
use Illuminate\Http\Request;
class Customers_Report extends Controller
{
    public function index(){

        $sections = sections::all();
        return view('reports.customers_report',compact('sections'));

    }


    public function Search_customers(Request $request){


        // without Dates

        if ($request->Section && $request->product && $request->start_at =='' && $request->end_at=='') {


            $invoices = invoices::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
            $sections = sections::all();
            $section=sections::where('id',$request->Section)->first() ;
            return view('reports.customers_report',compact('sections','section'))->withDetails($invoices);

        }
        // if there is no any select
        elseif ($request->Section=='' && $request->product=='' && $request->start_at =='' && $request->end_at==''){

            $invoices = invoices::select('*')->get();
            $sections = sections::all();
            return view('reports.customers_report',compact('sections'))->withDetails($invoices);
        }
        // if there is only date
        elseif ($request->Section=='' && $request->product=='' && $request->start_at !='' && $request->end_at!=''){

            $start_at = date($request->start_at);
            $end_at = date($request->end_at);
            $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->get();
            $sections = sections::all();
            return view('reports.customers_report',compact('sections'))->withDetails($invoices);
        }

        // with Date
        else {

            $start_at = date($request->start_at);
            $end_at = date($request->end_at);

            $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
            $sections = sections::all();
            return view('reports.customers_report',compact('sections'))->withDetails($invoices);


        }



    }
}
