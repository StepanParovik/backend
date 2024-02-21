<head>
    <script src="<?php echo base_url();?>js/Small_business_table.js"></script>
</head>
<container>
    <?php if ($inspections_id === null): ?>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Реестры <span class="breadcrumb-divider">></span></li>
                <li class="breadcrumb-item active" aria-current="page">Субьекты малого предпринимательства</li>
            </ol>
        </nav>
    <?php endif ?>
    <a class="btn btn-success" href="/small_business/create" role="button">Добавить</a>
    <?php if ($inspections_id === null): ?>
    <?php endif ?>
    <table class="table table-striped table-bordered">
        <thead>
            <th></th>
            <th scope="col">Наименование</th>
            <th scope="col">ИНН</th>
            <th scope="col">КПП</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Действия</th>
        </thead>
        <tbody>
        <?php $n=1;
        if (! empty($data) && is_array($data)): ?>
            <?php foreach ($data as $data_item): ?>
                <tr>
                    <th scope="row"><?=$n?></th>
                    <td><?= esc($data_item['subject_name']) ?></td>
                    <td><?= esc($data_item['inn']) ?></td>
                    <td><?= esc($data_item['kpp']) ?></td>
                    <td><?= esc($data_item['create_date'] = date("d.m.Y")) ?></td>
                    <td>
                        <?php if (!is_null($inspections_id)): ?><button type="button" class="btn btn-outline-secondary" id="add_link" small_id = '<?= esc($data_item['id'])?>'>Связать</button><?php endif ?>
                        <?php if ($inspections_id === null): ?><a href="small_business/edit/<?= esc($data_item['id'])?>" class="btn btn-outline-secondary">Ред.</a><?php endif ?>
                        <?php if ($inspections_id === null): ?><a href="small_business/delete/<?= esc($data_item['id'])?>" class="btn btn-outline-secondary">Удалить</a><?php endif ?>
                    </td>
                </tr>
            <?php $n++;
            endforeach ?>

        <?php else: ?>
            <th scope="row"><?=$n?></th>
            <td>Нет записей</td>

        <?php endif ?>
        </tbody>
    </table>
    <!-- Пагинация -->
    <div class="d-flex justify-content-end">
        <?= $pager?>
    </div>
    <!-- Модальное окно -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Заголовок модального окна</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Импорт поддерживается из файлов следующих форматов: .xls, .xlsx; <br>
                                Максимальный размер: нет ограничений. <br>
                                <a href="<?php echo base_url();?>/sd.s">Скачать шаблон для импорта</a>
                            </label>

                            <input class="form-control" type="file" name="attached[]" id="fileInput" accept=".xls, .xlsx">
                            <div id="errorContainer"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </div>
            </div>
        </div>
</container>

