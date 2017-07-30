@extends('base')

@section('title', 'A notes manager')

@push('styles')
    <style>
        .home {
            text-align: center;
        }
        
        .home > * {
            opacity: 0;
        }
        
        .title {
            margin-top: 2rem;
            margin-bottom: 5rem;
        }
        
        .lead {
            font-size: 1.5rem;
            margin-bottom: 5rem;
        }
    </style>
@endpush

@section('content')
    <div class="home">
        <h1 class="title display-1">Welcome to Mem.</h1>
        <p class="lead">Mem is a bare bones note manager.</p>
        <p class="lead">No formatting, no nonsense.</p>
        <p class="lead">Just you and your notes.</p>
        <p class="lead"><a class="btn btn-lg btn-outline-primary" href="/login">I'm in</a></p>
    </div>
@endsection

@push('scripts')
    <script>
        // If state is saved, redirect to notes page
        if (localStorage.api_token) {
            location = "/notes?api_token=" + localStorage.api_token;
        }
        
        $(function() {
            initHome();
            
            function initHome() {
                $(".home").children().each(function(i) {
                    console.log("processing %o", this);
                    $(this).delay(i * 200).animate({opacity: 1});
                });
            }
        });
    </script>
@endpush