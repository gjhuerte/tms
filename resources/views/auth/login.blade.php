@extends('layouts.app')

@section('styles-include')
<style type="text/css">
	body {
		background-color: #2c3e50;
	}

	a:hover {
		text-decoration: none;
	}
</style>
@endsection

@section('content')
<div class="offset-md-3 col-md-6 offset-lg-4 col-lg-4 mt-5 pt-5">

	<div class="card p-3 rounded-0">
		<div class="card-body">
	
			<h3 class="text-muted text-center">
				{{ config('app.name') }}
			</h3>
			<hr />

			@include('notification.alert')
            <form 
            	method="POST" 
            	ref="form"
            	action="{{ route('login') }}" 
            	aria-label="{{ __('Login') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<div class="form-group">
					<label 
						for="username"> Username
					</label>
					<input 
						type="username" 
						name="username" 
						value="{{ old('username') }}" 
						id="username"
						class="form-control"
						placeholder="john.doe" />
				</div>
				<div class="form-group">
					<label 
						for="password"> Password
					</label>
					<input 
						type="password" 
						name="password" 
						value="{{ old('password') }}" 
						id="password"
						class="form-control"
						placeholder="*********" />
				</div>
				<div class="form-group">
					<button-loading
						element-type="submit"
						element-id="submit-button"
						element-class="btn btn-primary btn-block"
						default-text="Submit">
					</button-loading>
				</div>
				<div class="col-sm-12 text-center">
					<a 
						href="{{ url('password/reset') }}"
						id="forgot-password"
						class="text-primary"> Forgot Password?
					</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
