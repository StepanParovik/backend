
<container>
    <?php echo $spinner; ?>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Реестры <span class="breadcrumb-divider">></span></li>
            <li class="breadcrumb-item active" aria-current="page">Плановые проверки</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col col-lg-3">
            <a class="btn btn-success" href="/inspections/create" role="button">Добавить</a>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                Импортировать
            </button>
            <a class="btn btn-success" href="/inspections/exportToExcel" role="button">Экспортировать</a>
        </div>
        <div class="col col-lg-1">
        </div>
        <div class="col">
            <form id = "search_form" method="post">
                <div class="row g-2">
                    <div class="col-md">
                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-success" id="Enter">Найти</button>
                        </div>
                    </div>
                    <div class="col-md">
                        <input type="text" name="subject_name" class="form-control" placeholder="СМП" aria-label="С">
                    </div>
                    <div class="col-md">
                        <input type="date" name="period_start" class="form-control" placeholder="Дата проверки c" aria-label="По">
                    </div>
                    <div class="col-md">
                        <input type="date" name="period_end" class="form-control" placeholder="По" aria-label="По">
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
            <th>
                <th scope="col">СМП</th>
                <th scope="col">Контролирующий орган</th>
                <th scope="col">Плановый период</th>
                <th scope="col">Плановая длительность</th>
                <th scope="col">Действия</th>
            </tr>
            </thead>
            <tbody id = "table_body">
            </tbody>
        </table>

        <div class="d-flex justify-content-end pagination">
            <!-- Пагинация -->
        </div>

    <!-- Модальное окно -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Импорт данных</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Импорт поддерживается из файлов следующих форматов: .xls, .xlsx; <br>
                                Максимальный размер: нет ограничений. <br>
                                <a href="<?php echo base_url();?>/sd.s">Скачать шаблон для импорта</a>
                            </label>
                            <input class="excel_file" type="file" id="excel_file" accept=".xls, .xlsx">
                            <div id="errorContainer"></div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-start">
                        <button type="button" class="btn btn-primary" id="import">Импортировать</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
</container>
<script src="<?php echo base_url();?>js/Inspections.js"></script>
