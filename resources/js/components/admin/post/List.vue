<template>
    <div>
        <section class="content">
            <div class="row justify-content-around">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Post List</h3>
                            <div class="card-tools">
                                <button class="btn btn-success" >
                                    <router-link to="/add-post" style="color: #fff">Add Post</router-link>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Category Name</th>
                                    <th>User Name</th>
                                    <th>Post Title</th>
                                    <th>Post Description</th>
                                    <th>Post Photo</th>
                                    <th>Action</th>
                                    <th>
                                        <select v-model="select" @change="delectSelected" name="" id="">
                                            <option value="">Action</option>
                                            <option value="">Delete</option>
                                        </select><br>
                                        <span v-if="select_all==false"><input v-model="select_all" @click.prevent="SelectAll" type="checkbox">Check ALl</span>
                                        <span v-if="select_all==true"><input v-model="select_all" @click.prevent="SelectAll" type="checkbox">UnCheck ALl</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(result,index) in getAllPost">
                                    <td>{{index+1}}</td>
                                    <td v-if="result.category">{{result.category.cat_name}}</td>
                                    <td v-if="result.user">{{result.user.name}}</td>
                                    <td>{{result.title | sortlenght(20,"......")}}</td>
                                    <td>{{result.description | sortlenght(30,"......")}}</td>
                                    <td><img style="height: 80px; width: 80px" :src="/uploadimage/ + result.photo"></td>
                                    <td>
                                        <router-link :to="`/edit-post/${result.id}`" >Edit</router-link> || <a href="" @click.prevent="deletePostById(result.id)">Delete</a>
                                    </td>
                                    <td><input :value="result.id" v-model="postItem" type="checkbox"></td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
</template>

<script>
    export default {
        name: "Post",
        data(){
            return{
                postItem:[],
                select:'',
                select_all:false
            }
        },

        //mounted for action method add from action
        mounted() {
            this.$store.dispatch("AllPost")
        },

        //computed for getters method added and select method from v-for
        computed: {
            getAllPost(){
                return this.$store.getters.getPost
            }
        },

        //method for delete and select method from prevent
        methods: {
            deletePostById(id){
                        Swal({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            type: 'warning',
                            showCancelButton: true,
                            cancelButtonText: 'No, cancel!',
                            cancelButtonColor: '#d33',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel){

                        }else{
                            axios.get('/delete-PostById/'+id).then(()=>{
                                this.$store.dispatch("AllPost")
                                if (result.value) {
                                    Swal(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                }
                            })
                        }


                        })


            },
            delectSelected(){
                if (this.postItem==''){
                    Swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You have no Select Item!. Please Select At First'
                    })
                    this.postItem=[]
                    this.select=''
                } else{
                    Swal({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        cancelButtonText: 'No, cancel!',
                        cancelButtonColor: '#d33',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.cancel){
                            this.select_all=false,
                                this.postItem=[]
                        }else{
                            axios.get('/deletPostBycheckbox/'+this.postItem).then(()=>{
                                this.postItem=[]
                                this.$store.dispatch("AllPost")
                                if (result.value) {
                                    Swal(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                }
                            })
                        }


                    })
                }

            },
            SelectAll(){
                if(this.select_all==false){
                    this.select_all=true
                    for(var post in this.getAllPost){
                        this.postItem.push(this.getAllPost[post].id)
                    }
                }else{
                    this.select_all=false
                    this.postItem=[]
                }

            }

        }
    }
</script>

<style scoped>

</style>
