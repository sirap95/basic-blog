<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script>
    CKEDITOR.replace('ckeditor', {
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
            var contents = CKEDITOR.instances['ckeditor'].getData();

            $('#contentPreview').html(contents);
        });

    });
</script>
