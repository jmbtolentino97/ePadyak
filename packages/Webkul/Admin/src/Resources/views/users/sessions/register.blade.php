@extends('admin::layouts.anonymous-master')

@section('page_title')
    {{ __('admin::app.users.register.title') }}
@stop

@section('content')

    <div class="panel">

        <div class="panel-content">

            <div class="form-container" style="text-align: left">

                <h1>{{ __('admin::app.users.register.title') }}</h1>

                <form method="POST" action="{{ route('admin.register.store') }}" @submit.prevent="onSubmit">
                    @csrf

                    <div class="control-group" :class="[errors.has('name') ? 'has-error' : '']">
                        <label for="name">{{ __('admin::app.users.register.name') }}</label>
                        <input type="text" v-validate="'required'" class="control" id="name" name="name" data-vv-as="&quot;{{ __('admin::app.users.register.name') }}&quot;"/>
                        <span class="control-error" v-if="errors.has('name')">@{{ errors.first('name') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('email') ? 'has-error' : '']">
                        <label for="email">{{ __('admin::app.users.sessions.email') }}</label>
                        <input type="text" v-validate="'required|email'" class="control" id="email" name="email" data-vv-as="&quot;{{ __('admin::app.users.sessions.email') }}&quot;"/>
                        <span class="control-error" v-if="errors.has('email')">@{{ errors.first('email') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('password') ? 'has-error' : '']">
                        <label for="password">{{ __('admin::app.users.sessions.password') }}</label>
                        <input type="password" v-validate="'required|min:6|max:18'" class="control" id="password" name="password" ref="password" data-vv-as="&quot;{{ __('admin::app.users.sessions.password') }}&quot;" />
                        <span class="control-error" v-if="errors.has('password')">@{{ errors.first('password') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('password_confirmation') ? 'has-error' : '']">
                        <label for="password_confirmation">{{ __('admin::app.users.register.confirm-password') }}</label>
                        <input type="password" v-validate="'min:6|max:18|confirmed:password'" class="control" id="password_confirmation" name="password_confirmation" data-vv-as="&quot;{{ __('admin::app.users.register.confirm-password') }}&quot;"/>
                        <span class="control-error" v-if="errors.has('password_confirmation')">@{{ errors.first('password_confirmation') }}</span>
                    </div>

                    <div class="control-group" :class="[errors.has('role_id') ? 'has-error' : '']">
                        <label for="role">{{ __('admin::app.users.register.role') }}</label>
                        <select v-validate="'required'" class="control" name="role_id" data-vv-as="&quot;{{ __('admin::app.users.register.role') }}&quot;">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <span class="control-error" v-if="errors.has('role_id')">@{{ errors.first('role_id') }}</span>
                    </div>

                    <div class="control-group">
                        <a href="{{ route('admin.session.create') }}">{{ __('admin::app.users.register.existing-account') }}</a>
                    </div>

                    <div class="button-group">
                        <button class="btn btn-xl btn-primary">{{ __('admin::app.users.register.submit-btn-title') }}</button>
                    </div>
                </form>

            </div>

        </div>

    </div>

@stop