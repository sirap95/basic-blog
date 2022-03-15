<script>
     function countChar(val, limit) {
        var len = val.value.length;
        var maxLength = limit;

        if (len >= limit) {
            $('#count-error').html('<span style="color: red;">You have exceeded the limit of '+maxLength+' characters</span>');
            $('#charNum').text(len);
        } else {
            $('#charNum').text(len);
        }
    }
</script>
