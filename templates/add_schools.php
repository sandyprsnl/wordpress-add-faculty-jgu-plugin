<div class="container wrap">
  <h1 class="wp-heading-inline">Schooles</h1>
  <!-- Button trigger modal -->
  <button type="button" class=" page-title-action" data-toggle="modal" data-target="#exampleModal">
    Add School
  </button>

  <table id="faculty-table" class="table">
  <caption>List of users</caption>
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">School</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Mark</td>
      <td>Mark</td>
      <td>@mdo</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="addSchool" id="add-schoole">
            <div class="form-group">
              <label for="exampleInputEmail1">Schoole Name</label>
              <input required type="Text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</div>