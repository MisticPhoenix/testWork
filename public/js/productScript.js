const input = document.getElementById('product-visible');
$('#product-visible').on('input', function() {
    if (!/^[01]?$/.test($(this).val())) {
        $(this).val($(this).val().slice(0, -1));
    }
});

function trimText(text, maxLength, ending = '...') {
    return text.length > maxLength ? text.slice(0, maxLength) + ending : text;
}

limitRows();

function remove(id){
    $.ajax({
        url: `/api/products/destroy/${id}`,
        type: 'DELETE',
        contentType: 'application/json',
        data: JSON.stringify(id),
        success: function(response) {
            $(`#product-${id}`).remove();
            limitRows();
        },
        error: function(xhr, status, error) {
            console.error('Ошибка:', error);
            alert('Произошла ошибка при удалении записи');
        }
    });
}

function store(){
    let id = parseInt($('#product-id').val()) + 1;
    let name = $('#product-name').val();
    let price = $('#product-price').val();
    let quantity = $('#product-quantity').val();
    let visible = $('#product-visible').val();

    const data = {
        id: id,
        name: name,
        price: price,
        quantity: quantity,
        visible: visible
    };

    if (!data.name || !data.price || !data.quantity || !data.visible) {
        alert('Все поля должны быть заполнены!');
        return;
    }

    $('#product-id').val(id);

    $.ajax({
        url: '/api/products',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
            let newRow = $('<tr>', { id: 'product-' + data.id });
            newRow.html(`
                <td>${data.id}</td>
                <td>${data.name}</td>
                <td>${data.price}</td>
                <td>${data.quantity}</td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="remove(${data.id})">Delete</button>
                </td>
                <td>
                    <button type="button" class="btn btn-warning" onclick="update()">Update</button>
                </td>
            `);
            $('#product-table').append(newRow);
            limitRows();
        },
        error: function(xhr) {
            let errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Ошибка при сохранении данных';
            alert(errorMessage);
        }
    });
}


function update(){
    alert("Почти так же, как и при создании");
}

function limitRows() {
    const rows = $("#product-table tr");
    let limit = parseInt($('#product-count').val());
    const newURL = window.location.origin + '/' + limit;

    rows.each(function(index) {
        if (index < limit) {
            let nameCell = $(this).find("td:eq(1)");
            let name = nameCell.text().trim();
            nameCell.text(trimText(name, 18));
            $(this).show();  // Показать строку
        } else {
            $(this).hide();  // Скрыть строку
        }
    });

    window.history.replaceState(null, null, newURL);
}