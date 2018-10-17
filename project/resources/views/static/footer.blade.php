<script>
    $(function () {
        ch = function () {
            $(this).attr('placeholder',$(this).val())
            $(this).val('')
        }

        $('.number input').focus(ch).click(ch).blur(function () {
            if (this.value == '') $(this).val($(this).attr('placeholder'))
        })

    })
</script>
</div>
</div>
</body>

</html>