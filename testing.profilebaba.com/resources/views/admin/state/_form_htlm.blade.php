<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<select  name="coid" id= "country" class="form-control country javascript_select">
								<?php
								$StateController=new App\Http\Controllers\Admin\StateController;
								echo $StateController->country_list([$item->coid ?? 0]);
								?>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							{{ Form::text('stitle',null, ['class' => 'form-control', 'id' => 'stitle', 'placeholder' => 'state Name']) }}
							@if ($errors->has('stitle'))
							<label id="stitle-error" class="error text-danger" for="stitle">
								<small>{{ $errors->first('stitle') }}</small>
							</label>
							@endif
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="isActive">Select Status</label>
							{{ Form::select('status', StaticArray::status2(), NULL, ['class' => 'form-control', 'id' => 'experience']) }}
							@if ($errors->has('status'))
							<label id="status-error" class="error text-danger" for="status">
								<small>{{ $errors->first('status') }}</small>
							</label>
							@endif
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>


	<script src="{{asset('public/admin/assets/bootstrap-fileupload/bootstrap-fileupload.js')}}"></script>
	<script src="{{asset('public/admin/js/jquery.fileuploader.min.js')}}" ></script>
	<link href="{{asset('public/admin/assets/bootstrap-fileupload/bootstrap-fileupload.css')}}"/>