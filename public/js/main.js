window.addEventListener("DOMContentLoaded", (event) => {
  event.preventDefault();
  const saveBtn = document.getElementById("store");
  const addForm = document.getElementById("add-form");
  const updateBtn = document.getElementById("update");


  // POST
  const storeUpdateNote = (e,url,method,id = '') => {
    // empty errors
    setErrorText("title-err");
    setErrorText("content-err");

    e.preventDefault();
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

  saveBtn.addEventListener("click", (e) => {
    storeUpdateNote(e, "/note/store", "POST");
  });
  updateBtn.addEventListener("click", (e) => {
    storeUpdateNote(e, "/note/update/" + updateBtn.dataset.id, "PUT", updateBtn.dataset.id);
  });
});

//error func
function setErrorText(elementId, text = "") {
  document.getElementById(elementId).innerHTML = text;
}

//add table row func
function addRow(noteTable, response) {
  let tbody = noteTable.getElementsByTagName("tbody")[0];
  let newRow = tbody.insertRow(0);

  let td1 = newRow.insertCell(0);
  let td2 = newRow.insertCell(1);
  let td3 = newRow.insertCell(2);

  td1.innerText = response["title"];
  td2.innerText = response["created_at"];
  td3.innerHTML = `<button class='button show' onclick ='showNote(${response["id"]})'>Show</button>
        <button id='modalBtn_${response["id"]}' class='button edit' onclick ='getNote(${response["id"]})'>Edit</button>
        <button id='${response["id"]}' class='button delete' onclick ='deleteNote(${response["id"]})'>Delete</button>`;
}

//getNoteById func
const getNote = (id) => {
  document.getElementById("myModal").style.display = "block";
  let url = "/note/find/" + id;
  ajaxRequest(url, "GET", id);
};

//DELETE func
const deleteNote = (id) => {
  let url = "/note/delete/" + id;
  ajaxRequest(url, "DELETE", id);
};

//Show func
const showNote = (id) => {
  let url = "/note/show/" + id;
  window.location.href = url;
  // ajaxRequest(url,"GET", id);
}

// CRUD request func
function ajaxRequest(url, method, data = "") {
  const request = new XMLHttpRequest();
  const addForm = document.getElementById("add-form");

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let res = '';
    
      if(method != "DELETE" && method != "PUT") {
        res = JSON.parse(request.response);
      }

      const myModal =  document.getElementById("myModal");
      
      if (method === "POST") {
        addForm.reset();
        myModal.style.display = "none";
        addRow(document.getElementById("notes"), res);

      } else if (method === "DELETE") {
        if (confirm("Are you sure you want to delete this " + data)) {
          let deleteRow = document.getElementById(data);
          deleteRow.parentNode.parentNode.remove();
        }

      } else if (method === "GET" && url.includes("find")) {
        let updateBtn = document.getElementById('update');
        let storeBtn = document.getElementById('store');
        storeBtn.style.display = "none";
        updateBtn.style.display = "block";
        updateBtn.setAttribute("data-id", res['id']);
        addForm.setAttribute("method", res['method']);

        document.getElementById('title').value = res['title'];
        document.getElementById('content').value = res['content'];

      } else if (method === "PUT") {
        myModal.style.display = "none";

      }else if (method === "GET" && url.includes("show")) {
        console.log
      }
    }
  };

  request.open(method, url);
  request.send(data);
}