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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">افزودن کتگوری محصولات</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse">
                                    <div class="card-body">
                                        <div class="card-text">
                                            <p>کتگوری محصولات تان را اینجا اضافه نمایید</p>
                                        </div>
                                        <form method="POST" action="{{url('dashboard/category/add-category')}}"
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="owner_name">نوع</label>
                                                            <input type="text" id="user_id" class="form-control"
                                                                   name="type" placeholder="نوع">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="owner_name">کتگوری وب آدرس</label>
                                                            <input type="text" id="owner_name" class="form-control"
                                                                   name="category_webaddress"
                                                                   placeholder="کتگوری وب آدرس">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="owner_name">کتگوری</label>
                                                            <input type="text" id="owner_name" class="form-control"
                                                                   name="category_name" placeholder="کتگوری">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>تصویر کتگوری</label>
                                                            <input type="file"
                                                                   class="form-control"
                                                                   name="category_image">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="geolocation">توضیحات کتگوری</label>
                                                    <textarea id="geolocation" rows="5" class="form-control"
                                                              name="category_description"
                                                              placeholder="توضیحات کتگوری"></textarea>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-primary">
                                                        ذخیره
                                                    </button>
                                                    <button type="button" class="btn btn-warning mr-1">
                                                        لغو
                                                    </button>
                                                </div>
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
                                <h4 class="card-title">لیست کتگوری</h4>
                                <a class="heading-elements-toggle"><i class="ft-ellipsis-h font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <button class="btn btn-primary btn-sm"><i class="ft-plus white"></i> New Task
                                    </button>
                                    <span class="dropdown">
                        <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"
                                class="btn btn-warning btn-sm dropdown-toggle dropdown-menu-right"><i
                                class="ft-download white"></i></button>
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
                                        <table id="project-task-list"
                                               class="table table-white-space table-bordered row-grouping display wrap-border icheck table-middle">
                                            <thead>
                                            <tr>
                                                <th> نوعیت کتگوری</th>
                                                <th>آدرس وب کتگوری</th>
                                                <th>نام کتگوری</th>
                                                <th>توضیحات کتگوری</th>
                                                <th>تصویر کتگوری</th>
                                                <th>اکشن</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($categories as $category)
                                                <tr>
                                                    <td>{{$category->type}}</td>
                                                    <td>{{$category->category_webaddress}}</td>
                                                    <td>{{$category->category_name}}</td>
                                                    <td class="table-text-wrap" style="word-wrap: break-word;

white-space: normal !important;
text-align: justify;">{{$category->category_description}}</td>
                                                    <td class="text-center">
                                                        <img
                                                            src="{{url('dashboard/category/category-image/categoryImage/'.$category->category_image)}}"
                                                            alt="avatar" data-placement="right"
                                                            title="Nicole Barrett" style="height: 200px"
                                                        ><i></i>

                                                    </td>
                                                    <td>
					                	<span class="dropdown">
					                        <button id="btnSearchDrop4" type="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"
                                                    class="btn btn-info dropdown-toggle"><i
                                                    class="fa fa-cog"></i></button>
					                        <span aria-labelledby="btnSearchDrop4"
                                                  class="dropdown-menu mt-1 dropdown-menu-right">
					                            <a href="#" class="dropdown-item"><i class="ft-eye"></i> Open Task</a>
					                            <a href="#" class="dropdown-item"><i
                                                        class="ft-edit-2"></i> Edit Task</a>
					                            <a href="#" class="dropdown-item"><i class="ft-check"></i> Complete Task</a>
					                            <a href="#" class="dropdown-item"><i
                                                        class="ft-upload"></i> Assign to</a>
					                            <div class="dropdown-divider"></div>
					                            <a href="#" class="dropdown-item"><i
                                                        class="ft-trash"></i> Delete Task</a>
					                        </span>
					                    </span>
                                                    </td>
                                                </tr>
                                            @endforeach


                                            </tbody>
                                        </table>
                                        <div class="mt-4 mr-4">
                                            {{$categories->onEachSide(3)->links()}}
                                        </div>
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
