$(document).ready(function() {
    //$('#search_form').trigger('submit');

    // Отправка формы
    $('#createinspections').submit(function (e) {
        e.preventDefault(); // Предотвращаем отправку формы с помощью обычного действия
        var formData = new FormData(this);

        $.ajax({
            url: '/inspections/save',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                $('form input, form select, form textarea').val('');
                $('#resultContainer').text('Успех');
            },
            error: function (xhr, textStatus, errorThrown) {
                $('#resultContainer').text('Ошибка при отправке формы: ' + errorThrown);
            }
        });
    });

    // При открытии модального окна
    $('#modalTable').on('show.bs.modal', function () {
        $('#spinner').show();
        var value = $('[name="id"]').val();
        var url = '/small_business/get_table/' + value;
        // Загружаем содержимое файла inspection
        $.get(url, function (data) {
            // Помещаем содержимое файла в тело модального окна
            $('.modal-body').html(data);
            $('#spinner').hide();
        });
    });

    // Поиск по таблице
    $('#search_form').submit(function(e){
        e.preventDefault();
        $('#spinner').show();
        var formData = new FormData(this);

        $.ajax({
            url: 'inspections/search',
            method: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response){
                // Обновить таблицу новыми данными
                $('#table_body').html(response.results);
                $('.pagination').html(response.pagination);
                $('#spinner').hide();
            },
            error: function (xhr, textStatus, errorThrown) {
                $('#spinner').hide();
            }
        });
    });

    // Импорт данных
    $('#import').click(function () {
// Получить данные формы
        var formData = new FormData();
        var fileInput = document.getElementById('excel_file');
        formData.append('file', fileInput.files[0]);

// Отправить данные через AJAX
        $.ajax({
            url: '/inspections/import',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Обработка успешного ответа
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Обработка ошибки
            }
        });
    });

    $('#search_form').trigger('submit');
})