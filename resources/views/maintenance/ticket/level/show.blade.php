@extends('layouts.client')

@section('content')

    <div class="container offset-sm-3 col-sm-6 mt-5">

		<div class="row p-3" style="background-color: white;">
			<div class="col-sm-12 my-1">
				<h1 class="display-4">Level: {{ $level->name }}</h1>
			</div>
			
			<div class="col-sm-12">
				<ul class="breadcrumb">
					<li class="breadcrumb-item">Maintenance</li>
					<li class="breadcrumb-item">
						<a href="{{ route('level.index') }}">Level</a>
					</li>
					<li class="breadcrumb-item active">{{ $level->name }}</li>
				</ul>
			</div>

			<div class="col-sm-12 my-1">
				@include('notification.alert')

				<div class="form-group">
					<strong>Name</strong> <pre>{{ $level->name }}</pre>
				</div>

				<div class="form-group">
					<strong>Description</strong>
					<pre>{{ $level->description ?? 'Not Set' }}</pre>
				</div>

				<div class="form-group">
					<strong>Created At</strong>
					<pre>{{ $level->created_at ?? 'Not Set' }}</pre>
				</div>

				<div class="form-group">
					<strong>Updated At</strong>
					<pre>{{ $level->updated_at ?? 'Not Set' }}</pre>
				</div>
			</div>
		</div>
	</div>
@endsection 
