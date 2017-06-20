<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BootstrapSwitchAsset extends BaseAsset
{
    public $css = [
        'assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'
    ];
    public $js = [
        'assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
