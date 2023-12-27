// 管理页面【虽然只有一个接口就是了】
// 对应的页面为templates/index.php
document.addEventListener('DOMContentLoaded', () => {
    $('#url-btn').on('click', function () {
        var input = document.querySelector("#url-input");
        var url = input.value;
    
        if (!url) {
            OC.dialogs.info('url不能为空', '提示');
            return;
        }

        $.ajax({
            url: '/nextcloud/index.php/apps/customizing_download_urls/saveUrl',
            method: "POST",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify({ url: url }),
            success: function() {
                OC.dialogs.info('保存成功？！', '提示');
                var customUrl = window.sessionStorage.getItem("customUrl");
                if (customUrl) {
                    window.sessionStorage.setItem("customUrl", "")
                }
            },
            error: function() {
                OC.dialogs.info('保存失败？！', '提示');
            }
        });
    });
});