@extends('components.layouts.app')
@section('content')
    <div class="container">
        <h1>Edytuj zgłoszenie</h1>
        <form action="{{ route('client.requests.update', $service_request) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PATCH")

            <div class="form-group">
                <label for="model">Opis problemu</label>
                <input id="problem_description"
                       type="text"
                       class="form-control"
                       name="problem_description" required
                       value="{{$service_request->problem_description}}"
                >
            </div>

            <div class="form-group">
                <label for="urgency">Pilność</label>
                <select id="urgency" name="urgency" class="form-control" required>
                    <option value="low">Niewielkie znaczenie</option>
                    <option value="medium">Średnie znaczenie</option>
                    <option value="high">Duże znaczenie</option>
                </select>
            </div>

            <div class="form-group">
                <label for="location">Lokalizacja</label>
                <input id="location"
                       type="text"
                       class="form-control"
                       name="location" required
                       value="{{$service_request->location}}"
                >
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Zapisz</button>
        </form>
    </div>
@endsection
