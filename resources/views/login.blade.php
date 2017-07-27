@extends('base')

@section('title', 'Login')

@push('styles')
    <style>
        .login-container {
            max-width: 500px;
        }
    </style>
@endpush

@section('content')
    <div class="container login-container">
        <h1>Login to Mem</h1>
        @if ($error)
            <div class="alert alert-danger" role="alert">
                <strong>Oops!</strong> We were unable to verify your information. Please try again.
            </div>
        @endif
        <form action="/api/login">
            <input type="hidden" name="redirect" value="1">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

{{-- @push('scripts')
    <script>
        $(function() {
            //debugger;
            
            var error = {{ $error ? 1 : 0 }};
            
            // If state is saved, redirect to notes page
            if (localStorage.api_token && !error) {
                location = "/notes?api_token=" + localStorage.api_token;
            }
        });
    </script>
@endpush --}}

</html>