<template>
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title mr-3">Categories Table

        </h3>
        <a href="#" style="wi" @click.prevent="newCategory" class="btn  btn-default "><i class="fas fa-plus"></i> Add Category</a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">STT</th>
              <th>Categories Image</th>
              <th>Categories Name</th>
              <th>Created at</th>
              <th style="width:150px">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for=" (category, i) in categories" :key="i">
              <td>{{i}}</td>
              <td>
                <img v-bind:src="'../uploads/' + category.iconImage" alt="Photo" />
              </td>
              <td>{{category.categoryName}}</td>
              <td>{{category.created_at}}</td>
              <td>
                <a @click.prevent="editCategory(category,i)">
                  <i class="fa fa-edit text-blue ml-4 mr-2"></i>

                </a>
                <a @click.prevent="deleteCategory(category,i)">
                  <i class="fa fa-trash text-red ml-2"></i>

                </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <!-- <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
        </ul>
      </div> -->
    </div>
    <!-- right col -->

  </section>
  <!-- Model add tag -->
  <div class="modal fade" id='addcategory' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100">Add Category</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" placeholder="Add category name" v-model="data.categoryName">
        </div>

        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
          <input id="upload" type="file" @change="chooseFile" accept="image/*" class="form-control border-0">
          <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose photo</label>
          <div class="input-group-append">
            <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
          </div>
        </div>
        <p class="note" v-if="filesize / 1048576 >= 2">Vui lòng chọn hình nhỏ hơn 2MB</p>
        <p v-else for="photo" class="text-center">Selected File: {{data.photo}}</p>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click.prevent="addCategory">Add </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Model edit tag -->

  <div class="modal fade" id='deletecategory' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center" id="modaldel">
          <h4 class="modal-title  w-100"><i class="fas fa-exclamation"></i> Delete Cateogry</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Are You sure delete it?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger" @click.prevent="delCategory">Delete </button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id='editcategory' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title w-100">Edit Category</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" placeholder="Add category name" v-model="editData.categoryName">
        </div>
        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
          <input id="upload" type="file" @change="chooseFile" accept="image/*" class="form-control border-0">
          <label id="upload-label" for="upload" class="font-weight-light text-muted">{{editData.iconImage}}</label>
          <div class="input-group-append">
            <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
          </div>
        </div>
        <p class="note" v-if="filesize / 1048576 >= 2">Vui lòng chọn hình nhỏ hơn 2MB</p>
        <p v-else for="photo" class="text-center">Selected File: {{data.photo}}</p>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click.prevent="saveCategory">Save </button>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
const Swal = require('sweetalert2');

export default {
  data() {
    return {
      data: {
        categoryName: '',
        image: null,
        photo: ''

      },
      filesize: '',
      categories: [],
      editData: {
        categoryName: '',
        image: null,
        iconImage: ''


      },
      index: 0,
      delcategory: {
        categoryName: '',
        iconImage: ''
      },
      form: new FormData()

    }
  },
  methods: {
    chooseFile(event) {
      this.data.image = event.target.files[0];
      let filename = event.target.files[0].name;
      if (!filename.match(/.(jpg|jpeg|png|gif)$/i))
        return this.e("This file is not iamge please choose image file");
      this.data.photo = filename;

    },
    async addCategory() {
      this.form.append('categoryName', this.data.categoryName);
      this.form.append('image', this.data.image);
      if (this.data.categoryName == '') return this.i('categoryName is required !');
      const res = await this.callApi('post', 'app/create_category', this.form);
      if (res.status === 200) {
        this.categories.push(res.data);
        this.s('Tag haved been added successfully');
        this.data.categoryName = '';
        this.data.photo = '';
        $('#addcategory').modal('hide');
      } else {
        this.swr();
      }
    },

    newCategory() {
      $('#addcategory').modal('show');
    },
    editCategory(category, index) {
      $('#editcategory').modal('show');
      // let image = this.data.image;
      let obj = {
        id: category.id,
        categoryName: category.categoryName,
        iconImage :category.iconImage

      }
      this.editData = obj;
      this.index = index
    },
    deleteCategory(category, index) {
      $('#deletecategory').modal('show');
      console.log(category);
      this.delcategory = category;
      this.index = index;

    },
    async delCategory() {
      const res = await this.callApi('post', 'app/del_category', this.delcategory);
      if (res.status === 200) {
        this.categories.splice(this.index, 1);
        this.s('This category has delete successfull');
        $('#deletecategory').modal('hide');

      } else {
        this.swr();
      }
    },
    async saveCategory() {
      if (this.editData.categoryName == '') return this.i('categoryName is required !');
      this.form.append('categoryName', this.editData.categoryName)
      this.form.append('id',this.editData.id);

      this.form.append('image', this.data.image)
      console.log(this.form);
      const res = await this.callApi('post', 'app/edit_category', this.form);
      if (res.status === 200) {
        console.log(this.index);
        this.categories[this.index].categoryName = res.data.categoryName
        this.categories[this.index].iconImage = res.data.iconImage
        this.s('Tag have been edited successfully');

        $('#editcategory').modal('hide');
      } else {
        this.swr();
      }

    },

  },

  async created() {
    const res = await this.callApi('get', 'app/get_categories');

    if (res.status == 200) {
      this.categories = res.data.categories
    } else {
      this.swr();
    }
  },

}
</script>

<style scoped>
img {
  height: 100px;
  width: 100px;
}

#modaldel {
  /* background-color:; */
  border-color: #dc3545;
  color: #dc3545;

}

#upload {
  opacity: 0;
}

#upload-label {
  position: absolute;
  top: 50%;
  left: 1rem;
  transform: translateY(-50%);
}

.image-area {
  border: 2px dashed rgba(255, 255, 255, 0.7);
  padding: 1rem;
  position: relative;
}

.image-area::before {
  content: 'Uploaded image result';
  color: #fff;
  font-weight: bold;
  text-transform: uppercase;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 0.8rem;
  z-index: 1;
}

.image-area img {
  z-index: 2;
  position: relative;
}
</style>
