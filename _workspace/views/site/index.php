<?php

/* @var $this yii\web\View */

use app\models\Person;
use app\models\Postulant;
use app\models\School;
use dosamigos\highcharts\HighCharts;

$this->title = 'Unidad Desempeño Docente';
$postulants = Postulant::Report();
?>

<div class="theme-panel hidden-xs hidden-sm">
    <div class="toggler"> </div>
    <div class="toggler-close"> </div>
    <div class="theme-options">
        <div class="theme-option theme-colors clearfix">
            <span> THEME COLOR </span>
            <ul>
                <li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default"> </li>
                <li class="color-darkblue tooltips" data-style="darkblue" data-container="body" data-original-title="Dark Blue"> </li>
                <li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue"> </li>
                <li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey"> </li>
                <li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light"> </li>
                <li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2"> </li>
            </ul>
        </div>
        <div class="theme-option">
            <span> Theme Style </span>
            <select class="layout-style-option form-control input-sm">
                <option value="square" selected="selected">Square corners</option>
                <option value="rounded">Rounded corners</option>
            </select>
        </div>
        <div class="theme-option">
            <span> Layout </span>
            <select class="layout-option form-control input-sm">
                <option value="fluid" selected="selected">Fluid</option>
                <option value="boxed">Boxed</option>
            </select>
        </div>
        <div class="theme-option">
            <span> Header </span>
            <select class="page-header-option form-control input-sm">
                <option value="fixed" selected="selected">Fixed</option>
                <option value="default">Default</option>
            </select>
        </div>
        <div class="theme-option">
            <span> Top Menu Dropdown</span>
            <select class="page-header-top-dropdown-style-option form-control input-sm">
                <option value="light" selected="selected">Light</option>
                <option value="dark">Dark</option>
            </select>
        </div>
        <div class="theme-option">
            <span> Sidebar Mode</span>
            <select class="sidebar-option form-control input-sm">
                <option value="fixed">Fixed</option>
                <option value="default" selected="selected">Default</option>
            </select>
        </div>
        <div class="theme-option">
            <span> Sidebar Menu </span>
            <select class="sidebar-menu-option form-control input-sm">
                <option value="accordion" selected="selected">Accordion</option>
                <option value="hover">Hover</option>
            </select>
        </div>
        <div class="theme-option">
            <span> Sidebar Style </span>
            <select class="sidebar-style-option form-control input-sm">
                <option value="default" selected="selected">Default</option>
                <option value="light">Light</option>
            </select>
        </div>
        <div class="theme-option">
            <span> Sidebar Position </span>
            <select class="sidebar-pos-option form-control input-sm">
                <option value="left" selected="selected">Left</option>
                <option value="right">Right</option>
            </select>
        </div>
        <div class="theme-option">
            <span> Footer </span>
            <select class="page-footer-option form-control input-sm">
                <option value="fixed">Fixed</option>
                <option value="default" selected="selected">Default</option>
            </select>
        </div>
    </div>
</div>
<!-- END THEME PANEL -->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>SISTEMA</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> Panel de Administración
    <small>Estadisticas, reportes</small>
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="1349"><?= Person::find()->count() ?></span>
                </div>
                <div class="desc"> Personas en el sistema </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 red" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="12,5"><?= School::find()->count() ?></span></div>
                <div class="desc"> Total Unidades Educativas </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="549"><?= Postulant::find()->where(['approved'=>1])->count() ?></span>
                </div>
                <div class="desc"> Postulantes aprobados </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number"> +
                    <span data-counter="counterup" data-value="89"><?= Postulant::find()->where(['approved'=>0])->count() ?></span></div>
                <div class="desc"> Postulantes desaprobados </div>
            </div>
        </a>
    </div>
</div>
<div class="clearfix"></div>
<!-- END DASHBOARD STATS 1-->
<div class="row">
    <div class="col-lg-6 col-xs-12 col-sm-12">
        <!-- BEGIN PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-dark hide"></i>
                    <span class="caption-subject font-dark bold uppercase">Reporte Gráfico de Barras</span>
                    <span class="caption-helper">aprobados y no aprobados</span>
                </div>

            </div>
            <div class="portlet-body">
                <?=
                HighCharts::widget([
                    'clientOptions' => [
                        'chart' => [
                            'type' => 'bar'
                        ],

                        'title'=> [
                            'text'=> 'Postulantes'
                        ],

                        'subtitle'=> [
                            'text' => 'Aprobados y No Aprobados'
                        ],

                        'yAxis'=> [
                            'title'=> [
                                'text'=> 'Cantidad'
                            ]
                        ],

                        'xAxis'=> [
                            'categories' => Postulant::Label($postulants)
                        ],

                        'legend'=> [
                            'layout'=> 'horizontal',
                            'align'=> 'center',
                            'verticalAlign'=> 'bottom'
                        ],

                        'series' => [[
                            'name'=> 'Aprobados',
                            'data'=> Postulant::Approved($postulants)
                        ], [
                            'name'=> 'Desaprobados',
                            'data'=> Postulant::Disapproved($postulants)
                        ]]
                    ]
                ]); ?>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
    <div class="col-lg-6 col-xs-12 col-sm-12">
        <!-- BEGIN PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-share font-red-sunglo hide"></i>
                    <span class="caption-subject font-dark bold uppercase">Reportes de tipo área</span>
                    <span class="caption-helper">por gestión</span>
                </div>

                <div class="portlet-body">
                    <?=
                    HighCharts::widget([
                        'clientOptions' => [
                            'chart' => [
                                'type' => 'area'
                            ],

                            'title'=> [
                                'text'=> 'Postulantes'
                            ],

                            'subtitle'=> [
                                'text' => 'Aprobados y No Aprobados'
                            ],

                            'yAxis'=> [
                                'title'=> [
                                    'text'=> 'Cantidad'
                                ]
                            ],

                            'xAxis'=> [
                                'categories' => Postulant::Label($postulants)
                            ],

                            'legend'=> [
                                'layout'=> 'horizontal',
                                'align'=> 'center',
                                'verticalAlign'=> 'bottom'
                            ],

                            'series' => [[
                                'name'=> 'Aprobados',
                                'data'=> Postulant::Approved($postulants)
                            ], [
                                'name'=> 'Desaprobados',
                                'data'=> Postulant::Disapproved($postulants)
                            ]]
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
</div>