@extends('dashboard.layout.layout')
@section('content')
    <div class="card">
        <div class="card-header">ثبت</div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name" class="text-md-right">نام</label>

                        <input id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror" name="name"
                               value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="role"
                               class="text-md-right">{{ trans('local.role') }}</label>

                        <select id="role" class="form-control @error('role') is-invalid @enderror"
                                name="role" required autocomplete="email">
                            <option value="admin">{{ trans('admin') }}</option>
                            <option value="blogger">{{ trans('blogger') }}</option>
                            <option value="{{ old('role') }}">{{ old('role') }}</option>
                        </select>

                        @error('@role')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-6">
                        <label for="email"
                               class=" text-md-right">ایمیل</label>

                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror" name="email"
                               value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="password"
                               class="text-md-right">رمز عبور</label>

                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror" name="password"
                               required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="password-confirm"
                               class=" text-md-right">تکرار رمز عبور</label>

                        <input id="password-confirm" type="password" class="form-control"
                               name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            ثبت
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
