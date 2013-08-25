$(document).ready(function() {
    if ($('#type').val() > 0) {
        changeOptions($('#type').val(), $('#id').val());
    }
});

function changeOptions(eq_type_id, eq_id)
{
    // AJAX アクセス先URLをセット
    var url = $.url();
    var ajax_url = url.attr('protocol') + '://' + url.attr('host') + '/'
        + 'eq_options/type/' + eq_type_id + '/' + eq_id + '/';

    // 変更前の種別のオプション項目を削除
    // TODO アニメーションでフォームを削除
    var fieldsets = $('.module_content > fieldset');
    fieldsets.children("input[name^='option']").parent('fieldset').remove();

    // 変更後の種別のオプション項目を AJAX で取得
    $.getJSON(ajax_url, function(json) {
        $.each(json, function() {
            // 取得したオプション項目をフォームに追加
            // TODO アニメーションでフォームを追加
            var fieldsets = $('.module_content > fieldset');
            var content = $(fieldsets[0]).clone();
            content.children('label').text(this.caption);
            content.children('input').attr('name', 'option-' + this.id);
            content.children('input').attr('id', 'option-' + this.id);
            content.children('input').attr('value', this.value);
            $(fieldsets[fieldsets.length - 1]).after(content);
        });
    });
}
