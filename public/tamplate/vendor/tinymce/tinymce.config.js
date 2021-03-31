        tinymce.init({
            selector: "textarea#editor",
            skin: "bootstrap",
            plugins: "lists fullscreen preview table codesample",
            toolbar:
            "undo redo | bold italic underline strikethrough | fullscreen  preview removeformat | formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist table | forecolor backcolor | charmap emoticons ",
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
                @this.set('data.description', editor.getContent());
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
