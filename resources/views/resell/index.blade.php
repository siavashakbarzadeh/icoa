@extends('layouts.admin')
@php
   // $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar/');
@endphp
@push('script-page')
    <script>
        $(document).on('click', '#billing_data', function () {
            $("[name='shipping_name']").val($("[name='billing_name']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_phone']").val($("[name='billing_phone']").val());
            $("[name='shipping_zip']").val($("[name='billing_zip']").val());
            $("[name='shipping_address']").val($("[name='billing_address']").val());
        })

    </script>
@endpush
@section('page-title')
    {{__('Manage Resells')}}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item">{{__('Resell')}}</li>
@endsection

@section('action-btn')
    <div class="float-end">
        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="{{__('Import')}}" data-url="{{ route('resell.file.import') }}" data-ajax-popup="true" data-title="{{__('Import resell CSV file')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
        <a href="{{route('resell.export')}}" data-bs-toggle="tooltip" title="{{__('Export')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a>

        <a href="#" data-size="lg" data-url="{{ route('resell.create') }}" data-ajax-popup="true" data-bs-toggle="tooltip" title="{{__('Create')}}" data-title="{{__('Create Customer')}}" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>

                                <th> {{__('billing_acount_name')}}</th>
                                <th> {{__('billing_acount_id')}}</th>
                                <th> {{__('project_name')}}</th>
                                <th> {{__('project_id')}}</th>
                                <th> {{__('project_hierarchy')}}</th>
                                <th>{{__('Service_description')}}</th>
                                <th>{{__('Service_ID')}}</th>
                                <th>{{__('SKU_ID')}}</th>
                                <th>{{__('Credit_type')}}</th>
                                <th>{{__('Cost_type')}}</th>
                                <th>{{__('Usage_start_date')}}</th>
                                <th>{{__('Usage_end_date')}}</th>
                                <th>{{__('Usage_amount')}}</th>
                                <th>{{__('Usage_unit')}}</th>
                                <th>{{__('Unrounded_cost')}}</th>
                                <th>{{__('Cost')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($resells as $k=>$resell)
{{--                                <tr class="cust_tr" id="cust_detail" data-url="{{route('resell.show',$resell['id'])}}" data-id="{{$resell['id']}}">--}}
                                <tr class="cust_tr" id="cust_detail ">
{{--                                    <td class="Id">--}}
{{--                                        @can('show customer')--}}
{{--                                            <a href="{{ route('customer.show',\Crypt::encrypt($customer['id'])) }}" class="btn btn-outline-primary">--}}
{{--                                                {{ AUth::user()->customerNumberFormat($customer['customer_id']) }}--}}
{{--                                            </a>--}}
{{--                                        @else--}}
{{--                                            <a href="#" class="btn btn-outline-primary">--}}
{{--                                                {{ AUth::user()->customerNumberFormat($customer['customer_id']) }}--}}
{{--                                            </a>--}}
{{--                                        @endcan--}}
{{--                                    </td>--}}
                                    <td class="font-style">{{$resell['billing_acount_name']}}</td>
                                    <td class="font-style">{{$resell['billing_acount_id']}}</td>
                                    <td class="font-style">{{$resell['project_name']}}</td>
                                    <td class="font-style">{{$resell['project_id']}}</td>
                                    <td class="font-style">{{$resell['project_hierarchy']}}</td>
                                    <td class="font-style">{{$resell['Service_description']}}</td>
                                    <td class="font-style">{{$resell['Service_ID']}}</td>
                                    <td class="font-style">{{$resell['SKU_ID']}}</td>
                                    <td class="font-style">
                                    @if($resell['Credit_type']==="PROMOTION")
                                            Gettoni
                                        @else
                                        {{$resell['Credit_type']}}
                                        @endif
                                    </td>
                                    <td class="font-style">{{$resell['Cost_type']}}</td>
                                    <td class="font-style">{{$resell['Usage_start_date']}}</td>
                                    <td class="font-style">{{$resell['Usage_end_date']}}</td>
                                    <td class="font-style">{{$resell['Usage_amount']}}</td>
                                    <td class="font-style">{{$resell['Usage_unit']}}</td>
                                    <td class="font-style">{{$resell['Unrounded_cost']}}</td>
                                    <td class="font-style">{{number_format((float)$resell['Cost']*1.1, 2, '.', '')}}</td>
{{--                                    <td>{{$customer['contact']}}</td>--}}
{{--                                    <td>{{$customer['email']}}</td>--}}
{{--                                    <td>{{\Auth::user()->priceFormat($customer['balance'])}}</td>--}}
{{--                                    <td>{{ (!empty($customer->last_login_at)) ? $customer->last_login_at : '-' }}</td>--}}
{{--                                    <td class="Action">--}}
{{--                                        <span>--}}
{{--                                        @if($customer['is_active']==0)--}}
{{--                                                <i class="ti ti-lock" title="Inactive"></i>--}}
{{--                                            @else--}}
{{--                                                @can('show customer')--}}
{{--                                                <div class="action-btn bg-info ms-2">--}}
{{--                                                    <a href="{{ route('customer.show',\Crypt::encrypt($customer['id'])) }}" class="mx-3 btn btn-sm align-items-center"--}}
{{--                                                       data-bs-toggle="tooltip" title="{{__('View')}}">--}}
{{--                                                        <i class="ti ti-eye text-white text-white"></i>--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                                @endcan--}}
{{--                                                @can('edit customer')--}}
{{--                                                        <div class="action-btn bg-primary ms-2">--}}
{{--                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-url="{{ route('customer.edit',$customer['id']) }}" data-ajax-popup="true"  data-size="lg" data-bs-toggle="tooltip" title="{{__('Edit')}}"  data-title="{{__('Edit Customer')}}">--}}
{{--                                                            <i class="ti ti-pencil text-white"></i>--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                @endcan--}}
{{--                                                @can('delete customer')--}}
{{--                                                    <div class="action-btn bg-danger ms-2">--}}
{{--                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['customer.destroy', $customer['id']],'id'=>'delete-form-'.$customer['id']]) !!}--}}
{{--                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="{{__('Delete')}}" ><i class="ti ti-trash text-white text-white"></i></a>--}}
{{--                                                        {!! Form::close() !!}--}}
{{--                                                    </div>--}}
{{--                                                @endcan--}}
{{--                                            @endif--}}
{{--                                        </span>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
