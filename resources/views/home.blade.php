@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <general-entries-component
        :users_id="null"
        :logged="false"
        >
      </general-entries-component>
    </div>
  </div>
</div>
</div>
@endsection