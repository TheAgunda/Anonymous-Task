@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Availability') }}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{route('availability.store')}}">
                        <input type="hidden" value="{{auth()->user()->id}}" name="vendor_id" />
                        <button class="btn btn-sm btn-success" id="addButton" type="button">
                            +
                        </button>
                        <button class="btn btn-sm btn-success" id="removeButton" type="button">
                            -
                        </button>
                        @csrf
                        <div id="nodeWrapper">
                            <div class="d-flex">
                                <div class="col-4">
                                    <div class="m-3">
                                        <label class="form-label">Weekday name</label>
                                        <select class="form-select" name="days[]" required>
                                            <option value="" selected>Open this select menu</option>
                                            @foreach(\Carbon\Carbon::getDays() as $key=>$day)
                                            <option value={{strtolower($day)}}>{{$day}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="m-3">
                                        <label for="startTime" class="form-label">startTime</label>
                                        <input type="time" class="form-control" id="startTime" name="startTime[]">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="m-3">
                                        <label for="endTime" class="form-label">endTime</label>
                                        <input type="time" class="form-control" id="endTime" name="endTime[]">
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
    const addButton = document.getElementById("addButton");
    const removeButton = document.getElementById("removeButton");
    let firstChildNode = nodeWrapper.children[0];

    console.log(nodeWrapper.children.length)

    addButton.addEventListener("click", function() {
        let firstChildNode = nodeWrapper.children[0];
        let cloneNode = nodeWrapper.cloneNode(true);
        nodeWrapper.appendChild(cloneNode);
    })
    removeButton.addEventListener("click", function() {
        if (nodeWrapper.children.length > 1) {
            nodeWrapper.removeChild(nodeWrapper.lastChild);
        }
    });
</script>
@endsection