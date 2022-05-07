@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>


                                <div class="col-md-6">
                                    <select name='position_id' class='custom-select custom-select-sm' label='Role'
                                        id='role'>
                                        <option value="0" selected>Whats Your Role</option>
                                        <option value="1">I'm an Admin</option>
                                        <option value="2">I'm a City Manager</option>
                                        <option value="3">I'm a Gym Manager</option>
                                        <option value="4">I'm a User</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 d-none" id='extras'>
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Extra information') }}</label>

                                <div class="col-md-6">
                                    <div class="alert alert-success d-none" id='extrasMsg' role="alert">
                                        no extra informations is needed for this user
                                    </div>
                                    <div class='form-row d-none' data-role=2> 
                                        National ID :
                                        <input id="NID" type="number" class="form-control" name="cmanager_NID">
                                        <br>
                                        city name :
                                        <input id="city_name" type="text" class="form-control" name="city_name">
                                    </div>
                                    <div class='form-row d-none' data-role=3> National ID :
                                        <input id="NID" type="number" class="form-control" name="gmanager_NID">
                                        <br>
                                        Gym branch :
                                        <select name='gym_id' class='custom-select custom-select-sm' label='Role'>
                                            <option value=' 'selected>select a Gym</option>
                                            @foreach ($gyms as $gym)
                                                <option value="{{ $gym->id }}">{{ $gym->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('dataTable-scripts')
    <script>

        $('#role').on('change', function() {
            const val = +$("option:selected", this).val();
            if (val == 1 || val == 4) {
                $('#extras').removeClass("d-none")
                $('#extrasMsg').removeClass("d-none")
            }
            $(".form-row").each(function() {
                if ($(this).data('role') == val) {
                    $('#extras').removeClass("d-none")
                    $(this).removeClass("d-none")
                    $('#extrasMsg').addClass("d-none")
                } else {
                    $(this).addClass("d-none")
                }
            })
            if(val == 0) $('#extras').addClass("d-none")
        })
    </script>
@endsection
