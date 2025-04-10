@extends('user.layouts.app')
@section('nav_title')
    التقارير
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            كل التقارير
        </div>
        <div class="card-body">
            <form action="{{ route('user.search.reborts') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">حالة الشحنة</label>
                            <select name="status_id" id="" class="form-control">
                                <option value="">اختار حالة الشحنة</option>
                                @if (isset($status) && $status->count() > 0)
                                    @foreach ($status as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>

                            @error('status_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">تاريخ البداية</label>
                           <input type="date" class="form-control" name="start_date">
                           @error('start_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                           @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">تاريخ النهاية </label>
                            <input type="date" class="form-control" name="end_date">
                            @error('end_date')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="submit" value="بحث" class="form-control btn btn-warning">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection