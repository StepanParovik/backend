<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url();?>/bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Путь к CSS файлу Bootstrap -->
    <script src="<?php echo base_url();?>/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script> <!-- Путь к JavaScript файлу Bootstrap -->
</head>
<body>
<div class="vh-100 gradient-custom">
    <div class="p-5 bg-imиage" style ="background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg'); height: 100%">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2>Авторизация</h2>
                                <form action="<?php echo base_url(); ?>auth/loginAuth" method="post">
                                    <div class="form-outline form-white mb-4">
                                        <input type="text" name="login" placeholder="Логин" value="<?= set_value('login') ?>" class="form-control form-control-lg" >
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <input type="password" name="password" placeholder="Пароль" value="<?= set_value('password') ?>" class="form-control form-control-lg" >
                                    </div>
                                    <?php if(session()->getFlashdata('msg')):?>
                                        <div class="alert alert-warning">
                                            <?= session()->getFlashdata('msg') ?>
                                        </div>
                                    <?php endif;?>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-success btn-lg">Войти</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
