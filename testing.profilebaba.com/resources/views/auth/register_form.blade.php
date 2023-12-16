 <div class="row">
        <div class="col-md-12">
            <h4>Personal Detail</h4>
        </div>
    </div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Name:</label>
            <input type="text" value="{{ old('name',  $user->name ?? "") }}" name="name" class="form-control" placeholder="Name">
        </div>
    </div>
    @if (!isset($register_form_edit))
    <div class="col-md-6">
        <div class="form-group">
            <label>Email Id:</label>
            <input type="text" value="{{ old('email',  $user->email ?? "") }}" name="email" class="form-control" placeholder="Email Id">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Password:</label>
            <?php 
                $pass_bu = '';
                if(isset($user->email)){
                    $pass_bu = '';
                }
            ?>
            <input type="password" value="{{ $pass_bu }}" name="password" class="form-control" placeholder="Password">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Contact Number:</label>
            <input type="text" value="{{ old('contact_number',  $user->contact_number ?? "") }}" name="contact_number" class="form-control" placeholder="Contact Number">
        </div>
    </div>
    @endif
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Address:</label>
            <textarea class="form-control" name="address" rows="4" placeholder="Address">{{ old('address',  $user->address ?? "") }}</textarea>
        </div>
    </div>
    
</div>