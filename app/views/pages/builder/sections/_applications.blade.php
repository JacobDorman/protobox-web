<input type="hidden" name="applications[_prevent_empty]" />

<div class="page-header">
    <h1>{{ trans('builder/'.$section_name.'.name') }}</h1>
</div>

<div class="row">
	<div class="col-md-12">
		<p>This section you can use to install popular web applications such as wordpress, drupal, symfony, laravel, etc. It is completely optional, so feel free to proceed to the next section.</p>
	</div>
</div>

<div id="application-group">
@foreach(Input::old('applications', $section->param('applications', [])) as $app_type => $app_group)
@if($app_type != '_prevent_empty')
	@foreach($app_group as $appid => $app)
	<!-- application / {{ $app_type }} -->
	@include('pages.builder.sections.application._'.$app_type, ['type' => 'data'])
	<!-- end application / {{ $app_type }} -->
	@endforeach
@endif
@endforeach
</div>

<div class="row application-selection">
	<div class="form-inline form-group">
		<div class="col-md-12">
			<label for="application-select">New Application:</label> 
			<select id="application-select" class="form-control">
				@foreach($section->applications() as $application => $name)
				<option value="{{ $application }}">{{ $name }}</option>
				@endforeach
			</select>

			<button type="button" class="btn btn-success" data-application="application-select" data-replace="appid:[id],appnewid:[newid]" data-append="#application-group">Add Application</button>
		</div>
	</div>
</div>

@foreach($section->applications() as $app_type => $name)
@if($app_type != '_prevent_empty')
<input type="hidden" id="application-{{ $app_type }}-start" name="application-{{ $app_type }}-start" value="{{ count(Input::old('applications.'.$app_type, $section->param('applications', []))) }}" />
@endif
@endforeach

@foreach($section->applications() as $app_type => $name)
@if($app_type != '_prevent_empty')
<script type="text/template" id="application-{{ $app_type }}-template">
<!-- application / {{ $app_type }} -->
@include('pages.builder.sections.application._'.$app_type, ['type' => 'template', 'appid' => '{appid}'])
<!-- end application / {{ $app_type }} -->
@endif
</script>
@endforeach

@include('pages.builder._continue')

@include('pages.builder._create')
