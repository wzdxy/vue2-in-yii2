/**
 * Created by zchi on 2017/7/19.
 */
$(function () {
    // commentValidateInit();
    $('pre code').each(function(i, block) {
        hljs.highlightBlock(block);
    });
});

function commentSubmit(btn) {
    const timeout=3000;
    let $submitBtn=$('#comment-sumbit-btn').attr('disabled','disabled');
    let $form=$('#review-form');
    let commentFormData=$form.serializeJSON();
    if(validate(commentFormData)){
        $.ajax({'url':'/comment/add',method:'post',dataType:'json',data:commentFormData,success:function (res) {
            $submitBtn.removeAttr('disabled');
            if(res.result===0){
                $form[0].reset();
                Materialize.toast('reviewed success', timeout)
            }else {
                Materialize.toast(res.message, timeout)
            }
        },error:function (err) {
            $submitBtn.removeAttr('disabled');
            Materialize.toast(err.toString(), timeout)
        }})
    }else {
        $submitBtn.removeAttr('disabled');
        Materialize.toast('input invalid', timeout)
    }
}

function validate(commentFormData) {
    return !!(commentFormData.author_name && commentFormData.author_email && commentFormData.text);
}

function commentValidateInit() {
    $('#review-form').validate();
}