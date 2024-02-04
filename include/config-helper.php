<?php

/**
 * 主题配置备份
 *
 * @author      rehiy <https://www.rehiy.com>
 * @version     1.0.0
 */

$name = 'waxyz';

$db = Typecho_Db::get();

$themeData = $db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name));
$themeData = $themeData['value'] ?? null;

$themeBackup = $db->fetchRow($db->select()->from('table.options')->where('name = ?', 'themeBackup:' . $name));
$themeBackup = $themeBackup['value'] ?? null;

if (isset($_POST) && $themeData) {
    // 备份配置
    if (!empty($_POST["backup"])) {
        if ($themeBackup) {
            $result = $db->query($db->update('table.options')->rows(array('value' => $themeData))->where('name = ?', 'themeBackup:' . $name));
        } else {
            $result = $db->query($db->insert('table.options')->rows(array('name' => 'themeBackup:' . $name, 'user' => '0', 'value' => $themeData)));
        }
        if ($result) {
            echo '<div class="message popup success" style="position: absolute; top: 36px; display: block;"><ul><li>主题数据备份成功</li></ul></div>';
        }
        echo '<script>setTimeout(function(){window.location = location.href},1000)</script>';
    }
    // 恢复配置
    if (!empty($_POST["restore"])) {
        if ($themeBackup) {
            $result = $db->query($db->update('table.options')->rows(array('value' => $themeBackup))->where('name = ?', 'theme:' . $name));
            if ($result) {
                echo '<div class="message popup success" style="position: absolute; top: 36px; display: block;"><ul><li>主题数据恢复成功</li></ul></div>';
            }
        } else {
            echo '<div class="message popup error" style="position: absolute; top: 36px; display: block;"><ul><li>抱歉，请先进行主题数据备份</li></ul></div>';
        }
        echo '<script>setTimeout(function(){window.location = location.href},1000)</script>';
    }
}
?>

<form class="protected home col-mb-12" action="" method="post">
    <ul class="typecho-option" style="position: relative;left: -9px;">
        <li>
            <label class="typecho-label">主题配置备份</label>
            <input type="submit" name="backup" class="btn primary" value="备份配置">
            <input type="submit" name="restore" class="btn primary" value="恢复配置">
        </li>
    </ul>
</form>