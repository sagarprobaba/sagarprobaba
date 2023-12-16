<div>


	<!-- Tab panes -->
	<div class="tab-content">

		<div class="row">

			{{csrf_field()}}
			<div class="col-lg-9">

				<section class="panel">

					<header class="panel-heading">Home blog Details</header>

					<div class="panel-body">

						<div class="row">


							<div class="col-md-12">

								<div class="form-group">
									<label for="isActive">Title:</label>

									<input type="text" name="title" id="categoriesTitle" class="form-control" placeholder="Page title" value="{{ old('title',  isset($blog->title)?$blog->title:"") }}">

								</div>

							</div>

							
						</div>

						<div class="row">


							<div class="col-md-12">

								<div class="form-group">
									<label for="isActive">Paragraph:</label>
									<textarea class="form-control" name="paragraph">{{ old('paragraph',  isset($blog->paragraph)?$blog->paragraph:"") }}</textarea>

								</div>

							</div>

							
						</div>


						<div class="row" >
							<div class="col-md-4">

								<div class="form-group">
									<label for="isActive">Image:</label>
									<input type="file" name="image">

								</div>

							</div>

							<div class="col-md-4">

								<div class="form-group">

									<label for="isActive">Select Status:</label>

									<select name="status" id="isActive" class="form-control">

										<option {{ (isset($blog->status)?$blog->status:"")=='1'?'selected':"" }} value="1">Active</option>

										<option {{ (isset($blog->status)?$blog->status:"")=='0'?'selected':"" }} value="0">Deactive</option>

									</select>

								</div>

							</div>

							<div class="col-md-4">

								<div class="form-group">

									<label for="isActive">Home show:</label>

									<select name="is_ficher" id="isActive" class="form-control">

										<option {{ (isset($blog->is_ficher)?$blog->is_ficher:"")=='1'?'selected':"" }} value="1">Yes</option>

										<option {{ (isset($blog->is_ficher)?$blog->is_ficher:"")=='0'?'selected':"" }} value="0">NO</option>

									</select>

								</div>

							</div>

						</div>
					</div>

					<div class="form-group">
						<label for="isActive">Description:</label>

						<textarea rows="14" class="form-control ckeditor" name="body" id="categoriesDesc" placeholder="Products Description">{{ old('body',  isset($blog->body)?$blog->body:"") }}</textarea>

					</div>

				</div>
				
				<input type ="hidden" name="submit" value="submit">

			</div>

		</div>

	</div>

</div>