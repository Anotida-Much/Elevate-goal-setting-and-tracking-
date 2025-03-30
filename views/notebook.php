<!-- Notebook -->
<div id="notebook-container" class="bg-white shadow-sm rounded-3 p-3">
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
</div>

<!-- Required Scripts -->
<script src="../node_modules/quill/dist/quill.js"></script>
<script src="../assets/js/notebook.js"></script>