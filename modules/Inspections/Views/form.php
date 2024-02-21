<head>
    <script src="<?php echo base_url();?>js/Inspections.js"></script>
</head>
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/inspections">Перечень плановых проверок</a></li>
        <li class="breadcrumb-item" aria-current="page">Добавление</li>
    </ol>
</nav>
<div class="container-fluid">
    <div class="col-5">
        <h2>Добавление</h2>
        <?php if(isset($validation)):?>
            <div class="alert alert-warning">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif;?>
        <form method="post" enctype="multipart/form-data" id="createinspections" class="form-floating">
            <input class="form-control" type="text" name="id" value = '<?php echo isset($data) ? $data->id: ''; ?>' hidden="hidden">

            <div class="form-group mb-3">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">СМП *:</span>
                    <input type="text" class="form-control" placeholder="Выберите СМП*:" disabled
                           value="<?php echo isset($data) ? htmlspecialchars($data->subject_name . ' ИНН: ' . $data->inn . ' КПП: ' . $data->kpp): ''; ?>">
                    <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalTable">Добавить</button>
                    <button class="btn btn-outline-secondary" type="button">Удалить</button>
                </div>
            </div>

            <div class="form-floating mb-3">
                <select id="select" class="form-select" aria-label="Default select" required="required" name = "select_rubricators">
                    <option>Не задано</option>
                    <?php $n=0;
                    foreach ($rubricators[0] as $rubricator): ?>
                        <option value="<?= $rubricator->id?>" <?= (set_value('control_body') == $rubricator->id || (isset($data->control_body) && $data->control_body == $rubricator->id)) ? 'selected' : ''; ?>>
                            <?= $rubricator->name?>
                        </option>
                    <?php endforeach ?>
                </select>
                <label for="select">Контроллирующий орган *:</label>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input id="period_start" type="date" name="period_start" value="<?php echo isset($data) ? $data->period_start : ''; ?>" class="form-control" placeholder="С" aria-label="С">
                        <label for="period_start">Дата проверки с</label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-floating mb-3">
                        <input id="period_end" type="date" name="period_end" value="<?php echo isset($data) ? $data->period_end : ''; ?>" class="form-control" placeholder="По" aria-label="По">
                        <label for="period_end">Дата проверки по</label>
                    </div>
                </div>
            </div>

            <div class="form-floating mb-3">
                <input id="planned_duration" type="text" name="planned_duration" placeholder="Плановая длительность проверки*:" value="<?php echo isset($data) ? $data->planned_duration: ''; ?>" class="form-control" required="required">
                <label for="planned_duration">Плановая длительность проверки *:</label>
            </div>

            <div class="mb-3">
                <label for="formFileMultiple" class="form-label">Выберите один или несколько файлов</label>
                <input class="form-control" type="file" name="attached[]" id="fileInput">
                <div id="errorContainer"></div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success" id="Enter">Сохранить</button>
            </div>
        </form>
        <div id="resultContainer"></div>
    </div>
    <!-- Модальное окно -->
    <div class="modal fade" id="modalTable" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Заголовок модального окна</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
</div>
</body>

