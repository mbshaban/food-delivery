@extends('dashboard.layout.layout')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Dashboard-->
                @if(session()->has('message'))
				    <div class="alert alert-success">
				        {{ session()->get('message') }}
				    </div>
				@endif
                <!--begin::Row-->

 <section class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
            	<h4 class="card-title">مشتریان</h4>
            	<a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
        		<div class="heading-elements">
            		<button class="btn btn-primary btn-sm"><i class="ft-plus white"></i> New Task</button>
        			<span class="dropdown">
                        <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-warning btn-sm dropdown-toggle dropdown-menu-right"><i class="ft-download white"></i></button>
                        <span aria-labelledby="btnSearchDrop1" class="dropdown-menu mt-1 dropdown-menu-right">
                            <a href="#" class="dropdown-item"><i class="fa fa-calendar"></i> Due Date</a>
                            <a href="#" class="dropdown-item"><i class="fa fa-random"></i> Priority </a>
                            <a href="#" class="dropdown-item"><i class="fa fa-bar-chart"></i> Progress</a>
                            <a href="#" class="dropdown-item"><i class="fa fa-user"></i> Assign to</a>
                        </span>
                    </span>
        			<button class="btn btn-success btn-sm"><i class="ft-settings white"></i></button>
                </div>
            </div>
            <div class="card-content">
                <div class="card-body">
	                <!-- Task List table -->
	                <div class="table-responsive">
		                <table id="project-task-list" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
					        <thead>
					            <tr>
					                <th>نام مشتری</th>
					                <th>شماره تماس</th>				                
					                <th>ناحیه</th>				                
					                <th>منطقه</th>
					                <th>عکس</th>
					                <th>عمل</th>
					            </tr>
					        </thead>
					        <tbody>
					        @forelse ($customers as $seller)
					            <tr>
					                <td><h6 class="mb-0">{{$seller->customer_name}}</td>
					                <td><span class="badge badge-default badge-warning">{{$seller->phone}}</span></td>				                
					                <td>{{$seller->district_name}}</td>
					                	
					                <td class="text-center">
					                	{{$seller->village}}
					                </td>
					                <td>
					               		<span class="avatar avatar-online">
					                		<img src="{{url('dashboard/sellers/logo/'.$seller->logo)}}" alt="avatar" data-placement="right" title="{{$seller->logo}}" style="width: 100%">
					                	</span>
					                	
					                </td>
					                <td>
					                	<span class="dropdown">
					                        <button id="btnSearchDrop4" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-info dropdown-toggle"><i class="fa fa-cog"></i></button>
					                        <span aria-labelledby="btnSearchDrop4" class="dropdown-menu mt-1 dropdown-menu-right">
					                            <a href="#" class="dropdown-item"><i class="ft-eye"></i> Open Task</a>
					                            <a href="#" class="dropdown-item"><i class="ft-edit-2"></i> Edit Task</a>
					                            <a href="#" class="dropdown-item"><i class="ft-check"></i> Complete Task</a>
					                            <a href="#" class="dropdown-item"><i class="ft-upload"></i> Assign to</a>
					                            <div class="dropdown-divider"></div>
					                            <a href="#" class="dropdown-item"><i class="ft-trash"></i> Delete Task</a>
					                        </span>
					                    </span>
					                </td>
					            </tr>
					        @empty
					        @endforelse

					        </tbody>

						</table>
					</div>
					<!--/ Task List table -->
				</div>
            </div>
        </div>
    </div>
</section>
                <!--end::Dashboard-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
@stop
