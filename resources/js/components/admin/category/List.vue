<template>
    <div>
        <section class="content">
            <div class="row justify-content-around">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Category List</h3>
                            <div class="card-tools">
                                <button class="btn btn-success" >
                                    <router-link to="/add-category" style="color: #fff">Add Category</router-link>
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
                                    <th>Created At</th>
                                    <th>Action</th>
                                    <th>
                                        <select v-model="select"  name="" id="" @change="deleteSelected">
                                            <option  value="">Action</option>
                                            <option value="">Delete All</option>
                                             </select>
                                        <br>
                                        <span v-if="Select_all==false"><input type="checkbox" v-model="Select_all" @click.prevent="SelectAll" >Check ALl</span>
                                        <span v-if="Select_all==true"><input type="checkbox" v-model="Select_all" @click.prevent="SelectAll" >UnCheck ALl</span>

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(showResult,index) in getAllCategory">
                                    <td>{{index+1}}</td>
                                    <td>{{showResult.cat_name}}</td>
                                    <td>{{showResult.created_at | timeFormat}}</td>
                                    <td>
                                        <router-link :to="`/edit-category/${showResult.id}`" href="">Edit</router-link> || <a href="" @click.prevent="deleteCategoryById(showResult.id)">Delete</a>
                                    </td>
                                    <td>
                                        <input :value="showResult.id" v-model="CategoryItem" type="checkbox">
                                    </td>

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
        name: "List",
        data(){
            return{
                CategoryItem:[],
                select:'',
                Select_all:false
            }
        },

        //mounted for action method add from action
        mounted() {
            this.$store.dispatch("allCategory")
        },

        //computed for getters method added and select method from v-for
        computed: {
            getAllCategory() {
                return this.$store.getters.getCategory
            }
        },

       //method for delete and select method from prevent
        methods: {
            deleteCategoryById(id) {
                axios.get('/delete-categoryById/' + id)
                    .then(() => {
                        this.$store.dispatch("allCategory");

                        toast({
                            type: 'success',
                            title: 'Category Deleted Successfully'
                        })
                    })
            },
            deleteSelected(){
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
                        axios.get('/deletebyCheckbox/'+this.CategoryItem).then(()=>{
                            this.CategoryItem = []
                            this.$store.dispatch("allCategory")
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

            SelectAll(){
                if (this.Select_all==false){
                    this.Select_all=true
                    for (var category in this.getAllCategory ){
                        this.CategoryItem.push(this.getAllCategory[category].id)
                    }
                } else{
                    this.Select_all=false
                    this.CategoryItem=[]
                }

            }
        },

    }
</script>

<style scoped>

</style>
