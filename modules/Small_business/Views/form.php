<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/inspections">Субьекты малого предпринимательства</a></li>
        <li class="breadcrumb-item" aria-current="page">Добавление</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="col-5">
        <h2>Редактирование</h2>
        <?php if(isset($validation)):?>
            <div class="alert alert-warning">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif;?>
        <form method="post" enctype="multipart/form-data" id="createsmallbusiness">
            <input class="form-control" type="text" name="id" value = '<?php echo isset($data) ? $data['id']: ''; ?>' hidden="hidden">

            <div class="form-group mb-3">
                <input type="text" name="subject_name" placeholder="Наименование*:" value="<?php echo isset($data) ? htmlspecialchars($data['subject_name']): ''; ?>" class="form-control" required="required">
            </div>

            <div class="form-group mb-3">
                <input type="text" name="inn" placeholder="ИНН*:" value="<?php echo isset($data) ? $data['inn']: ''; ?>" class="form-control" required="required">
            </div>

            <div class="form-group mb-3">
                <input type="text" name="kpp" placeholder="КПП*:" value="<?php echo isset($data) ? $data['kpp']: ''; ?>" class="form-control" required="required">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-dark" id="Enter" data-record-id="<?php echo isset($data) ? $data['id']: ''; ?>">Сохранить</button>
            </div>
        </form>
        <div id="resultContainer"></div>
    </div>
</div>
</body>

