@extends('layouts.app')

@section('content')

@section('content')
    <div class="container-fluid">
        <div class="row hv-100">
            <main class="col-md-12 px-md-4 custom-dflex">
            <div class="profile_wrapper">
      <div class="left">
        <div>
        <img src="{{URL::asset ('images/userprofile.png')}}" alt="user" width="100">
          <h4>{{ $user->name }}</h4>
           <!-- <p>Role: {{ $allroles }} </p> -->
        </div>
         
      </div>
      <div class="right">
          <div class="info">
              <h3>Information</h3>
              <div class="info_data">
                   <div class="data">
                      <h4>Email: {{ $user->email }}</h4>
                   </div>
                   <!-- <div class="data">
                     <h4>Role</h4>
                      <p>{{ $user->name }}</p>
                </div> -->
              </div>
          </div>
        
        <div class="projects">
              <h3>Roles</h3>
              <div class="projects_data">
                   
              @foreach($user->roles as $role)
                   <div class="data">
                   <h4> {{ $role->name }}</h4>
                   </div>
              @endforeach

              </div>
          </div>

        <!--    <div class="projects">
             <h3>Tickets</h3>
              <div class="projects_data">
                   <div class="data">
                      <h4>Recent</h4>
                      <p></p>
                   </div>
                  <div class="data">
                     <h4>Most Viewed</h4>
                      <p>dolor sit amet.</p>
                </div> 
              </div>
          </div> -->
        
           <!-- <div class="social_media">
             <ul>
                <li><a href="#">Tickets</a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </div> -->
      </div>
  </div>

            </main>
        </div>
    </div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


  
</script>

@endsection