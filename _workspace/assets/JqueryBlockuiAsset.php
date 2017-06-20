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
class JqueryBlockuiAsset extends BaseAsset
{
    public $js = [
        'assets/global/plugins/jquery.blockui.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
