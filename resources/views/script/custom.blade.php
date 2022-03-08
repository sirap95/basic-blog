<script>
     function countChar(val) {
        var len = val.value.length;
        var maxLength = 400;

        if (len >= 400) {
            $('#count-error').html('<span style="color: red;">You have exceeded the limit of '+maxLength+' characters</span>');
            $('#charNum').text(len);
        } else {
            $('#charNum').text(len);
        }
    }
</script>
