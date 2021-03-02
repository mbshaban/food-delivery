@extends('dashboard.layout.layout')
@section('content')
    <section id="basic-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card mt-5 mr-5">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="card-text">
                                <p>کتگوری محصولات تان را اینجا بروز رسانی نمایید</p>
                            </div>
                            <form method="POST" action="{{url('dashboard/category/update-category/'.$data->id)}}"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <div class="form-group">
                                                    <label for="owner_name">نوع</label>
                                                    <input type="text" id="user_id" class="form-control"
                                                           name="type" value="{{$data->type}}">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group">
                                                    <label for="owner_name">آدرس وب کتگوری</label>
                                                    <input type="text" id="owner_name" class="form-control"
                                                           name="category_webaddress"
                                                           placeholder="کتگوری وب آدرس"
                                                           value="{{$data->category_webaddress}}">
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group">
                                                    <label for="owner_name">کتگوری</label>
                                                    <input type="text" id="owner_name" class="form-control"
                                                           name="category_name" placeholder="کتگوری"
                                                           value="{{$data->category_name}}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div>
                                                <div class="form-group">
                                                    <label for="geolocation">توضیحات کتگوری</label>
                                                    <textarea id="geolocation" rows="5" class="form-control"
                                                              name="category_description"
                                                              placeholder="توضیحات کتگوری">{{$data->category_description}}</textarea>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group">
                                                    <label>تصویر کتگوری</label>
                                                    <input type="file"
                                                           class="form-control"
                                                           name="category_image">
                                                    <input type="hidden"
                                                           class="form-control"
                                                           name="prev_image_path" value="{{$data->category_image}}">
                                                    <img style="height: 400px;width: 400px"
                                                         src="{{url('dashboard/category/category-image/categoryImage/'.$data->category_image)}}"
                                                         class="img-thumbnail img-responsive" alt="" title=""/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            بروز رسانی
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
@stop
