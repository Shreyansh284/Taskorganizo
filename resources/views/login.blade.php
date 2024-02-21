<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TaskOrganizo</title>
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     @notifyCss
    <!-- Main css -->
    <link rel="stylesheet" href="reg/css/style.css">
</head>
<body>


    <x-notify::notify />




    <div class="main">


        <i class="bi bi-box-arrow-left"></i>
        <section class="sign-in">
            <div class="container">


<br><br>
                @if(session()->has('success'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert"
                    style="transition: opacity 2s ease-in-out;" id="successAlert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @elseif(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert"
                    style="transition: opacity 2s ease-in-out;" id="successAlert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <script>
                    // Add JavaScript to hide the alert after 4 seconds
                    setTimeout(function() {
                        document.getElementById('successAlert').style.display = 'none';
                    }, 4000);
                </script>


                <div class="signin-content">


                    <div class="signin-image">
                        <figure><img src="reg/images/signin-image.jpg" alt="sing up image"></figure>
                        <a  wire:navigate href="register" class="signup-image-link" style="text-decoration: none" >Create A New Account</a>

                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST"  action="{{ URL::to('/') }}/loginAuth" class="register-form" id="login-form">
                            @csrf
                            <div class="form-group">

                                <input type="email" name="email" id="your_name" placeholder="Your Email" value="{{ old('name') }}" />
                                <span class="text-danger">
                                    @error('email')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group">

                                <input type="password" name="password" id="your_pass" placeholder="Password"/>
                                <span class="text-danger">
                                    @error('password')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <a href="login" style="color: brown">Forget Password ?</a>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>

    </div>
    @notifyJs
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
