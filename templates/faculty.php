<div class="container-fluid ">
    <form action="loadFacultyFilter">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="text" class="form-control search-profile" id="namefilter" placeholder="Search Profile by Name">
                </div>
            </div>
            <div class="col-sm-5">
                <div class="form-group">
                    <select class="form-control search-profile" id="select-schoole">
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn search-faculty-btn">Search</button>
            </div>
        </div>
    </form>
    <div id="load-more-container" class="row">
        <!-- <div class="col-sm-3">
            <div class="card faculty-card" >
                <img class="card-img-top faculty-img" src="https://upload.wikimedia.org/wikipedia/commons/b/bc/Unknown_person.jpg" alt="Card image cap">
                <div class="card-body">
                <h3 class="card-text faculty-name text-center">name</h3>
                    <p class="card-text faculty-name text-center">school.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-3">b</div>
        <div class="col-sm-3">c</div>
        <div class="col-sm-3">d</div> -->

    </div>
    <button id="load-more" class="btn mt-5 load-more-btn">load more</button>
    <input type="hidden" id="row" value="0">
    <input type="hidden" id="all" value="">
</div>