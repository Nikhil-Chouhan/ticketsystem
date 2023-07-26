@extends('layouts.app')

@section('content')
<div id="progresscontent" class="progress-content">
                
    <div class="timeline">  

      @foreach ($progressdata as $data)
      
      {{-- tl-content-active --}}
      <div class="tl-content">
        <div class="tl-header">
          <span class="tl-marker"></span>
          <p class="tl-title">
            {{$data->status}}
          <p>
          <time class="tl-time" datetime="{{$data->updated_at}}">
            {{date('d F Y, h:i A', strtotime($data->updated_at))}}
            
          </time>
        </div>
        <div class="tl-body">
          <p>
           Ticket Lead: {{$data->ticket_lead}}
          </p>
          <p>
           Assigned To: {{$data->ticket_assignee}}
          </p>
        </div>
      </div>
      @endforeach

              
      </div>

</div> 


<script>

// const queryString = window.location.search;
// const urlParams = new URLSearchParams(queryString);
// const ticket_id = urlParams.get('ticket_id')
//console.log("ticket_id" + ticket_id);

 // if(history.replaceState) history.replaceState({}, "", "/showprogress");


</script> 

@endsection