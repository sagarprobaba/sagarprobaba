@extends('admin.layout.master')
@section('page_title',ucfirst($type))
@section('title',ucfirst($type))
@section('container')
@if(Session::has('message'))
<div class="alert alert-success">
    {{ Session::get('message') }}
</div>
@endif                                                       
@if (Session::has('errors'))
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    {{ $error }}<br/>
    @endforeach
</div>
@endif

<form action="{{url('/admin/setting/')}}"   method="post" enctype="multipart/form-data">

    <input type="hidden" name="_method" value="PUT" />
    {{csrf_field()}}
    <?php $setting = new App\Setting; ?>
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab" aria-expanded="true">1st Section</a></li>
            <li role="presentation" class=""><a href="#image" aria-controls="image" role="tab" data-toggle="tab" aria-expanded="false">2nd Section</a></li>
            <li role="presentation" class=""><a href="#attribute" aria-controls="attribute" role="tab" data-toggle="tab" aria-expanded="false">3rd Section</a></li>
        </ul>
        <div class="tab-content">
            <!-- first section -->
            <div role="tabpanel" class="tab-pane active" id="general">
                <table width="100%" class="table table-striped table-hovered"  >

                    <tr>
                        <td>

                            <table width="100%" height="75" border="0">
                                <tr>
                                    <td width="22%">Admin Email</td>
                                    <td width="78%">
                                        <input type="hidden" name="meta_key[]" value="admin_email" />
                                        <input class="form-control" type="text" name="meta_value[]"  value="{{$setting->get_setting('admin_email')}}"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="22%">Admin Mobile</td>
                                    <td width="78%">
                                        <input type="hidden" name="meta_key[]" value="admin_mobile" />
                                        <input class="form-control" type="text" name="meta_value[]"  value="{{$setting->get_setting('admin_mobile')}}"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="22%">Meta Title</td>
                                    <td width="78%">
                                        <input type="hidden" name="meta_key[]" value="meta_title" />    
                                        <input class="form-control" type="text" name="meta_value[]"  value="{{$setting->get_setting('meta_title')}}"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="22%">Meta Keyword</td>
                                    <td width="78%">
                                        <input type="hidden" name="meta_key[]" value="meta_keyword" />  
                                        <input class="form-control" type="text" name="meta_value[]"  value="{{$setting->get_setting('meta_keyword')}}"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="22%">Meta Description</td>
                                    <td width="78%">
                                        <input type="hidden" name="meta_key[]" value="meta_description" />
                                        <textarea rows="4" class="form-control" name="meta_value[]"  >{{$setting->get_setting('meta_description')}}</textarea>
                                    </td>
                                </tr>

                            </table>

                        </td>
                    </tr>

                </table>
            </div>
            <!-- end first section -->

            <!-- second section -->
            <div role="tabpanel" class="tab-pane" id="image">
                <table width="100%" class="table table-striped table-hovered"  >

                    <tr>

                        <td>
                            <table width="100%" height="75" border="0">

                                <tr>
                                    <td width="22%">User listing Per Page</td>
                                    <td width="78%">
                                        <input type="hidden" name="meta_key[]" value="lawyer_listing_per_page" />
                                        <input class="form-control" type="number" style="width:60px" name="meta_value[]"  min="1" value="{{$setting->get_setting('lawyer_listing_per_page')}}"/>
                                    </td>

                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                </table>
            </div>
            <!-- end second section -->

            <!-- third section -->
            <div role="tabpanel" class="tab-pane" id="attribute">
                <table width="100%" class="table table-striped table-hovered"  >

                    <tr>

                        <td>
                            <table width="100%" height="75" border="0">

                                <tr>
                                    <td width="22%">Faceboook Url</td>
                                    <td width="78%">
                                        <input type="hidden" name="meta_key[]" value="facebook_url" />
                                        <input class="form-control" type="text" style="width:200px" name="meta_value[]"   value="{{$setting->get_setting('facebook_url')}}"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="22%">Twitter Url</td>
                                    <td width="78%">
                                        <input type="hidden" name="meta_key[]" value="twitter_url" />
                                        <input class="form-control" type="text" style="width:200px" name="meta_value[]"  value="{{$setting->get_setting('twitter_url')}}"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="22%">Linkedin Url</td>
                                    <td width="78%">
                                        <input type="hidden" name="meta_key[]" value="linkedin_url" />
                                        <input class="form-control" type="text" style="width:200px" name="meta_value[]"   value="{{$setting->get_setting('linkedin_url')}}"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="22%">Instagram Url</td>
                                    <td width="78%">
                                        <input type="hidden" name="meta_key[]" value="instagram_url" />
                                        <input class="form-control" type="text" style="width:200px" name="meta_value[]"   value="{{$setting->get_setting('instagram_url')}}"/>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td width="22%">Youtube Url</td>
                                    <td width="78%">
                                        <input type="hidden" name="meta_key[]" value="youtube_url" />
                                        <input class="form-control" type="text" style="width:200px" name="meta_value[]"   value="{{$setting->get_setting('youtube_url')}}"/>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="22%">Pinterest Url</td>
                                    <td width="78%">
                                        <input type="hidden" name="meta_key[]" value="pinterest_url" />
                                        <input class="form-control" type="text" style="width:200px" name="meta_value[]"   value="{{$setting->get_setting('pinterest_url')}}"/>
                                    </td>
                                </tr>               

                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- end third section -->
            <input type="submit" name="submit" value="Update" class="btn btn-primary" />

        </div>
    </div>
</form>
@endsection
