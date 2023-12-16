<div class="form-group">
                                <ul id="show_location">
                                    @php $location_input = []; @endphp
                                    @if(isset($data->location))
                                    @foreach($data->location as $key => $location)
                                    @php $location_input[] = [$location->service_location,['lat'=>$location->lat_lng->getlat(),'lng'=>$location->lat_lng->getlng()]]; @endphp
                                    <li>{{$location->service_location}}
                                        <span class='btn-danger btn-xs delete_loc' onClick='delete_loc(this)' style='margin:30px' id='{{$key}}'><i class='fa fa-trash-o'></i></span>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                                <input type="hidden" name="service_location" id="locations" value="{{json_encode($location_input)}}"/>
                            </div>
                            <input value="{{$vendor ?? ''}}" name="vendor_id" type="hidden" class="form-control">
                            <div class="form-group">
                                <input
                                    id="searchTextField"
                                    class="form-control"
                                    type="text"
                                    placeholder="Search Box"
                                />
                                <div id="map"></div>
                            </div>

                            <div class="form-group sbtn5 mt-30 text-center">
                                <button type="submit" class="btn btn-shape-round form__submit">SAVE & CONTINUE</button>
                            </div>