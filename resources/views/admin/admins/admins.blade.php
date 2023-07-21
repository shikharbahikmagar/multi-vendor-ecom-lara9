@extends('admin.layouts.layout')
@section('content')
<div class="content-wrapper">
   <div class="row">
   </div>
    <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
               <div class="card-body">
                  <h4 class="card-title">{{ $title }}</h4>
                  <div class="table-responsive pt-3">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                            <th>Admin ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                           <tr>
                              <td>{{ $admin['id'] }}</td>
                              <td>{{ $admin['name'] }}</td>
                              <td>{{ $admin['type'] }}</td>
                              <td>{{ $admin['mobile'] }}</td>
                              <td>{{ $admin['email'] }}</td>
                              <td><img src="{{ asset('admin/images/photos/'.$admin['image'] ) }}" alt=""></td>
                              <td>@if($admin['status'] == 1) 
                                 <a href="javascript:void(0)" class="updateAdminStatus" id="admin-{{ $admin['id'] }}" admin_id="{{$admin['id']}}">
                                    <i status="Active" style="font-size: 20px; " class="mdi mdi-check-circle-outline"></i></a>
                               @elseif($admin['status'] == 0)
                               <a href="javascript:void(0)" class="updateAdminStatus" id="admin-{{ $admin['id']}}" admin_id="{{$admin['id']}}">
                              <i style="font-size: 20px; " class="mdi mdi-checkbox-blank-circle-outline" status="InActive"></i></a>
                                 @endif </td>
                              <td>
                                @if($admin['type'] == "vendor")
                                <a href="{{ url('admin/view-vendor-details/'.$admin['id']) }}"><i style="font-size: 20px;" class="mdi mdi-file-document"></i></a>
                            @endif</td>
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
   </div>
</div>

@endsection