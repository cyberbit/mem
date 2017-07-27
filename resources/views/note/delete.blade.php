{{-- @extends('base')

@section('title', 'Delete note ' . $note->id . ' - ' . $note->title . '?')

@section('content')
    <h1>Confirm delete of note {{ $note->id }} - {{ $note->title }}?</h1>
    <p>Changes cannot be undone.</p>
    
    <form action="/api/notes/{{ $note->id }}/delete">
        <input type="hidden" name="api_token" value="{{ Auth::user()->api_token }}">
        <input type="hidden" name="redirect" value="1">
        
        <button type="submit" class="btn btn-danger">Delete</button>
        <a href="/notes?api_token={{ Auth::user()->api_token }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection --}}

<div class="modal-body">
    <p>Confirm delete of note {{ $note->id }} - {{ $note->title }}?</p>
    @component('alert', ['context' => 'warning'])
        Changes cannot be undone.
    @endcomponent
</div>
<div class="modal-footer">
    <a href="#" class="note-btn-delete btn btn-danger">Delete</a>
    <a href="#" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
</div>
    
<script>
    $(function() {
        var $modal = $("#note-delete-modal");
        var note = {!! json_encode($note) !!};
        
        $modal.find(".note-btn-delete").click(function(e) {
            e.preventDefault();
            
            var $delete = $(this);
            $delete.addClass("disabled");
            
            // Submit request
            $.get("/api/notes/" + note.id + "/delete", app.forms.api_token_serialized, function(d) {
                $delete.removeClass("disabled");
                
                if (d.status == "success") {
                    // Close modal and refresh notes
                    $modal.modal('hide');
                    initNotes();
                }
                
                else {
                    $delete.text("Error!");
                    
                    setTimeout(function() {
                        $delete.text("Delete");
                    }, 1700);
                }
            });
        });
    });
</script>