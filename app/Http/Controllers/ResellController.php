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
        $resells = Resell::where("Cost_type","!=","Tax")->where("Credit_type","!=","RESELLER_MARGIN")->get();

        return view('resell.index', compact('resells'));
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
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();

//        $resells=Excel::import(new ResellImport(), $namaFile);
        $theCollection = Excel::toCollection(collect([]), $request->file('file'));

        for($i=1;$i<count($theCollection[0]);$i++){
//
                $resell=new Resell();
//
                $resell->billing_acount_name=$theCollection[0][$i][0]; ////Billing account name
                $resell->billing_acount_id=$theCollection[0][$i][1];//Billing account ID
                $resell->project_name=$theCollection[0][$i][2];
            $resell->project_id	=$theCollection[0][$i][3];
            $resell->project_hierarchy=$theCollection[0][$i][4];
            $resell->Service_description=$theCollection[0][$i][5];
            $resell->Service_ID=$theCollection[0][$i][6];
            $resell->SKU_description=$theCollection[0][$i][7];
            $resell->SKU_ID=$theCollection[0][$i][8];
            $resell->Credit_type=$theCollection[0][$i][9];
            $resell->Cost_type=$theCollection[0][$i][10];
            $resell->Usage_start_date=$theCollection[0][$i][11];
            $resell->Usage_end_date	=$theCollection[0][$i][12];
            $resell->Usage_amount=$theCollection[0][$i][13];
            $resell->Usage_unit=$theCollection[0][$i][14];
            $resell->Unrounded_cost=$theCollection[0][$i][15];
            $resell->Cost=$theCollection[0][$i][16];
                $resell->save();




        }


//        $resells = (new ResellImport())->toArray(request()->file('file'))[0];



//        $resells=(new ResellImport(),$request);;
//dd((new ResellImport())->toArray(request()->file('file'))[0]);


//        $totalCustomer = count($resells) - 1;
////        dd($totalCustomer);
//        $errorArray    = [];
//        for($i = 1; $i <=$totalCustomer; $i++)
//        {
//            $resell = $resells[$i];
//
//
////            $resellByEmail = Vender::where('email', $resell[2])->first();
//
//            if(!empty($resellByEmail))
//            {
//                $resellData = $resellByEmail;
//            }
//            else
//            {
//                $resellData            = new Resell();
////                dd($resellData);
//
////                dd($resellData);
////                $resellData->resell_id = $this->venderNumber();
//            }
//
//            $resellData->resell_id          =$resell[0];
//            $resellData->billing_acount_name              = $resell[1];
//            $resellData->billing_acount_id             = $resell[2];
//            $resellData->project_name           = $resell[3];
//            $resellData->project_id             = $resell[4];
//            $resellData->project_hierarchy       = $resell[5];
//            $resellData->Service_description   = $resell[6];
//            $resellData->Service_ID      = $resell[7];
//            $resellData->SKU_description       = $resell[8];
//            $resellData->SKU_ID      = $resell[9];
//            $resellData->Credit_type        = $resell[10];
//            $resellData->Cost_type    = $resell[11];
//            $resellData->Usage_start_date      = $resell[12];
//            $resellData->Usage_end_date   = $resell[13];
//            $resellData->Usage_amount     = $resell[14];
//            $resellData->Usage_unit      = $resell[15];
//            $resellData->Unrounded_cost     = $resell[16];
////            $resellData->Cost       = $resell[17];
////            $resellData->created_by   = $resell[18];
//            $resellData->created_by         = \Auth::user()->creatorId();
//
//            if(empty($resellData))
//            {
//                $errorArray[] = $resellData;
//            }
//            else
//            {
//                $resellData->save();
//            }
//        }
//
//        $errorRecord = [];
//        if(empty($errorArray))
//        {
//            $data['status'] = 'success';
//            $data['msg']    = __('Record successfully imported');
//        }
//        else
//        {
//            $data['status'] = 'error';
//            $data['msg']    = count($errorArray) . ' ' . __('Record imported fail out of' . ' ' . $totalCustomer . ' ' . 'record');
//
//
//            foreach($errorArray as $errorData)
//            {
//
//                $errorRecord[] = implode(',', $errorData);
//
//            }
//
//            \Session::put('errorArray', $errorRecord);
//        }
//
//        return redirect()->back()->with($data['status'], $data['msg']);
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
