/**
 * Created by zchi on 2017/7/19.
 */
$(function () {
    // commentValidateInit();
});

function commentSubmit(btn) {
    let $submitBtn=$('#comment-sumbit-btn').attr('disabled','disabled');
    let commentFormData=$('#review-form').serializeJSON();
    if(validate(commentFormData)){
        $.ajax({'url':'/comment/add',method:'post',dataType:'json',data:commentFormData,success:function (res) {
            $submitBtn.removeAttr('disabled');
            if(res.result===0)alert('ok');
            else {

            }
        },error:function (err) {
            $submitBtn.removeAttr('disabled');
            console.log(err);
        }})
    }else {
        $submitBtn.removeAttr('disabled');
    }
}

function validate(commentFormData) {
    return !!(commentFormData.name && commentFormData.email && commentFormData.content);
}

function commentValidateInit() {
    $('#review-form').validate();
}