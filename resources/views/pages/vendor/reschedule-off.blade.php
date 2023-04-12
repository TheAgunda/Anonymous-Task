@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Reschedule off') }}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{route('reschedule-off.store')}}">
                        <input type="hidden" value="{{auth()->user()->id}}" name="vendor_id" />
                        @csrf
                        <div class="" id="nodeWrapper">
                            <div class="d-flex">
                                <div class="col-4">
                                    <div class="m-3">
                                        <label class="form-label">Date</label>
                                        <input type="date" name="date" class="form-control" required />
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="m-3">
                                        <label for="startTime" class="form-label">startTime</label>
                                        <input type="time" class="form-control" id="startTime" name="startTime" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="m-3">
                                        <label for="endTime" class="form-label">endTime</label>
                                        <input type="time" class="form-control" id="endTime" name="endTime" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const nodeWrapper = document.getElementById("nodeWrapper");
</script>
@endsection