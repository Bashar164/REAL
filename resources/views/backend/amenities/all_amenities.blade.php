@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

			<div class="page-content">

				<nav class="page-breadcrumb">
					<ol class="breadcrumb">
						<a href="{{route('add.amenities')}}" class="btn btn-inverse-info"> Add Amenities </a>
					</ol>
				</nav>

				<div class="row">
					<div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Amenities All</h6>
                <div class="table-responsive">
                  <table id="dataTableExample" class="table">
                    <thead>
                      <tr>
                        <th>Sl </th>
                        <th>Amenities Name </th>
                        <th>Action </th>
                      </tr>
                    </thead>
                    <tbody>

                      @foreach ($amenities as $key=>$amenities)   
                      
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$amenities->amenities_name}}</td>
                        <td>

                          @if(Auth::user()->can('edit.amenities'))
                          <a href="{{route('edit.amenities',$amenities->id)}}" class="btn btn-inverse-warning"> Edit </a>
                          @endif

                          @if(Auth::user()->can('delete.amenities'))
                          <a href="{{route('delete.amenities',$amenities->id)}}" class="btn btn-inverse-danger" id="delete"> Delete </a>
                          @endif
                          
                        </td>
                      </tr>

                      @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
					</div>
				</div>

			</div>
        
@endsection