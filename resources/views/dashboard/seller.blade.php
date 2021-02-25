@extends('dashboard.layout.layout')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Dashboard-->

                <!--begin::Row-->
                <section id="basic-form-layouts">
	<div class="row match-height">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form">افزودن فروشنده</h4>
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
				<div class="card-content collapse show">
					<div class="card-body">
						<div class="card-text">
							<p>This is the most basic and default form having form sections. To add form section use <code>.form-section</code> class with any heading tags. This form has the buttons on the bottom left corner which is the default position.</p>
						</div>
						<form class="form">
							<div class="form-body">
								<h4 class="form-section"><i class="ft-user"></i>معلومات شخصی</h4>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="projectinput1">نام مالک</label>
											<input type="text" id="projectinput1" class="form-control" name="fname">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="projectinput2">نام فروشگاه</label>
											<input type="text" id="projectinput2" class="form-control" name="lname">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="projectinput5">نوع تجارت</label>
											<select id="projectinput5" name="interested" class="form-control">
												<option value="none" selected="" disabled="">انتخاب</option>
												<option value="resturant">رستورانت</option>
												<option value="pastry">شیرنی فروشی</option>
												<option value="super-market">سوپر مارکت</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>لوگو</label>
											<label id="projectinput7" class="file center-block">
												<input type="file" id="file">
												<span class="file-custom"></span>
											</label>
										</div>
									</div>
									
								</div>


								<h4 class="form-section"><i class="fa fa-paperclip"></i> موقعیت</h4>

								<div class="form-group">
									<label for="companyName">آدرس مکمل</label>
									<input type="text" id="companyName" class="form-control" placeholder="آدرس" name="company">
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="projectinput6">ولایت</label>
											<select id="projectinput6" name="budget" class="form-control">
												<option value="0" selected="" disabled="">ولایت</option>
												<option value="less than 5000$">کابل</option>
												<option value="5000$ - 10000$">هرات</option>
												<option value="10000$ - 20000$">بلخ</option>
												<option value="more than 20000$">more than 20000$</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="projectinput6">ولسوالی/ناحیه</label>
											<select id="projectinput6" name="budget" class="form-control">
												<option value="0" selected="" disabled="">ناحیه</option>
												<option value="less than 5000$">ناحیه اول</option>
												<option value="5000$ - 10000$">ناحیه دوم</option>
												<option value="10000$ - 20000$">ناحیه سوم</option>
												<option value="more than 20000$">more than 20000$</option>
											</select>
										</div>
									</div>
									
								</div>
								<div class="form-group">
									<label for="companyName">قریه/ساحه</label>
									<input type="text" id="companyName" class="form-control" placeholder="قریه/ساحه" name="company">
								</div>

								<div class="form-group">
									<label for="projectinput8">موقعیت جغرافیایی</label>
									<textarea id="projectinput8" rows="5" class="form-control" name="comment" placeholder="موقعیت جغرافیایی"></textarea>
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

		<div class="col-md-6">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-colored-form-control">User Profile</h4>
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
				<div class="card-content collapse show">
					<div class="card-body">

						<div class="card-text">
							<p>You can always change the border color of the form controls using <code>border-*</code> class. In this example we have user <code>border-primary</code> class for form controls. Form action buttons are on the bottom right position.</p>
						</div>

						<form class="form">
							<div class="form-body">
								<h4 class="form-section"><i class="fa fa-eye"></i> About User</h4>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="userinput1">Fist Name</label>
											<input type="text" id="userinput1" class="form-control border-primary" placeholder="Name" name="name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="userinput2">Last Name</label>
											<input type="text" id="userinput2" class="form-control border-primary" placeholder="Company" name="company">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="userinput3">Username</label>
											<input type="text" id="userinput3" class="form-control border-primary" placeholder="Username" name="username">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="userinput4">Nick Name</label>
											<input type="text" id="userinput4" class="form-control border-primary" placeholder="Nick Name" name="nickname">
										</div>
									</div>
								</div>

								<h4 class="form-section"><i class="ft-mail"></i> Contact Info & Bio</h4>

								<div class="form-group">
									<label for="userinput5">Email</label>
									<input class="form-control border-primary" type="email" placeholder="email" id="userinput5">
								</div>

								<div class="form-group">
									<label for="userinput6">Website</label>
									<input class="form-control border-primary" type="url" placeholder="http://" id="userinput6">
								</div>

								<div class="form-group">
									<label>Contact Number</label>
									<input class="form-control border-primary" id="userinput7" type="tel" placeholder="Contact Number">
								</div>

								<div class="form-group">
									<label for="userinput8">Bio</label>
									<textarea id="userinput8" rows="5" class="form-control border-primary" name="bio" placeholder="Bio"></textarea>
								</div>

							</div>

							<div class="form-actions right">
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
