import Vue from "vue";
import Router from "vue-router";
import Home from "./components/mainapp.vue";
import ListBlog from './components/Admin/ListBlog.vue';
import Profile from './components/Admin/Profile.vue';
import CreateBlog from './components/Admin/CreateBlog.vue';
import Tags from './components/Admin/Tags.vue';
Vue.use(Router);

const routes = [{
        path: "/",
        component: Home,

    },
    //admin rroute


    {
        path: "/admin/create",
        component: CreateBlog
    },
    {
        path: "/admin/listblog",
        component: ListBlog
    },
    {
        path: "/admin/profile",
        component: Profile
    },
    {
        path: "/admin/tags",
        component: Tags
    }
];

export {
    routes
}