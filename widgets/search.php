<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="<?= $base_url ?>search.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Search By Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Search you food here</p>
                    <input type="text" class="form-control" name="searchText" id="searchText" placeholder="Search the item">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>