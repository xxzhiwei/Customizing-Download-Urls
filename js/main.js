var customUrl = window.sessionStorage.getItem("customUrl");

function copy(text) {
    var el = document.createElement("input");
    el.value = text;
    el.style.position = "fixed";
    el.style.left = "-999999px";
    el.style.zIndex = "999999";
    document.body.appendChild(el);
    el.select();
    // 防止某些时候，新增的el没有对焦时，导致复制失败的问题
    el.focus();
    document.execCommand('copy');
    document.body.removeChild(el);
}

// navigator.clipboard 为undefind的问题【导致无法复制】；
// navigator.clipboard只能在https和localhost环境下使用
if (!navigator.clipboard) {
    navigator.clipboard = { writeText: copy };
}

if (!customUrl) {
    $.ajax({
        url: '/nextcloud/index.php/apps/customizing_download_urls/getUrl',
        method: "GET",
        dataType: "json",
        contentType: "application/json",
        success: function(resp) {
            customUrl = resp.data.url;
            window.sessionStorage.setItem("customUrl", customUrl);
        }
    });
}

// 将url拼接后，复制到粘贴板；
function copyHandler(baseUrl, url) {
    var index = url.indexOf('/nextcloud');
    
    if (index != -1) {
        url = url.slice(index + 1);
    }
    var _url = baseUrl + url;
    navigator.clipboard.writeText(_url, true);
    OC.dialogs.info('复制成功？！', '提示');
}

window.addEventListener('DOMContentLoaded', () => {
    if (OCA.Sharing && OCA.Sharing.ExternalShareActions) {
        var _instance;
        OCA.Sharing.ExternalShareActions.registerAction({
            id: "copy my custom url",
            data: function(instance) {
                _instance = instance; // instance是一个vue组件实例；
                return {
                    is: instance.$parent.$children[0].$options.components.NcActionButton, // 引用NcActionButton组件；通过vue内置的component组件渲染（查看nextcloud源码得知）
                    text: "复制我的自定义链接",
                    icon: "icon-external"
                }
            },
            shareType: [3],
            handlers: {
                click: function() {
                    var url = "";
                    if (_instance) {
                        var _share = _instance._props.share._share;
                        // 在分享链接后拼接'/download/文件名'就是完整的下载链接
                        url = _share.url + "/download" + _share.file_target;
                    }
      				_instance.$parent.$parent.$parent.$parent.$parent.$options._parentListeners['update:open'](false);
                    copyHandler(customUrl, url);
                }                
            }
        });
    }
});
