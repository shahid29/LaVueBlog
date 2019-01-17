export default {
    state: {
        // add category array
        category:[],
        post:[],

        //frontEnd
        blogPost:[],
        singlePost:[],
        sidebarCategory:[],
        latestPost:[],

    },
    getters: {
        // and state within method and return it
        getCategory(state){
        return state.category
        },
        getPost(state){
            return state.post
        },

        //frontend
        getDataFromAction(state){
            return state.blogPost
        },
        singlePostById(state){
            return state.singlePost
        },
        sidebarCategory(state){
            return state.sidebarCategory
        },
        latestPost(state){
            return state.latestPost
        },
        getAllPostByCategoryId(state){
            return state.blogPost
        }
    },
    actions: {
        allCategory(context){
            axios.get('/getCategories')
                .then((response)=>{
                  context.commit('showCategoryInMutation',response.data.showResult)
                });

        },

        //Post
        AllPost(context){
            axios.get('/getPosts')
                .then((response)=>{
                    context.commit('showPostMutation',response.data.result)
                });
        },

        //Frontend

        allBlogPost(context){
            axios.get('/getblogPost')
                .then((response)=>{
                    context.commit('showblogPostMutation',response.data.result)
                })
        },
        getSinglePost(context,payload){
            axios.get('/singlePost/'+payload)
                .then((response)=>{
                    context.commit('getSinglePostMutation',response.data.result)
                })
        },
        categoryForSidebar(context){
            axios.get('/categoryForSidebar')
                .then((response)=>{
                    context.commit('sidebarCategoryMutation',response.data.result)
                })
        },
        latest(context){
            axios.get('/latest')
                .then((response)=>{
                    context.commit('latestMutation',response.data.result)
                })
        },
        allCategoryPost(context,payload){
             axios.get('/allpostbyCategoryId/'+payload)
                 .then((response)=>{
                     context.commit('allpostbyCategoryId_Mutation',response.data.result)
                 })
        },
        SearchPost(context,payload){
            axios.get('/search?s='+payload)
                .then((response)=>{
                    context.commit('Search_Mutation',response.data.result)
                })
        }
    },
    mutations: {
        showCategoryInMutation(state,data){
            return state.category = data
        },
        showPostMutation(state,data){
            return state.post = data
        },


        //frontend
        showblogPostMutation(state,data){
            return state.blogPost = data
        },
        getSinglePostMutation(state,payload){
            return state.singlePost = payload
        },
        sidebarCategoryMutation(state,payload){
            return state.sidebarCategory = payload
        },
        latestMutation(state,payload){
            return state.latestPost = payload
        },
        allpostbyCategoryId_Mutation(state,payload){
            return state.blogPost=payload
        },
        Search_Mutation(state,payload){
            return state.blogPost=payload
        }

    }

}
