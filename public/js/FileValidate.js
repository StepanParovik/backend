$(document).ready(function() {
    $('#fileInput').change(function() {
        var files = $(this).prop('files');
        var maxSize = 10240;  // Максимальный размер файла в килобайтах
        var allowedTypes = ['gif','jpg','jpeg','png','webp','pdf','doc','docx'];  // Разрешенные типы файлов
        $('#errorContainer').text('');
        $('#Enter').prop('disabled', false);
        // Проверяем каждый файл
        for (var i = 0; i < files.length; i++) {
            var file = files[i];

            // Проверяем размер файла
            if (file.size > maxSize * 1024) {
                $('#errorContainer').text('Файл ' + file.name + ' превышает максимально допустимый размер');
                $('#Enter').prop('disabled', true);
                return;
            }

            // Проверяем тип файла
            var fileType = file.name.split('.').pop().toLowerCase();
            if (allowedTypes.indexOf(fileType) == -1) {
                $('#errorContainer').text('Файл ' + file.name + ' имеет недопустимый тип');
                $('#Enter').prop('disabled', true);
                return;
            }
        }

        // Отправляем файлы на сервер
        var formData = new FormData();
        for (var i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }
        $('#errorContainer').text('');
    });
});