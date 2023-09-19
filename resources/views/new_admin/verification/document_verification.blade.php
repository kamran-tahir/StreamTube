
@extends('layouts.admin')



@section('title','Documents')



@section('content-header')

<h1>User Documents</h1>


@endsection



@section('breadcrumb')

    <li class="active"><i class="fa fa-user"></i>User Documents </li>

@endsection



@section('content')
  <div class="row">
   <div class="col-xs-12">
     @include('notification.notify')
        <div class="box box-primary">
         <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>

                 <th>Id</th>
                 <th>First Name</th>
                 <th>Last Name</th>
                 <th>Security Number</th>
                 <th>Email</th>
                 <th>State</th>
                 <th>Zip</th>
                 <th>Country</th>
                 <th>License</th>
                 <th>ID Card</th>
                 <th>Residence Document</th>
                 <th>Status</th>
                 <th>Action</th>
                </tr>
              </thead>
              <tbody>
                 
               <!--  <?
                  echo "<pre>"; 
                  print_r($user_details); 
                  ?> -->
                <tr>
                  <td>{{ $i+1 }}</td>
                  <td>{{ $user_details->first_name }}</td> 
                  <td>{{ $user_details->last_name }}</td> 
                  <td>{{ $user_details->tpi_ssn }}</td> 
                  <td>{{ $user_details->email }}</td> 
                  <td>{{ $user_details->state }}</td> 
                  <td>{{ $user_details->zip_code }}</td> 
                  <td>{{ $user_details->country }}</td> 
                 
                  <td>
                    @if($user_details->driving_lisence_doc)
                    <a role="menuitem" tabindex="-1" href="{{route('document.view' ,['user_id' => $user_details->id])}}">
                      <img class="img-circle" src="{{ $user_details->driving_lisence_doc }}" alt="{{ $user_details->name }}" style="height: 100px;width: 100px;">
                     </a>
                    @else
                    <img class="img-circle" src="{{asset('document.png') }}" alt="{{ $user_details->name }}" style="height: 100px;width: 100px;">
                    @endif
                  </td> 
                  <td>
                    @if($user_details->idcard_doc)
                   
                      <a role="menuitem" tabindex="-1" href="{{route('document.view' ,['user_id' => $user_details->id])}}">
                      <img class="img-circle" src="{{ $user_details->idcard_doc }}" alt="{{ $user_details->name }}" style="height: 100px;width: 100px;">
                     </a>
                    @else
                    <img class="img-circle" src="{{asset('document.png') }}" alt="{{ $user_details->name }}" style="height: 100px;width: 100px;">
                    @endif
                  </td>

                  <td>
                    @if($user_details->residence_doc)
                     <a role="menuitem" tabindex="-1" href="{{route('document.residence' ,['user_id' => $user_details->id])}}">
                     <img class="img-circle" src="{{ $user_details->residence_doc }}" alt="{{ $user_details->name }}" style="height: 100px;width: 100px;">
                    </a>
                    @else
                    <img class="img-circle" src="{{asset('document.png') }}" alt="{{ $user_details->name }}" style="height: 100px;width: 100px;">
                    @endif
                  </td>  
                  <td>                          
                          @if($user_details->status == USER_APPROVED)
                            <span class="label label-success">{{ tr('approved') }}</span>
                          @else
                            <span class="label label-warning">{{ tr('pending') }}</span>
                          @endif
                        </td>     
                  <td>



                                   <!--    <ul class="admin-action btn btn-default">



                                           <li class="dropdown">

                                               <a class="dropdown-toggle" data-toggle="dropdown" href="#">

                                                   {{ tr('action') }} <span class="caret"></span>

                                                </a>

                                               <ul class="dropdown-menu dropdown-menu-right">
                                                    <li role="presentation"></li> -->

    <!-- <li class="divider" role="presentation"></li> -->



         @if($user_details->status == USER_APPROVED )



           <!-- <li role="presentation"> -->

           <a role="menuitem" tabindex="-1" href="{{ route('admin.users.status', ['user_id' => $user_details->id] ) }}" onclick="return confirm(&quot;{{ tr('admin_user_decline_confirmation', $user_details->name) }}&quot;)">

         <span class="text-danger">{{ tr('decline') }}</span>

                                                            </a>

                                                       <!-- </li> -->



                                                   @else



           <!-- <li role="presentation"> -->
      <a role="menuitem"  tabindex="-1" href="{{ route('admin.users.status',['user_id' => $user_details->id] ) }}" onclick="return confirm(&quot;{{ tr('admin_user_approve_confirmation', $user_details->name) }}&quot;)" >

              <span class="text-success">{{ tr('approve') }}</span></a>
            <!-- </li> -->

                @endif



   <!-- <li class="divider" role="presentation"></li> -->



                                         <!--        </ul>



                                          </li>



                                       </ul> -->



                                </td>
               </tr>
                  

              </tbody>
            </table>
          </div>
        </div>

    </div>
  </div>
@endsection

