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
                                    <h4 class="card-title" id="basic-layout-form">بروزرسانی مینوی غذایی</h4>
                                </div>
                                <div class="card-content ">
                                    <div class="card-body">
                                        <div class="card-text">
                                            <p>مینوی غذایی خودرا اینجا وارد کنید</p>
                                        </div>
                                        <form method="POST" action="{{url('dashboard/menu/update-menu/'.$data->id)}}"
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="form-body">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="owner_name">مینو</label>
                                                        <input type="text" class="form-control"
                                                               name="title" value="{{$data->title}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    بروزرسانی
                                                </button>
                                                <button type="button" class="btn btn-warning mr-1">
                                                    لغو
                                                </button>
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
