<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Repair Tracking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 900px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input, select, button {
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        .checkbox-group {
            margin-top: 15px;
        }

        .inventory-items {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vehicle Repair Tracking</h1>
        <form id="vehicle-form" action="#">
            <label for="vehicle-number">Search Vehicle Number:</label>
            <input type="text" id="vehicle-number" name="vehicle_number" placeholder="Enter vehicle number" required>
            <button type="button" value="Submit" id="search-vehicle">Search</button>
        </form>

        <div id="repair-status" name="repair_status" style="display:none;">
            <h2>Repair Status</h2>
            <div class="checkbox-group">
            <label><input type="checkbox" value="Your vehicle is checked in at the service center."> Your vehicle is checked in at the service center.</label><br>
<label><input type="checkbox" value=" Your vehicle is currently in the inspection phase"> Your vehicle is currently in the inspection phase</label><br>
<label><input type="checkbox" value="Repair work has started on your vehicle and is progressing as planned"> Repair work has started on your vehicle and is progressing as planned</label><br>
<label><input type="checkbox" value="Parts have been ordered for your vehicle, and we are waiting for delivery"> Parts have been ordered for your vehicle, and we are waiting for delivery</label><br>
<label><input type="checkbox" value="The required parts have been received, and we will begin repairs shortly"> The required parts have been received, and we will begin repairs shortly</label><br>
<label><input type="checkbox" value="Repairs on your vehicle are now complete and undergoing quality checks"> Repairs on your vehicle are now complete and undergoing quality checks</label><br>
<label><input type="checkbox" value="Your vehicle has successfully passed the quality check and is ready for pickup"> Your vehicle has successfully passed the quality check and is ready for pickup</label><br>
<label><input type="checkbox" value="The servicing of your vehicle is now finished. Please proceed with delivery arrangements"> The servicing of your vehicle is now finished. Please proceed with delivery arrangements</label><br>

    </div>
        </div>

        <div id="inventory-selection" style="display:none;">
            <h2>Select Inventory Items</h2>
            <input type="text" id="inventory_search" name="inventory" placeholder="Search inventory items...">
            <select id="inventory-dropdown" multiple>
                <!-- Items will be populated dynamically -->
            </select>
            <button type="button" id="add-items">Add Items</button>
        </div>

        <table id="inventory-table" style="display:none;">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <!-- Selected items will be displayed here -->
            </tbody>
        </table>

        <button type="button" id="submit-repair" style="display:none;">Submit Repair</button>
    </div>

    <script src="updatedtracking/tracking.js"></script>
</body>
</html>