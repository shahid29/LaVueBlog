<template>
    <span>
        <div class="span4">
            <aside class="right-sidebar">
              <div class="widget">
                <form class="form-search">
                  <input @keyup="Search" placeholder="Type something" v-model="keyword" type="text" class="input-medium search-query">
                  <button type="submit" @click.prevent="Search" class="btn btn-square btn-theme">Search</button>
                </form>
              </div>
              <div class="widget">
                <h5 class="widgetheading">Categories</h5>
                <ul class="cat" v-for="showdata in showSidebarCategory">
                  <li><i class="icon-angle-right"></i><router-link :to="`/categories-id/${showdata.id}`">{{showdata.cat_name}}</router-link><span> (20)</span></li>

                </ul>
              </div>
              <div class="widget">
                <h5 class="widgetheading">Latest posts</h5>
                <ul class="recent">
                  <li v-for="(show,index) in displayData" v-if="index<3">
                    <img width="40px" height="40px" :src="`uploadimage/${show.photo}`" class="pull-left" alt="" />
                    <h6><router-link :to="`/singlePost/${show.id}`">{{show.title | sortlenght(20)}}</router-link></h6>
                    <p>
                     {{show.description | sortlenght(50,'....')}}
                    </p>
                  </li>
                </ul>
              </div>
            </aside>
          </div>
    </span>
</template>

<script>
    import _ from 'lodash';
    export default {
        name: "BlogSidebar",
        data(){
            return{
                keyword:''
            }
        },

        mounted(){
            this.$store.dispatch('categoryForSidebar');
            this.$store.dispatch("latest")
        },
        computed:{
            showSidebarCategory(){
                return this.$store.getters.sidebarCategory
            },
            displayData(){
                return this.$store.getters.latestPost
            }
        },

        methods:{
            // Search:_.debounce(function () {
            //     this.$store.dispatch('SearchPost',this.keyword);
            // }, 1000)
            Search(){
                this.$store.dispatch('SearchPost',this.keyword);
            }

        },
    }
</script>

<style scoped>

</style>
