<template>
    <div class="row">
     <div class="col-lg-7 mx-auto" id="content">
        <div class="item">
            <div class="header" :style="{ direction:arDir() }">
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
            <div class="body" :style="{ direction:arDir() }">
                <p v-if="post.content"> {{ post.content }} </p>
                <hr>
                <div class="image">
                    <img v-if="post.img" :src="getImage(post.img)" :alt="post.title">
                </div>
            </div>
            <div class="footer">
                <button @click="addLike(post.id)" :class="{ 'liked':post.liked }" :disabled="post.liked">
                    <i class="fas fa-thumbs-up"></i>
                    <span>{{ post.likes }} Like</span>
                </button>
                <button @click="showComment=!showComment" >
                    <i class="fas fa-comment"></i>
                    <span> Comments</span>
                </button>
                <button @click="savePost(post.id)" :class="{ 'saved':post.saved }" :disabled="post.saved">
                    <i class="fas fa-bookmark"></i>
                    <span>Save</span>
                </button>
            </div>
            <div id="comment" class="comments">
                <ul>
                    <li v-for="comment in post.comments" :key="comment.id">
                        <div class="header-list">
                            <h3>{{ comment.username }}</h3>
                            <p><i class="fas fa-clock"></i> {{comment.created_at | moment("from", "now") }} </p>
                        </div>
                        <p :style=" { 'text-align':direction(comment.lg) }">{{ comment.content }}</p>
                    </li>
                </ul>
                <div class="form">
                    <textarea   cols="30" v-model="comment.content"  class="form-control" placeholder="Commenter" rows="1" required></textarea>
                    <button type="submit" @click="addComment(post.id)"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
     </div>
     <div class="col-lg-3" id="sidebar">
        <div id="related_post">
            <h3>Related posts</h3>
            <hr>
            <ul>
                <li v-for="relatedPost in relatedPosts" :key="relatedPost.id" :style=" { 'text-align':direction(relatedPost.lg) }">
                <div @click="postLocation(relatedPost.slug)">
                    <h4> {{relatedPost.title}} </h4>
                    <p> {{diplayContent(relatedPost.content)}} </p>
                    <img v-if="relatedPost.img" :src="getImage(relatedPost.img)" :alt="relatedPost.title">
                </div>
                </li>
            </ul>
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
    props:['user_id','slug'],
    data(){
        return{
            post:{},
            relatedPosts:[],
            comment:{
                'post_id':0,
                'user_id':this.user_id,
                'content':""
            },
            like:{
                'post_id':0,
                'user_id':this.user_id,
            },
            save:{
                'post_id':0,
                'user_id':this.user_id,
            },
            isloading:false,
        };
    },
    methods: {
        getImage:function(elem){
            return '/images/'+elem;
        },
        arDir:function(){
            if(this.post.lg==="ar" || this.post.lg==="fa")
                return 'rtl';
        },
        direction:function(elem){
            if(elem ==="ar" || elem === "fa")
                return 'right';
            else
                return 'left';
        },
        postLocation:function(slug){
            window.location.href = "/post/"+slug;
        },
        addLike:function(id){
            this.save.post_id=id;
            axios.post('/api/like',this.save)
            .then((res) => {
                this.$toastr.s(
                    res.data.message,
                );
                this.showPost();
                this.save.post_id=0;
            })
            .catch(err=>console.log(err));
        },
        savePost:function(id){
            this.save.post_id=id;
            axios.post('/api/save',this.save)
            .then((res) => {
                this.$toastr.s(
                    res.data.message,
                );
                this.showPost();
                this.save.post_id=0;
            })
            .catch(err=>console.log(err));
        },
        addComment:function(id){
            this.comment.post_id=id;
            console.log(this.comment);
            axios.post('/api/comment',this.comment)
            .then((res) => {
                this.$toastr.s(
                    res.data.message,
                );
                this.showPost();
                this.comment.conten="";
            })
            .catch(err=>console.log(err));
        },
        showPost:function(){
            axios.get('/api/posts/'+this.slug+'/'+this.user_id)
            .then((res) => {
                this.post=res.data;
                this.isloading=true;
                console.log(this.post.lg);
            })
            .catch(err=>console.log(err));
        },
        related:function(){
            axios.get('/api/related')
            .then((res) => {
                this.relatedPosts=res.data;
            })
            .catch(err=>console.log(err));
        },
        diplayContent:function(content){
            var l = content?.length || 0;
            if ( l > 50 ) {
                return content.substring(0,20) + '...'
            } else {
                return content
            }
        }
    },
    mounted() {
        this.related();
        this.showPost();
    },
}
</script>
