<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\invoices_attachments;
use App\Models\invoices_details;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $invoice = invoices::find($id);
        $details = invoices_details::where('id_Invoice',$id)->get();
        $attachments = invoices_attachments::where('invoice_id',$id)->get();
        return view('invoices.details_invoices',compact('invoice','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        invoices_attachments::findOrFail($request->id_file)->delete();
        $path='Attachments\\'.$request->invoice_number."\\".$request->file_name;
        File::delete(public_path($path));
        session()->flash('delete','تم حذف المرفق بنجاح');
        return back();
    }

    public function view_attachments($invoice_number,$file_name){

        $path='Attachments\\'.$invoice_number."\\".$file_name;
        return view('invoices.show_invoice', compact('path'));



    }
    public function download_attachments($invoice_number,$file_name){

        return response()->download(public_path("Attachments\\".$invoice_number."\\".$file_name));


    }
}
