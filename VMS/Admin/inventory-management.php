<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

.container {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 80%;
    max-width: 900px;
}

h1, h2 {
    text-align: center;
    color: #333;
}

button {
    background-color: #3498db;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
    font-size: 1rem;
    margin-top: 10px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #2980b9;
}

table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}

table th, table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
}

input:focus {
    border-color: #3498db;
    outline: none;
}

.form-container {
    margin-top: 20px;
}

#add-item-form button {
    background-color: #2ecc71;
}

#add-item-form button:hover {
    background-color: #27ae60;
}

#cancel-add {
    background-color: #e74c3c;
}

#cancel-add:hover {
    background-color: #c0392b;
}

</style>
</head>
<body>

    <div class="container">
        <h1>Inventory Management</h1>
        <div class="inventory-controls">
            <button id="add-item-btn" onclick="toggleAddItemForm()">Add Item</button>
        </div>

        <div id="add-item-form" class="form-container" style="display:none;">
            <h2>Add New Inventory Item</h2>
            <form id="inventory-form" action="inventory/insert_inventory.php">
                <label for="item-name">Item Name:</label>
                <input type="text" id="item-name" name="item_name" required>

                <label for="item-quantity">Quantity:</label>
                <input type="number" id="item-quantity" name="item_quantity" required>

                <label for="item-price">Price per Item:</label>
                <input type="number" id="item-price" name="item_price" required>

                <button type="submit" id="submit-item">Add Item</button>
                <button type="button" id="cancel-add" onclick="cancelAddItem()">Cancel</button>
            </form>
        </div>

        <h2>Inventory List</h2>
        <table id="inventory-table">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price per Item</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Inventory items will be displayed here -->
            </tbody>
        </table>
    </div>

    <script src="inventory/inventory.js"></script>
</body>
</html>
