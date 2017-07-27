{{-- @extends('base')

@section('title', 'New Note')

@section('content')
    <h1>New Note</h1>
    
    <form action="/api/notes/create">
        <input type="hidden" name="api_token" value="{{ Auth::user()->api_token }}">
        <input type="hidden" name="redirect" value="1">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="new note {{ App\Note::max('id') + 1 }}" required>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="body" class="form-control" placeholder="Body" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/notes?api_token={{ Auth::user()->api_token }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection --}}

<form action="/api/notes/new">
    <div class="modal-body">
        <div class="form-group">
            <label for="note-edit-title">Title</label>
            <input type="text" name="title" class="form-control" value="new note {{ App\Note::max('id') + 1 }}" placeholder="Title" required>
        </div>
        <div class="form-group">
            <label for="note-edit-body">Body</label>
            <textarea name="body" id="note-edit-body" class="form-control" rows="6" placeholder="Body" required></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>
</form>

<script>
    $(function() {
        var $modal = $("#note-new-modal");
        
        $modal.find("form").submit(function(e) {
            e.preventDefault();
            
            var $submit = $(this).find("[type=submit]");
            $submit.attr("disabled", true);
            
            // Submit form
            $.get("/api/notes/create", $.merge(app.forms.api_token_serialized, $(this).serializeArray()), function(d) {
                $submit.attr("disabled", false);
                
                if (d.status == "success") {
                    // Close modal and refresh notes
                    $modal.modal('hide');
                    initNotes();
                }
                
                else {
                    $submit.removeCLass("btn-primary").addClass("btn-danger");
                    $submit.text("Error!");
                    
                    setTimeout(function() {
                        $submit.removeCLass("btn-danger").addClass("btn-primary");
                        $submit.text("Submit");
                    }, 1700);
                }
            });
        });
    });
</script>