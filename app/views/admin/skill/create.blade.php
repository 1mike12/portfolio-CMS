<h2 class="form-signup-heading">Create or modify</h2>

<ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
{{ Form::open(array('action'=>"SkillController@postCreate", 'class'=>'form-signup')) }}
{{ Form::select('talent_id', Talent::lists("name", "id")) }}
{{ Form::text('name', null, array('class'=>'input-block-level', 'placeholder'=>'skill name')) }}
{{ Form::text('level', null, array('class'=>'input-block-level', 'placeholder'=>'level')) }}

{{ Form::submit('Add', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}