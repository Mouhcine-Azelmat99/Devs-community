<template>
    <div class="row  mx-auto">
     <div class="col-lg-4 mx-auto my-3" v-for="post in posts" :key="post.id" id="content">
        <div class="item">
            <div class="header" :style="{ direction:arDir(post.lg) }" @click="showPost(post.slug)">
                <h1>{{ post.title }}</h1>
                <div>
                    <p class="poster">
                    {{ post.username }}
                    </p>
                    <p class="time">
                    <i class="fas fa-clock"></i> {{ post.created_at | moment("from", "now") }}
                    </p>
                </div>
            </div>
            <div class="body" :style="{ direction:arDir(post.lg) }">
                <p v-if="post.content"> {{ diplayContent(post.content) }}
                </p>
                <div class="image">
                    <img v-if="post.img" :src="getImage(post.img)" :alt="post.title">
                </div>
            </div>
        </div>
     </div>
</div>
</template>

<script>
import Vue from "vue";
import moment from "vue-moment";

Vue.use(moment);

import VueToastr from "vue-toastr";
Vue.use(VueToastr, {
    defaultTimeout: 10000,
    defaultProgressBar: false,
    defaultType: "info",
    defaultPosition: "toast-bottom-right",
    defaultStyle: { "background-color": "#2ecc71" },
});

Vue.config.productionTip = false;

export default {
    props:['user_id'],
    data(){
        return{
            posts:[],
            showMore:false,
        };
    },
    methods: {
        getImage:function(elem){
            return '/images/'+elem;
        },
        arDir:function(elem){
            return elem=="ar" ? 'rtl' : 'ltr';
        },
        showPost:function(slug){
            window.location.href = "/post/"+slug;
        },
        getPosts:function(){
            axios.get('/api/saved/'+this.user_id)
            .then((res) => {
                this.posts=res.data;
            })
            .catch(err=>console.log(err));
        },
        diplayContent:function(content){
            if(this.showMore){
                return content
            }
            var l = content?.length || 0;
            if ( l > 50 ) {
                return content.substring(0,50) + '...'
            } else {
                return content
            }
        }
    },
    mounted() {
        this.getPosts();
    },
}
</script>
