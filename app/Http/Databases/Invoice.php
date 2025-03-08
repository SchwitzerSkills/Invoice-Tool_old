<?php

namespace App\Http\Databases;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;


class Invoice
{

    public function get() {
        $invoices = DB::table("invoices")->select("id", "invoiceName", "customerName", "invoiceDate")->get();

        return view("invoice", ["invoices" => $invoices]);
    }

    public function createNewInvoiceView(){
        $count = DB::table("invoices")->where("company", "fleckviehbetrieb")->count();

        $count += 1;

        return view("invoice_create", ["count" => $count]);
    }

    public function createNewInvoiceCompany($company){
        $count = DB::table("invoices")->where("company", $company)->count();

        $count += 1;

        return response()->json(["count" => $count]);
    }

    public function create(Request $request, $id, $company){

        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('invoices', $filename, 'public');

            DB::table("invoices")->insert([
                "company" => $company,
                "invoiceName" => $filename,
                "customerName" => $request->customerName,
                "invoiceDate" => $request->invoiceDate
            ]);

            if($request->mailRequest == true){
                $attachment = public_path("storage/invoices/" . $filename);
                Mail::to($request->customerInfos)->send(new InvoiceMail($attachment));
                
            }

            return response()->json(['success' => true, 'message' => 'Invoice saved successfully.', 'path' => $path]);
        } else {
            return response()->json(['success' => false, 'message' => 'No file uploaded.'], 400);
        }
    }

    public function view($id){
        $invoiceName = DB::table("invoices")->select("invoiceName")->where("id", $id)->get()->first()->invoiceName;

        return redirect(asset("storage/invoices/" . $invoiceName));
    }
}