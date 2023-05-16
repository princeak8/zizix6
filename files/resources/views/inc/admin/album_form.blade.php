<div class="form-group">
	{!! Form::label('title', 'TITLE:') !!}
	{!! Form::text('title', null, ['placeholder'=>'ALBUM TITLE', 'class'=>'form-control', 'required']) !!}
</div>

@if($form == 'update')
<div class="form-group">
	{!! Form::label('post', 'Post:') !!}
	<select name="post_id" class="form-control">
		<option value="">SELECT A POST</option>
		@foreach($posts as $post)
			<option value="{{$post->id}}" @if($album->post_id==$post->id) selected @endif>
				{{$post->title}}
			</option>
		@endforeach
	</select>
</div>
@endif

<div class="form-group">
	{!! Form::label('description', 'DESCRIPTION:') !!}
	{!! Form::textarea('description', null, ['placeholder'=>'ALBUM DESCRIPTION', 'id'=>'description-field', 'class'=>'form-control', 'required', 'rows'=>5,]) !!}
</div>

{!! Form::submit($submitBtn, ['class'=>'btn btn-primary form-control']) !!}

{!! Form::close() !!}