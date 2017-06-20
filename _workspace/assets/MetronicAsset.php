<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MetronicAsset extends BaseAsset
{
    public $css = [
        'assets/global/css/components.min.css',
        'assets/global/css/plugins.min.css',
        'assets/layouts/layout/css/layout.min.css',
        'assets/layouts/layout/css/themes/default.min.css',
        'assets/layouts/layout/css/custom.min.css',
    ];
    public $js = [
        'assets/global/scripts/app.min.js',
        'assets/layouts/layout/scripts/layout.min.js',
        'assets/layouts/layout/scripts/demo.min.js',
        'assets/layouts/global/scripts/quick-sidebar.min.js',
        'assets/layouts/global/scripts/quick-nav.min.js',
    ];
    public $depends = [
        'app\assets\GoogleFontsAsset',
        'app\assets\FontAwesomeAsset',
        'app\assets\SimpleLineIconsAsset',
        'app\assets\JquerySlimscrollAsset',
        'app\assets\JqueryBlockuiAsset',
        'app\assets\JqueryCookieAsset',
        'app\assets\BootstrapSwitchAsset',
    ];
}
