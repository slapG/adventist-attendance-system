<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Adventist Attendance Management System';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken'))?>

    <?= $this->Html->css([
        'nunito.css',
        '/assets/css/bootstrap.css',
        '/assets/vendors/iconly/bold.css',
        '/assets/vendors/perfect-scrollbar/perfect-scrollbar.css',
        '/assets/vendors/bootstrap-icons/bootstrap-icons.css',
        '/assets/css/app.css',
        'custom.css',
    ]) ?>
       
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<div id="app">
    <?= $this->element('sidebar')?>
    <div id="main">
    <?= $this->element('header')?>
    <?= $this->fetch('content') ?>
    <?= $this->element('footer') ?>
    <?= $this->Html->script([
        '/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js',
        '/assets/js/bootstrap.bundle.min.js',
        '/swal/sweetalert2@11.js',
        '/assets/js/main.js',
        ])?>
    </div>
</div>
</body>
</html>

