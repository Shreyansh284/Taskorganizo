@extends('formMaster')
@section('formMaster')
@if (session()->has('success'))
<div class="custom-alert alert alert-success alert-dismissible fade show" id="successAlert">
    <span class="alert-text">{{session('success')}}</span>
    <i class="bi text-light closeAlert bi-x-circle" data-bs-dismiss="alert"></i>
</div>
@endif
@if (session()->has('error'))
<div class="custom-alert-error alert alert-success alert-dismissible fade show" id="successAlert">
    <span class="alert-text">{{session('error')}}</span>
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
            <img src="signin/images/image-1.png" alt="" class="image-1">
            <form method="POST" action="{{ URL::to('/') }}/loginAuth" class="register-form" id="login-form">
                @csrf
                <h3>Login</h3>
                <div class="form-holder">
                    <input class="custom-form-control" type="email" name="email" id="your_name" placeholder="Your Email"
                        value="{{ old('email') }}" />
                    <span class="fontbrown">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>

                </div>
                <div class="form-holder">

                    <input class="custom-form-control" type="password" name="password" id="your_pass" placeholder="Password" />
                    <span class="fontbrown">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <a class="fontbrown" href="register">Create New Account ?</a>


                <br>
                <p><a class="fontbrown" href="forgetPassword">Forget Password?</a></p>
                <button type="submit">
                    <span>Login</span>
                </button>
            </form>
            <img src="signin/images/image-2.png" alt="" class="image-2">
        </div>

    </div>
@endsection
