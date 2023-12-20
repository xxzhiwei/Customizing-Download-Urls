<?php
    use OCP\Util;
    $appId = OCA\FilesCustomUrlPlugin\AppInfo\Application::APP_ID;
    Util::addScript($appId, 'page');
?>

<div id="app-content">
    <div style="padding: 80px;">
        <div style="margin-bottom: 24px; font-size: 28px;">Files Custom Url Plugin配置管理</div>
        <span>自定义路径：</span>
        <?php
            echo '<input style="width: 300px;" id="url-input" value="' . $_['url'] . '" />';
        ?>
        &nbsp;<button id="url-btn">保存</button>
    </div>
</div>