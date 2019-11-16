@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    @auth
    <div class="col-md-8">
      <user-entries-component
        :users_id="{{ $user_id }}"
        :logged="true"
        >
      </user-entries-component>
    </div>
    <div class="col-md-4">
      <list-tweet-component
        :users_id="{{ $user_id }}"
        :can-hide="{{ (Auth::user()->id == $user_id) ? 'true' : 'false' }}"
        >
      </list-tweet-component>
    </div>
    @endauth
    @guest
    <div class="col-md-8">
      <user-entries-component
        :users_id="{{ $user_id }}"
        :logged="false"
        >
      </user-entries-component>
    </div>
    <div class="col-md-4">
      <list-tweet-component
        :users_id="{{ $user_id }}"
        :can-hide="false"
        >
      </list-tweet-component>
    </div>
    @endguest
  </div>
</div>
@endsection