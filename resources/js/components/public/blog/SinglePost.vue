<template>
    <span>
         <section id="content">
      <div class="container">
        <div class="row">
          <div class="span8">
            <article>
              <div class="row">
                <div class="span8">
                  <div class="post-image">
                    <div class="post-heading">
                      <h3><a href="#">{{singlePost.title}}</a></h3>
                    </div>
                    <img :src="`uploadimage/${singlePost.photo}`" alt="" />
                  </div>
                  <p>{{singlePost.description}}</p>
                  <div class="bottom-article">
                    <ul class="meta-post">
                      <li v-if="singlePost.user"><i class="icon-user"></i><a href="#">{{singlePost.user.name}}</a></li>
                      <li v-if="singlePost.category"><i class="icon-folder-open"></i><a href="#"> {{singlePost.category.cat_name}}</a></li>
                     <li><i class="icon-calendar"></i><a href="#"> {{singlePost.created_at | timeFormat()}}</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </article>

          </div>
            <BlogSidebar/>
        </div>
      </div>
    </section>
    </span>
</template>

<script>
    import BlogSidebar from './BlogSidebar'
    export default {
        name: "SinglePost",
        components:{
            BlogSidebar
        },
        mounted(){
           this.toView_SinglePost_When_Click_Sidebar_Title()
        },
        computed:{
            singlePost(){
                return this.$store.getters.singlePostById
            }
        },
        methods:{
            toView_SinglePost_When_Click_Sidebar_Title(){
                this.$store.dispatch('getSinglePost',this.$route.params.id)
            }
        },
        watch:{
            $route(to,from){
                this.toView_SinglePost_When_Click_Sidebar_Title()
            }
        }
    }
</script>

<style scoped>

</style>
