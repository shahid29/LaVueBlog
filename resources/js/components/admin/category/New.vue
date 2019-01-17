<template>
    <div class="row justify-content-around">
    <div class="col-md-6">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add Your Category</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" @submit.prevent="addCategory()">
            <div class="card-body">
                <div class="form-group">
                    <label for="categoryId">Category Name</label>
                    <input type="text" name="cat_name" v-model="form.cat_name" class="form-control" :class="{ 'is-invalid': form.errors.has('cat_name') }" id="categoryId" placeholder="Category Name........">
                    <has-error :form="form" field="cat_name"></has-error>
                </div>
            </div>
            <!-- /.c
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        </div>
    </div>
    </div>
</template>

<script>
    export default {
        name: "New",
        data(){
            return{
                form: new Form({
                    cat_name:''
                })
            }
        },


        methods:{
            addCategory(){
                this.form.post('/save-category')
                    .then((response)=>{
                        this.$router.push('/category-list')

                        toast({
                            type: 'success',
                            title: 'Category added successfully'
                        })
                    })
                    .catch(()=>{

                    })
            }
        },
    }
</script>

<style scoped>

</style>
