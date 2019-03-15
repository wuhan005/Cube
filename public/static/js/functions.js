function ShowNotification(title = 'Success', text = '', type = 'success'){
    $.extend($.gritter.options, { position: 'bottom-right' });
    $.gritter.add({
    title: title,
    text: text,
    class_name: 'color ' + type,
    });
}
