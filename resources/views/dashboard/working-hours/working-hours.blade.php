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
                                    <h4 class="card-title" id="basic-layout-form">افزودن ساعت کاری</h4>
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
                                            <p>ساعات کاری خودرا اینجا وارد کنید</p>
                                        </div>
                                        <form method="POST" action="{{url('dashboard/working-hour/add')}}"
                                              enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="owner_name"> عنوان</label>
                                                            <select class="form-control"
                                                                    name="title" id="lang">
                                                                <option  value="صبحانه">صبحانه</option>
                                                                <option  value="چاشت">چاشت</option>
                                                                <option  value="شب">شب</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="owner_name">وقت شروع</label>
                                                            <input type="text" class="form-control" id="startTime"
                                                                   name="start_time">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="owner_name">وقت ختم</label>
                                                            <input type="text" class="form-control" id="endTime"
                                                                   name="end_time">
                                                            <input type="hidden" name="user_id"
                                                                   value="{{auth()->user()->id}}">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    ذخیره
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
                                                <th>عنوان</th>
                                                <th>شروع وقت</th>
                                                <th>ختم وقت</th>
                                                <th>بروز رسان</th>
                                                <th>حذف</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($workingHours as $workingHour)
                                                <tr>
                                                    <td>{{$workingHour->title}}</td>
                                                    <td>{{$workingHour->start_time}}</td>
                                                    <td>{{$workingHour->end_time}}</td>
                                                    <td>
                                                        <button title="بروز رسانی"
                                                                onclick="window.location='{{ url('dashboard/working-hour/update-view/'.$workingHour->id) }}'"
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
                                                                        onclick="deleteCategory({{$workingHour->id}})"
                                                                        class="btn btn-danger">تایید
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </tbody>
                                        </table>
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
        $('#startTime').datetimepicker({
            format: 'hh:mm:ss',
        });
        $('#endTime').datetimepicker({
            format: 'hh:mm:ss',
        });

        function deleteCategory(id) {
            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            $.ajax({
                url: "delete-working-hours",
                type: "POST",
                headers: headers,
                data: {'id': id},
                dataType: "text",
                success: function (monitordata) {
                    if (monitordata === "success") {
                        window.location.href = 'working-hours';
                    }
                }
            });
        }
    </script>
@stop
