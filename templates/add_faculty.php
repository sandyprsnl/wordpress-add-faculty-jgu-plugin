<?php
global $wpdb;
$wpdb_tablename = $wpdb->prefix . 'faculty';
$faculties =  $wpdb->get_results("SELECT * FROM $wpdb_tablename  ORDER BY school_order ASC,faculty_order ASC");
?>
<div class="fullbodyoverlay" style="display:none">
<img src="<?php echo NECURL."assets/img/loadinggif.gif"?>" alt="">
</div>
  
<div class="container wrap">
    <h1 class="wp-heading-inline"> Faculties</h1>
    <!-- Button trigger Add Faculty modal -->
    <button type="button" class="btn btn-primary page-title-action" data-toggle="modal" data-target="#facultyModal">
        Add Faculty
    </button>
    <table id="faculty-table" class="table">
        <caption>List of users</caption>
        <thead>
            <tr class="text-center">
                <th scope="col">Name</th>
                <th scope="col">Detaile Page</th>
                <th scope="col">Designation</th>
                <th scope="col">School Name</th>
                <th scope="col">Images</th>
                <th scope="col">School ID</th>
                <th scope="col">Faculty ID</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="faculty-table">
            <?php
            foreach ($faculties as $faculty) {
                echo "<tr class='text-center'>";
                echo "<td>" . $faculty->name . "</td>";
                echo "<td>" . $faculty->details_page . "</td>";
                echo "<td>" . $faculty->designation . "</td>";
                echo "<td>" . $faculty->school_name . "</td>";
                echo "<td><img src=" . $faculty->image_url . " width='50px' height='50px'/></td>";
                echo "<td>" . $faculty->school_order . "</td>";
                echo "<td>" . $faculty->faculty_order . "</td>";
                echo "<td> <img  class='edit-faculty' edit-faculty=' ". $faculty->id ."' src='".NECURL."assets/img/pencil.svg' ><img class='delete-faculty' delete-faculty=' ". $faculty->id ."' src='".NECURL."assets/img/delete.svg' ></td>";

                echo "</tr>";
            }
            ?>
            <!-- <tr>
                <td><img src="http://localhost/jgu/wp-content/uploads/2021/06/jumma.jpg" alt=""/></td>
                <td>Mark</td>
                <td>@mdo</td>
                <td>@mdo</td>
                 <td>@mdo</td>
            </tr> -->
        </tbody>
    </table>
    <!-- <table id="example" class="display" width="100%">
        
    </table> -->

    <!--Add Faculty Modal -->
    <div class="modal fade" id="facultyModal" tabindex="-1" role="dialog" aria-labelledby="facultyModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="addFaculty" id="addFaculty" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="facultyModal">Add Faculty</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <?php wp_nonce_field('add_faculty', 'faculty-nonce'); ?>
                                    <input type="text" class="form-control" id="faculty-name" name="name" placeholder="Faculty Name...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="school">School</label>
                                    <input type="text" class="form-control" id="school-name" name="school" placeholder="School Name...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="school">Detaile Page</label>
                                    <input type="text" class="form-control" id="detaile-page" name="detaile-page" placeholder="Detaile Page...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="school">Designation</label>
                                    <input type="text" class="form-control" id="designation" name="designation" placeholder="Designation...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="school">School ID</label>
                                    <input type="text" class="form-control" id="faculty-school-id" name="faculty-school-id" placeholder="School ID">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="school">Faculty ID</label>
                                    <input type="text" class="form-control" id="faculty-id" name="faculty-id" placeholder="Faculty ID">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group text-center">

                                    <input type="hidden" name="faculty-img" id="faculty-img">
                                    <button id="upload-img" type="button" class="page-title-action">Select image</button>
                                    <img id="img-preview" src="" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="submit" id="addfacultybtn" class="btn page-title-action">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="facultyUpdateModal" tabindex="-1" role="dialog" aria-labelledby="facultyUpdateModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="UpdateFaculty" id="UpdateFaculty" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="facultyUpdateModal">Update Faculty</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <?php wp_nonce_field('update_faculty', 'update_faculty-nonce'); ?>
                                    <input type="text" class="form-control" id="update-faculty-name" name="name" placeholder="Faculty Name...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="school">School</label>
                                    <input type="text" class="form-control" id="update-faculty-school" name="school" placeholder="School Name...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="school">Detaile Page</label>
                                    <input type="text" class="form-control" id="update-detaile-page" name="update-detaile-page" placeholder="Detaile Page...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="school">Designation</label>
                                    <input type="text" class="form-control" id="update-designation" name="update-designation" placeholder="Designation...">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="school">School ID</label>
                                    <input type="text" class="form-control" id="update-faculty-school-id" name="update-faculty-school-id" placeholder="School ID">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="school">Faculty ID</label>
                                    <input type="text" class="form-control" id="update-faculty-id" name="update-faculty-id" placeholder="Faculty ID">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group text-center">

                                    <input type="hidden" name="update-faculty-img" id="update-faculty-img">
                                    <button id="update-img" type="button" class="page-title-action">Update image</button>
                                    <img id="update-img-preview" src="" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        <button type="submit" id="updatefacultybtn" class="btn page-title-action">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>