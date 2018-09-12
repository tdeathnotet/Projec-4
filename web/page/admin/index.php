<?php   require $_SERVER['DOCUMENT_ROOT']."/static/header.php";
        require $_SERVER['DOCUMENT_ROOT']."/static/sidebar.php"; ?>

<div class="container">
    <a href="/filemanager/dialog.php?type=1&editor=fancybox" class="btn iframe-btn" type="button">Select Picture</a>
</div>
<script>

    function responsive_filemanager_callback(field_id) {
        console.log(field_id);
        var url = jQuery('#' + field_id).val();
        alert('update ' + field_id + " with " + url);
        //your code
    }

    $(() => {
        $('.iframe-btn').fancybox({
            'width': 880,
            'height': 570,
            'type': 'iframe',
            'autoScale': false
        });
    })

</script>
<?php   require $_SERVER['DOCUMENT_ROOT']."/static/footer.php"; ?>