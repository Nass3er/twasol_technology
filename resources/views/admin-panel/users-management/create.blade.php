@extends('adminlte::page')

@php
    $route = 'users-management';
    $id = 'users_management';
    $pageName = 'menu.users_management';
@endphp

@section('title', __("adminlte::$pageName") .' - '. __('adminlte::adminlte.createNewUser'))

@section('content_header')
    <div class="row">
        <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a
                    href="{{ localizedRoute("$route.index") }}">{{ __("adminlte::$pageName") }}</a></li>
            <li class="breadcrumb-item active">{{ __('adminlte::adminlte.createNewUser') }}</li>
        </ol>
    </div>
@stop

@section('content')
    @include('admin-panel.modals')

    @if (session('error'))
    <div class="container">
        <x-adminlte-card title="{{ __('adminlte::adminlte.error!') }}" theme="danger" theme-mode="outline" 
            icon="fas fa-lg fa-exclamation-circle" 
            body-class="{{ app()->getLocale() =='ar'? 'text-right' : 'text-left' }}"
            header-class="text-uppercase rounded-bottom border-info text-left" removable >
            <i>{{ session('error') }}</i>
        </x-adminlte-card>
    </div>
    @endif

    <form action="{{ localizedRoute("$route.store") }}" method="POST">
        @csrf

        <div class="card card-default">
            <div class="card-body">
                <div class="row">
                    <!-- Name and Email Column -->
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <x-adminlte.form.input id="name" name="name"
                                label="{{ __('adminlte::adminlte.name') }}" 
                                label-class="text-olive" 
                                enable-old-support required />
                        </div>

                        <div class="form-group">
                            <x-adminlte.form.input id="password" name="password" type="password"
                                label="{{ __('adminlte::adminlte.password') }}" 
                                label-class="text-olive" 
                                enable-old-support required />
                            <!-- Password strength indicator will appear here -->
                        </div>
                    </div>

                    <!--  Column -->
                    <div class="col-12 col-md-6">
                        
                        <div class="form-group">
                            <x-adminlte.form.input id="email" name="email" type="email"
                                label="{{ __('adminlte::adminlte.email') }}" 
                                label-class="text-olive" 
                                enable-old-support required />
                        </div>
                        <div class="form-group">
                            <x-adminlte.form.input id="password_confirmation" name="password_confirmation" type="password"
                                label="{{ __('adminlte::adminlte.password_confirmation') }}" 
                                label-class="text-olive" 
                                enable-old-support required />
                            <!-- Password match indicator will appear here -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center mt-3">
                        <button class="btn btn-success p-2 col-12 col-md-6" type="submit">
                            {{ __('adminlte::adminlte.save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@stop

@section('plugins.Select2', true)
@section('plugins.toastr', true)

@section('adminlte_js')
<script>
$(document).ready(function() {
    const passwordInput = $('#password');
    const passwordConfirmationInput = $('#password_confirmation');
    
    // Password strength indicator
    function checkPasswordStrength(password) {
        let strength = 0;
        let feedback = [];
        
        if (password.length >= 8) {
            strength++;
        } else {
            feedback.push('At least 8 characters');
        }
        
        if (password.match(/[a-z]/)) {
            strength++;
        } else {
            feedback.push('lowercase letter');
        }
        
        if (password.match(/[A-Z]/)) {
            strength++;
        } else {
            feedback.push('uppercase letter');
        }
        
        if (password.match(/[0-9]/)) {
            strength++;
        } else {
            feedback.push('number');
        }
        
        if (password.match(/[^a-zA-Z0-9]/)) {
            strength++;
        } else {
            feedback.push('special character');
        }
        
        return { strength, feedback };
    }
    
    // Add password strength indicator container
    passwordInput.closest('.form-group').append(`
        <div id="password-strength-container" class="mt-2" style="display: none;">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <h6 class="mb-2"><i class="fas fa-shield-alt"></i> Password Strength</h6>
                    <div class="progress mb-2" style="height: 8px;">
                        <div id="strength-bar" class="progress-bar" role="progressbar" style="width: 0%" 
                             aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small id="strength-text" class="form-text d-block mb-2"></small>
                    <div id="password-feedback"></div>
                </div>
            </div>
        </div>
    `);
    
    // Add password confirmation matching indicator container
    passwordConfirmationInput.closest('.form-group').append(`
        <div id="password-match-container" class="mt-2" style="display: none;">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <h6 class="mb-2"><i class="fas fa-check-double"></i> Password Match</h6>
                    <small id="match-text" class="form-text d-block"></small>
                </div>
            </div>
        </div>
    `);
    
    // Check password strength on input
    passwordInput.on('input', function() {
        const password = $(this).val();
        const strengthDiv = $('#password-strength-container');
        
        if (password.length > 0) {
            strengthDiv.show();
            const result = checkPasswordStrength(password);
            
            let progressClass = '';
            let strengthText = '';
            let progressPercent = 0;
            
            switch(result.strength) {
                case 0:
                case 1:
                    progressClass = 'bg-danger';
                    strengthText = 'Very Weak';
                    progressPercent = 20;
                    break;
                case 2:
                    progressClass = 'bg-warning';
                    strengthText = 'Weak';
                    progressPercent = 40;
                    break;
                case 3:
                    progressClass = 'bg-info';
                    strengthText = 'Fair';
                    progressPercent = 60;
                    break;
                case 4:
                    progressClass = 'bg-primary';
                    strengthText = 'Good';
                    progressPercent = 80;
                    break;
                case 5:
                    progressClass = 'bg-success';
                    strengthText = 'Strong';
                    progressPercent = 100;
                    break;
            }
            
            $('#strength-bar')
                .attr('class', 'progress-bar ' + progressClass)
                .css('width', progressPercent + '%')
                .attr('aria-valuenow', progressPercent);
            
            $('#strength-text')
                .removeClass('text-danger text-warning text-info text-primary text-success')
                .addClass(result.strength >= 3 ? 'text-success' : result.strength >= 2 ? 'text-warning' : 'text-danger')
                .text(strengthText);
            
            // Show feedback for missing requirements
            const feedbackHtml = result.feedback.map(item => 
                `<span class="badge badge-secondary mr-1">Missing: ${item}</span>`
            ).join('');
            $('#password-feedback').html(feedbackHtml);
        } else {
            strengthDiv.hide();
        }
        
        // Also check password matching when password changes
        checkPasswordMatch();
    });
    
    // Check password matching on both inputs
    passwordConfirmationInput.on('input', checkPasswordMatch);
    
    function checkPasswordMatch() {
        const password = passwordInput.val();
        const confirmation = passwordConfirmationInput.val();
        const matchDiv = $('#password-match-container');
        
        if (confirmation.length > 0) {
            matchDiv.show();
            
            if (password === confirmation) {
                $('#match-text')
                    .removeClass('text-danger')
                    .addClass('text-success')
                    .html('<i class="fas fa-check-circle"></i> Passwords match');
                
                // Remove invalid class
                passwordConfirmationInput.removeClass('is-invalid').addClass('is-valid');
            } else {
                $('#match-text')
                    .removeClass('text-success')
                    .addClass('text-danger')
                    .html('<i class="fas fa-times-circle"></i> Passwords do not match');
                
                // Add invalid class
                passwordConfirmationInput.removeClass('is-valid').addClass('is-invalid');
            }
        } else {
            matchDiv.hide();
            passwordConfirmationInput.removeClass('is-invalid is-valid');
        }
    }
    
    // Clear indicators when input is cleared
    passwordInput.on('focusout', function() {
        if ($(this).val().length === 0) {
            $('#password-strength-container').hide();
        }
    });
    
    passwordConfirmationInput.on('focusout', function() {
        if ($(this).val().length === 0) {
            $('#password-match-container').hide();
            $(this).removeClass('is-invalid is-valid');
        }
    });
});
</script>

<style>
#password-strength-container .card,
#password-match-container .card {
    background-color: #f8f9fa;
}

#password-feedback .badge {
    font-size: 0.75rem;
    margin: 0.15rem;
}

#strength-text {
    font-weight: bold;
}

#password-strength-container h6,
#password-match-container h6 {
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

#password-strength-container .progress {
    border-radius: 4px;
}

#password-strength-container .card-body {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
}
</style>
@stop
