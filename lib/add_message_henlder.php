<script>
// <-- Проверка валидности формы
$(document).ready(function() {
    $("#ajaxform").submit(function(){
        var form = $(this);
        var return_bool = false;
        var data = form.serialize();
        $.ajax({
            type: 'POST',
            url: 'lib/ajax_hendler.php',
            dataType: 'json',
            data: data,
            async: false,
            beforeSend: function(data) {
                $("#submit").attr('disabled', 'disabled');
            },
            success: function(data){
                if (data['error']) {
                    $("#captcha").attr('src', '../captcha/captcha.php');
                    $("#error").show().html(data['error']);
                    $("#submit").attr('disabled', 'unable');
                } else {
                    return_bool =  true;
                }
            },
            complete: function(data) {

            }

        });
        return return_bool;
    });


    function tag(text1, text2)
    {
        if ((document.selection))
        {
            document.form.content.focus();
            document.form.document.selection.createRange().text = text1+document.form.document.selection.createRange().text+text2;
        } else if(document.forms['ajaxform'].elements['message'].selectionStart != undefined) {
            var element    = document.forms['ajaxform'].elements['message'];
            var str     = element.value;
            var start    = element.selectionStart;
            var length    = element.selectionEnd - element.selectionStart;
            element.value = str.substr(0, start) + text1 + str.substr(start, length) + text2 + str.substr(start + length);
        } else document.form.content.value += text1+text2;
        document.form.content.focus();
        element.selectionStart = element.selectionEnd = start;
    }

    document.getElementById("button_strong").onclick = function () {
        tag("[strong]", "[/strong]");
    }

    document.getElementById("button_strike").onclick = function () {
        tag("[strike]", "[/strike]");
    }

    document.getElementById("button_italic").onclick = function () {
        tag("[italic]", "[/italic]");
    }

    document.getElementById("button_code").onclick = function () {
        tag("[code]", "[/code]");
    }

    document.getElementById("button_link").onclick = function () {
        tag("[url=]", "[/url]");
    }

    document.getElementById("refresh").onclick = function () {
       $("#captcha").attr('src', 'captcha/captcha.php');
    }

    document.getElementById("button_preview").onclick = function () {
        $("#preview_message").attr('value', $("#message").val())
    }

});


</script>