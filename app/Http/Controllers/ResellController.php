<?php

namespace App\Http\Controllers;


use App\Imports\ResellImport;
use App\Imports\VenderImport;
use App\Models\Customer;
use App\Models\Resell;
use App\Http\Requests\StoreResellRequest;
use App\Http\Requests\UpdateResellRequest;

use App\Models\Vender;
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

        $rules = [
            'file' => 'required|mimes:csv,txt',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        $resells = (new ResellImport())->toArray(request()->file('file'))[0];

        $totalCustomer = count($resells) - 1;
        $errorArray    = [];
        for($i = 1; $i <= count($resells) - 1; $i++)
        {
            $vendor = $resells[$i];

            $vendorByEmail = Vender::where('email', $vendor[2])->first();

            if(!empty($vendorByEmail))
            {
                $resellData = $vendorByEmail;
            }
            else
            {
                $resellData            = new Vender();
                $resellData->vender_id = $this->venderNumber();
            }

            $resellData->vender_id          =$vendor[0];
            $resellData->name               = $vendor[1];
            $resellData->email              = $vendor[2];
            $resellData->contact            = $vendor[3];
            $resellData->avatar             = $vendor[4];
            $resellData->billing_name       = $vendor[5];
            $resellData->billing_country    = $vendor[6];
            $resellData->billing_state      = $vendor[7];
            $resellData->billing_city       = $vendor[8];
            $resellData->billing_phone      = $vendor[9];
            $resellData->billing_zip        = $vendor[10];
            $resellData->billing_address    = $vendor[11];
            $resellData->shipping_name      = $vendor[12];
            $resellData->shipping_country   = $vendor[13];
            $resellData->shipping_state     = $vendor[14];
            $resellData->shipping_city      = $vendor[15];
            $resellData->shipping_phone     = $vendor[16];
            $resellData->shipping_zip       = $vendor[17];
            $resellData->shipping_address   = $vendor[18];
            $resellData->created_by         = \Auth::user()->creatorId();

            if(empty($resellData))
            {
                $errorArray[] = $resellData;
            }
            else
            {
                $resellData->save();
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
