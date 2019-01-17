<template>
     <span>
         <section id="inner-headline">
      <div class="container">
        <div class="row">
          <div class="span4">
            <div class="inner-heading">
              <h2>Blog left sidebar{{this.$route.params.id}}</h2>
            </div>
          </div>
          <div class="span8">
            <ul class="breadcrumb">
              <li><a href="#"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
              <li><a href="#">Blog</a><i class="icon-angle-right"></i></li>
              <li class="active">Blog with left sidebar</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section id="content">
      <div class="container">
        <div class="row">
          <div class="span8">
            <article v-for="showResult in displayData">
              <div class="row">
                <div class="span8">
                  <div class="post-image">
                    <div class="post-heading">
                      <h3><a href="#">{{showResult.title}}</a></h3>
                    </div>
                    <img :src="`uploadimage/${showResult.photo}`" alt="" />
                  </div>
                  <p>{{showResult.description | sortlenght(100,".....")}}</p>
                  <div class="bottom-article">
                    <ul class="meta-post">
                      <li><i class="icon-calendar"></i><a href="#"> {{showResult.created_at | timeFormat()}}</a></li>
                      <li v-if="showResult.user"><i class="icon-user"></i><a href="#"> {{showResult.user.name}}</a></li>
                      <li v-if="showResult.category"><i class="icon-folder-open"></i><a href="#"> {{showResult.category.cat_name}}</a></li>
                      <li><i class="icon-comments"></i><a href="#">4 Comments</a></li>
                    </ul>
                    <router-link :to="`/singlePost/${showResult.id}`" class="pull-right">Continue reading <i class="icon-angle-right"></i></router-link>
                  </div>
                </div>
              </div>
            </article>
            <div id="pagination">
              <span class="all">Page 1 of 3</span>
              <span class="current">1</span>
              <a href="#" class="inactive">2</a>
              <a href="#" class="inactive">3</a>
            </div>
          </div>
            <BlogSidebar/>
        </div>
      </div>
    </section>
    </span>
</template>

<script>
    import BlogSidebar from "./BlogSidebar"
    export default {
        name: "BlogPost",

        components:{
            BlogSidebar
        },
        mounted(){
        this.$store.dispatch("allBlogPost")
            this.allpostByCategoryID()
        },
        computed:{
            displayData(){
                return this.$store.getters.getDataFromAction
            }
        },
        methods:{
            allpostByCategoryID(){
                if (this.$route.params.id!=null){
                    this.$store.dispatch("allCategoryPost",this.$route.params.id)

                } else{
                    this.$store.dispatch("allBlogPost")


                }

            }
        },
        watch:{
            $route(to,from){
                this.allpostByCategoryID()
            }
        }
    }
</script>

<style scoped>

</style>
