@extends('layouts.app', ['title' => 'Note Edit', 'livewire' => true, 'tinymce' => true])

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-capitalize">{{ $note->user->name }} <small>( Note )</small></h6>
        </div>
        <div class="card-body">
            <form action="{{ route('noteUpdate', $note->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="highlight" class="@error('highlight') text-danger @enderror">Highlight</label>
                    <textarea name="highlight" id="highlight" class="form-control @error('highlight') border-danger @enderror" rows="2">{{ old('highlight') ?? $note->highlight }}</textarea>
                    @error('highlight')
                        <span class="text-danger"><small>{{$message}}</small></span>
                    @enderror
                  </div>
                <div class="form-group">
                    <textarea name="note" class="form-control" id="editor" rows="7">{{ $note->note }}</textarea>
                    @error('note')
                        <span class="text-danger"><small>{{$message}}</small></span>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary mr-2">Update</button>
                    <a href="{{ route('noteDetail', $note->id) }}" class="btn btn-sm btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        tinymce.init({
            selector: "textarea#editor",
            skin: "bootstrap",
            plugins: "lists fullscreen preview table codesample wordcount charmap emoticons",
            toolbar:
            "undo redo | bold italic underline strikethrough | fullscreen  preview removeformat | formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist table | forecolor backcolor codesample | charmap emoticons ",
            menubar: false,
            toolbar_mode: 'sliding',
            height: 400,
            setup: (editor) => {
                 // Apply the focus effect
                editor.on("init", () => {
                    editor.getContainer().style.transition =
                    "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out";
                });
                editor.on('init change', function () {
                    editor.save();
                });
                editor.on("focus", () => {
                    (editor.getContainer().style.boxShadow =
                    "0 0 0 .2rem rgba(0, 123, 255, .25)"),
                    (editor.getContainer().style.borderColor = "#80bdff");
                });
                editor.on("blur", () => {
                    (editor.getContainer().style.boxShadow = ""),
                    (editor.getContainer().style.borderColor = "");
                });
            },
        });
    </script>
@endsection