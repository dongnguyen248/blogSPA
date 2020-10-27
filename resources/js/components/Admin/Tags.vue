<template>
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title mr-3">Tags Table

        </h3>
        <a href="#" style="wi" class="btn  btn-default "><i class="fas fa-plus"></i>  Add tag</a>        
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">STT</th>
              <th>Tags Name</th>
              <th>Created at</th>
              <th style="width:150px">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1.</td>
              <td>Update software</td>
              <td>
                <div class="progress progress-xs">
                  <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                </div>
              </td>
            
              <td>
                <a href="#">
                  <i class="fa fa-edit text-blue ml-4 mr-2"></i>
                </a>
                
                <a href="#">
                  <i class="fa fa-trash text-red ml-2"></i>
                </a>
              </td>
             
            </tr>

          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
        </ul>
      </div>
    </div>
    <!-- right col -->

  </section>
  <!-- /.content -->
</div>
</template>
