@section('script')
<script type="text/javascript">
    $(document).ready(function() {

        $('#title').on('blur', function() {
            var theTitle = this.value.toLowerCase().trim(),
                slugInput = $('#slug'),
                theSlug = theTitle.replace(/&/g, '-and-')
                                  .replace(/[^a-z0-9-]+/g, '-')
                                  .replace(/\-\-+/g, '-')
                                  .replace(/^-+|-+$/g, '');

            slugInput.val(theSlug);
        });
        
        $("#category").DataTable({
            "lengthMenu": [10, 25, 50, "All"],
            // "order": [[ 4, "desc" ]],
        });

        

    });
</script>
@endsection