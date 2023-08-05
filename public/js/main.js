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

  var btns = document.getElementsByClassName(".page-item");
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", () => {
    btns[i].classList.remove("active");
    });
  }
});
