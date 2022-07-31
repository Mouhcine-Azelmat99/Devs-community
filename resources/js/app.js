import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

window.Vue = require('vue').default;


Alpine.start();

import Posts from './components/Posts.vue';
import Show from './components/ShowPost.vue';
import Saved from './components/Saved.vue';
import Search from './components/Search.vue';
import Ressources from './components/Ressources.vue';
import Profile from './components/Profile.vue';
import Questions from './components/Questions.vue';
import Showuestion from './components/ShowQuestion.vue';
import Postscategory from './components/PostsCategory.vue';

const app = new Vue({
    el: '#app',
    components:{
        Posts,
        Saved,
        Show,
        Search,
        Ressources,
        Profile,
        Questions,
        Showuestion,
        Postscategory,
    }
});
