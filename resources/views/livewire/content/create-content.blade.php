<div class="col-lg-8">
    <div class="card shadow mb-4">
        <div class="card-header">
            <h5 class="mr-2 font-weight-bold text-primary my-auto">Content Group {{ $group->segment }}</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="createContent">
                <div class="form-group">
                    <label for="title" class="@error('data.title') text-danger @enderror">Title</label>
                    <textarea name="title" id="title" class="form-control @error('data.title') border-danger @enderror" wire:model.defer='data.title' rows="2"></textarea>
                    @error('data.title')
                        <span class="text-danger"><small>{{$message}}</small></span>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-5">
                        <label for="journalist" class="@error('data.journalist') text-danger @enderror">Journalist</label>
                        <a href="#journalist" class="text-decoration-none d-flex text-gray-600">
                            <img style="height: 35px;width :35px;" src="{{ isset($journalist->imgprofile) ? asset('storage/'. $journalist->imgprofile) : asset('tamplate/img/undraw_profile.svg') }}" alt="" class="img-profile rounded-circle @error('data.journalist') border border-danger @enderror mr-2">
                            <div class="d-flex {{ isset($journalist->id) ? 'flex-column' : null }} align-items-center">
                                <small class="text-capitalize @error('data.journalist') text-danger @enderror">{{ isset($journalist->name) ? $journalist->name : 'Note selected' }}@error('data.journalist'){{$message}}@enderror</small>
                                @if (isset($journalist->id))
                                    <small class="text-xs text-left text-capitalize" style="width: 100%;">{{ $journalist->id }}</small>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="form-group col-sm-7">
                        <label for="deadline" class="@error('data.deadline') text-danger @enderror">Deadline</label>
                        <input wire:model.defer='data.deadline' type="date" name="date" class="form-control @error('data.deadline') border-danger @enderror" id="deadline" aria-describedby="emailHelp" placeholder="Enter email">
                        @error('data.deadline')
                            <span class="text-danger"><small>{{$message}}</small></span>
                        @enderror
                    </div>
                </div>
                <div class="form-group" wire:ignore>
                    <label for="desc" class="@error('data.desc') text-danger @enderror">Description</label>
                    <textarea name="desc" class="form-control @error('data.desc') border-danger @enderror" id="editor" wire:model.defer='data.desc' rows="7"></textarea>
                </div>
                @error('data.desc')
                    <span class="text-danger"><small>{{$message}}</small></span>
                @enderror
                <button type="submit" class="btn btn-sm btn-primary"><small>Add</small></button>
            </form>
        </div>
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
    height: 300,
    forced_root_block: false,
    setup: (editor) => {
    // Apply the focus effect
        editor.on("init", () => {
            editor.getContainer().style.transition =
            "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out";
        });
        editor.on('init change', function () {
            editor.save();
        });
        editor.on('change', function (e) {
            @this.set('data.desc', editor.getContent());
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
