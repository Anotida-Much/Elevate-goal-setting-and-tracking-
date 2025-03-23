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

// Clear input boxes
function clearInputBoxes() {
  document.getElementById("note-title").value = "";
  quill.setContents("");
}

// Fetch notes from the server
async function fetchNotes() {
  try {
    const response = await fetch("../config/notebook.php", {
      method: "GET",
      headers: { "Content-Type": "application/json" },
    });
    const notes = await response.json();
    const noteList = document.getElementById("note-list");
    noteList.innerHTML = ""; // Clear the list before appending new notes

    notes.forEach((note) => {
      const noteItem = createNoteItem(note);
      noteList.appendChild(noteItem);
    });
  } catch (error) {
    console.error("Error fetching notes:", error);
  }
}

// Create a note item element
function createNoteItem(note) {
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

  noteItem.addEventListener("click", () => loadNoteForEditing(note.id));
  editButton.addEventListener("click", (event) =>
    deleteNoteHandler(event, note.id)
  );

  return noteItem;
}

// Load note for editing
async function loadNoteForEditing(noteId) {
  try {
    currentNoteId = noteId;
    const response = await fetch(`../config/notebook.php?id=${noteId}`, {
      method: "GET",
      headers: { "Content-Type": "application/json" },
    });
    const noteData = await response.json();
    document.getElementById("note-title").value = noteData.title;
    quill.setContents(noteData.content.ops);
    toolbar.container.style.display = "none";
    document.getElementById("save-note").classList.add("d-none");
    document.getElementById("update-note").classList.add("d-none");
    document.getElementById("edit-note").classList.remove("d-none");
  } catch (error) {
    console.error("Error loading note:", error);
  }
}

// Save note button click handler
document.getElementById("save-note").addEventListener("click", async () => {
  const title = document.getElementById("note-title").value;
  const content = quill.getContents();

  try {
    const response = await fetch("../config/notebook.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ title, content }),
    });
    const data = await response.json();
    window.showToast(data.message);
    clearInputBoxes();
    fetchNotes(); // Refresh the note list
  } catch (error) {
    console.error("Error saving note:", error);
  }
});

// Edit note button click handler
document.getElementById("edit-note").addEventListener("click", () => {
  toolbar.container.style.display = "block";
  document.getElementById("edit-note").classList.add("d-none");
  document.getElementById("update-note").classList.remove("d-none");
});

// Update note button click handler
document.getElementById("update-note").addEventListener("click", async () => {
  const title = document.getElementById("note-title").value;
  const content = quill.getContents();

  try {
    const response = await fetch(`../config/notebook.php?id=${currentNoteId}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ title, content }),
    });
    const data = await response.json();
    window.showToast(data.message);
    clearInputBoxes();
    fetchNotes(); // Refresh the note list
  } catch (error) {
    console.error("Error updating note:", error);
  }
});

// Delete note handler
async function deleteNoteHandler(event, noteId) {
  event.stopPropagation();
  if (
    confirm(
      "Are you sure you want to delete this note? This action can't be undone."
    )
  ) {
    try {
      const response = await fetch(`../config/notebook.php?id=${noteId}`, {
        method: "DELETE",
      });
      const data = await response.json();
      window.showToast(data.message);
      // Remove deleted note from list
      event.target.closest("LI").remove();
    } catch (error) {
      console.error("Error deleting note:", error);
    }
  }
}

// Fetch notes on page load
fetchNotes();
