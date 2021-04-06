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
                                    <h4 class="card-title" id="basic-layout-form">افزودن سفارش</h4>
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
                                            <p> سفارشتان تان را اینجا اضافه نمایید</p>
                                        </div>
                                        <form method="POST" action="{{url('dashboard/orders/add-order')}}"
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="owner_name"> رستورانت</label>
                                                            <select class="form-control"
                                                                    name="seller_id" id="lang">
                                                                @foreach($sellers as $seller)
                                                                    <option
                                                                        value="{{$seller->id}}">{{$seller->business_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>متطقه</label>
                                                            <input type="text"
                                                                   class="form-control"
                                                                   name="village">
                                                            <input type="hidden"  class="form-control"
                                                                   name="customer_id" value="{{auth()->user()->id}}">
                                                            <input type="hidden"  class="form-control"
                                                                   name="order_status" value="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="geolocation">موقعیت</label>
                                                    <textarea id="geolocation" rows="5" class="form-control"
                                                              name="location"
                                                              placeholder="موقعیت"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="geolocation">جیولوکیشن</label>
                                                    <textarea id="geolocation" rows="5" class="form-control"
                                                              name="geolocation"
                                                              placeholder="جیولوکیشن"></textarea>
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
@stop
