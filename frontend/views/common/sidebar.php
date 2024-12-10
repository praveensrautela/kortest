<?php
$action = Yii::$app->controller->action->id;
$con = Yii::$app->controller->id;
?>

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="<?= STATIC_URL ?>assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Brandname</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="<?= $action == 'index' && $con = 'dashboard' ? 'mm-active' : '' ?>">
            <a href="<?= BASE_URL ?>dashboard">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Megabill</div>
            </a>
        </li>
        <li class="<?= $action == 'cluster' && $con = 'dashboard' ? 'mm-active' : '' ?>">
            <a href="<?= BASE_URL ?>cluster">
                <div class="parent-icon"><i class='bx bx-cube-alt'></i>
                </div>
                <div class="menu-title">Cluster</div>
            </a>
        </li>
        <!-- <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Application</div>
            </a>
            <ul>
                <li> <a href="app-emailbox.html"><i class='bx bx-radio-circle'></i>Email</a>
                </li>
            </ul>
        </li> -->
        <!-- <li class="menu-label">UI Elements</li> -->

    </ul>
    <!--end navigation-->
</div>