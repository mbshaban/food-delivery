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
								<div class="card-content">
									<div class="card-body">
										<div class="card-text">
											<p>This is the most basic and default form having form sections. To add form section use <code>.form-section</code> class with any heading tags. This form has the buttons on the bottom left corner which is the default position.</p>
										</div>
										<form class="form" action="{{url('/dashboard/sellers/update-account')}}" method="POST" enctype="multipart/form-data">
											{{ csrf_field() }}
											<div class="form-body">
												<h4 class="form-section"><i class="ft-user"></i>معلومات کاربری</h4>
												<div class="row">
													
													<div class="col-md-6">
														<div class="form-group">
															<label for="email">ایمل</label>
															<input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$deliver->email}}">
															<input type="hidden" id="user_id"name="user_id" value="{{$deliver->user_id}}">
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
															<input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$deliver->phone}}">
															@error('phone')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                    @enderror
														</div>
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
												<form class="form" action="{{url('/dashboard/delivers/update-info')}}" method="POST" enctype="multipart/form-data">
												{{ csrf_field() }}
												<div class="form-body">
												<h4 class="form-section"><i class="ft-user"></i>معلومات شخصی</h4>
												
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="deliver_name">نام دلیور</label>
															<input type="text" id="deliver_name" class="form-control @error('deliver_name') is-invalid @enderror" name="deliver_name" value="{{$deliver->deliver_name}}">
															<input type="hidden" id="id" name="id" value="{{$deliver->id}}">
															@error('deliver_name')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                    @enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="col-md-8 pull-right">
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
														<div class="col-md-4 pull-left">
															<img src="{{url('dashboard/delivers/profile/'.$deliver->profile_picture)}}" style="width: 100%;">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="district_id ">ولسوالی/ناحیه</label>
															<select id="district_id " name="district_id" class="form-control">
																@forelse ($districts as $district)
																	@if($district->id == $deliver->district_id)
																	<option value="{{ $district->id }}">{{ $district->district_name }}</option>
																	@endif
																@empty
																@endforelse
																@forelse ($districts as $district)
																	@if($district->id != $deliver->district_id)
																	<option value="{{ $district->id }}">{{ $district->district_name }}</option>
																	@endif
																@empty
																@endforelse
															</select>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="village">قریه/ساحه</label>
															<input type="text" id="village" name="village" class="form-control" placeholder="قریه/ساحه" value="{{$deliver->village}}">
														</div>
													</div>
													
												</div>
												<div class="form-group">
														<label for="full_address">آدرس مکمل</label>
														<input type="text" id="full_address" name="full_address" class="form-control" placeholder="آدرس" value="{{$deliver->full_address}}">
													</div>
													<div class="form-group">
														<label for="geolocation">موقعیت جغرافیایی</label>
														<textarea id="geolocation" rows="5" class="form-control" name="geolocation" placeholder="موقعیت جغرافیایی">{{$deliver->village}}</textarea>
													</div>
													<div class="form-actions">
														<button type="button" class="btn btn-warning mr-1">
															<i class="ft-x"></i> Cancel
														</button>
														<button type="submit" class="btn btn-primary">
															<i class="fa fa-check-square-o"></i> Save
														</button>
													</div>
													
												</div>

											</form>
											<form class="form" action="{{url('/dashboard/delivers/update-password')}}" method="POST">
											{{ csrf_field() }}
											<div class="form-body">
												<h4 class="form-section"><i class="ft-user"></i>تبدیل پسورد</h4>
												<div class="row">
													
													<div class="col-md-6">
														<div class="form-group">
															<label for="current_password">پسورد فعلی</label>
															<input type="password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" placeholder="********">
															<input type="hidden" name="user_id" value="{{$deliver->user_id}}">
															@if(session()->has('pfaild'))
										                        <div class="alert alert-danger" style="direction: rtl;">
										                          <button type="button" class="close" data-dismiss="alert" style="float: left;">&times;</button>
										                          <i class="fa fa-ban-circle"></i><strong>{{session('pfaild')}}</strong>
										                        </div>
										                    @endif
															@error('current_password')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                    @enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="password">پسورد جدید</label>
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
				 
                <!--end::Dashboard-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

@stop
