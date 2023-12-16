<div class="col-md-12">
	<table class="table table-stripped table-hovered" width="405" height="226" border="0">
		<tr>
			<td width="89">Name</td>
			<td width="378"><input class="form-control" type="text" name="name" value="{{ old('name', $data->name ?? '') }}" /></td>
		</tr>
		<tr>

		<tr>
			<td width="89">Username</td>
			<td width="378"><input class="form-control" type="text" name="username" value="{{ old('username', $data->username ?? '') }}" />
			</td>
		</tr>
		<tr>
			<td>Email</td>
			<td><input class="form-control" type="text" name="email" value="{{ old('email', $data->email ?? '') }}" /></td>
		</tr>
		<tr>
			<td>Photo</td>
			<td>
				@if (isset($data))
					@if ($data->profile_pic != '')
						<img class="col-md-4 rounded img-fluid" src="{{ url('/uploads/admin/photo/' . $data->profile_pic) }}"
							style="max-width:200px" />
						<br /><br />
						<div style="clear:both"></div>
					@endif
				@endif

				Upload new ?<br><input class="form-control" type="file" name="photo" />
			</td>
		</tr>
		<tr>
			<td>New Password ?</td>
			<td><input class="form-control" type="password" name="password" /></td>
		</tr>

		@if (isset($admin_foem))
		<tr>
			<td>Role</td>
			<td>
				<div class="form-group">
					<select name="role_id" class="form-control">
						<option value="">Select Role</option>
						@foreach(\App\Role::get() as $role)
						<option value="{{$role->id}}" {{isset($data) ? ($data->role_id == $role->id ? "selected" : "") : ''}}>{{$role->name}}</option>
						@endforeach
					</select>
				</div>
			</td>
		</tr>
		@endif
		
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></td>
		</tr>
	</table>
</div>
 