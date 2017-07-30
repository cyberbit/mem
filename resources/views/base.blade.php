<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--<meta name="description" content="">-->
        <!--<meta name="author" content="">-->
        <link rel="icon" href="/img/favicon.png">
    
        <title>Mem - @yield('title')</title>
    
        <!-- Bootstrap core CSS -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        
        <style>
            body {
                padding-top: 5rem;
            }
            
            #factory {
                display: none;
            }
            
            .empty {
                opacity: 0.5 !important;
                pointer-events: none;
                user-select: none;
            }
            
            .empty * {
                color: rgba(0, 0, 0, 0) !important;
            }
            
            .content-loadable {
                min-height: 200px;
            }
        </style>
        
        @stack('styles')
    </head>
  
    <body>
        <div class="container">
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded fixed-top">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="{{ Auth::check() ? '/notes?api_token=' . Auth::user()->api_token : '/' }}">Mem</a>
          
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav ml-auto">
                        @if (Auth::check())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Welcome, {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarUser">
                                    <a class="logout dropdown-item" href="/logout?api_token={{ Auth::user()->api_token }}">Logout</a>
                                </div>
                            </li>
                        @elseif (!(isset($login) and $login))
                            <li class="nav-item">
                                <a class="nav-link" href="/login">Login</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
                
            @yield('content')
            
            <!--<div class="text-center text-muted">
                Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="http://www.flaticon.com" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>
            </div>-->
        </div><!-- /.container -->
        
        <div class="modal fade" id="note-view-modal" tabindex="-1" role="dialog" aria-labelledby="note-view-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content content-loadable"></div>
            </div>
        </div>
        
        <div class="modal fade" id="note-edit-modal" tabindex="-1" role="dialog" aria-labelledby="note-edit-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="note-edit-title">Edit Note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="content-loadable"></div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="note-new-modal" tabindex="-1" role="dialog" aria-labelledby="note-new-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="note-new-title">New Note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="content-loadable"></div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="note-delete-modal" tabindex="-1" role="dialog" aria-labelledby="note-delete-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="note-delete-title">Confirm Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="content-loadable"></div>
                </div>
            </div>
        </div>
        
        <div id="factory">
            <div class="note-card card">
                <div class="card-block">
                    <h4 class="card-title"><a href="#" class="note-title">note.title</a></h4>
                    <p class="note-body card-text">note.body</p>
                    <p class="card-text"><small class="text-muted"><span class="note-updated-at">note.updated_at</span> by <span class="note-created-by">user.name</span></small></p>
                    <a href="#" class="note-btn-edit btn btn-sm btn-primary">Edit</a>
                    <a href="#" class="note-btn-delete btn btn-sm btn-outline-danger">Delete</a><br>
                </div>
            </div>
            <div class="modal-loading modal-body">
                <p>Loading...</p>
            </div>
        </div>
        
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" crossorigin="anonymous"></script>
        <!--<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <!--<script src="/js/ie10-viewport-bug-workaround.js"></script>-->
        
        <script src="/js/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.loadingoverlay/latest/loadingoverlay.min.js"></script>
        
        <script>
            // Set up global app variables
            var app = {
                user: {!! Auth::check() ? Auth::user()->makeVisible(['api_token'])->toJson() : "null" !!},
                forms: {}
            };
            
            var modal_LoadingOverlay = {
                resizeInterval: 20,
                fade: false
            };
            
            if (app.user) {
                // Save authorization
                localStorage.api_token = app.user.api_token;
                
                app.forms = {
                    api_token: {api_token: app.user.api_token},
                    api_token_serialized: [{name: "api_token", value: app.user.api_token}]
                };
            }
        </script>
        <script src="/js/app.js"></script>
        
        @stack('scripts')
    </body>
</html>
