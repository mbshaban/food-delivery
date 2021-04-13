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
                <section id="basic-form-layouts">
					<div class="row match-height">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title" id="basic-layout-form">سفارشات</h4>
								</div>
								<div class="card-content collapse">
									<div class="card-body">
										<div class="card-text">
											<p>This is the most basic and default form having form sections. To add form section use <code>.form-section</code> class with any heading tags. This form has the buttons on the bottom left corner which is the default position.</p>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
                </section>
                <!--end::Row-->
				 <section class="row">
				    <div class="col-12">
				        <div class="card">
				            <div class="card-header">
				            	<h4 class="card-title">سفارشها</h4>
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
									                <th>نام تجارت</th>
									                <th>مالک</th>				                
									                <th>نوع تجارت</th>				                
									                <th>لوگو</th>
									                <th>عمل</th>
									            </tr>
									        </thead>
									        <tbody>
									        @forelse ($sellers as $seller)
									            <tr>
									                <td><h6 class="mb-0">{{$seller->business_name}}</td>
									                <td><span class="badge badge-default badge-warning">{{$seller->owner_name}}</span></td>				                
									                <td>{{$seller->seller_type}}</td>
									                
									                <td class="text-center">
									                	<span class="avatar avatar-online">
									                		<img src="{{url('dashboard/sellers/logo/'.$seller->logo)}}" alt="avatar" data-placement="right" title="{{$seller->logo}}" style="width: 100%">
									                	</span>
									                </td>
									                <td>
									                	<button title="بروز رسانی"
                                                                onclick="window.location='{{ url('dashboard/sellers/edit/'.$seller->id) }}'"
                                                                class="btn btn-success">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button onclick="" data-toggle="modal" data-target="#delete"
                                                                title="حذف"
                                                                class="btn btn-danger">
                                                            <i class="fa fa-times"></i>
                                                        </button>
									                </td>
									            </tr>
									            <div id="delete" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h2 class="modal-title text-right">پنجره تاییدی</h2>
                                                                <button type="button" class="close text-left "
                                                                        data-dismiss="modal">&times;
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h4 align="center" style="margin: 0">آیا با حذف {{$seller->business_name}} موافق هستید؟</h4>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal"
                                                                        class="btn btn-warning">لغو
                                                                </button>
                                                                <button type="button"
                                                                        onclick="deleteSeller({{$seller->id}})"
                                                                        class="btn btn-danger">تایید
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
    <script type="text/javascript">
        function deleteSeller(id) {
        	var headers = {
	    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
            $.ajax({
                url: "sellers/delete",
                type: "post",
                headers: headers,
                data: {'id': id},
                dataType: "text",
                success: function (monitordata) {
                    if (monitordata === "success") {
                        window.location.href = 'sellers';
                    }
                }
            });
        }
    </script>
@stop
