@extends('layouts.app')

@section('extra-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @role('admin')
                        I am an admin!
                    @endrole
                    @role('city_manager')
                        I am a city manager!
                    @endrole
                    @role('gym_manager')
                        I am a gym manager!
                    @endrole
                    @hasanyrole('admin|gym_manager|city_manager')
                        I am either a writer or an admin or both!
                    @else
                        I have none of these roles...
                    @endhasanyrole
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
