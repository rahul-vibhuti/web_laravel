<!DOCTYPE html>
<html lang="en">
@include('admin.components.head')

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{ asset('assets/images/logo.svg') }}">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                            @endif
                            <form class="pt-3" action="{{ route('admin.login') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg @error('email') in-valid @enderror" name="email" id="email" placeholder="Username">
                                    <div>@error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg @error('email') in-valid @enderror" autocomplete="false" name="password" id="password" placeholder="Password">
                                    <div>@error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                                </div>

                                <div class="mb-2">
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

</body>

</html>