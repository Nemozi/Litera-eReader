@extends('templates.master')

@section('content')
    <header>
        <link rel="stylesheet" href="/css/profile.css">
    </header>

    <x-slot name="header">
        <h2>
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <!-- Profile Information -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">
                        {{ __('Profile Information') }}
                    </h3>
                    <p class="card-text">
                        {{ __("Update your account's profile information and email address.") }}
                    </p>

                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>

                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-3">
                                    <p>
                                        {{ __('Your email address is unverified.') }}

                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Click here to re-send the verification email.') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="text-success">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                        @if (session('status') === 'profile-updated')
                            <p class="text-success mt-2" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                                {{ __('Saved.') }}
                            </p>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Update Password -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">
                        {{ __('Update Password') }}
                    </h3>
                    <p class="card-text">
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>

                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
                            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
                            @error('current_password', 'updatePassword')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
                            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
                            @error('password', 'updatePassword')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                            @error('password_confirmation', 'updatePassword')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                        @if (session('status') === 'password-updated')
                            <p class="text-success mt-2" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                                {{ __('Saved.') }}
                            </p>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">
                        {{ __('Delete Account') }}
                    </h3>
                    <p class="card-text">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                    </p>

                    <button class="btn btn-danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                        {{ __('Delete Account') }}
                    </button>

                    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')

                            <h4>
                                {{ __('Are you sure you want to delete your account?') }}
                            </h4>

                            <p>
                                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                            </p>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" name="password" type="password" class="form-control" placeholder="{{ __('Password') }}" />
                                @error('password', 'userDeletion')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <button type="button" x-on:click="$dispatch('close')" class="btn btn-secondary">
                                    {{ __('Cancel') }}
                                </button>

                                <button type="submit" class="btn btn-danger">
                                    {{ __('Delete Account') }}
                                </button>
                            </div>
                        </form>
                    </x-modal>
                </div>
            </div>
        </div>
    </div>
@endsection
