/**
 * Tiny textarea
 */
tinymce.init({
    selector: '.tinyText',
    file_picker_types: 'image',
    automatic_uploads: true,
    plugins: "advlist autolink lists link image charmap print preview anchor",
    toolbar: 'undo redo | styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code',
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        /*
          Note: In modern browsers input[type="file"] is functional without
          even adding it to the DOM, but that might not be the case in some older
          or quirky browsers like IE, so you might want to add it to the DOM
          just in case, and visually hide it. And do not forget do remove it
          once you do not need it anymore.
        */

        input.onchange = function () {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function () {
                /*
                  Note: Now we need to register the blob in TinyMCEs image blob
                  registry. In the next release this part hopefully won't be
                  necessary, as we are looking to handle it internally.
                */
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);

                /* call the callback and populate the Title field with the file name */
                cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
        };

        input.click();
    },
});

/**
 *
 *

 file manager settings
 file_browser_callback: function(field_name, url, type, win) {
        tinyMCE.activeEditor.windowManager.open({
            file: '/file-manager/tinymce',
            title: 'Laravel File Manager',
            width: window.innerWidth * 0.8,
            height: window.innerHeight * 0.8,
            resizable: 'yes',
            close_previous: 'no',
        }, {
            setUrl: function(url) {
                win.document.getElementById(field_name).value = url;
            },
        });
    },


 *
 */

/**
 * Select init
 */
$(".select2-term").select2()
