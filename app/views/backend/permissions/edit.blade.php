@extends('backend/layouts/default')

{{-- Traduction Laravel-france --}}
{{--  Maj:17/06/2013 - backend/permissions/edit.blade.php --}}

{{-- Page title --}}
@section('title')
{{Lang::get('backend/permissions/actions.edit.title')}}
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		{{Lang::get('backend/permissions/actions.edit.description')}}

		<div class="pull-right">
			<a href="{{ route('permissions') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> {{Lang::get('buttons.back')}}</a>
		</div>
	</h3>
</div>

<form class="form-horizontal" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

  <!-- Name -->
  <div class="control-group {{ $errors->has('name') ? 'error' : '' }}">
    <label class="control-label" for="name">{{Lang::get('backend/permissions/labels.name')}}</label>
    <div class="controls">
      <input type="text" name="name" id="name" value="{{ Input::old('name', $permission->name) }}" />
      {{ $errors->first('name', '<span class="help-inline">:message</span>') }}

      <span class="help-block">
        {{Lang::get('backend/permissions/labels.name_help')}}
      </span>
    </div>
  </div>

  <!-- Description -->
  <div class="control-group {{ $errors->has('description') ? 'error' : '' }}">
    <label class="control-label" for="description">{{Lang::get('backend/permissions/labels.description')}}</label>
    <div class="controls">
      <input class="input-xxlarge" type="text" name="description" id="description" value="{{ Input::old('description', $permission->description) }}" />
      {{ $errors->first('description', '<span class="help-inline">:message</span>') }}
    </div>
  </div>

	<!-- Form Actions -->
	<div class="control-permission">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('permissions') }}">{{Lang::get('buttons.cancel')}}</a>

			<button type="reset" class="btn">{{Lang::get('buttons.reset')}}</button>

			<button type="submit" class="btn btn-success">{{Lang::get('backend/permissions/actions.buttons.edit')}}</button>
		</div>
	</div>
</form>
@stop
