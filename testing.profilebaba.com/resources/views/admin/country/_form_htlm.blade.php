<div class="row">
	<div class="col-lg-9">
		<div class="form-group">
			{{ Form::text('title',null, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Country Name']) }}

			@if ($errors->has('title'))
			<label id="title-error" class="error text-danger" for="title">
				<small>{{ $errors->first('title') }}</small>
			</label>
			@endif
		</div>
		<div class="form-group">

			{{ Form::textarea('body',null, ['class' => 'form-control ckeditor','rows' => '3' , 'id' => 'body', 'placeholder' => 'Country Description']) }}

			@if ($errors->has('body'))
			<label id="body-error" class="error text-danger" for="body">
				<small>{{ $errors->first('body') }}</small>
			</label>
			@endif
		</div>
	</div>
	<div class="col-lg-3 removePaddingLeft">
		<div class="form-group">
			<label for="isActive">Select Status:</label>
			{{ Form::select('status', StaticArray::status2(), NULL, ['class' => 'form-control', 'id' => 'experience']) }}
			@if ($errors->has('status'))
			<label id="status-error" class="error text-danger" for="status">
				<small>{{ $errors->first('status') }}</small>
			</label>
			@endif
		</div>
		<div class="form-group last">
			<label for="categoriesImage">Image:</label>
			<div class="fileupload fileupload-new" data-provides="fileupload">
				<div class="fileupload-preview fileupload-exists thumbnail img-responsive">
					@if (isset($item->image))
					<img src="{{ CustomValue::filecheck($item->image,'uploads/country/') }}" class="img-responsive" width="200" />
					@else
					<img src="{{ asset('uploads/users/1608085470_lc5.png') }}" class="img-responsive" width="200" />
					@endif
				</div>
				<div>
					<span class="btn btn-white btn-file">
						<input type="file" name="image" id="categoriesImage" class="default" />
					</span>
				</div>
			</div>
		</div>
	</div>

</div>

<script src="{{asset('public/admin/assets/bootstrap-fileupload/bootstrap-fileupload.js')}}"></script>
<script src="{{asset('public/admin/js/jquery.fileuploader.min.js')}}" ></script>
<link href="{{asset('public/admin/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}"/>