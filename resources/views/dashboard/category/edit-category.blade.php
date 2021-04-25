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
                                                    <label for="owner_name">کتگوری</label>
                                                    <input type="text" id="owner_name" class="form-control"
                                                           name="title" placeholder="کتگوری"
                                                           value="{{$data->title}}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
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
