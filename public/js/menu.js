$(document).ready(function() {

    $(".l-navbar")
        .mouseenter(function () {
            // навели курсор на объект (не учитываются переходы внутри элемента)
            $('.l-navbar').css('width', '280px');
        })
        .mouseleave(function () {
            // отвели курсор с объекта (не учитываются переходы внутри элемента)
            $('.l-navbar').css('width', 'var(--nav-width)');
        });
})