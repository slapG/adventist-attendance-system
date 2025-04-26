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

    <?= $this->Html->css([
        'https://fonts.gstatic.com',
        'https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap',
        '/assets/css/bootstrap.css',
        '/assets/vendors/iconly/bold.css',
        '/assets/css/app.css',
        '/assets/css/pages/auth.css',
    ]) ?>

    <?= $this->Html->script([
        '/datatable/jquery-3.6.0.min.js',
        '/datatable/jquery.dataTables.min.js',
        '/swal/sweetalert2@11.js',
    ])?>
    <?= $this->Html->css([
        '/datatable/jquery.dataTables.min.css',
    ])?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<div id="auth">
    <?= $this->fetch('content') ?>
</div>
</body>
</html>

