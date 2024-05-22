function handleDragEnter(e) {
    e.preventDefault();
    e.stopPropagation();
    e.currentTarget.classList.add("dragover");
}

function handleDragOver(e) {
    e.preventDefault();
    e.stopPropagation();
    e.currentTarget.classList.add("dragover");
}

function handleDragLeave(e) {
    e.preventDefault();
    e.stopPropagation();
    e.currentTarget.classList.remove("dragover");
}

function handleDrop(e) {
    e.preventDefault();
    e.stopPropagation();
    e.currentTarget.classList.remove("dragover");

    let fileList = e.dataTransfer.files;
    handleFiles(fileList);
}

function handleFileSelect(e) {
    let fileList = e.target.files;
    handleFiles(fileList);
}

function handleFiles(files) {
    let fileListContainer = document.getElementById("file-list");
    let dropbox = document.getElementById("dropbox");

    fileListContainer.innerHTML = "";

    for (let i = 0; i < files.length; i++) {
        let file = files[i];

        if (file.type === "application/pdf") {
            let dropbox = document.getElementById("dropbox");
            dropbox.classList.add("active");

            let fileItem = document.createElement("div");
            fileItem.classList.add("file-item", "text-truncate");

            let fileIcon = document.createElement("i");
            fileIcon.classList.add("bi-file-earmark-pdf", "file-icon");
            fileItem.appendChild(fileIcon);

            let fileName = document.createTextNode(file.name);
            fileItem.appendChild(fileName);

            fileListContainer.appendChild(fileItem);
        } else {
            alert("Hanya dapat menerima file PDF.");
        }
    }

    dropbox.classList.add("file-selected");
    dropbox.querySelector(".dropbox-default-label").classList.add("d-none");
    dropbox.querySelector(".cloud-icon").classList.add("d-none");
    document.getElementById("clear-button").classList.remove("d-none");
}

function handleClearButtonClick(event) {
    if  (event) {
        event.stopPropagation();
    }
    let fileListContainer = document.getElementById("file-list");
    let dropbox = document.getElementById("dropbox");
    fileListContainer.innerHTML = "";
    dropbox.classList.remove("file-selected");
    dropbox.querySelector(".dropbox-default-label").classList.remove("d-none");
    dropbox.querySelector(".cloud-icon").classList.remove("d-none");
    document.getElementById("clear-button").classList.add("d-none");
    document.getElementById("file").value = "";
    document.getElementById("file-error").classList.add("d-none")
}

document.getElementById("file").addEventListener("change", handleFileSelect);

document.getElementById("dropbox").addEventListener("click", function() {
    document.getElementById("file").click();
});