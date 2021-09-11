@extends('dashboard.layout.layout')
@section('content')
    <section id="basic-form-layouts">
        <div class="row match-height">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-form">بروز رسانی محصولات</h4>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="card-text">
                                    <p> محصولات تان را اینجا بروز رسانی نمایید</p>
                                </div>
                                <form method="POST" action="{{url('dashboard/products/update-product/'.$data->id)}}"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="owner_name">نام محصول</label>
                                                    <input type="text" id="user_id" class="form-control"
                                                           name="product_title" placeholder="نام محصول"
                                                           value="{{$data->product_title}}">
                                                    <input type="hidden" class="form-control"
                                                           name="seller_id" value="1">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="owner_name"> کتگوری</label>
                                                    <select class="form-control"
                                                            name="category_id" id="lang">
                                                        @foreach($categories as $category)
                                                            <option
                                                                value="{{$category->id}}">{{$category->category_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="owner_name">قیمت</label>
                                                    <input type="text" id="owner_name" class="form-control"
                                                           name="price" placeholder="قیمت" value="{{$data->price}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="owner_name"> حالت محصول</label>
                                                    <select class="form-control"
                                                            name="product_status" id="lang">
                                                        <option value="yes">وجود دارد</option>
                                                        <option value="no">وجود ندارد</option>
                                                    </select>
                                                    <input type="hidden"
                                                           class="form-control"
                                                           name="isApproved" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="geolocation">توضیحات محصول</label>
                                                    <textarea id="geolocation" rows="5" class="form-control"
                                                              name="description"
                                                              placeholder="توضیحات محصول">{{$data->description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>تصویر محصول</label>
                                                    <input type="file"
                                                           class="form-control"
                                                           name="product_image">
                                                    <input type="hidden"
                                                           class="form-control"
                                                           name="prev_image_path" value="{{$data->product_image}}">
                                                    <img style="height: 400px;width: 400px"
                                                         src="{{url('dashboard/products/product-image/productImage/'.$data->product_image)}}"
                                                         class="img-thumbnail img-responsive" alt="" title=""/>
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
