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
                                    <h4 class="card-title" id="basic-layout-form">افزودن محصولات</h4>
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
                                            <p> محصولات تان را اینجا اضافه نمایید</p>
                                        </div>
                                        <form method="POST" action="{{url('dashboard/products/add-product')}}"
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="form-body">

                                                <div class="form-group">
                                                    <label for="geolocation">توضیحات محصول</label>
                                                    <textarea id="geolocation" rows="5" class="form-control"
                                                              name="description"
                                                              placeholder="توضیحات محصول"></textarea>
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
                                <h4 class="card-title">لیست محصولات</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- Task List table -->
                                    <div class="table-responsive">
                                        <table id="project-task-list"
                                               class="table table-bordered  ">
                                            <thead>
                                            <tr>
                                                <th> نام محصول</th>
                                                <th>کتگوری</th>
                                                <th>بروز رسان</th>
                                                <th>حذف</th>
                                            </tr>
                                            </thead>
                                            <tbody>
{{--                                            @foreach($products as $product)--}}
{{--                                                <tr>--}}
{{--                                                    <td>{{$product->product_title}}</td>--}}
{{--                                                    <td>{{$product->category_name}}</td>--}}

{{--                                                    <td>--}}
{{--                                                        <button title="بروز رسانی"--}}
{{--                                                                onclick="window.location='{{ url('dashboard/product/update-product-view/'.$product->id) }}'"--}}
{{--                                                                class="btn btn-success">--}}
{{--                                                            <i class="fa fa-edit"></i>--}}
{{--                                                        </button>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <button onclick="" data-toggle="modal" data-target="#delete"--}}
{{--                                                                title="حذف"--}}
{{--                                                                class="btn btn-danger">--}}
{{--                                                            <i class="fa fa-times"></i>--}}
{{--                                                        </button>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
                                                <div id="delete" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
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
{{--                                                                        onclick="deleteCategory({{$product->id}})"--}}
                                                                        class="btn btn-danger">تایید
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
{{--                                            @endforeach--}}
                                            </tbody>
                                        </table>
                                        <div class="mt-4 mr-4">
{{--                                            {{$products->links()}}--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">افزودن محصولات</h4>
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
                                            <p> محصولات تان را اینجا اضافه نمایید</p>
                                        </div>
                                        <form method="POST" action="{{url('dashboard/products/add-product')}}"
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="form-body">

                                                <div class="form-group">
                                                    <label for="geolocation">توضیحات محصول</label>
                                                    <textarea id="geolocation" rows="5" class="form-control"
                                                              name="description"
                                                              placeholder="توضیحات محصول"></textarea>
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
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function deleteCategory(id) {
            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            $.ajax({
                url: "delete-product",
                type: "POST",
                headers: headers,
                data: {'id': id},
                dataType: "text",
                success: function (monitordata) {
                    if (monitordata === "success") {
                        window.location.href = 'products';
                    }
                }
            });
        }
    </script>
@stop
