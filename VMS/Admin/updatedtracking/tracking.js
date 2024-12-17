document.addEventListener('DOMContentLoaded', () => {
    const searchButton = document.getElementById('search-vehicle');
    const repairStatus = document.getElementById('repair-status');
    const inventorySelection = document.getElementById('inventory-selection');
    const inventoryDropdown = document.getElementById('inventory-dropdown');
    const inventoryTable = document.getElementById('inventory-table');
    const submitRepair = document.getElementById('submit-repair');
    const inventorySearch = document.getElementById('inventory-search');
    const selectedItems = new Map();
    let inventoryItems = []; // Store all inventory items for filtering

    // Search vehicle number and display repair status checkboxes
    searchButton.addEventListener('click', () => {
        const vehicleNumber = document.getElementById('vehicle-number').value.trim();

        if (!vehicleNumber) {
            alert("Please enter a vehicle number");
            return;
        }

        fetch(`updatedtracking/vehicle_search.php?vehicle_number=${encodeURIComponent(vehicleNumber)}`)
            .then(response => response.json())
            .then(data => {
                console.log("Vehicle search response:", data);

                if (data.exists) {
                    repairStatus.style.display = 'block'; // Show checkboxes
                    fetchInventory(); // Load inventory items
                } else {
                    repairStatus.style.display = 'none'; // Hide checkboxes
                    alert("Vehicle not found!");
                }
            })
            .catch(error => {
                console.error("Error searching vehicle:", error);
                alert("Error searching vehicle");
            });
    });

    // Fetch inventory items
    function fetchInventory() {
        fetch('updatedtracking/inventory_fetch.php')
            .then(response => response.json())
            .then(items => {
                console.log("Inventory items fetched:", items);
                inventoryItems = items; // Store for filtering
                renderInventoryDropdown(items);
            })
            .catch(error => {
                console.error('Error fetching inventory:', error);
                alert('Failed to fetch inventory items');
            });
    }

    // Render inventory dropdown
    function renderInventoryDropdown(items) {
        inventoryDropdown.innerHTML = ''; // Clear existing options
        if (items.length > 0) {
            items.forEach(item => {
                const option = document.createElement('option');
                option.value = item.id;
                option.textContent = `${item.item_name} (${item.item_quantity} available)`;
                inventoryDropdown.appendChild(option);
            });
            inventorySelection.style.display = 'block'; // Show inventory section
        } else {
            alert('No inventory items available');
            inventorySelection.style.display = 'none'; // Hide inventory if no items
        }
    }

    // Filter inventory based on search input
    if (inventorySearch) {
        inventorySearch.addEventListener('keyup', () => {
            const query = inventorySearch.value.toLowerCase();
            const filteredItems = inventoryItems.filter(item =>
                item.item_name.toLowerCase().includes(query)
            );
            renderInventoryDropdown(filteredItems);
        });
    }

    // Add selected items to the table
    document.getElementById('add-items').addEventListener('click', () => {
        const selectedOptions = Array.from(inventoryDropdown.selectedOptions);
        const tbody = inventoryTable.querySelector('tbody');
        
        selectedOptions.forEach(option => {
            const [name, available] = option.textContent.split('(');
            const itemId = option.value;
            const existingRow = tbody.querySelector(`tr[data-id="${itemId}"]`);

            if (!existingRow) {
                const row = document.createElement('tr');
                row.setAttribute('data-id', itemId);
                row.innerHTML = `
                    <td>${name.trim()}</td>
                    <td>
                        <input type="number" min="1" max="${available.split(' ')[0]}" value="1" data-id="${itemId}" class="quantity-input">
                    </td>
                    <td>
                        <button class="remove-item">Remove</button>
                    </td>
                `;
                tbody.appendChild(row);
                selectedItems.set(itemId, 1); // Store in selected items map
            }
        });

        inventoryTable.style.display = 'table'; // Show inventory table
        submitRepair.style.display = 'block'; // Show submit button
        attachRowEvents(); // Attach event listeners for quantity and remove buttons
    });

    // Attach event listeners to table rows for quantity and remove
    function attachRowEvents() {
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const removeButtons = document.querySelectorAll('.remove-item');

        quantityInputs.forEach(input => {
            input.addEventListener('change', () => {
                const itemId = input.dataset.id;
                const quantity = parseInt(input.value, 10);

                if (quantity <= 0) {
                    selectedItems.delete(itemId); // Remove from the map
                    input.closest('tr').remove(); // Remove row
                } else {
                    selectedItems.set(itemId, quantity); // Update map
                }
            });
        });

        removeButtons.forEach(button => {
            button.addEventListener('click', () => {
                const row = button.closest('tr');
                const itemId = row.dataset.id;

                selectedItems.delete(itemId); // Remove from map
                row.remove(); // Remove row
            });
        });
    }

    // Submit the repair
    submitRepair.addEventListener('click', () => {
        const vehicleNumber = document.getElementById('vehicle-number').value.trim();
        const rows = inventoryTable.querySelectorAll('tr[data-id]');
        const inventoryItems = [];

        // Collect inventory item data
        rows.forEach(row => {
            const itemId = row.dataset.id;
            const quantity = parseInt(row.querySelector('.quantity-input').value, 10);
            if (quantity > 0) {
                inventoryItems.push([itemId, quantity]);
            }
        });

        // Collect repair status updates
        const selectedStatuses = Array.from(
            repairStatus.querySelectorAll('input:checked')
        ).map(input => input.value);

        // Validate inputs
        if (!vehicleNumber) {
            alert("Please enter a valid vehicle number.");
            return;
        }



        // Prepare repair data
        const repairData = {
            vehicle_number: vehicleNumber,
            repair_status: selectedStatuses,
            inventory: inventoryItems
        };

        // Send repair data to the server
        fetch('updatedtracking/submit_repair.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(repairData),
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                // Reset the UI
                fetchInventory();
                repairStatus.style.display = 'none';
                inventorySelection.style.display = 'none';
                inventoryTable.style.display = 'none';
                submitRepair.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error submitting repair:', error);
            alert("An error occurred while submitting the repair. Please try again.");
        });
    });
});
