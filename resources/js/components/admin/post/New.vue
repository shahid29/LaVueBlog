<template>
    <div class="row justify-content-around">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Your Post</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form accept="image/*"  enctype="multipart/form-data" role="form" @submit.prevent="addPost()" >
                    <div class="card-body">
                        <div class="form-group">
                            <label for="postId">Post Name</label>
                            <input type="text" name="title" v-model="form.title" class="form-control"
                                   :class="{ 'is-invalid': form.errors.has('title') }" id="postId" placeholder="Post Title........">
                            <has-error :form="form" field="title"></has-error>
                        </div>
                    <div class="form-group">
                            <label for="descriptionId">Description</label>
                            <!--<textarea name="description" v-model="form.description" class="form-control"-->
                            <!--:class="{ 'is-invalid': form.errors.has('description') }" id="descriptionId" placeholder="Post Description........">-->
                                <!--</textarea>-->
                        <markdown-editor v-model="form.description"></markdown-editor>
                            <has-error :form="form" field="description"></has-error>
                        </div>
                        <div class="form-group">
                            <label for="postId">Select Category</label>
                            <select v-model="form.cat_id" class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" >
                                <option disabled value="">Select One</option>
                                <option :value="showResult.id" v-for="showResult in getAllCategory">{{showResult.cat_name}}</option>
                            </select>
                            <has-error :form="form" field="cat_id"></has-error>
                        </div>

                        <div class="form-group">
                            <label for="postId">Upload Image</label>
                            <input @change="changePhoto($event)" name="photo[]" type="file"  :class="{ 'is-invalid': form.errors.has('photo') }">
                            <img style="height: 100px; width: 100px" :src="form.photo" alt="">
                            <has-error :form="form" field="photo"></has-error>
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
                    title:'',
                    description:'',
                    cat_id:'',
                    photo:'',
                })
            }
        },
        mounted() {
            this.$store.dispatch("allCategory")
        },
        computed: {
            getAllCategory() {
                return this.$store.getters.getCategory
            }
        },


        methods:{
            changePhoto(event){
                let file = event.target.files[0];
                if (file.size>1048576){
                    Swal({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        footer: '<a href>Why do I have this issue?</a>'
                    })
                } else {
                    let reader = new FileReader();
                    reader.onload = event=> {
                        // The file's text will be printed here
                        this.form.photo =event.target.result
                    };

                    reader.readAsDataURL(file);
                }

            },
            addPost(){
                this.form.post('/save-post')
                    .then((response)=>{
                        this.$router.push('/post-list')

                        toast({
                            type: 'success',
                            title: 'Category added successfully'
                        })
                    })
            }
            // addCategory(){
            //     this.form.post('/save-category')
            //         .then((response)=>{
            //             this.$router.push('/category-list')
            //
            //             toast({
            //                 type: 'success',
            //                 title: 'Category added successfully'
            //             })
            //         })
            //         .catch(()=>{
            //
            //         })
            // }
        },
    }
</script>

<style scoped>

</style>
