{{ Form::open(array('action'=>"TalentController@postCreate", 'class'=>'form-signup')) }}
<h2 class="form-signup-heading">Create or modify</h2>

<ul>
    @foreach($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>

{{ Form::text('name', null, array('class'=>'input-block-level', 'placeholder'=>'talent name')) }}
{{ Form::text('weight', null, array('class'=>'input-block-level', 'placeholder'=>'weight')) }}

{{ Form::submit('Add', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}