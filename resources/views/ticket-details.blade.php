@extends('layouts.app')

@section('content')

{{-- <style>
    .themecolor .toggle {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 40px;
    height: 20px;
    display: inline-block;
    position: relative;
    border-radius: 50px;
    overflow: hidden;
    outline: none;
    border: none;
    cursor: pointer;
    background-color: #707070;
    transition: background-color ease 0.3s;
    margin-right: 10px;
    }

    .themecolor .toggle:before {
    content: "on off";
    display: block;
    position: absolute;
    z-index: 2;
    width: 16px;
    height: 16px;
    background: #fff;
    left: 2px;
    top: 2px;
    border-radius: 50%;
    font: 9px/18px Helvetica;
    text-transform: uppercase;
    font-weight: bold;
    text-indent: -18px;
    word-spacing: 20px;
    color: #fff !important;
    text-shadow: -1px -1px rgba(0,0,0,0.15);
    white-space: nowrap;
    box-shadow: 0 1px 2px rgba(0,0,0,0.2);
    transition: all cubic-bezier(0.3, 1.5, 0.7, 1) 0.3s;
    }

    .themecolor .toggle:checked {
    background-color: green;
    }

    .themecolor .toggle:checked:before {
    left: 22px;
    }

    .themecolor .dark-light {
        background-color :#424a4f !important;
    }

    .themecolor .dark-light ul li.nav-item a{
        color: #ff0000 !important;
    }
</style> --}}
{{-- 
    <div class="container-fluid">
        <div class="row">
            
                <main class="col-md-12 px-md-4">
                @isset($getTicketDetails)
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Ticket ID : {{$getTicketDetails->id}}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0"> </div>                                      
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex shadow p-3 mb-3 rounded">
                            <div class="fw-bold">Ticket Raised Date : </div>
                            <div class="px-1">{{date('d-M-Y',strtotime($getTicketDetails->created_at));}}</div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        
                        <div class="d-flex shadow p-3 mb-3 rounded">
                            <div class="fw-bold">Company Name : </div>
                            <div class="px-1">{{$getTicketDetails->company_id}}</div>
                        </div>
                        
                        
                    </div>
                    <div class="col-md-4 " >
                        <div class="d-flex shadow p-3 mb-3 rounded">
                            <div class="fw-bold">Branch Name : </div>
                            <div class="px-1">{{$getTicketDetails->branch_id}}</div>
                        </div>
                    </div>
                </div>
                <div class="shadow p-3 mb-5 rounded">
                    <div class="fw-bold fs-5 mt-4">
                        Ticket Title:
                    </div>
                    <div>
                        {{$getTicketDetails->ticket_title}}
                    </div>
                    <div class="fw-bold fs-5 mt-4">
                        Ticket Description:
                    </div>
                    <div class="row">

                        <div class="col-md-8 col-12">{{$getTicketDetails->ticket_description}}</div>
                        <div class="col-md-4 col-12">
                            <img style="height:250px; width:250px;"src="{{@asset($getTicketDetails->file)}}" />
                            @if(isset($imageFile))
                            @foreach($imageFile as $image)
                              <div class="row">
                                    <img src="{{URL::to($image)}}">
                                    <img class="img-fluid" src="{{@asset($image)}}" />
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>  
                    <div>
                        <a href={{url('downloadexcel/'.$getTicketDetails->id)}}><button type="button" class="btn btn-light">Download Excel</button></a>  
                    </div>
                </div>
                @endisset
            </main>
        </div>
    </div> --}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card event-detail-bx overflow-hidden">
                           
                            <div class="card-body">
                                <div class="d-flex flex-wrap align-items-center mb-4">
                                    <div class="d-flex align-items-center">
                                        <a class="btn btn-primary light mr-3"><i class="fa fa-users mr-3 scale5" aria-hidden="true"></i>Ticket ID :  {{$getTicketDetails->id}}   </a>
                                        
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-3 col-md-6 col-xxl-6 mb-3">
                                        <div class="media bg-light p-3 rounded align-items-center">	
                                            <i class="fa fa-building mr-3 scale5"></i>
                                            <div class="media-body">
                                                <span class="fs-12 d-block mb-1">Company Name :</span>
                                                <span class="fs-16 text-black">{{$getTicketDetails->company_name}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-xxl-6 mb-3">
                                        <div class="media bg-light p-3 rounded align-items-center">	
                                            <i class="fa fa-location"></i>
                                            <div class="media-body">
                                                <span class="fs-12 d-block mb-1">Branch Name :</span>
                                                <span class="fs-16 text-black">{{$getTicketDetails->branch_name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-lg-3 col-md-6 col-xxl-6 mb-3">
                                        <div class="media bg-light p-3 rounded align-items-center">	
                                            <i class="fa fa-user mr-3 scale5"></i>
                                            <div class="media-body">
                                                <span class="fs-12 d-block mb-1">Branch Contact Person Name :</span>
                                                <span class="fs-16 text-black">{{$getTicketDetails->exec_name}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-xxl-6 mb-3">
                                        <div class="media bg-light p-3 rounded align-items-center">	
                                            <i class="fa fa-mobile mr-3 scale5"></i>
                                            <div class="media-body">
                                                <span class="fs-12 d-block mb-1">Branch Contact Person Number :</span>
                                                <span class="fs-16 text-black">{{$getTicketDetails->exec_number}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xxl-6 mb-3">
                                        <div class="media bg-light p-3 rounded align-items-center">	
                                            <i class="fa fa-envelope  mr-3 scale5"></i>
                                            <div class="media-body">
                                                <span class="fs-12 d-block mb-1">Branch Contact Person Email :</span>
                                                <span class="fs-16 text-black">{{$getTicketDetails->exec_email}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xxl-6 mb-3">
                                        <div class="media bg-light p-3 rounded align-items-center">	
                                            <i class="fa fa-calendar mr-3 scale5"></i>
                                            <div class="media-body">
                                                <span class="fs-12 d-block mb-1">Date :</span>
                                                <span class="fs-16 text-black">{{date('d-M-Y',strtotime($getTicketDetails->created_at))}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xxl-6 mb-3">
                                        <div class="media bg-light p-3 rounded align-items-center">	
                                            <i class="fa fa-email mr-3 scale5"></i>
                                            <div class="media-body">
                                                <span class="fs-12 d-block mb-1">Product :</span>
                                                <span class="fs-16 text-black">{{$getTicketDetails->product}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xxl-6 mb-3">
                                        <div class="media bg-light p-3 rounded align-items-center">	
                                            <i class="fa fa-email mr-3 scale5"></i>
                                            <div class="media-body">
                                                <span class="fs-12 d-block mb-1">Service :</span>
                                                <span class="fs-16 text-black">{{$getTicketDetails->service}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="fs-20 text-black font-w600">Ticket Title : {{$getTicketDetails->ticket_title}}</h4>
                                        
                                        <h4 class="fs-20 text-black font-w600">Ticket Description</h4>
                                        <p class="fs-14 mb-0">{{$getTicketDetails->ticket_description}}</p>
                                    </div>
                                    
                                    <div class="col-6">
                                        <div class="card-media">
                                            @if(isset($imageFile))
                                                 @foreach($imageFile as $image)
                                                    <div class="row">
                                                        <img style="height :250px" class="w-100" src="{{URL::to($image)}}">
                                                        {{-- <img class="w-100" src="{{@asset($image)}}" /> --}}
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    {{-- <div>
                                        <a href="{{ Storage::url($imageFile)}}"  target="_blank" download><button type="button" class="btn btn-light">Download Image</button></a>  
                                    </div> --}}
                                    <div>
                                        <a href={{url('downloadexcel/'.$getTicketDetails->id)}}><button type="button" class="btn btn-light">Download Excel</button></a>  
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection