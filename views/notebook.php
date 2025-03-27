<!-- Notebook -->
<!-- Button to trigger modal -->
<button id="notebook-btn-custom-position" class="btn btn-primary rounded-pill shadow-md pe-5 py-2 border-0"
    data-bs-toggle="modal" data-bs-target="#notebookModal">
    <i class="bi bi-pencil-square"></i> Open Notebook
</button>

<!-- Modal -->
<div class="modal fade" id="notebookModal" tabindex="-1" aria-labelledby="notebookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="text-primary"><i class="bi bi-pencil-square fs-1"></i> Notebook</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body container">
                <div class="row">
                    <div class="col-xs-12 col-md-4 mb-3 shadow-sm">
                        <h5>All Notes</h5>
                        <ul id="note-list" class="list-group list-group-flush d-flex flex-row flex-md-column">
                        </ul>
                    </div>
                    <div class="col-xs-12 col-md-8 p-0">
                        <!-- Title input and Quill editor -->
                        <input type="text" id="note-title" class="form-control border-bottom-0" value=""
                            placeholder="Note Title" required>
                        <div id="quill-editor" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Save buttons -->
                <button id="edit-note" class="btn btn-primary m-2 d-none">Edit Note</button>
                <button id="save-note" class="btn btn-success m-2">Save Note</button>
                <button id="update-note" class="btn btn-success m-2 d-none">Save Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Required Scripts -->
<script src="../assets/vendor/quill/quill.js"></script>
<script src="../assets/js/notebook.js"></script>
<script>
    // Initialize Quill editor
    const quill = new Quill('#quill-editor', {
        theme: 'snow'
    });

    // Fetch notes and populate the note list
    const fetchNotes = () => {
        fetch('/Elevate/config/notebook-get-note.php')
            .then(response => response.json())
            .then(data => {
                const noteList = document.getElementById('note-list');
                noteList.innerHTML = '';
                data.forEach(note => {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item';
                    listItem.textContent = note.title;
                    listItem.onclick = () => loadNote(note.id);
                    noteList.appendChild(listItem);
                });
            })
            .catch(error => console.error('Error fetching notes:', error));
    };

    // Load a note into the editor
    const loadNote = (noteId) => {
        fetch(`/Elevate/config/notebook-get-note.php?id=${noteId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('note-title').value = data.title;
                quill.setContents(data.content);
                document.getElementById('save-note').classList.add('d-none');
                document.getElementById('update-note').classList.remove('d-none');
            })
            .catch(error => console.error('Error loading note:', error));
    };

    // Save a new note
    document.getElementById('save-note').addEventListener('click', () => {
        const title = document.getElementById('note-title').value;
        const content = quill.getContents();
        fetch('/Elevate/config/notebook-api.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ title, content })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Note saved successfully!');
                    fetchNotes();
                } else {
                    alert('Error saving note.');
                }
            })
            .catch(error => console.error('Error saving note:', error));
    });

    // Update an existing note
    document.getElementById('update-note').addEventListener('click', () => {
        const title = document.getElementById('note-title').value;
        const content = quill.getContents();
        fetch('/Elevate/config/notebook-update.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ title, content })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Note updated successfully!');
                    fetchNotes();
                } else {
                    alert('Error updating note.');
                }
            })
            .catch(error => console.error('Error updating note:', error));
    });

    // Fetch notes on page load
    document.addEventListener('DOMContentLoaded', fetchNotes);
</script>