




// let isAdminMode = false;

// // Function to show the User Panel
// function showLoginPanel() {
//     document.querySelector(".headline").textContent = "Welcome to the User Panel";
//     document.getElementById("whole").style.display = "block";
//     document.getElementById("dynamicForm").action = "/vms/userjs/authentication.php";
//     document.getElementById("isAdmin").value = "0";
//     isAdminMode = false;

//     // Change URL to match user login context
//     history.pushState({ panel: 'user' }, null, "/vms/userjs/login.php");
// }

// // Function to show the Admin Panel
// function showAdminPanel() {
//     document.querySelector(".headline").textContent = "Welcome to the Admin Panel";
//     document.getElementById("whole").style.display = "block";
//     document.getElementById("dynamicForm").action = "/vms/Admin/authentication.php";
//     document.getElementById("isAdmin").value = "1";
//     isAdminMode = true;

//     // Change URL to match admin login context
//     history.pushState({ panel: 'admin' }, null, "/vms/Admin/login.php");
// }

// // Cancel button logic: Close UI without navigating history
// function hideLoginPanel(event) {
//     event.preventDefault();
//     document.getElementById("whole").style.display = "none";
//     document.getElementById("vsms").style.display = "block";

//     // Clear history URL logic and ensure no back-navigation
//     history.replaceState(null, null, "/");
// }

// // Handle browser refresh or history navigation cleanly
// window.onpopstate = function () {
//     if (window.location.pathname.includes("/vms/Admin/")) {
//         showAdminPanel();
//     } else if (window.location.pathname.includes("/vms/userjs/")) {
//         showLoginPanel();
//     }
// };
















let isAdminMode = false;

// Function to show the User Panel
function showLoginPanel() {
    document.querySelector(".headline").textContent = "Welcome to the User Panel";
    document.getElementById("whole").style.display = "block";
    document.getElementById("dynamicForm").action = "/vms/userjs/authentication.php";
    document.getElementById("isAdmin").value = "0";
    isAdminMode = false;

    // Update URL to match user login context
    history.pushState({ panel: 'user' }, null, "/vms/userjs/login.php");
}

// Function to show the Admin Panel
function showAdminPanel() {
    document.querySelector(".headline").textContent = "Welcome to the Admin Panel";
    document.getElementById("whole").style.display = "block";
    document.getElementById("dynamicForm").action = "/vms/Admin/authentication.php";
    document.getElementById("isAdmin").value = "1";
    isAdminMode = true;

    // Update URL to match admin login context
    history.pushState({ panel: 'admin' }, null, "/vms/Admin/login.php");
}

// Cancel button logic: Close UI without navigating history
function hideLoginPanel(event) {
    event.preventDefault();
    document.getElementById("whole").style.display = "none";
    document.getElementById("vsms").style.display = "block";

    // Reset URL back to home
    history.replaceState(null, null, "/");
}

// Handle Logout
// function handleLogout() {
//     const redirectUrl = isAdminMode
//         ? "/vms/Admin/logout.php?isAdmin=1"
//         : "/vms/userjs/logout.php";
//     window.location.href = redirectUrl;
// }

// Handle browser refresh or history navigation cleanly
// window.onpopstate = function () {
//     if (window.location.pathname.includes("/vms/Admin/")) {
//         showAdminPanel();
//     } else if (window.location.pathname.includes("/vms/userjs/")) {
//         showLoginPanel();
//     }
// };
// window.onpopstate = function () {
//     const path = window.location.pathname;

//     if (path.includes("/vms/Admin/") && !path.includes("/vms/userjs/")) {
//         showAdminPanel();
//     } else if (path.includes("/vms/userjs/") && !path.includes("/vms/Admin/")) {
//         showLoginPanel();
//     }
// };




// Ensure the form submission redirects correctly
document.getElementById("dynamicForm").onsubmit = function () {
    const successRedirectUrl = isAdminMode
        ? "/vms/Admin/login.php"
        : "/vms/userjs/login.php";
    this.action = isAdminMode
        ? "/vms/Admin/authentication.php"
        : "/vms/userjs/authentication.php";
};





































