@extends('backend/layouts/default')

{{-- Traduction Laravel-france --}}
{{--  Maj:16/06/2013 - backend/users/create.blade.php --}}

{{-- Page title --}}
@section('title')
{{Lang::get('backend/users/actions.create.title')}}
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		{{Lang::get('backend/users/actions.create.description')}}

		<div class="pull-right">
			<a href="{{ route('users') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> {{Lang::get('buttons.back')}}</a>
		</div>
	</h3>
</div>

<!-- Tabs -->
<ul class="nav nav-tabs">
	<li class="active"><a href="#tab-general" data-toggle="tab">{{Lang::get('backend/general.tabs.general')}}</a></li>
	<li><a href="#tab-permissions" data-toggle="tab">{{Lang::get('backend/general.tabs.permissions')}}</a></li>
</ul>

<form class="form-horizontal" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

	<!-- Tabs Content -->
	<div class="tab-content">
		<!-- General tab -->
		<div class="tab-pane active" id="tab-general">
			<!-- First Name -->
			<div class="control-group {{ $errors->has('first_name') ? 'error' : '' }}">
				<label class="control-label" for="first_name">{{Lang::get('backend/users/labels.first_name')}}</label>
				<div class="controls">
					<input type="text" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" />
					{{ $errors->first('first_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Last Name -->
			<div class="control-group {{ $errors->has('last_name') ? 'error' : '' }}">
				<label class="control-label" for="last_name">{{Lang::get('backend/users/labels.last_name')}}</label>
				<div class="controls">
					<input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}" />
					{{ $errors->first('last_name', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Email -->
			<div class="control-group {{ $errors->has('email') ? 'error' : '' }}">
				<label class="control-label" for="email">{{Lang::get('backend/users/labels.email')}}</label>
				<div class="controls">
					<input type="text" name="email" id="email" value="{{ Input::old('email') }}" />
					{{ $errors->first('email', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Password -->
			<div class="control-group {{ $errors->has('password') ? 'error' : '' }}">
				<label class="control-label" for="password">{{Lang::get('backend/users/labels.password')}}</label>
				<div class="controls">
					<input type="password" name="password" id="password" value="" />
					{{ $errors->first('password', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Password Confirm -->
			<div class="control-group {{ $errors->has('password_confirm') ? 'error' : '' }}">
				<label class="control-label" for="password_confirm">{{Lang::get('backend/users/labels.password_confirm')}}</label>
				<div class="controls">
					<input type="password" name="password_confirm" id="password_confirm" value="" />
					{{ $errors->first('password_confirm', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Activation Status -->
			<div class="control-group {{ $errors->has('activated') ? 'error' : '' }}">
				<label class="control-label" for="activated">{{Lang::get('backend/users/labels.activated')}}</label>
				<div class="controls">
					<select name="activated" id="activated">
						<option value="1"{{ (Input::old('activated', 0) === 1 ? ' selected="selected"' : '') }}>{{Lang::get('backend/general.yes')}}</option>
						<option value="0"{{ (Input::old('activated', 0) === 0 ? ' selected="selected"' : '') }}>{{Lang::get('backend/general.no')}}</option>
					</select>
					{{ $errors->first('activated', '<span class="help-inline">:message</span>') }}
				</div>
			</div>

			<!-- Super User -->
      <div class="control-group">
        <label class="control-label">{{Lang::get('backend/users/labels.superuser')}}</label>
        <div class="controls">
          <div class="radio inline">
            <label for="perm_superuser_allow" >
              <input type="radio" value="1" id="perm_superuser_allow" name="permissions[superuser]" >
              {{Lang::get('backend/general.yes')}}
            </label>
          </div>

          <div class="radio inline">
            <label for="perm_superuser_deny" >
              <input type="radio" value="0" id="perm_superuser_deny" name="permissions[superuser]" checked >
              {{Lang::get('backend/general.no')}}
            </label>
          </div>
					<span class="help-block">
						{{Lang::get('backend/users/labels.superuser_help')}}
					</span>
        </div>
      </div>

			<!-- Groups -->
			<div class="control-group {{ $errors->has('groups') ? 'error' : '' }}">
				<label class="control-label" for="groups">{{Lang::get('backend/users/labels.groups')}}</label>
				<div class="controls">
					<select name="groups[]" id="groups[]" multiple="multiple">
						@foreach ($groups as $group)
						<option value="{{ $group->id }}"{{ (in_array($group->id, $selectedGroups) ? ' selected="selected"' : '') }}>{{ $group->name }}</option>
						@endforeach
					</select>

					<span class="help-block">
						{{Lang::get('backend/users/labels.groups_help')}}
					</span>
				</div>
			</div>
		</div>

		<!-- Permissions tab -->
		<div class="tab-pane" id="tab-permissions">
      <fieldset>
        <legend>{{Lang::get('backend/permissions/labels.user_permissions')}}</legend>
        <span class="help-block">
          {{Lang::get('backend/permissions/labels.user_permissions_check_note')}}
        </span>

        @foreach ($domains as $domain_name => $fields)
        <table class="matrix table table-striped">
          <thead>
            <tr>
              <th style="width: 150px"><b style="color: #222">{{Lang::get('backend/modules/'.$domain_name.'.domain')}}</b></th>
              @foreach ($fields['actions'] as $action)
                <th class="text-center">{{Lang::get('backend/permissions.'.$action)}}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($fields as $field_name => $field_actions)
              @if ($field_name != 'actions')
              <tr>
                <td class="matrix-title"><b>{{Lang::get('backend/modules/'.$domain_name.'.controllers.'.$field_name)}}</b></td>
                @foreach ($fields['actions'] as $action)
                  <td class="text-center">

                    @if (in_array($action, $field_actions))

                        <div class="control-group">
                          <div class="radio">
                            <label for="perm_{{ $domain_name }}_{{ $field_name }}_{{ $action }}_allow" >
                              <input type="radio" value="1" id="perm_{{ $domain_name }}_{{ $field_name }}_{{ $action }}_allow" name="permissions[{{ $domain_name }}.{{ $field_name }}.{{ $action }}]">
                              {{Lang::get('backend/permissions/labels.allow')}}
                            </label>
                          </div>

                          <div class="radio">
                            <label for="perm_{{ $domain_name }}_{{ $field_name }}_{{ $action }}_deny" >
                              <input type="radio" value="0" id="perm_{{ $domain_name }}_{{ $field_name }}_{{ $action }}_deny" name="permissions[{{ $domain_name }}.{{ $field_name }}.{{ $action }}]" checked="checked">
                              {{Lang::get('backend/permissions/labels.deny')}}
                            </label>
                          </div>

                          <div class="radio">
                            <label for="perm_{{ $domain_name }}_{{ $field_name }}_{{ $action }}_inherit" >
                              <input type="radio" value="-1" id="perm_{{ $domain_name }}_{{ $field_name }}_{{ $action }}_inherit" name="permissions[{{ $domain_name }}.{{ $field_name }}.{{ $action }}]">
                              {{Lang::get('backend/permissions/labels.inherit')}}
                            </label>
                          </div>
                        </div>

                    @else
                        <span class="help-inline small">{{Lang::get('backend/permissions/labels.not_applicable')}}</span>
                    @endif

                  </td>
                @endforeach
              </tr>
              @endif
            @endforeach
          </tbody>
        </table>
        <br/>
        @endforeach

      </fieldset>
		</div>
	</div>

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('users') }}">{{Lang::get('buttons.cancel')}}</a>

			<button type="reset" class="btn">{{Lang::get('buttons.reset')}}</button>

			<button type="submit" class="btn btn-success">{{Lang::get('backend/users/actions.buttons.create')}}</button>
		</div>
	</div>
</form>
@stop
