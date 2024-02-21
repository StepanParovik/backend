$(document).ready(function() {
    $('#createsmallbusiness').submit(function(e) {
        e.preventDefault(); // Предотвращаем отправку формы с помощью обычного действия
        var formData = new FormData(this);

        $.ajax({
            url: '/small_business/save', // Путь к обработчику формы на сервере
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(response) {
                $('form input, form select, form textarea').val('');
                $('#resultContainer').text('Успех');
            },
            error: function(xhr, textStatus, errorThrown) {
                // Обработка ошибок при отправке формы
                $('#resultContainer').text('Ошибка при отправке формы: ' + errorThrown);
            }
        });
    });

    // связывание с СМП
    $('#add_link').click(function() {
// Получаем значения inspection_id и small_id
        var inspection_id = $('[name="id"]').val();
        var small_id = $('#add_link').attr('small_id');

// Формируем URL для запроса
        var url = '/inspections/link/add/' + small_id + '/' + inspection_id;

// Отправляем AJAX запрос
        $.ajax({
            type: 'GET',  // Или 'POST', в зависимости от вашей логики приложения
            url: url,
            success: function(response) {
                // Здесь вы можете обработать ответ от сервера
                // Например, обновить содержимое какого-то элемента на странице
                $('#resultContainer').text('Успех');
                $('.btn-close').trigger('submit');
            },
            error: function(xhr, status, error) {
                // Обработка ошибок
                console.error('Произошла ошибка при выполнении запроса: ', error);
            }
        });
    });
});