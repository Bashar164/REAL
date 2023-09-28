@extends('agent.agent_dashboard')
@section('agent')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    

<div class="page-content">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
                    <h6 class="card-title">Property Details  </h6>
                    <div class="table-responsive">
                            <table class="table table-striped">
                               
                                <tbody>
                                    <tr>
                                        <th>Property Name </th>
                                        <td><code>{{ $property->property_name }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Property Status </th>
                                        <td><code>{{ $property->property_status }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Lowest Price </th>
                                        <td><code>{{ $property->lowest_price }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Max Price </th>
                                        <td><code>{{ $property->max_price }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>BedRooms </th>
                                        <td><code>{{ $property->bedrooms }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Bathrooms </th>
                                        <td><code>{{ $property->bathrooms }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Garage </th>
                                        <td><code>{{ $property->garage }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Garage Size </th>
                                        <td><code>{{ $property->garage_size }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Address </th>
                                        <td><code>{{ $property->address }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>City </th>
                                        <td><code>{{ $property->city }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>State </th>
                                        <td><code>{{ $property['pstate']['state_name'] }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Main Image </th>
                                        <td><img src="{{ asset( $property->property_thumbnail) }}" style="width: 100px; height:70px;"></td>
                                    </tr>
                                    <tr>
                                        <th>Status </th>
                                        <td>
                                            @if ($property->status == 1)
                                            <span class="badge rounded-pill bg-success">Active</span>
                                            @else
                                            <span class="badge rounded-pill bg-danger">InActive</span>   
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
  </div>
</div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
<div class="card">
  <div class="card-body">
                    <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>property Code </th>
                                        <td><code>{{ $property->property_code }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>property Size </th>
                                        <td><code>{{ $property->property_size }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>property video </th>
                                        <td><code>{{ $property->property_video }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Neighborhood </th>
                                        <td><code>{{ $property->neighborhood }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Latitude </th>
                                        <td><code>{{ $property->latitude }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Longitude </th>
                                        <td><code>{{ $property->longitude }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Property Type </th>
                                        <td><code>{{ $property['type']['type_name'] }}</code></td>
                                    </tr>
                                    <tr>
                                        <th>Amenities </th>
                                        <td>
                                            <select name="amenities_id[]" class="js-example-basic-multiple form-select" multiple="multiple" data-width="100%">

                                                @foreach ( $amenities as $amenity)

                                                <option value="{{$amenity->amenities_name}}"{{ (in_array($amenity->amenities_name,$property_ami)) ? 'selected' : '' }}> {{$amenity->amenities_name}}</option>

                                                @endforeach
                                                
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Agent </th>
                                        
                                        @if($property->agent_id == Null)
                                        <td><code>Admin</code></td>
                                        @else
                                        <td><code>{{$property['user']['name']}}</code></td>
                                        @endif
                                        
                                    </tr>
                                </tbody>                               
                            </table>

                    </div>
  </div>
</div>
        </div>
    </div>
   
</div>


@endsection
