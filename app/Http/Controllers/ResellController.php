<?php

namespace App\Http\Controllers;


use App\Imports\ResellImport;
use App\Models\Customer;
use App\Models\Resell;
use App\Http\Requests\StoreResellRequest;
use App\Http\Requests\UpdateResellRequest;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ResellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $data['billChartData'] = \Auth::user()->billChartData();

        return view('resell.dashboard', $data);
    }
    public function index()
    {
        $customers = Customer::where('created_by', \Auth::user()->creatorId())->get();

        return view('resell.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreResellRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreResellRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Resell  $resell
     * @return \Illuminate\Http\Response
     */
    public function show(Resell $resell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Resell  $resell
     * @return \Illuminate\Http\Response
     */
    public function edit(Resell $resell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateResellRequest  $request
     * @param  \App\Models\Resell  $resell
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateResellRequest $request, Resell $resell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Resell  $resell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resell $resell)
    {
        //
    }
    public function import(Request $request)
    {
dd('ok');
        $rules = [
            'file' => 'required|mimes:csv,txt',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $customers = (new ResellImport())->toArray(request()->file('file'))[0];

        $totalCustomer = count($customers) - 1;
        $errorArray    = [];
        for($i = 1; $i <= count($customers) - 1; $i++)
        {
            $customer = $customers[$i];

            $customerByEmail = Resell::where('email', $customer[2])->first();
            if(!empty($customerByEmail))
            {
                $customerData = $customerByEmail;
            }
            else
            {
                $customerData = new Resell();
                $customerData->customer_id      = $this->customerNumber();
            }

            $customerData->customer_id             = $customer[0];
            $customerData->name             = $customer[1];
            $customerData->email            = $customer[2];
            $customerData->contact          = $customer[3];
            $customerData->is_active        = 1;
            $customerData->billing_name     = $customer[4];
            $customerData->billing_country  = $customer[5];
            $customerData->billing_state    = $customer[6];
            $customerData->billing_city     = $customer[7];
            $customerData->billing_phone    = $customer[8];
            $customerData->billing_zip      = $customer[9];
            $customerData->billing_address  = $customer[10];
            $customerData->shipping_name    = $customer[11];
            $customerData->shipping_country = $customer[12];
            $customerData->shipping_state   = $customer[13];
            $customerData->shipping_city    = $customer[14];
            $customerData->shipping_phone   = $customer[15];
            $customerData->shipping_zip     = $customer[16];
            $customerData->shipping_address = $customer[17];
            $customerData->balance          = 0;
            $customerData->created_by       = \Auth::user()->creatorId();

            if(empty($customerData))
            {
                $errorArray[] = $customerData;
            }
            else
            {
                $customerData->save();
            }
        }

        $errorRecord = [];
        if(empty($errorArray))
        {
            $data['status'] = 'success';
            $data['msg']    = __('Record successfully imported');
        }
        else
        {
            $data['status'] = 'error';
            $data['msg']    = count($errorArray) . ' ' . __('Record imported fail out of' . ' ' . $totalCustomer . ' ' . 'record');


            foreach($errorArray as $errorData)
            {

                $errorRecord[] = implode(',', $errorData);

            }

            \Session::put('errorArray', $errorRecord);
        }

        return redirect()->back()->with($data['status'], $data['msg']);
    }
    public function importFile()
    {
        return view('resell.import');
    }
//    public function import(Request $request)
//    {
//        $file = $request->file('file');
//
//        Excel::import(new ResellsImport, $file);
//
//        return redirect()->back()->with('success', 'CSV imported successfully.');
//    }
}
