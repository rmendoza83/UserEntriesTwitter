@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <user-entries-component
        :users_id="{{ $user_id }}"
        :logged="{{ Auth::check() ? 'true' : 'false' }}"
        >
      </user-entries-component>
    </div>
    <div class="col-md-4">
      <list-tweet-component
        :users_id="{{ $user_id }}"
        :can-hide="{{ Auth::check() ? 'true' : 'false' }}"
        >
      </list-tweet-component>
    </div>
  </div>
</div>
@endsection