@extends('error/layouts/defaut')

<!-- Traduction Laravel-france  -->
<!-- Maj:2/05/2013 - frontend.php -->

{{-- Page title --}}
@section('title')
{{Lang::get('error.503.page-title')}}
@stop

{{-- Error page content --}}
@section('content')
	<div class="wrapper">
		<div class="error-spacer"></div>
		<div role="main" class="main">
			<h1>{{Lang::get('error.503.error-title')}}</h1>

			<h2>{{Lang::get('error.503.error')}}</h2>

			<hr>

			<h3>{{Lang::get('error.503.meaning')}}</h3>

			<p>
				{{Lang::get('error.503.reason')}}
			</p>

		</div>
	</div>
@stop