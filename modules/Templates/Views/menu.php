<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?php echo base_url();?>jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url();?>js/FileValidate.js"></script>
    <script src="<?php echo base_url();?>js/Small_business.js"></script>
    <script src="<?php echo base_url();?>js/menu.js"></script>
    <link href="<?php echo base_url();?>bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Путь к CSS файлу Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url();?>css/menusite.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/global.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>bootstrap-icons/font/bootstrap-icons.css" type="text/css">
    <script src="<?php echo base_url();?>bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script> <!-- Путь к JavaScript файлу Bootstrap -->
</head>
<body id="body-pd">
<header class="header" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
    <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
</header>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="/user" class="nav_logo">
                <i class='bi bi-bootstrap-fill' style="font-size: 1.5rem; color: white;"></i>
                <span class="nav_logo-name">Тестовое задание</span>
            </a>
            <div class="nav_list">
                <a href="/user" class="nav_link active" title="Пользователи">
                    <i class='bi bi-people-fill'></i>
                    <span class="nav_name">Пользователи</span>
                </a>
                <a href="/inspections" class="nav_link" title="Плановые проверки">
                    <i class='bi bi-card-checklist'></i>
                    <span class="nav_name">Плановые проверки</span>
                </a>
                <a href="/small_business" class="nav_link" title="Субъекты малого предпринимательства">
                    <i class='bi bi-person-rolodex'></i>
                    <span class="nav_name">Субъекты малого предп...</span>
                </a>
            </div>
        </div> <a href="auth/logout" class="nav_link"> <i class='bi bi-box-arrow-left'></i> <span class="nav_name">Выйти</span> </a>
    </nav>
</div>
