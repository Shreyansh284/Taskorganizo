@extends('formMaster')
@section('formMaster')
@if (session()->has('success'))
<div class="custom-alert alert alert-success alert-dismissible fade show" id="successAlert">
    <span class="alert-text">{{session('success')}}</span>
    <i class="bi text-light closeAlert bi-x-circle" data-bs-dismiss="alert"></i>
</div>
@endif
<script>

    setTimeout(function() {
        document.getElementById('successAlert').style.display = 'none';

    }, 4000);
</script>
    <div class="wrapper">

        <div class="inner">
            <img src="/signin/images/image-1.png" alt="" class="image-1">
            <form method="POST" action="{{ URL::to('/') }}/resetPassword" class="register-form" id="login-form">
                @csrf
                <h3>Reset Password</h3>
                <input type="text" name="token" hidden value="{{$token}}">
                <div class="form-holder">
                    <input class="custom-form-control" value="{{$email}}" readonly type="email" name="email" id="your_name" placeholder="Your Email"
                        value="{{ old('name') }}" />
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

                <button type="submit">
                    <span>Reset</span>
                </button>
            </form>
            <img src="/signin/images/image-2.png" alt="" class="image-2">
        </div>

    </div>
@endsection
