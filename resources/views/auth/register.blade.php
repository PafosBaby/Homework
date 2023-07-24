@extends('layouts.app')

@section('content')
    <section class="sec-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-centered">
                    <div class="text-box padding-3 border">
                        <div class="smart-forms smart-container wrap-3">
                            <h3>{{__('Registretion Form')}}</h3>
                            <form method="POST" action="{{ route('register.store') }}">
                                @csrf
                                <div class="form-body">
                                    <div class="section">
                                        <label for="name" class="field-label">{{ __('Login') }}</label>
                                        <label class="field prepend-icon">
                                            <input type="text" name="name" id="name" class="gui-input"
                                                placeholder="Login...">
                                            <span class="field-icon"><i class="fa fa-user"></i></span>
                                        </label>
                                    </div><!-- end section -->

                                    <div class="section">
                                        <label for="email" class="field-label">{{ __('Email') }}</label>
                                        <label class="field prepend-icon">
                                            <input type="email" name="email" id="email" class="gui-input"
                                                placeholder="example@domain.com...">
                                            <span class="field-icon"><i class="fa fa-envelope"></i></span>
                                        </label>
                                    </div><!-- end section -->

                                    <div class="section">
                                        <label for="password" class="field-label">{{ __('Password') }}</label>
                                        <label class="field prepend-icon">
                                            <input type="password" name="password" id="password" class="gui-input">
                                            <span class="field-icon"><i class="fa fa-lock"></i></span>
                                        </label>
                                    </div><!-- end section -->

                                    <div class="section">
                                        <label for="confirm_password"
                                            class="field-label">{{ __('Confirm Password') }}</label>
                                        <label class="field prepend-icon">
                                            <input type="password" name="confirm_password" id="confirm_password"
                                                class="gui-input">
                                            <span class="field-icon"><i class="fa fa-unlock-alt"></i></span>
                                        </label>
                                    </div><!-- end section -->

                                </div><!-- end .form-body section -->
                                <div class="form-footer">
                                    <button class="button btn-primary">{{ __('Create Account') }}</button>
                                </div><!-- end .form-footer section -->
                            </form>

                        </div>
                    </div>
                </div>

            </div>
            <!--end item-->

        </div>
    </section>
@endsection
