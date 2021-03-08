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
										<form class="form" action="{{url('/dashboard/sellers/update-account')}}" method="POST">
											{{ csrf_field() }}
											<div class="form-body">
												<h4 class="form-section"><i class="ft-user"></i>ایمل و شماره تماس</h4>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="email">ایمل</label>
															<input type="text" id="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{$seller->email}}">
															<input type="hidden" name="user_id" value="{{$seller->user_id}}">
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
															<input type="text" id="phone" class="form-control" name="phone" value="{{$seller->phone}}">
														</div>
													</div>
												</div>
											</div>

											<div class="form-actions">
												<button type="submit" class="btn btn-primary">
													<i class="fa fa-check-square-o"></i> ذخیره
												</button>
											</div>
										</form>
										<form class="form" action="{{url('/dashboard/sellers/update-info')}}" method="POST" enctype="multipart/form-data">
											{{ csrf_field() }}
											<div class="form-body">
												<h4 class="form-section"><i class="fa fa-paperclip"></i> معلومات شخصی</h4>

												<div class="row">
													<div class="col-md-6">
														<label for="business_name">نام تجارت</label>
														<input type="text" id="business_name" name="business_name" class="form-control @error('business_name') is-invalid @enderror" placeholder="نام" value="@if($seller) {{$seller->business_name}} @endif">
														<input type="hidden" name="user_id" value="{{$seller->user_id}}">
														@error('business_name')
				                                    <span class="invalid-feedback" role="alert">
				                                        <strong>{{ $message }}</strong>
				                                    </span>
				                                    @enderror
													</div>
													<div class="col-md-6">
														<label for="owner_name">نام مالک</label>
														<input type="text" id="owner_name" name="owner_name" class="form-control @error('owner_name') is-invalid @enderror" placeholder="نام" value="@if($seller) {{$seller->owner_name}} @endif">
														@error('owner_name')
				                                    <span class="invalid-feedback" role="alert">
				                                        <strong>{{ $message }}</strong>
				                                    </span>
				                                    @enderror
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="district_id ">ولسوالی/ناحیه</label>
															<select id="district_id " name="district_id" class="form-control @error('district_id') is-invalid @enderror">
																@forelse ($districts as $district)
																	@if($seller && ($district->id == $seller->district_id))
																	<option value="{{ $district->id }}">{{ $district->district_name }}</option>
																	@endif
																@empty
																@endforelse
																@forelse ($districts as $district)
																	<option value="{{ $district->id }}">{{ $district->district_name }}</option>
																@empty
																@endforelse
															</select>
															@error('district_id')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                    @enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="seller_type ">نوع تجارت</label>
															<select id="seller_type " name="seller_type" class="form-control @error('seller_type') is-invalid @enderror">
																<option value="{{ $seller->seller_type }}">{{ $seller->seller_type }}</option>
															</select>
															@error('seller_type')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                    @enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="village">قریه/ساحه</label>
															<input type="text" id="village" name="village" class="form-control @error('village') is-invalid @enderror" placeholder="قریه/ساحه" value="@if($seller) {{$seller->village}} @endif">
															@error('village')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                    @enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="col-md-8">
															<label for="logo">لوگو</label>
															<input type="file" id="logo" name="logo" class="form-control @error('logo') is-invalid @enderror">
															@error('logo')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                    @enderror
														</div>
														<div class="col-md-4">
															
														</div>
													</div>
												</div>
												<div class="form-group">
													<label for="full_address">آدرس مکمل</label>
													<input type="text" id="full_address" name="full_address" class="form-control @error('full_address') is-invalid @enderror" placeholder="نام" value="@if($seller) {{$seller->full_address}} @endif">
													@error('full_address')
				                                    <span class="invalid-feedback" role="alert">
				                                        <strong>{{ $message }}</strong>
				                                    </span>
				                                    @enderror
												</div>
												<div class="form-group">
													<label for="geolocation">موقعیت جغرافیایی</label>
													<textarea id="geolocation" rows="5" class="form-control @error('geolocation') is-invalid @enderror" name="geolocation" placeholder="موقعیت جغرافیایی">@if($seller) {{$seller->geolocation}} @endif</textarea>
													@error('geolocation')
				                                    <span class="invalid-feedback" role="alert">
				                                        <strong>{{ $message }}</strong>
				                                    </span>
				                                    @enderror
												</div>
												
											</div>

											<div class="form-actions">
												<button type="submit" class="btn btn-primary">
													<i class="fa fa-check-square-o"></i> ذخیره
												</button>
											</div>
										</form>

										<form class="form" action="{{url('/dashboard/sellers/update-password')}}" method="POST" enctype="multipart/form-data">
											{{ csrf_field() }}
											<div class="form-body">
												<h4 class="form-section"><i class="fa fa-paperclip"></i> پسورد</h4>

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="current_password">پسورد فعلی</label>
															<input type="text" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="پسورد فعلی">
															<input type="hidden" name="user_id" value="{{$seller->user_id}}">
															@if(session()->has('pfaild'))
										                        <div class="alert alert-danger" style="direction: rtl;">
										                          <button type="button" class="close" data-dismiss="alert" style="float: left;">&times;</button>
										                          <i class="fa fa-ban-circle"></i><strong>{{session('pfaild')}}</strong>
										                        </div>
										                    @endif
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="password">پسورد جدید</label>
															<input type="text" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="پسورد جدید">
															@error('password')
						                                    <span class="invalid-feedback" role="alert">
						                                        <strong>{{ $message }}</strong>
						                                    </span>
						                                    @enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="password_confirmation">تکرار پسورد جدید</label>
															<input type="text" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="تکرار پسورد جدید">
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
												<button type="submit" class="btn btn-primary">
													<i class="fa fa-check-square-o"></i> ذخیره
												</button>
											</div>
										</form>
									</div>
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
