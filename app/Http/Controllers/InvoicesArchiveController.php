<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\invoices;
use App\Models\invoices_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesArchiveController extends Controller
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->invoice_id;
        invoices::withTrashed()->where('id',$id)->restore();
        session()->flash('restore_invoice');
        return redirect('/invoices');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = invoices::withTrashed()->where('id', $id)->first();
        $Details = invoices_attachments::where('invoice_id', $id)->first();

            if (!empty($Details->invoice_number)) {
                storage::disk('public_uploads')->deleteDirectory($Details->invoice_number);
            }
            $invoices->forceDelete();
            session()->flash('delete_invoice');
            return redirect('/invoices');
        }
}
