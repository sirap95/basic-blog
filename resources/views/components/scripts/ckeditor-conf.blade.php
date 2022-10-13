<script src="https://cdn.ckeditor.com/4.20.0/standard-all/ckeditor.js"></script>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script>
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.replace('ckeditor', {
        extraPlugins: 'sourcedialog',
        removePlugins: 'sourcearea',
        removeButtons: 'PasteFromWord',
        height: 500,
        filebrowserUploadUrl: "{{route('admin.upload', ['_token' => csrf_token()])}}",
        filebrowserUploadMethod: "form"
    });

    function getName(value) {
        console.log(value);
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#previewButton').click(function () {
            let contents = CKEDITOR.instances['ckeditor'].getData();

            $('#titlePreview').html($('#title').val());
            $('#contentPreview').html(contents);
        });

    });
</script>
