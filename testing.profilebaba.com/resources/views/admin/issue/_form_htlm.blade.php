<div class="form-group">
	{{ Form::label(' Business category ', ' Business category ') }}
	<select  class=" form-control javascript_select " name="cid[]" multiple="multiple">
		<?php 
		$cid = explode(",",$item->cid);

		$product_controller=new App\Http\Controllers\Admin\CategoryController;
		echo $product_controller->cat_list(0,'',old('cid', $cid ?? [0])); 
		?>
	</select>
</div>
<div class="form-group">
	{{ Form::text('issuename',null, ['class' => 'form-control', 'id' => 'issuename', 'placeholder' => 'Work and service']) }}

	@if ($errors->has('issuename'))
	<label id="name-error" class="error text-danger" for="name">
		<small>{{ $errors->first('issuename') }}</small>
	</label>
	@endif

</div>
