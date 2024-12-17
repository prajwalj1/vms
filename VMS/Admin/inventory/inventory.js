document.addEventListener('DOMContentLoaded', () => {
    fetchInventory();

    // Fetch inventory data and display it
    function fetchInventory() {
        fetch('inventory/fetch_inventory.php') // Replace with your endpoint to fetch inventory
            .then(response => response.json())
            .then(data => {
                const tbody = document.querySelector("#inventory-table tbody");
                tbody.innerHTML = "";

                data.forEach(item => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${item.item_name}</td>
                        <td>${item.item_quantity}</td>
                        <td>${item.item_price}</td>
                        <td><button onclick="deleteItem(${item.id})">Delete</button></td>
                    `;
                    tbody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching inventory:', error));
    }

    // Add item to the database
    document.getElementById('inventory-form').addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(event.target);
        fetch('inventory/insert_inventory.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(`Error: ${data.error}`);
            } else {
                alert(data.message);
                location.reload(); // Refresh the entire page
            }
        })
        .catch(error => console.error('Error adding item:', error));
    });
});

// Delete an item from the database
function deleteItem(itemId) {
    if (!confirm("Are you sure you want to delete this item?")) {
        return;
    }

    fetch(`inventory/delete_inventory.php?id=${itemId}`, { method: 'DELETE' })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload(); // Refresh the entire page
            } else {
                alert(`Error: ${data.error}`);
            }
        })
        .catch(error => console.error('Error deleting item:', error));
}

// Show/Hide Add Item Form
function toggleAddItemForm() {
    const formContainer = document.getElementById('add-item-form');
    formContainer.style.display = formContainer.style.display === 'none' ? 'block' : 'none';
}

// Cancel Add Item form
function cancelAddItem() {
    document.getElementById('add-item-form').style.display = 'none';
}
