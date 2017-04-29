<?php

/* @var $this yii\web\View */

use app\models\Postulant;
use app\models\Teaching;
use dosamigos\highcharts\HighCharts;

$this->title = 'Reporte';
$colegios = Teaching::Report();
?>

<div>
    <?=
    HighCharts::widget([
        'clientOptions' => [
            'chart'=> [
                'plotBackgroundColor' => null,
                'plotBorderWidth' => null,
                'plotShadow'=> false,
                'type'=> 'pie'
            ],
            'title'=> [
                'text'=> 'Browser market shares January, 2015 to May, 2015'
            ],
            'tooltip'=> [
                'pointFormat'=> '{series.name}: <b>{point.percentage:.1f}%</b>'
            ],
            'plotOptions' => [
                'pie'=> [
                    'allowPointSelect'=> true,
                    'cursor'=> 'pointer',
                    'dataLabels'=> [
                        'enabled'=> true,
                        'format'=> '<b>{point.name}</b>: {point.percentage:.1f} %',
                        'style'=> [
                            'color'=> '(Highcharts.theme && Highcharts.theme.contrastTextColor)' || 'black'
                        ]
                    ]
                ]
            ],
            'series'=> [
                [
                    'name'=> 'Brands',
                    'colorByPoint'=> true,
                    'data'=> Teaching::Data($colegios)
                ]
            ]
        ]
    ]); ?>
</div>