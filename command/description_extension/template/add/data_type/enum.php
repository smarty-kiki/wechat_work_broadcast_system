@if (count($entity_name::struct_formaters($struct_name)) > 6)

<select name="{{ $struct_name }}" lay-verify="required" lay-filter="aihao" lay-search>
  <option value=""></option>
@foreach ($entity_name::struct_formaters[$struct_name] as $key => $value)
  <option value="{{ $key }}">{{ $value }}</option>
@endforeach
</select>

@else

@foreach ($entity_name::struct_formaters($struct_name) as $key => $value)
<input type="radio" name="{{ $struct_name }}" value="{{ $key }}" title="{{ $value }}">
@endforeach

@endif
