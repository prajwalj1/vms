document.addEventListener("DOMContentLoaded", () => {
  const logoutButton = document.getElementById("logout-btn");
  const modal = document.getElementById("logout-modal");
  const confirmLogout = document.getElementById("confirm-logout");
  const cancelLogout = document.getElementById("cancel-logout");

  logoutButton.addEventListener("click", () => {
    modal.style.display = "flex";
  });

  cancelLogout.addEventListener("click", () => {
    modal.style.display = "none";
  });

  confirmLogout.addEventListener("click", () => {
    window.location.href = "login.php";
  });
});
