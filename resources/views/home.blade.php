@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <list-tweet-component
                  :can-hide="true"
                  :users_id="1"
                  >
                </list-tweet-component>
            </div>
        </div>
    </div>
</div>
@endsection
