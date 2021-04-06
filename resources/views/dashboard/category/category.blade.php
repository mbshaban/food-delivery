@extends('dashboard.layout.layout')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-column-fluid">
            <div class="container">
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
                                                            <label for="owner_name">آدرس وب کتگوری</label>
                                                            <input type="text" class="form-control"
                                                                   name="category_webaddress"
                                                                   placeholder="کتگوری وب آدرس">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="owner_name">کتگوری</label>
                                                            <input type="text"  class="form-control"
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
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">لیست کتگوری</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- Task List table -->
                                    <div class="table-responsive">
                                        <table id="project-task-list"
                                               class="table table-bordered  ">
                                            <thead>
                                            <tr>
                                                <th> نوعیت کتگوری</th>
                                                <th>آدرس وب کتگوری</th>
                                                <th>نام کتگوری</th>
                                                <th>توضیحات کتگوری</th>
                                                <th>تصویر کتگوری</th>
                                                <th>بروز رسان</th>
                                                <th>حذف</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($categories as $category)
                                                <tr>
                                                    <td>{{$category->type}}</td>
                                                    <td>{{$category->category_webaddress}}</td>
                                                    <td>{{$category->category_name}}</td>
                                                    <td class="table-text-wrap">
                                                        {{$category->category_description}}
                                                    </td>
                                                    <td class="text-center">
                                                        <img
                                                            src="{{url('dashboard/category/category-image/categoryImage/'.$category->category_image)}}"
                                                            alt="avatar" data-placement="right"
                                                            title="Nicole Barrett" style="height: 200px">
                                                    </td>
                                                    <td>
                                                        <button title="بروز رسانی"
                                                                onclick="window.location='{{ url('dashboard/category/update-category-view/'.$category->id) }}'"
                                                                class="btn btn-success">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                    </td>
                                                    <td>
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
                                                                <h4 align="center" style="margin: 0"> مطمین هستید که می
                                                                    خواهید این اطلاعات را حذف کنید؟</h4>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" data-dismiss="modal"
                                                                        class="btn btn-warning">لغو
                                                                </button>
                                                                <button type="button"
                                                                        onclick="deleteCategory({{$category->id}})"
                                                                        class="btn btn-danger">تایید
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="mt-4 mr-4">
                                            {{$categories->links()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function deleteCategory(id) {
            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            $.ajax({
                url: "delete-category",
                type: "POST",
                headers: headers,
                data: {'id': id},
                dataType: "text",
                success: function (monitordata) {
                    if (monitordata === "success") {
                        window.location.href = 'categories';
                    }
                }
            });
        }
    </script>
@stop
