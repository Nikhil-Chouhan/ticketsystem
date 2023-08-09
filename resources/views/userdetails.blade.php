@extends('layouts.app')

@section('content')

  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
          <div class="profile card card-body px-3 pt-3 pb-0">
              <div class="profile-head">
                  {{-- <div class="photo-content">
                      <div class="cover-photo"></div>
                  </div> --}}
                  <div class="profile-info">
                    <div class="profile-photo">
                      <img src="{{ asset('websiteimages/person-avatar-icon.png') }}" class="img-fluid rounded-circle" alt="">
                    </div>
                    <div class="profile-details">
                      <div class="profile-name px-3 pt-2">
                        <h4 class="text-primary mb-0">{{ $user->name }}</h4>
                        @foreach($user->roles as $role)
                          <p> {{ $role->name }}</p>
                        @endforeach
                      </div>
                      <div class="profile-email px-2 pt-2">
                        <h4 class="text-muted mb-0">{{ $user->email }}</h4>
                       </div>
                    </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  </div>
@endsection