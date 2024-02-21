<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/user">Пользователи</a></li>
        <li class="breadcrumb-item" aria-current="page">Добавление</li>
    </ol>

</nav>
<div class="col-5">
    <h2>Добавление пользователя</h2>
    <?php if(isset($validation)):?>
        <div class="alert alert-warning">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif;?>
    <form action="<?php echo base_url(); ?>user/validate_data" method="post">
        <div class="form-group mb-3">
            <input type="text" name="last_name" placeholder="Фамилия*:" value="<?= set_value('last_name') ?>" class="form-control" required="required">
        </div>
        <div class="form-group mb-3">
            <input type="text" name="first_name" placeholder="Имя*:" value="<?= set_value('first_name') ?>" class="form-control" required="required">
        </div>
        <div class="form-group mb-3">
            <input type="text" name="patronymic" placeholder="Отчество" value="<?= set_value('patronymic') ?>" class="form-control" >
        </div>
        <div class="form-group mb-3">
            <input type="text" name="login" placeholder="Логин*:" value="<?= set_value('login') ?>" class="form-control" required="required">
        </div>
        <div class="form-group mb-3">
            <input type="password" name="password" placeholder="Пароль*:" class="form-control" required="required">
        </div>
        <div class="form-group mb-3">
            <input type="password" name="confirmpassword" placeholder="Подтвердите пароль*" class="form-control" required="required">
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-dark">Сохранить</button>
        </div>
    </form>
</div>
