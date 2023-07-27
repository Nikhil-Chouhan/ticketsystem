@extends('layouts.app')

@section('content')

    <style>
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
    </style>
    <style>
        /* sidebar css start here */
        #sidebarMenu .nav-item{
            background-color: #a48a29 !important;
        }
        #sidebarMenu .nav-item:hover{
            background-color: #174368 !important;
        }
        /* sidebar css end here */    
    </style>

    <div class="container-fluid">
        <div class="row">
            
                <main class="col-md-12 px-md-4">
                @isset($getTicketDetails)
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Ticket ID : {{$getTicketDetails->tickets_id}}</h1>
                    <div class="btn-toolbar mb-2 mb-md-0"> </div>                                      
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="d-flex shadow p-3 mb-3 rounded">
                            <div class="fw-bold">Ticket Raised Date : </div>
                            <div class="px-1">{{date('d-M-Y',strtotime($getTicketDetails->created_at));}}</div>
                        </div>
                        {{-- <div class="d-flex shadow p-3 mb-3 rounded">
                            <div class="fw-bold">Target Closer Date : </div>
                            <div class="px-1">18-Jun-2023</div>
                        </div> --}}
                        {{-- <div class="d-flex shadow p-3 mb-3 rounded">
                            <div class="fw-bold">Priority : </div>
                            <div class="px-1">Low</div>
                        </div> --}}
                    </div>
                    <div class="col-md-4">
                        
                        <div class="d-flex shadow p-3 mb-3 rounded">
                            <div class="fw-bold">Company Name : </div>
                            <div class="px-1">{{$getTicketDetails->company_id}}</div>
                        </div>
                        
                        {{-- <div class="d-flex shadow p-3 mb-3 rounded">
                            <div class="fw-bold">Status : </div>
                            <div class="px-1">
                                <select name="Status" class="border-1 rounded" id="Status" style="padding: 5px 10px;"
                                    required>
                                    <option selected value="Open">Open</option>
                                    <option value="Working-in-progress">Work In Progress</option>
                                    <option value="Close">Close</option>
                                </select>
                            </div>
                        </div> --}}
                        
                        {{-- <div class="d-flex shadow p-3 mb-3 rounded">
                            <div class="fw-bold">Assign To : </div>
                            <div class="px-1">Dipak</div>
                        </div> --}}
                        {{-- <div class=" shadow p-3 mb-3 rounded">
                            <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Responce</div>
                                <div class="progress-bar bg-success" role="progressbar" style="width: 80%"
                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">Resolution</div>
                            </div>
                        </div> --}}
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
                            {{-- <img style="height:250px; width:250px;"src="{{@asset($getTicketDetails->file)}}" /> --}}
                            @foreach($imageFile as $image)
                                <div class="row">
                                    <img src="{{URL::to($image)}}">
                                    {{-- <img class="img-fluid" src="{{@asset($image)}}" /> --}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endisset
            </main>
        </div>
    </div>
@endsection