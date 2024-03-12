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
            <img src="signin/images/image-1.png" alt="" class="image-1">
            <form method="POST" action="{{ URL::to('/') }}/forgetPasswordForm" class="register-form" id="login-form">
                @csrf
                <h4 class="fontbrown">Reset Link will Send In Mail</h4> <br>
                <div class="form-holder">
                    <input class="custom-form-control" type="email" name="email" id="your_name" placeholder="Your Email"
                        value="{{ old('name') }}" />
                    <span class="fontbrown">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>

                </div>

                <button type="submit">
                    <span>Submit</span>
                </button>
            </form>
            <img src="signin/images/image-2.png" alt="" class="image-2">
        </div>

    </div>
@endsection
