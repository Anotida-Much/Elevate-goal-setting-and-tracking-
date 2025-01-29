// Initialize Quill editor
const quill = new Quill("#quill-editor", {
  modules: {
    toolbar: [
      [
        "header",
        "background",
        "list",
        "bullet",
        "indent",
        "bold",
        "italic",
        "underline",
        "strike",
      ],
      ["font", "size", "color"],
      ["image", "video", "link"],
      ["clean"],
    ],
  },
  placeholder: "Type your note...",
  theme: "snow",
  readonly: true,
});

// Global variables
const toolbar = quill.getModule("toolbar");
let currentNoteId;
document.getElementById("note-title").value = "";

// clear input boxes
function clearInputBoxes() {
  document.getElementById("note-title").value = "";
  quill.setContents("");
}

// Save note button click handler
document.getElementById("save-note").addEventListener("click", () => {
  const title = document.getElementById("note-title").value;
  const content = quill.getContents();

  fetch("./config/notebook-api.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ title, content }),
  })
    .then((response) => response.text())
    .then((data) => {
      window.showToast("success", data);
      clearInputBoxes();
    });
  // .catch((error) => console.error(error));
});

// Get notes
fetch("./config/notebook-api.php", {
  method: "GET",
  headers: { "Content-Type": "application/json" },
})
  .then((response) => response.json())
  .then((notes) => {
    const noteList = document.getElementById("note-list");

    notes.forEach((note) => {
      const noteItem = document.createElement("LI");
      noteItem.className =
        "list-group-item list-group-item-action d-flex justify-content-start align-items-center fs-5 text-dark";
      noteItem.textContent = note.title;
      noteItem.dataset.noteId = note.id;
      const editButton = document.createElement("BUTTON");
      editButton.className =
        "btn btn-sm btn-danger delete-notes me-2 rounded-pill order-first fs-6";
      editButton.dataset.noteId = note.id;
      const icon = document.createElement("i");
      icon.className = "bi bi-trash mx-auto";
      editButton.appendChild(icon);
      noteItem.appendChild(editButton);

      noteItem.addEventListener("click", () => {
        currentNoteId = noteItem.dataset.noteId;
        fetch(`./config/notebook-get-note.php?id=${currentNoteId}`, {
          method: "GET",
          headers: { "Content-Type": "application/json" },
        })
          .then((response) => response.json())
          .then((noteData) => {
            // console.log(noteData);
            document.getElementById("note-title").value = noteData.title;
            quill.setContents(noteData.content.ops);
            toolbar.container.style.display = "none";
            document.getElementById("save-note").classList.add("d-none");
            document.getElementById("update-note").classList.add("d-none");
            document.getElementById("edit-note").classList.remove("d-none");
          });
      });
      noteList.appendChild(noteItem);
    });
  });

// Edit note button click handler
document.getElementById("edit-note").addEventListener("click", () => {
  toolbar.container.style.display = "block";
  document.getElementById("edit-note").classList.add("d-none");
  document.getElementById("update-note").classList.remove("d-none");
});

// Update note button click handler
document.getElementById("update-note").addEventListener("click", () => {
  const title = document.getElementById("note-title").value;
  const content = quill.getContents();

  fetch(`./config/notebook-update.php?id=${currentNoteId}`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ title, content }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data.message);
      window.showToast(data.message);
      clearInputBoxes();
    });
});

// Delete button
setTimeout(function () {
  const deleteButtons = document.querySelectorAll(".delete-notes");
  deleteButtons.forEach((button) => {
    const noteId = button.dataset.noteId;
    button.addEventListener("click", function () {
      if (
        confirm(
          "Are you sure you want to delete this note? This action cant be undone."
        )
      ) {
        fetch(`./config/notebook-delete.php?id=${noteId}`, {
          method: "DELETE",
        })
          .then((response) => response.text())
          .then((data) => {
            window.showToast(data.message);
            // Remove deleted note from list
            button.parentNode.remove();
          })
          .catch((error) => console.error("Error:", error));
      }
    });
  });
}, 150);
