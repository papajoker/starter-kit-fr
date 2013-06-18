@extends('backend/layouts/default')

{{-- Traduction Laravel-france --}}
{{--  Maj:17/06/2013 - backend/permissions/index.blade.php --}}

{{-- Page title --}}
@section('title')
{{Lang::get('backend/permissions/actions.index.title')}}
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="page-header">
	<h3>
		{{Lang::get('backend/permissions/actions.index.description')}}

		<div class="pull-right">
      @if(Sentry::getUser()->hasAccess('site.permissions.create'))
          <a href="{{ route('create/permission') }}" class="btn btn-small btn-info"><i class="icon-plus-sign icon-white"></i> {{Lang::get('backend/permissions/actions.buttons.create')}}</a>
      @endif
		</div>
	</h3>
</div>

{{ $permissions->links() }}

<table class="table table-bordered table-striped table-hover">
	<thead>
		<tr>
			<th class="span1">{{Lang::get('backend/permissions/table.id')}}</th>
			<th class="span2">{{Lang::get('backend/permissions/table.name')}}</th>
			<th class="span6">{{Lang::get('backend/permissions/table.description')}}</th>
			<th class="span2">{{Lang::get('backend/permissions/table.actions')}}</th>
		</tr>
	</thead>
	<tbody>
		@if ($permissions->count() >= 1)
		@foreach ($permissions as $permission)
		<tr>
			<td>{{ $permission->id }}</td>
			<td>{{ $permission->name }}</td>
			<td>{{ $permission->description }}</td>
			<td>
        @if(Sentry::getUser()->hasAccess('site.permissions.edit'))
            <a href="{{ route('update/permission', $permission->id) }}" class="btn btn-mini">{{Lang::get('buttons.edit')}}</a>
        @endif
        @if(Sentry::getUser()->hasAccess('site.permissions.delete'))
            <a href="{{ route('delete/permission', $permission->id) }}" class="btn btn-mini btn-danger">{{Lang::get('buttons.delete')}}</a>
        @endif
			</td>
		</tr>
		@endforeach
		@else
		<tr>
			<td colspan="5">{{Lang::get('backend/permissions/table.no-results')}}</td>
		</tr>
		@endif
	</tbody>
</table>

{{ $permissions->links() }}
@stop
