window.addEventListener("DOMContentLoaded", (event) => {
  event.preventDefault();
  const saveBtn = document.getElementById("store");
  const updateBtn = document.getElementById("update");

  saveBtn.addEventListener("click", (e) => {
    storeUpdateNote(e, "/note/store", "POST");
  });

  updateBtn.addEventListener("click", (e) => {
    storeUpdateNote(
      e,
      "/note/update/" + updateBtn.dataset.id,
      "POST",
      updateBtn.dataset.id
    );
  });
});