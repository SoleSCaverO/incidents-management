$(document).on('ready',principal);

function principal()
{
    buttonEvents();
}

function buttonEvents()
{
    $('[data-disorder]').on('click',order);
    $('[data-order]').on('click',disorder);
}

function order()
{
    var order = $('.order');
    var div = $(this);
    div.removeAttr('data-disorder');
    div.attr('data-order','');
    order.append(div);

    buttonEvents();
}

function disorder()
{
    var disorder = $('.disorder');
    var div = $(this);
    div.removeAttr('data-order');
    div.attr('data-disorder','');
    disorder.append(div);

    buttonEvents();
}
