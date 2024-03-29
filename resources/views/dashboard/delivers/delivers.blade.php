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
									<h4 class="card-title" id="basic-layout-form">افزودن دلیور</h4>
									<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
									<div class="heading-elements">
										<ul class="list-inline mb-0">
											<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
											<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
											<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
											<li><a data-action="close"><i class="ft-x"></i></a></li>
										</ul>
									</div>
								</div>
								<div class="card-content collapse">
									<div class="card-body">
										<div class="card-text">
											<p>This is the most basic and default form having form sections. To add form section use <code>.form-section</code> class with any heading tags. This form has the buttons on the bottom left corner which is the default position.</p>
										</div>
										<form class="form" action="{{url('/dashboard/delivers/insert')}}" method="POST" enctype="multipart/form-data">
											{{ csrf_field() }}
											<div class="form-body">
												<h4 class="form-section"><i class="ft-user"></i>معلومات شخصی</h4>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="deliver_name">نام دلیور</label>
															<input type="text" id="deliver_name" class="form-control @error('deliver_name') is-invalid @enderror" name="deliver_name">
															@error('email')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                    @enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="email">ایمل</label>
															<input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email">
															@error('email')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                    @enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="phone">شماره تماس</label>
															<input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone">
															@error('phone')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                    @enderror
														</div>
													</div>
													<div class="col-md-6">
														
														<div class="form-group">
															<label>تصویر پروفایل</label>
																<input type="file" name="profile_picture" id="file" class="form-control @error('profile_picture') is-invalid @enderror">
																@error('profile_picture')
							                                    <span class="invalid-feedback" role="alert">
							                                        <strong>{{ $message }}</strong>
							                                    </span>
							                                    @enderror
																<span class="file-custom"></span>	
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="password">پسورد</label>
															<input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="********">
															@error('password')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                    @enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="password_confirmation">تکرار پسورد</label>
															<input type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="********">
															@error('password_confirmation')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                    @enderror
														</div>
													</div>
													
												</div>


												<h4 class="form-section"><i class="fa fa-paperclip"></i> موقعیت</h4>

												<div class="form-group">
													<label for="full_address">آدرس مکمل</label>
													<input type="text" id="full_address" name="full_address" class="form-control" placeholder="آدرس" name="company">
												</div>

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="district_id ">ولسوالی/ناحیه</label>
															<select id="district_id " name="district_id" class="form-control">
																<option value="0" selected="" disabled="">ناحیه</option>
																@forelse ($districts as $district)
																<option value="{{ $district->id }}">{{ $district->district_name }}</option>
																@empty
																<option></option>
																@endforelse
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="village">قریه/ساحه</label>
															<input type="text" id="village" name="village" class="form-control" placeholder="قریه/ساحه" name="company">
														</div>
													</div>

												</div>
												
												<div class="form-group">
													<label for="geolocation">موقعیت جغرافیایی</label>
													<textarea id="geolocation" rows="5" class="form-control" name="geolocation" placeholder="موقعیت جغرافیایی"></textarea>
												</div>
											</div>

											<div class="form-actions">
												<button type="button" class="btn btn-warning mr-1">
													<i class="ft-x"></i> Cancel
												</button>
												<button type="submit" class="btn btn-primary">
													<i class="fa fa-check-square-o"></i> Save
												</button>
											</div>
										</form>
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
				            	<h4 class="card-title">دلیورها</h4>
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
									                <th>نام دلیور</th>		                
									                <th>تماس</th>	
									                <th>ناحیه</th>			                
									                <th>تصویر</th>
									                <th>عمل</th>
									            </tr>
									        </thead>
									        <tbody>
									        @forelse ($delivers as $deliver)
									            <tr>
									                <td><h6 class="mb-0">{{$deliver->deliver_name}}</td>
									                <td><span class="badge badge-default badge-warning">{{$deliver->phone}}</span></td>				                
									                <td>{{$deliver->district_name}}</td>
									                
									                <td class="text-center">
									                	<span class="avatar avatar-online">
									                		<img src="{{url('dashboard/delivers/profile/'.$deliver->profile_picture)}}" alt="avatar" data-placement="right" title="{{$deliver->logo}}" style="width: 100%">
									                	</span>
									                </td>
									                <td>
									                	<button title="بروز رسانی"
                                                                onclick="window.location='{{ url('dashboard/delivers/edit/'.$deliver->id) }}'"
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
                                                                <h4 align="center" style="margin: 0">آیا با حذف {{$deliver->deliver_name}} موافق هستید؟</h4>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal"
                                                                        class="btn btn-warning">لغو
                                                                </button>
                                                                <button type="button"
                                                                        onclick="deleteDeliver({{$deliver->id}})"
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
        function deleteDeliver(id) {
        	var headers = {
	    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
            $.ajax({
                url: "delivers/delete",
                type: "post",
                headers: headers,
                data: {'id': id},
                dataType: "text",
                success: function (monitordata) {
                    if (monitordata === "success") {
                        window.location.href = 'delivers';
                    }
                }
            });
        }
    </script>
@stop
