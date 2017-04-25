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
class JqueryUiAsset extends BaseAsset
{
    public $js = [
        'assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
