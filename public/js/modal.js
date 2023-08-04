window.addEventListener("DOMContentLoaded", (event) => {

  console.log('modal');
  const modal = document.getElementById("myModal");
  const addNodeBtn = document.getElementById("addNodeBtn");
  const closeBtn = document.getElementsByClassName("close")[0];
  const submitForm = document.getElementById("add-form");
  const updateBtn = document.getElementById('update');
  const storeBtn = document.getElementById('store');

  function displayChange(dispayCondition) {
    modal.style.display = dispayCondition;
  }

  addNodeBtn.addEventListener("click", (event) => {
    submitForm.reset();
    submitForm.setAttribute("method", 'POST');
    storeBtn.style.display = "block";
    updateBtn.style.display = "none";
    displayChange("block");
  });


  closeBtn.addEventListener("click", (event) => {
    displayChange("none");
    
  });

  window.addEventListener("click", (event) => {
    if (event.target == modal) {
      displayChange("none");
    }
  });
});
