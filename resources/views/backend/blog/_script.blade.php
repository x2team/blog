@section('style')
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    
    <link rel="stylesheet" href="https://cdn.rawgit.com/yahoo/pure-release/v0.6.0/pure-min.css">

    <link rel="stylesheet" href="/backend/plugins/tag-editor/jquery.tag-editor.css">
@endsection
 
@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/backend/plugins/tag-editor/jquery.caret.min.js"></script>
    <script src="/backend/plugins/tag-editor/jquery.tag-editor.min.js"></script>
    

    {{-- TinyMCE 5 with domain: congphim.xyz --}}
    {{-- <script src="https://cdn.tiny.cloud/1/vnh32pxgydzvub50pah6ienn6lfdxvx20i3qz5vpnugvbhwu/tinymce/5/tinymce.min.js"></script> --}}

    {{-- TinyMCE 4 --}}
    <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>

    {{-- CKEditor 4 --}}
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

    <script type="text/javascript">
        var editor_config = {
          path_absolute : "/",
          selector: "#excerpt",
          plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
          ],
          toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
          relative_urls: false,
          file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
      
            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
              cmsURL = cmsURL + "&type=Images";
            } else {
              cmsURL = cmsURL + "&type=Files";
            }
      
            tinyMCE.activeEditor.windowManager.open({
              file : cmsURL,
              title : 'Filemanager',
              width : x * 0.8,
              height : y * 0.8,
              resizable : "yes",
              close_previous : "no"
            });
          }
        };
        tinymce.init(editor_config);



        // CK Editor 4
        var options_ckeditor = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
        };
        CKEDITOR.replace('body', options_ckeditor);


    </script>

    
    
    
    
    
    <script type="text/javascript">

        // tinymce.init({selector:'#body'});



        //Tags
        var options = {};

        @if(isset($post) && $post->exists)

            options = {
                initialTags: {!! json_encode($post->tags->pluck('name')) !!},
                delimiter: ',', /* space and comma */
                placeholder: 'Enter tags ...',
                autocomplete: {
                    delay: 0, // show suggestions immediately
                    position: { collision: 'flip' }, // automatic menu position up/down
                    source: @php echo $tags; @endphp
                },
            };
        @endif
        $('input[name=post_tags]').tagEditor(options);



        //Khi bam vao nut Savedraft
        $('#draft-btn').click(function (e) {
            e.preventDefault();
            $('#post-form').submit();
        });


        //dataTables
        $("#post").DataTable({
            "lengthMenu": [10, 25, 50, "All"],
            "order": [[ 4, "desc" ]],
            "language": {
            "paginate": {
                // "previous": "<",
                // "next": ">",
            }
            }
        });
        
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "lengthMenu": [[5, 25, 50, -1], [5, 25, 50, "All"]],
        });

        //Summernote
        // $('#excerpt').summernote({
        //     height: 300,
        //     toolbar: [
        //         ['style', ['style']],
        //         ['font', ['bold', 'underline', 'clear']],
        //         ['fontname', ['fontname']],
        //         ['color', ['color']],
        //         ['para', ['ul', 'ol', 'paragraph']],
        //         ['table', ['table']],
        //         ['insert', ['link', 'picture', 'video']],
        //         ['view', ['fullscreen', 'codeview', 'help']],
        //         ['fontsize', ['fontsize']],
        //     ],
        // });
    </script>
@endsection