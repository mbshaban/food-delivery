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
									<h4 class="card-title" id="basic-layout-form">فرم ثبت فروشنده</h4>
								</div>
								<div class="card-content">
									<div class="card-body">
										<div class="card-text">
											<p>This is the most basic and default form having form sections. To add form section use <code>.form-section</code> class with any heading tags. This form has the buttons on the bottom left corner which is the default position.</p>
										</div>
										<form class="form" action="{{url('/dashboard/sellers/insert')}}" method="POST" enctype="multipart/form-data">
											{{ csrf_field() }}
											<div class="form-body">
												<h4 class="form-section"><i class="ft-user"></i>معلومات شخصی</h4>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="owner_name">نام مالک</label>
															<input type="text" id="owner_name" class="form-control @error('owner_name') is-invalid @enderror" name="owner_name" value="{{ old('owner_name') }}">
															@error('owner_name')
							                                <span class="invalid-feedback" role="alert">
							                                    <strong>{{ $message }}</strong>
							                                </span>
							                                @enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="email">ایمل</label>
															<input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
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
															<input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
															@error('phone')
							                                <span class="invalid-feedback" role="alert">
							                                    <strong>{{ $message }}</strong>
							                                </span>
							                                @enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="business_name">نام فروشگاه</label>
															<input type="text" id="business_name" class="form-control @error('business_name') is-invalid @enderror" name="business_name" value="{{ old('business_name') }}">
															@error('business_name')
							                                <span class="invalid-feedback" role="alert">
							                                    <strong>{{ $message }}</strong>
							                                </span>
							                                @enderror
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="seller_type">نوع تجارت</label>
															<select id="seller_type" name="seller_type" class="form-control" required>
																<option value="none" selected="" disabled="">انتخاب</option>
																<option value="resturant">رستورانت</option>
																<option value="pastry">شیرنی فروشی</option>
																<option value="super-market">سوپر مارکت</option>
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
															<label>لوگو</label>
																<input type="file" name="logo" id="file" class="form-control @error('logo') is-invalid @enderror" value="{{ old('logo') }}">
																@error('logo')
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
															<input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="********" required>
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
															<input type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="********" required>
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
													<input type="text" id="full_address" name="full_address" class="form-control @error('full_address') is-invalid @enderror" placeholder="آدرس" name="company" value="{{ old('full_address') }}">
													@error('full_address')
					                                <span class="invalid-feedback" role="alert">
					                                    <strong>{{ $message }}</strong>
					                                </span>
					                                @enderror
												</div>

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="district_id ">ولسوالی/ناحیه</label>
															<select id="district_id " name="district_id" class="form-control @error('district_id') is-invalid @enderror">
																<option value="0" selected="" disabled="">ناحیه</option>
																@forelse ($districts as $district)
																<option value="{{ $district->id }}">{{ $district->district_name }}</option>
																@empty
																<option></option>
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
															<label for="village">قریه/ساحه</label>
															<input type="text" id="village" name="village" class="form-control @error('village') is-invalid @enderror" placeholder="قریه/ساحه" name="company" value="{{ old('village') }}">
															@error('village')
							                                <span class="invalid-feedback" role="alert">
							                                    <strong>{{ $message }}</strong>
							                                </span>
							                                @enderror
														</div>
													</div>

												</div>
												
												<div class="form-group">
													<label for="geolocation">موقعیت جغرافیایی</label>
													<textarea id="geolocation" rows="5" class="form-control @error('geolocation') is-invalid @enderror" name="geolocation" placeholder="موقعیت جغرافیایی">{{ old('geolocation') }}</textarea>
													@error('geolocation')
					                                <span class="invalid-feedback" role="alert">
					                                    <strong>{{ $message }}</strong>
					                                </span>
					                                @enderror
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
