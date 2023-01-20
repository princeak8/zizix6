<div class="form-group">
	{!! Form::label('title', 'TITLE:') !!}
	{!! Form::text('title', null, ['placeholder'=>'POST TITLE', 'class'=>'form-control', 'required']) !!}
</div>

<div class="col-sm-8 col-xs-12 no-padding">
	@if($form == 'update' && !empty($post->cover_photo))
		<img id="cover-img" src="{{env('APP_URL').'files/storage/images/posts/covers/'.$post->cover_photo}}" width="50" height="60" class="col-sm-3 col-xs-5 no_pad_left" />
	@else
		<img id="cover-img" class="col-sm-3 col-xs-5 no_pad_left" />
	@endif
	<span id="cover-info" class="no_pad_left col-sm-6 col-xs-7" ></span>
</div>
				
<div style="clear: both;"></div>

<div class="form-group">
	{!! Form::label('image', 'COVER IMAGE:') !!}
	<input type="file" name="photo" id="cover-photo" class="form-control photo-input" placeholder="COVER PHOTO" />
</div>

<div class="form-group">
	{!! Form::label('album', 'ALBUM:') !!}
	<select name="album_id" required class="form-control">
		<option value="">SELECT AN ALBUM</option>
		@foreach($albums as $album)
			<option value="{{$album->id}}" @if($post->album_id == $album->id) selected @endif>
				{{$album->title}}
			</option>
		@endforeach
	</select>
</div>

<div class="form-group">
	{!! Form::label('preview', 'PREVIEW:') !!}
	{!! Form::textarea('preview', null, ['placeholder'=>'POST PREVIEW', 'id'=>'preview-field', 'class'=>'form-control', 'required', 'rows'=>5,]) !!}
</div>

<div class="form-group" id="post-field-group">
	{!! Form::label('post', 'POST CONTENT:') !!}
	{!! Form::textarea('post', null, ['placeholder'=>'POST CONTENT', 'id'=>'post-field', 'class'=>'form-control tinymce', 'data-error'=>0]) !!}
</div>

{!! Form::submit($submitBtn, ['class'=>'btn btn-primary form-control']) !!}
{!! Form::close() !!}