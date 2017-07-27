{{-- @extends('base')

@section('title', 'Edit Note')

@section('content')
    <h1>Edit Note</h1>
    
    <form action="/api/notes/{{ $note->id }}/update">
        <input type="hidden" name="api_token" value="{{ Auth::user()->api_token }}">
        <input type="hidden" name="redirect" value="1">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $note->title }}" placeholder="Title" required>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="body" class="form-control" placeholder="Body" required>{{ $note->body }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/notes?api_token={{ Auth::user()->api_token }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
@endsection --}}

<form action="/api/notes/{{ $note->id }}/update">
    <div class="modal-body">
        <div class="form-group">
            <label for="note-edit-title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $note->title }}" placeholder="Title" required>
        </div>
        <div class="form-group">
            <label for="note-edit-body">Body</label>
            <textarea name="body" id="note-edit-body" class="form-control" rows="6" placeholder="Body" required>{{ $note->body }}</textarea>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>
</form>

<script>
    $(function() {
        var $modal = $("#note-edit-modal");
        var note = {!! json_encode($note) !!};
        
        $modal.find("form").submit(function(e) {
            e.preventDefault();
            
            var $submit = $(this).find("[type=submit]");
            $submit.attr("disabled", true);
            
            // Submit form
            $.get("/api/notes/" + note.id + "/update", $.merge(app.forms.api_token_serialized, $(this).serializeArray()), function(d) {
                $submit.attr("disabled", false);
                
                if (d.status == "success") {
                    // Close modal and refresh notes
                    $modal.modal('hide');
                    initNotes();
                }
                
                else {
                    $submit.removeClass("btn-primary").addClass("btn-danger");
                    $submit.text("Error!");
                    
                    setTimeout(function() {
                        $submit.removeClass("btn-danger").addClass("btn-primary");
                        $submit.text("Submit");
                    }, 1700);
                }
            });
        });
    });
</script>