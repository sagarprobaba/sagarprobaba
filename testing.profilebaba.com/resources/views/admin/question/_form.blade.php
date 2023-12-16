<div>


	<!-- Tab panes -->
	<div class="tab-content">

		<div class="row">

			{{csrf_field()}}
			<div class="col-lg-9">

				<section class="panel">

					<header class="panel-heading">Your question and our answers</header>

					<div class="panel-body">

						<div class="row" >
							<div class="col-md-6">

								<div class="form-group">
									<label for="isActive">Phone:</label>
									<input type="text" name="phone" id="pategoriesPhone" class="form-control" placeholder="Page phone" value="{{ old('phone',  isset($question->phone)?$question->phone:"") }}">

								</div>

							</div>

							<div class="col-md-6">

								<div class="form-group">
									<label for="isActive">Email:</label>
									<input type="text" name="email" id="pategoriesemail" class="form-control" placeholder="Page email" value="{{ old('email',  isset($question->email)?$question->email:"") }}">

								</div>

							</div>

						</div>

						{{-- <div class="row">


							<div class="col-md-12">

								<div class="form-group">
									<label for="isActive">Subject:</label>

									<input type="text" name="subject" id="categoriessubject" class="form-control" placeholder="Page subject" value="{{ old('subject',  isset($question->subject)?$question->subject:"") }}">

								</div>

							</div>

							
						</div> --}}
						<div class="row">


							<div class="col-md-12">

								<div class="form-group">
									<label for="isActive">Paractice Area:</label>
									
									<?php
										$services = \App\Services::all();
									?>

									<select style="width: 100%;" class="form-control selectlist" id="servicesccff" name="area">
										<option value="">Select paractice Area</option>
										@foreach ($services as $servicescc)
											@if ($servicescc->serid == old('area'))
											<option value="{{ $servicescc->serid }}" selected>{{ $servicescc->stitle }}</option>
											@else
											<option value="{{ $servicescc->serid }}">{{ $servicescc->stitle }}</option>
											@endif
										@endforeach
									</select>

									{{-- <input  type="text" name="subject" id="categoriessubject" class="form-control" placeholder="Page subject" value="{{ old('subject',  isset($question->subject)?$question->subject:"") }}"> --}}

								</div>

							</div>

							<div class="col-md-12">

								<div class="form-group">
									<label for="isActive">Sub Area</label>
									
									<select style="width: 100%;" class="form-control selectlist" id="Issueffff" name="issue">
										@if (old('area'))
											<?php
												$items = \App\Issue::where('serid','=',old('area'))->orderby('issuename','ASC')->get();
											?>

											@foreach ($items as $itemscc)
												@if ($itemscc->isid == old('issue'))
												<option value="{{ $itemscc->isid }}" selected>{{ $itemscc->issuename }}</option>
												@else
												<option value="{{ $itemscc->isid }}">{{ $itemscc->issuename }}</option>
												@endif
											@endforeach
										@endif
									</select>

									{{-- <input  type="text" name="subject" id="categoriessubject" class="form-control" placeholder="Page subject" value="{{ old('subject',  isset($question->subject)?$question->subject:"") }}"> --}}

								</div>

							</div>

							
						</div>

						<div class="row">


							<div class="col-md-12">

								<div class="form-group">
									<label for="isActive">Question:</label>
									<textarea class="form-control" name="question">{{ old('question',  isset($question->question)?$question->question:"") }}</textarea>

								</div>

							</div>

							
						</div>
						
						<div class="row">


							<div class="col-md-12">

								<div class="form-group">
									<label for="isActive">Page Url:</label>
									<input  type="text" name="page_url" class="form-control" placeholder="Page url" value="{{ old('page_url',  isset($question->page_url)?$question->page_url:"") }}"> 
								</div>

							</div>

							
						</div>						

						<div class="row">


							<div class="col-md-12">

								<div class="form-group">
									<label for="isActive">Answers:</label>
									<textarea rows="14" class="form-control ckeditor" name="answers" id="categoriesDesc" placeholder="Answers">{{ old('answers',  isset($question->answers)?$question->answers:"") }}</textarea>

								</div>

							</div>

							
						</div>


					</div>
					

				</div>
				
				<input type ="hidden" name="submit" value="submit">

			</div>

		</div>

	</div>

</div>