@extends('backend/layouts/default')

{{-- Traduction Laravel-france --}}
{{--  Maj:17/06/2013 - backend/groups/edit.blade.php --}}

{{-- Page title --}}
@section('title')
{{Lang::get('backend/groups/actions.edit.title')}}
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		{{Lang::get('backend/groups/actions.edit.description')}}

		<div class="pull-right">
			<a href="{{ route('groups') }}" class="btn btn-small btn-inverse"><i class="icon-circle-arrow-left icon-white"></i> {{Lang::get('buttons.back')}}</a>
		</div>
	</h3>
</div>

<form class="form-horizontal" method="post" action="" autocomplete="off">
	<!-- CSRF Token -->
	<input type="hidden" name="_token" value="{{ csrf_token() }}" />

  <!-- Name -->
  <div class="control-group {{ $errors->has('name') ? 'error' : '' }}">
    <label class="control-label" for="name">{{Lang::get('backend/groups/labels.name')}}</label>
    <div class="controls">
      <input type="text" name="name" id="name" value="{{ Input::old('name', $group->name) }}" />
      {{ $errors->first('name', '<span class="help-inline">:message</span>') }}
    </div>
  </div>

  <fieldset>
    <legend>{{Lang::get('backend/permissions/labels.group_permissions')}}</legend>
    <span class="help-block">
      {{Lang::get('backend/permissions/labels.group_permissions_check_note')}}
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
                          <input type="radio" value="1" id="perm_{{ $domain_name }}_{{ $field_name }}_{{ $action }}_allow" name="permissions[{{ $domain_name }}.{{ $field_name }}.{{ $action }}]" {{ ($permissions["$domain_name.$field_name.$action"] == 1 ? ' checked="checked"' : '') }}>
                          {{Lang::get('backend/permissions/labels.allow')}}
                        </label>
                      </div>

                      <div class="radio">
                        <label for="perm_{{ $domain_name }}_{{ $field_name }}_{{ $action }}_deny" >
                          <input type="radio" value="0" id="perm_{{ $domain_name }}_{{ $field_name }}_{{ $action }}_deny" name="permissions[{{ $domain_name }}.{{ $field_name }}.{{ $action }}]" {{ ($permissions["$domain_name.$field_name.$action"] == 0 ? ' checked="checked"' : '') }}>
                          {{Lang::get('backend/permissions/labels.deny')}}
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

	<!-- Form Actions -->
	<div class="control-group">
		<div class="controls">
			<a class="btn btn-link" href="{{ route('groups') }}">{{Lang::get('buttons.cancel')}}</a>
			<button type="submit" class="btn btn-success">{{Lang::get('backend/groups/actions.buttons.edit')}}</button>
		</div>
	</div>
</form>
@stop
