@extends('layouts.app')

@section('content')

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
                                            <i class="fa-solid fa-location-dot mr-3 scale5"></i>
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
                                            <i class="fa-solid fa-laptop-code mr-3 scale5"></i>
                                            <div class="media-body">
                                                <span class="fs-12 d-block mb-1">Product :</span>
                                                <span class="fs-16 text-black">{{$getTicketDetails->product}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xxl-6 mb-3">
                                        <div class="media bg-light p-3 rounded align-items-center">	
                                            <i class="fa-solid fa-laptop-file mr-3 scale5"></i>
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