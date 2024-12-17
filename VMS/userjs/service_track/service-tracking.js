
    function hideLoginPanel() {
            window.history.back(); // This will take the user to the previous page in the browser's history
        } 
    
















// document.getElementById("tracking-form").addEventListener("submit", function (event) {
//     event.preventDefault();

//     const vehicleNumber = document.getElementById("tracking-id").value.trim();
//     const statusDiv = document.getElementById("tracking-status");
//     const statusMessage = document.getElementById("status-message");
//     const updatesList = document.getElementById("status-updates");

//     if (!vehicleNumber) {
//         alert("Please enter a valid vehicle number!");
//         return;
//     }

//     // Clear previous status messages
//     updatesList.innerHTML = "";
//     statusDiv.classList.remove("hidden");
//     statusMessage.innerText = "🔍 Fetching your service details...";

//     // Fetch repair statuses from the backend
//     fetch(`fetch_items.php?vehicle_number=${vehicleNumber}`)
//         .then((response) => response.json())
//         .then((data) => {
//             if (!data.success) {
//                 statusMessage.innerText = "❌ " + data.message;
//                 return;
//             }

//             const repairStatuses = data.data[0].repair_status.split(","); // Split statuses by commas
//             let updateIndex = 0;

//             // Display statuses one by one with a 2-second delay
//             const interval = setInterval(() => {
//                 if (updateIndex < repairStatuses.length) {
//                     const updateItem = document.createElement("li");
//                     const text = repairStatuses[updateIndex].trim();
//                     updateItem.textContent = text;

//                     // Add a checkbox for "The servicing of your vehicle is now finished" status
//                     if (text === "The servicing of your vehicle is now finished. Please proceed with delivery arrangements") {
//                         const checkbox = document.createElement("input");
//                         checkbox.type = "checkbox";
//                         checkbox.value = text;
//                         checkbox.addEventListener("change", handleCheckboxChange);
//                         updateItem.appendChild(checkbox);
//                     }

//                     updatesList.appendChild(updateItem);
//                     updateIndex++;
//                 } else {
//                     clearInterval(interval);
//                     statusMessage.innerText = "✅ All updates fetched.";
//                 }
//             }, 2000);
//         })
//         .catch((error) => {
//             statusMessage.innerText = "❌ An error occurred. Please try again.";
//             console.error("Error fetching repair statuses:", error);
//         });
// });

// // Handle checkbox functionality
// function handleCheckboxChange(event) {
//     const checkbox = event.target;
//     const value = checkbox.value;

//     if (value === "The servicing of your vehicle is now finished. Please proceed with delivery arrangements" && checkbox.checked) {
//         alert("✅ Service marked as complete!");
//     } else {
//         alert("⚠️ Service still in progress.");
//     }
// }












































// document.getElementById("tracking-form").addEventListener("submit", function (event) {
//     event.preventDefault();

//     const vehicleNumber = document.getElementById("tracking-id").value.trim();
//     const statusDiv = document.getElementById("tracking-status");
//     const statusMessage = document.getElementById("status-message");
//     const updatesList = document.getElementById("status-updates");

//     if (!vehicleNumber) {
//         alert("Please enter a valid vehicle number!");
//         return;
//     }

//     // Clear previous status messages
//     updatesList.innerHTML = "";
//     statusDiv.classList.remove("hidden");
//     statusMessage.innerText = "🔍 Fetching your service details...";

//     // Fetch repair statuses from the backend
//     fetch(`fetch_items.php?vehicle_number=${vehicleNumber}`)
//         .then((response) => response.json())
//         .then((data) => {
//             if (!data.success) {
//                 statusMessage.innerText = "❌ " + data.message;
//                 return;
//             }

//             const repairStatuses = data.data[0].repair_status.split(","); // Split statuses by commas
//             let updateIndex = 0;

//             // Display statuses one by one with a 2-second delay
//             const interval = setInterval(() => {
//                 if (updateIndex < repairStatuses.length) {
//                     const updateItem = document.createElement("li");
//                     const text = repairStatuses[updateIndex].trim();
//                     updateItem.textContent = text;

//                     // Add a checkbox for "The servicing of your vehicle is now finished" status
//                     if (text === "The servicing of your vehicle is now finished. Please proceed with delivery arrangements") {
//                         const checkbox = document.createElement("input");
//                         checkbox.type = "checkbox";
//                         checkbox.value = text;
//                         checkbox.addEventListener("change", handleCheckboxChange);
//                         updateItem.appendChild(checkbox);
//                     }

//                     updatesList.appendChild(updateItem);
//                     updateIndex++;
//                 } else {
//                     clearInterval(interval);
//                     statusMessage.innerText = "✅ All updates fetched.";
//                 }
//             }, 2000);
//         })
//         .catch((error) => {
//             statusMessage.innerText = "❌ An error occurred. Please try again.";
//             console.error("Error fetching repair statuses:", error);
//         });
// });

// // Handle checkbox functionality
// function handleCheckboxChange(event) {
//     const checkbox = event.target;
//     const value = checkbox.value;

//     if (value === "The servicing of your vehicle is now finished. Please proceed with delivery arrangements" && checkbox.checked) {
//         alert("✅ Service marked as complete!");
//     } else {
//         alert("⚠️ Service still in progress.");
//     }
// }






































document.getElementById("tracking-form").addEventListener("submit", function (event) {
    event.preventDefault();

    const vehicleNumber = document.getElementById("tracking-id").value.trim();
    const statusDiv = document.getElementById("tracking-status");
    const statusMessage = document.getElementById("status-message");
    const updatesList = document.getElementById("status-updates");

    if (!vehicleNumber) {
        alert("Please enter a valid vehicle number!");
        return;
    }

    // Clear previous status messages
    updatesList.innerHTML = "";
    statusDiv.classList.remove("hidden");
    statusMessage.innerText = "🔍 Fetching your service details...";

    // Fetch repair statuses from the backend
    fetch(`fetch_items.php?vehicle_number=${vehicleNumber}`)
        .then((response) => response.json())
        .then((data) => {
            if (!data.success) {
                statusMessage.innerText = "❌ " + data.message;
                return;
            }

            const repairStatuses = data.data[0].repair_status.split(","); // Split statuses by commas
            let updateIndex = 0;

            // Keep track if the final service completion status is found
            let serviceCompleted = false;

            // Display statuses one by one with a 2-second delay
            const interval = setInterval(() => {
                if (updateIndex < repairStatuses.length) {
                    const updateItem = document.createElement("li");
                    const text = repairStatuses[updateIndex].trim();

                    // Check if the current status is the "service completed" status
                    if (text === "The servicing of your vehicle is now finished. Please proceed with delivery arrangements") {
                        serviceCompleted = true;
                    }

                    // Always display the status as plain text (no checkbox)
                    updateItem.textContent = text;
                    updatesList.appendChild(updateItem);

                    updateIndex++;
                } else {
                    clearInterval(interval);

                    // Display appropriate status message after fetching all updates
                    if (serviceCompleted) {
                        statusMessage.innerText = "✅ Service completed!";
                    } else {
                        statusMessage.innerText = "⚠️ Service still in progress.";
                    }
                }
            }, 1000);
        })
        .catch((error) => {
            statusMessage.innerText = "❌ An error occurred. Please try again.";
            console.error("Error fetching repair statuses:", error);
        });
});
