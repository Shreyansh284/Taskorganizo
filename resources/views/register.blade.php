@extends('formMaster')
@section('formMaster')

    @php

    $team = request('team');
    $teamId = request('team_id');
    $adminName = request('adminName');
    $adminEmail = request('adminEmail');
    $userEmail = request('userEmail');

    @endphp


		<div class="wrapper">
			<div class="inner">
				<img src="signin/images/image-1.png" alt="" class="image-1">
                @if(request()->is('registerByTeamInvite'))
                <form method="POST" action="{{ URL::to('/addUserByTeamInvite') }}?team={{ $team }}&team_id={{ $teamId }}&adminName={{ $adminName }}&adminEmail={{ $adminEmail }}&userEmail={{$userEmail}}"
                class="register-form" id="register-form">
                 @else
                 <form method="POST" action="{{URL::to('/users')}}"class="register-form" id="register-form">
                @endif

                    @csrf

					<h3>New Account?</h3>
					<div class="form-holder">
                        <input type="text" class="custom-form-control" name="name" id="name" placeholder="Your Name"
                        value="{{ old('name') }}" />
                        <span class="fontbrown">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
					</div>
					<div class="form-holder">

                        <input type="email" class="custom-form-control" name="email" id="email" placeholder="Your Email"
                        value="@if($userEmail!=''){{$userEmail}} @endif"  @if($userEmail!='')readonly @endif />

                        <span class="fontbrown">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </span>
					</div>
					<div class="form-holder">

						<input type="password" class="custom-form-control" name="password" id="pass" placeholder="Password" />

                        <span class="fontbrown">
                            @error('password')
                                {{ $message }}
                            @enderror
                    </span>
					</div>
					<div class="form-holder">


                        <input type="password" class="custom-form-control" name="password_confirmation" id="re_pass"
                        placeholder="Repeat your password" />
                        <span class="fontbrown text-center">
                            @error('password_confirmation')
                                {{ $message }}
                            @enderror
                        </span>
					</div>
                    <a class="fontbrown" href="login">Already Registered ?</a>

                    <button type="submit">
                        <span>Register</span>
                    </button>

				</form>
				<img src="signin/images/image-2.png" alt="" class="image-2">
			</div>

		</div>
@endsection
