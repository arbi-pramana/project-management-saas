<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Acara - Ticketing Bootstrap Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('acara/images/favicon.png')}}">
    <link href="{{asset('acara/css/style.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
					
					<div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="#"><img src="{{asset('acara/images/logo-full-white.png')}}" height="100px"></a>
									</div>
                                    <h4 class="text-center mb-4 text-white">Forgot Password</h4>
                                    @if (\Session::has('danger'))
                                        <div class="alert alert-danger">
                                            {!! \Session::get('danger') !!}
                                        </div>
                                    @endif
                                    @if (\Session::has('success'))
                                        <div class="alert alert-success">
                                            {!! \Session::get('success') !!}
                                        </div>
                                    @endif
                                    <form action="{{route('users.forgot-password.storeNewPassword')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="token" value="{{request('token')}}">
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                        @error('confirm_password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="form-group">
                                            <label class="mb-1 text-white"><strong>Confirmation Password</strong></label>
                                            <input type="password" class="form-control" name="confirm_password" required>
                                        </div>
                                        <button type="submit" class="btn bg-white text-primary btn-block">Submit</button>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p class="text-white">Already have an account? <a class="text-white" href="{{url('login')}}">Sign in</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{asset('acara/vendor/global/global.min.js')}}"></script>
<script src="{{asset('acara/js/custom.min.js')}}"></script>
<script src="{{asset('acara/js/deznav-init.js')}}"></script>

</body>
</html>