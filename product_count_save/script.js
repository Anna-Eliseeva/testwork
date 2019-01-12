$(document).ready(function() {
    let $form,
        $productCount,
        $increment,
        $decrement,
        $buyButton;

    $form = $('#product-form');
    if ($form.length !== 1) {
        return;
    }

    $productCount = $form.find('#product-count');
    if ($productCount.length !== 1) {
        return;
    }

    $increment = $form.find('button[data-type=increment]');
    if ($increment.length !== 1) {
        return;
    }

    $decrement = $form.find('button[data-type=decrement]');
    if ($increment.length !== 1) {
        return;
    }

    $buyButton = $form.find('#buy-button');
    if ($buyButton.length !== 1) {
        return;
    }

    $increment.on('click', (el) => {
        let oldCount = $productCount.val();
        oldCount = parseInt(oldCount);
        $productCount.val(++oldCount);
        $decrement.prop('disabled', false);
    });

    $decrement.on('click', (el) => {
        let oldCount = $productCount.val();
        oldCount = parseInt(oldCount);

        if (oldCount > 0) {
            $productCount.val(--oldCount);
            if (oldCount < 1) {
                $(el.target).prop('disabled', true);
            }
        } else {
            $(el.target).prop('disabled', true);
        }
    });

    $buyButton.on('click', () => {
        let data = {
            cart: 'add',
            col: $productCount.val()
        };

        /** Отправляем ajax запрос на сервер */
        $.ajax({
            url: '/add_to_cart.php',
            method: 'get',
            dataType: 'json',
            data: data,
            success: (response, status, XHR) => {
                // alert(response.message);
                let $alertBlock = $('.alert');

                //Удаляем предыдущий цвет блока
                $alertBlock.removeClass('alert-danger');
                //Удаляем предыдущий текст в блоках
                $alertBlock.find('.alert-header').html(null);
                $alertBlock.find('.alert-body').html(null);

                // Вставляем новый цвет блока
                $alertBlock.addClass('alert-success');
                // Вставляем текст в блок
                $alertBlock.find('.alert-header').html(response.message);
                // блок с текстом ошибки появляется и исчезает через 3секунды
                $alertBlock.fadeIn(500, () => {
                    $('.alert').delay(3000).fadeOut(500);
                });
            },
            error: (XHR, status, errorMessage) => {
                let $alertBlock = $('.alert');
                //Удаляем предыдущий цвет блока
                $alertBlock.removeClass('alert-success');
                //Удаляем предыдущий текст в блоках
                $alertBlock.find('.alert-header').html(null);
                $alertBlock.find('.alert-body').html(null);
                // Вставляем новый цвет блока
                $alertBlock.addClass('alert-danger');
                // Вставляем текст в блок
                $alertBlock.find('.alert-header').html('Ошибка при добавлении товара');
                $alertBlock.find('.alert-body').html(XHR.responseJSON.message);
                // блок с текстом ошибки появляется и исчезает через 3секунды
                $alertBlock.fadeIn(500, () => {
                    $('.alert').delay(3000).fadeOut(500);
                });
            },
        });
    });

});