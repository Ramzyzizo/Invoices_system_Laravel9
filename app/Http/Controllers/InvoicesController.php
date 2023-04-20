<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\invoices;
use App\Models\invoices_attachments;
use App\Models\invoices_details;
use App\Models\sections;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use App\Notifications\Add_invoiceNotification;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = invoices::all();
        return view('invoices.invoices',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections=sections::all();
        return view('invoices.add_invoice',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        3 tables
//       1- invoices
        $input=$request;
        $input['Status']='غير مدفوعة';
        $input['status_id']=2;
        invoices::create($input->all());

//      2-  invoices_details
        $invoice_id=invoices::latest()->first()->id;
        $input['id_Invoice']=$invoice_id;
//        $input['id_Invoice']= DB::table('invoices')->latest()->first()->id;
        $input['user']=Auth::user()->id;
        invoices_details::create($input->all());

//        3- invoices_attachments

        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;
            $attachments = new invoices_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->id;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }
//        $user =Auth::user();
        $user =User::get();     // send notification for every user
        $invoices= invoices::latest()->first();
        Notification::send($user,new \App\Notifications\Add_invoiceNotification($invoices));
        session()->flash('Add','تمت اضافة الفاتورة');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice=invoices::where('id',$id)->first();
        return view('invoices.change_status',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sections=sections::all();
        $invoice=invoices::findOrFail($id);
        $invoice_details = invoices_details::where('id_invoice',$id)->first();
        return view('invoices.edit_invoice',compact('invoice','sections','invoice_details'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
//       3 tables
//       1- invoices
        $input=$request;
//        $input['Status']='غير مدفوعة';
//        $input['status_id']=2;

        invoices::findOrFail($id)->update($input->all());

//      2-  invoices_details

        $input['id_Invoice']=$id;
//        $input['id_Invoice']= DB::table('invoices')->latest()->first()->id;
        $input['user']=Auth::user()->id;
        invoices_details::where('id_Invoice',$id)->update(['invoice_number'=>$input->invoice_number,
            'product'=>$input->product,
            'section_id'=>$input->section_id,
            'note'=>$input->note,
            'user'=>$input->user]);
        $invoices=invoices::all();

        return view('invoices.invoices',compact('invoices'));


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoices = invoices::where('id', $id)->first();
        $Details = invoices_attachments::where('invoice_id', $id)->first();
        $id_page=$request->id_page;

        if($id_page==2) {
//          Delete
            if (!empty($Details->invoice_number)) {
//            unlink(public_path('Attachments\\'.$Details->invoice_number.'\\'.$Details->file_name));
                storage::disk('public_uploads')->deleteDirectory($Details->invoice_number);

            }
            $invoices->forceDelete();
            session()->flash('delete_invoice');
            return redirect('/invoices');
        }
        else{
            // archive
            $invoices->delete();
            session()->flash('archive_invoice');
            return redirect('/archived_invoice');

        }

    }

    public function export_excel(){
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
       }
//    public function archive_invoice(Request $request)
//    {
//        $id = $request->invoice_id;
//        $invoices = invoices::where('id', $id)->first();
//        $Details = invoices_attachments::where('invoice_id', $id)->first();
//
//        if (!empty($Details->invoice_number)) {
////            unlink(public_path('Attachments\\'.$Details->invoice_number.'\\'.$Details->file_name));
//            storage::disk('public_uploads')->deleteDirectory($Details->invoice_number);
//
//        }
//        $invoices->forceDelete();
//        session()->flash('delete_invoice');
//        return redirect('/invoices');
//
//    }
    /**
     * to return products list according section id at {add invoice page}
     */
    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }
    public function status_update(Request $request,$id){

        $invoices = invoices::findOrFail($id);
        $request['id_Invoice']=$id;
        $request['user']=Auth::user()->id;

        if ($request->status_id == 1) {
            $request['Status']='مدفوعة';
            $invoices->update([
                'status_id' => $request->status_id,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);

            invoices_Details::create($request->all());
        }

        else {
            $request['Status']='مدفوعة جزئيا';
            $invoices->update([
                'status_id' => $request->status_id,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);
            invoices_Details::create($request->all());
        }
        session()->flash('Status_Update');
        return redirect('/invoices');
    }
    public function paid_invoices(){
        $invoices=invoices::where('status_id',1)->get();
        return view('invoices.paid',compact('invoices'));
    }
    public function unpaid_invoices(){
        $invoices=invoices::where('status_id',2)->get();
        return view('invoices.unpaid',compact('invoices'));

    }
    public function partialpaid_invoices(){
        $invoices=invoices::where('status_id',3)->get();
        return view('invoices.partial_paid',compact('invoices'));

    }

    public function archived(){
        $invoices=invoices::onlyTrashed()->get();
        return view('invoices.archived_invoices',compact('invoices'));

    }
    public function print_invoice($id){
        $invoices=invoices::findOrFail($id)->first();
        return view('invoices.invoices_print',compact('invoices'));
        }

    public function MarkAsRead($notify_id){
        $notification = auth()->user()->notifications()->where('notifiable_id', $notify_id)->first();
        if ($notification) {
            $notification->markAsRead();
            $id = $notification->data['id'];
            return redirect('InvoicesDetails/'.$id);
        }
            return back();
    }
    public function MarkAsReadall(){
        if(auth()->user()){
        $userUnreadNotification= auth()->user()->unreadNotifications;
        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
        }
            return back();
        }

    }
}
