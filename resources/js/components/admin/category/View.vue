<template>
    <div class="row justify-content-around">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Your Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" @submit.prevent="updateCategory()">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="categoryId">Edit Category Name</label>
                            <input type="text" name="cat_name" v-model="form.cat_name" class="form-control" :class="{ 'is-invalid': form.errors.has('cat_name') }" id="categoryId" placeholder="Category Name........">
                            <has-error :form="form" field="cat_name"></has-error>
                        </div>
                    </div>
                    <!-- /.c
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Edit",
        mounted(){
            axios.get(`/edit-category/${this.$route.params.CategoryId}`)
                .then((response)=>{
                     this.form.fill(response.data.result)
                })
        },
        data(){
            return{
                form: new Form({
                    cat_name:''
                })
            }
        },


        methods:{
            updateCategory(){
                this.form.post(`/update-category/${this.$route.params.CategoryId}`)
                    .then((response)=>{
                        this.$router.push('/category-list');

                        toast({
                            type: 'success',
                            title: 'Category updated successfully'
                        })


                    })
            }
        },
    }
</script>

<style scoped>

</style>
