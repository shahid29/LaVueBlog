import AdminHome from './components/admin/AdminHome.vue'
import CategoryList from './components/admin/category/List'
import AddCategory from './components/admin/category/New'
import EditCategory from './components/admin/category/View'

//Post Related
import PostList from './components/admin/post/List'
import AddPost from './components/admin/post/New'
import EditPost from './components/admin/post/View'


//frontend
import PublicHome from './components/public/PublicHome'
import allBlog from './components/public/blog/BlogPost'
import singlePost from './components/public/blog/SinglePost'

export const routes = [
    {
        path:'/home',
        component:AdminHome
    },
    {
        path:'/category-list',
        component:CategoryList
    },
    {
        path:'/add-category',
        component:AddCategory
    },
    {
        path:'/edit-category/:CategoryId',
        component:EditCategory
    },


    //Post Related
    {
        path:'/post-list',
        component:PostList
    },
    {
        path:'/add-post',
        component:AddPost
    },
    {
        path:'/edit-post/:PostId',
        component:EditPost
    },

    //frontend
    {
        path:'/',
        component:PublicHome
    },
    {
        path:'/all-blog',
        component:allBlog
    },
    {
        path:'/singlePost/:id',
        component:singlePost
    },
    {
        path:'/categories-id/:id',
        component:allBlog
    }


];


