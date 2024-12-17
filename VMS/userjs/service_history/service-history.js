

document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('history-form');
  const historyDisplay = document.getElementById('history-display');
  const historyList = document.getElementById('history-list');
  const backButton = document.getElementById('back-button');

  // Handle form submission
  form.addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission
    const vehicleNumber = document.getElementById('vehicle-number').value.trim();

    if (!vehicleNumber) {
      alert("Please enter a valid vehicle number.");
      return;
    }

    // Send AJAX request to fetch service history
    fetch(`../../vms/Admin/fetch_service_history.php?vehicle_number=${encodeURIComponent(vehicleNumber)}`)
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          alert(data.error);
        } else {
          showHistory(data);
        }
      })
      .catch(error => {
        console.error("Error fetching service history:", error);
        alert("Failed to fetch service history.");
      });
  });

  // Function to dynamically show service history in the UI
  function showHistory(history) {
    historyList.innerHTML = ""; // Clear previous history entries
    if (history.length === 0) {
      historyList.innerHTML = "<li>No service history found for the given vehicle number.</li>";
    } else {
      history.forEach(record => {
        const listItem = document.createElement("li");
        listItem.innerHTML = `
          <strong>Date:</strong> ${record.service_date} |
          <strong>Service Type:</strong> ${record.service_type} |
          <strong>Notes:</strong> ${record.additional_notes}
        `;
        historyList.appendChild(listItem);
      });
    }

    historyDisplay.classList.remove("hidden"); // Show history section
  }

  // Handle "Back to Search" button click
  backButton.addEventListener('click', function () {
    historyDisplay.classList.add("hidden"); // Hide history section
    form.reset(); // Clear the form input
  });
});
