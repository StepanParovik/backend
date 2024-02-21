$(document).ready(function() {
    // связывание с СМП
    $('#add_link').click(function() {
        // Получаем значения inspection_id и small_id
        var inspection_id = $('[name="id"]').val();
        var small_id = $('#add_link').attr('small_id');

        // Формируем URL для запроса
        var url = '/inspections/link/add/' + small_id + '/' + inspection_id;

        $.ajax({
            type: 'GET',
            url: url,
            success: function(response) {
                // Здесь вы можете обработать ответ от сервера
                // Например, обновить содержимое какого-то элемента на странице
                $('#resultContainer').text('Успех');
                $('#spinner').hide();
            },
            error: function(xhr, status, error) {
                // Обработка ошибок
                console.error('Произошла ошибка при выполнении запроса: ', error);
                $('#spinner').hide();
            }
        });
    });
});

// success: function (response) {
//     $('form input, form select, form textarea').val('');
//     $('#resultContainer').text('Успех');