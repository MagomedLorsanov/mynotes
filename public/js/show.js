window.addEventListener("DOMContentLoaded", (event) => {
  let updateBtn = document.getElementById("update");
  updateBtn.addEventListener("click", (e) => {
    storeUpdateNote(
      e,
      "/note/update/" + updateBtn.dataset.id,
      "POST",
      updateBtn.dataset.id
    );
  });
});
