// POST
const storeUpdateNote = (e, url, method, id = "") => {
  e.preventDefault();
  const addForm = document.getElementById("add-form");

  // empty errors
  setErrorText("title-err");
  setErrorText("content-err");

  const noteTitle = document.getElementById("title").value;
  const noteContent = document.getElementById("content").value;

  if (noteTitle != "" && noteContent != "") {
    const data = new FormData(addForm);
    data.append("id", id);
    ajaxRequest(url, method, data);
  } else {
    if (noteTitle == "") {
      setErrorText("title-err", "Please enter a title");
    }
    if (noteContent == "") {
      setErrorText("content-err", "Please enter a content");
    }
  }
};

//error func
function setErrorText(elementId, text = "") {
  document.getElementById(elementId).innerHTML = text;
}

//add table row func
function addRow(noteTable, response) {
  let tbody = noteTable.getElementsByTagName("tbody")[0];
  let newRow = tbody.insertRow(0);
  let id = response["id"];

  let td1 = newRow.insertCell(0);
  let td2 = newRow.insertCell(1);
  let td3 = newRow.insertCell(2);
  td1.setAttribute("class", "title-" + id);

  td1.innerText = response["title"];
  td2.innerText = response["created_at"];
  td3.innerHTML = `<a href='/note/show/${id}'><button class='button show'>Show</button></a>
          <button class='button edit' onclick ='getNote(${id})'>Edit</button>
          <button class='button delete' onclick ='deleteNote(${id})'>Delete</button>`;
}

//getNoteById func
const getNote = (id) => {
  document.getElementById("myModal").style.display = "block";
  let url = "/note/find/" + id;
  ajaxRequest(url, "GET", id);
};

//DELETE func
const deleteNote = (id) => {
  console.log('del')
  let url = "/note/delete/" + id;
  document.getElementById("delModal").style.display = "block";
  document.querySelector(".deletebtn").addEventListener("click", () => {
  console.log('del222')
    document.getElementById('delModal').style.display='none';
    ajaxRequest(url, "DELETE", id);
  });
};

// success message handler
function successMessage(successMsg, addForm, myModal, resetForm = true) {
  successMsg.style.display = "block";
  setTimeout(function () {
    if (resetForm) {
      addForm.reset();
    }
    myModal.style.display = "none";
    successMsg.style.display = "none";
  }, 1000);
}

// CRUD request func
function ajaxRequest(url, method, data = "") {
  const request = new XMLHttpRequest();
  const addForm = document.getElementById("add-form");

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      const myModal = document.getElementById("myModal");
      const title = document.getElementById("title");
      const content = document.getElementById("content");
      const successMsg = document.querySelector(".successfully-saved");

      let res = "";

      if (method != "DELETE") {
        res = JSON.parse(request.response);
      }

      if (method === "GET" && url.includes("find")) {
        let updateBtn = document.getElementById("update");
        let storeBtn = document.getElementById("store");

        storeBtn.style.display = "none";
        updateBtn.style.display = "block";
        updateBtn.setAttribute("data-id", res.id);
        addForm.setAttribute("method", "POST");

        title.value = res.title;
        content.value = res.content;
      }

      if (method === "POST" && !url.includes("update")) {
        successMessage(successMsg, addForm, myModal);
        addRow(document.getElementById("notes"), res);
      }

      if (method === "DELETE") {
        let deleteRow = document.querySelector(".title-" + data);
        deleteRow.parentNode.remove();
      }

      if (method === "POST") {
        let formReset = true;
        if (document.getElementsByClassName("show-submit-btn").length > 0) {
          formReset = false;
        }
        successMessage(successMsg, addForm, myModal, formReset);
        document.querySelector(".title-" + res.id).innerText = res.title;
      }
    }
  };

  request.open(method, url);
  request.send(data);
}
