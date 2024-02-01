const fileInput = document.getElementsByName("filename");

const saveButton = document.getElementById("save_btn");

if (fileInput.files.length < 0) {

    saveButton.disabled = true;

} 