// Notebook JavaScript code
// Initialize Quill editor
const quill = new Quill("#quill-editor", {
  modules: {
    toolbar: [
      ["bold", "italic", "underline", "strike"],
      ["blockquote", "code-block"],
      [{ header: 1 }, { header: 2 }],
      [{ list: "ordered" }, { list: "bullet" }],
      [{ script: "sub" }, { script: "super" }],
      [{ indent: "-1" }, { indent: "+1" }],
      [{ direction: "rtl" }],
      [{ size: ["small", false, "large", "huge"] }],
      [{ header: [1, 2, 3, 4, 5, 6, false] }],
      [{ color: [] }, { background: [] }],
      [{ font: [] }],
      [{ align: [] }],
      ["clean"],
      ["link", "image", "video"],
    ],
  },
  placeholder: "Type your note...",
  theme: "snow",
  readonly: true,
});

// Global variables
const toolbar = quill.getModule("toolbar");
let currentNoteId;
const noteTitleInput = document.getElementById("note-title");
if (noteTitleInput) {
  noteTitleInput.value = "";
}

// Clear input boxes
function clearInputBoxes() {
  if (noteTitleInput) {
    noteTitleInput.value = "";
  }
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
    if (noteList) {
      noteList.innerHTML = ""; // Clear the list before appending new notes

      notes.forEach((note) => {
        const noteItem = createNoteItem(note);
        noteList.appendChild(noteItem);
      });
    }
  } catch (error) {
    console.error("Error fetching notes:", error);
    showError("Failed to load notes");
  }
}

// Create a note item element
function createNoteItem(note) {
  const noteItem = document.createElement("LI");
  noteItem.className =
    "list-group-item list-group-item-action d-flex justify-content-start align-items-center fs-5";
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
    if (noteTitleInput) {
      noteTitleInput.value = noteData.title;
    }
    quill.setContents(noteData.content.ops);
    toolbar.container.style.display = "none";

    const saveNoteBtn = document.getElementById("save-note");
    const updateNoteBtn = document.getElementById("update-note");
    const editNoteBtn = document.getElementById("edit-note");

    if (saveNoteBtn) saveNoteBtn.classList.add("d-none");
    if (updateNoteBtn) updateNoteBtn.classList.add("d-none");
    if (editNoteBtn) editNoteBtn.classList.remove("d-none");
  } catch (error) {
    console.error("Error loading note:", error);
    showError("Failed to load note");
  }
}

// Save note button click handler
const saveNoteBtn = document.getElementById("save-note");
if (saveNoteBtn) {
  saveNoteBtn.addEventListener("click", async () => {
    const title = noteTitleInput ? noteTitleInput.value : "";
    const content = quill.getContents();

    if (!title || !content) {
      showError("Please fill in both title and content");
      return;
    }

    try {
      const response = await fetch("../config/notebook.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ title, content }),
      });
      const data = await response.json();
      if (data.status === "success") {
        showSuccess(data.message);
        clearInputBoxes();
        fetchNotes(); // Refresh the note list
      } else {
        showError(data.message);
      }
    } catch (error) {
      console.error("Error saving note:", error);
      showError("Failed to save note");
    }
  });
}

// Edit note button click handler
const editNoteBtn = document.getElementById("edit-note");
if (editNoteBtn) {
  editNoteBtn.addEventListener("click", () => {
    toolbar.container.style.display = "block";
    editNoteBtn.classList.add("d-none");
    const updateNoteBtn = document.getElementById("update-note");
    if (updateNoteBtn) updateNoteBtn.classList.remove("d-none");
  });
}

// Update note button click handler
const updateNoteBtn = document.getElementById("update-note");
if (updateNoteBtn) {
  updateNoteBtn.addEventListener("click", async () => {
    const title = noteTitleInput ? noteTitleInput.value : "";
    const content = quill.getContents();

    if (!title || !content) {
      showError("Please fill in both title and content");
      return;
    }

    try {
      const response = await fetch(
        `../config/notebook.php?id=${currentNoteId}`,
        {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ title, content }),
        }
      );
      const data = await response.json();
      if (data.status === "success") {
        showSuccess(data.message);
        clearInputBoxes();
        fetchNotes(); // Refresh the note list
      } else {
        showError(data.message);
      }
    } catch (error) {
      console.error("Error updating note:", error);
      showError("Failed to update note");
    }
  });
}

// Delete note handler
async function deleteNoteHandler(event, noteId) {
  event.stopPropagation();
  showConfirmDialog(
    "Delete Note",
    "Are you sure you want to delete this note? This action can't be undone.",
    async () => {
      try {
        const response = await fetch(`../config/notebook.php?id=${noteId}`, {
          method: "DELETE",
        });
        const data = await response.json();
        if (data.status === "success") {
          showSuccess(data.message);
          // Remove deleted note from list
          const noteElement = event.target.closest("LI");
          if (noteElement) {
            noteElement.remove();
          }
        } else {
          showError(data.message);
        }
      } catch (error) {
        console.error("Error deleting note:", error);
        showError("Failed to delete note");
      }
    }
  );
}

// Initialize notes on page load
document.addEventListener("DOMContentLoaded", fetchNotes);
