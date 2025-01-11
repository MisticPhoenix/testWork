const input = document.getElementById('product-visible');
input.addEventListener('input', function() {
    if (!/^[01]?$/.test(this.value)) {
        this.value = this.value.slice(0, -1); // Убираем последний введённый символ
    }
});

limitRows();

function deleteProduct(id){
    fetch(`/api/products/destroy/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(id)
    })
        .then(response => {
            if (response.ok) {
                document.getElementById(`product-${id}`).remove();
                limitRows();
            } else {
                throw new Error('Ошибка HTTP: ' + response.status);
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            alert('Произошла ошибка при удалении записи');
        });
}
function  storeProduct() {
    let id = parseInt(document.getElementById('product-id').value) + 1;
    let name = document.getElementById('product-name').value;
    let price = document.getElementById('product-price').value;
    let quantity = document.getElementById('product-quantity').value;
    let visible = document.getElementById('product-visible').value;

    const data = {
        id : id,
        name: name,
        price: price,
        quantity: quantity,
        visible: visible
    };

    if (!data.name || !data.price || !data.quantity || !data.visible) {
        alert('Все поля должны быть заполнены!');
        return;
    }

    document.getElementById('product-id').value = id;

    fetch('/api/products', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
        .then(response => {
            if (response.ok) {
                let newRow = document.createElement('tr');
                newRow.id = 'product-' + data.id;
                newRow.innerHTML = `
                    <td>${data.id}</td>
                    <td>${data.name}</td>
                    <td>${data.price}</td>
                    <td>${data.quantity}</td>
                    <td>
                        <button class="delete-btn" onclick="deleteProduct(${data.id})">Delete</button>
                    </td>
                    <td>
                        <button class="delete-btn" onclick="updateProduct()">Update</button>
                    </td>
                `;
                document.getElementById('product-table').appendChild(newRow);
                limitRows();

            } else {
                alert(data.message || 'Ошибка при сохранении данных');
            }
        })
        .catch(error => {
            // Обрабатываем ошибки
            console.error('Ошибка:', error);
            alert('Произошла ошибка при отправке данных');
        });
}

function updateProduct(){
    alert("Почти так же, как и при создании");
}

function limitRows() {
    const rows = document.querySelectorAll("#product-table tr");
    let limit = parseInt(document.getElementById('product-count').value);
    const newURL = window.location.origin + '/' + limit;

    rows.forEach((row, index) => {
        console.log(limit)
        console.log(index);
        if (index >= limit) {
            row.style.display = "none";
        } else {
            row.style.display = "";
        }
    });
    window.history.replaceState(null, null, newURL);
}