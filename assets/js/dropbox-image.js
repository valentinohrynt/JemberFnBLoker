function handleDragEnter(e) {
  e.stopPropagation();
  e.preventDefault();
  document.getElementById("dropbox").classList.add("dragover");
}

function handleDragOver(e) {
  e.stopPropagation();
  e.preventDefault();
  document.getElementById("dropbox").classList.add("dragover");
}

function handleDragLeave(e) {
  e.stopPropagation();
  e.preventDefault();
  document.getElementById("dropbox").classList.remove("dragover");
}


function updateFileName(fileName) {
  var container = document.getElementById("dropbox");
  container.querySelector(".file-name").textContent = fileName;
}

function handleClearButtonClick(event) {
  if (event) {
    event.stopPropagation();
  }
  document.getElementById("image-upload").value = "";
  document.querySelector(".dropbox-default-label").classList.remove("d-none");
  document.querySelector(".cloud-icon").classList.remove("d-none");
  document.querySelector(".file-name").textContent = "";
  document.querySelector("#image-preview").setAttribute("src", "");
  document.querySelector("#image-preview").classList.add("d-none");
  document.querySelector("#clear-button").classList.add("d-none");
  document.querySelector("#dropbox").classList.remove("file-selected");
}

function handleDrop(e) {
  e.stopPropagation();
  e.preventDefault();
  document.getElementById("dropbox").classList.remove("dragover");

  var file = e.dataTransfer.files[0];
  if (file && file.type.startsWith("image/")) {
    var reader = new FileReader();
    reader.onload = function (e) {
      var imagePreview = document.getElementById("image-preview");
      imagePreview.src = e.target.result;
      imagePreview.classList.remove("d-none");
    };
    reader.readAsDataURL(file);

    updateFileName(file.name);
  } else {
    alert("Hanya dapat menerima file gambar.");
  }
}

function handleFileSelect(event) {
  var file = event.target.files[0];
  if (file && file.type.startsWith("image/")) {
    if (
      event.target.files &&
      event.target.files[0] &&
      event.target.files[0].type.match("image.*")
    ) {
      document.querySelector(".dropbox-default-label").classList.add("d-none");
      document.querySelector(".cloud-icon").classList.add("d-none");
      var fileName = event.target.files[0].name;
      document.querySelector(".file-name").textContent = fileName;
      var reader = new FileReader();
      reader.onload = function (e) {
        document;
        document
          .querySelector("#image-preview")
          .setAttribute("src", e.target.result);
        document.querySelector("#image-preview").classList.remove("d-none");
        document.querySelector("#clear-button").classList.remove("d-none");
        document.querySelector("#dropbox").classList.add("file-selected");
      };
      reader.readAsDataURL(event.target.files[0]);
    }
  } else {
    alert("Hanya dapat menerima file gambar.");
  }
}
