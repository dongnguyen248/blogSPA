<template>
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title mr-3">Tags Table

        </h3>
        <a href="#" style="wi" @click.prevent="newTag" class="btn  btn-default "><i class="fas fa-plus"></i> Add tag</a>
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
            <tr v-for=" (tag, i) in tags" :key="i">
              <td>{{i}}</td>
              <td>{{tag.tagName}}</td>
              <td>{{tag.created_at}}</td>
              <td>
                <a @click.prevent="editTag(tag)">
                  <i class="fa fa-edit text-blue ml-4 mr-2"></i>

                </a>
                <a @click.prevent="deleteTag">
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
  <div class="modal fade" id='addTag' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Tag</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" placeholder="Add tag name" v-model="data.tagName">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click.prevent="addTag">Add Tage</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Model edit tag -->

  <div class="modal fade" id='editTag' tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Tag</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" placeholder="Add tag name" v-model="editData.tagName">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" @click.prevent="saveTag">Save Tag</button>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      data: {
        tagName: '',

      },
      tags: [],
      editData: {
        tagName: ''
      }
    }
  },
  methods: {
    newTag() {
      $('#addTag').modal('show');
    },
    editTag(tag) {
      $('#editTag').modal('show');
      this.editData = tag
    },
    deleteTag() {

    },

    async addTag() {

      if (this.data.tagName == '') return this.i('tagName is required !');

      const res = await this.callApi('post', 'app/create_tag', this.data);

      if (res.status === 201) {
        // console.log(res.status);
        this.tags.push(res.data);
        this.s('Tag haved been added successfully');
        this.data.tagName = '';
        $('#addTag').modal('hide');
      } else {
        this.swr();
      }

    },
    async saveTag() {

      if (this.editData.tagName == '') return this.i('tagName is required !');

      const res = await this.callApi('post', 'app/edit_tag', this.editData);
      if (res.status === 200) {
        console.log(res.data);
        this.s('Tag have been edited successfully');
        this.editData.tagName = '';
        $('#editTag').modal('hide');
      } else {
        this.swr();
      }

    },
  },

  async created() {
    const res = await this.callApi('get', 'app/getTag');
    // console.log(res);

    if (res.status == 200) {
      // console.log(res.data.tags);
      this.tags = res.data.tags
    } else {
      this.swr();
    }
  },

}
</script>
