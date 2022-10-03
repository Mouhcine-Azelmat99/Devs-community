<template>
    <div class="row">
     <div class="col-lg-7 mx-auto" id="content" :style="{direction:directionstyle()}">
     <!-- start loading  -->
            <div v-if="!isloaded">
                <div class="item">
                    <div>
                        <!-- <span class="placeholder col-6"></span> -->
                        <p class="d-flex justify-content-between placeholder-glow">
                            <span class="placeholder col-6"></span>
                            <span class="placeholder col-2"></span>
                        </p>
                        <p class="card-text placeholder-glow">
                            <span class="placeholder col-3"></span>
                            <span class="placeholder col-2"></span>
                        </p>
                    </div>
                    <div class="body my-4 placeholder-glow">
                        <p class="card-text placeholder-glow">
                            <span class="placeholder col-7"></span>
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-6"></span>
                            <span class="placeholder col-8"></span>
                        </p>
                        <div class="image my-3">
                            <span class="placeholder w-75 py-5"></span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between placeholder-glow">
                        <a href="#" tabindex="-1" class="btn disabled placeholder col-2 mr-3"></a>
                        <a href="#" tabindex="-1" class="btn disabled placeholder col-2 mr-3"></a>
                        <a href="#" tabindex="-1" class="btn disabled placeholder col-2 mr-3"></a>
                    </div>
                </div>
            </div>
            <!-- end of loading  -->
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
                    <div class="image" v-if="post.img">
                        <a
                            v-if="isDocument(post.img)"
                            :href="getImage(post.img)"
                            target="_blank"
                            download
                            >{{ post.img }}</a
                        >
                        <img
                            v-else
                            :src="getImage(post.img)"
                            :alt="post.title"
                        />
                    </div>
                </div>
            </div>
            <div class="footer">
                <button @click="addLike(post.id)" :class="{ 'liked':post.liked }" :disabled="post.liked">
                    <i class="fas fa-thumbs-up"></i>
                    <span>{{ post.likes }} {{change_langue('Like','اعجاب')}}</span>
                </button>
                <button @click="showComment=!showComment" >
                    <i class="fas fa-comment"></i>
                    <span> {{change_langue('Comments','تعاليق')}}</span>
                </button>
                <button @click="savePost(post.id)" :class="{ 'saved':post.saved }" :disabled="post.saved">
                    <i class="fas fa-bookmark"></i>
                    <span>{{change_langue('Save','حفظ')}}</span>
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
                    <textarea   cols="30" v-model="comment.content"  class="form-control" :placeholder="change_langue('Comment','تعليق')" rows="1" required></textarea>
                    <button type="submit" @click="addComment(post.id)"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
     </div>
     <div class="col-lg-3" id="sidebar">
        <div id="related_post">
            <h3>{{change_langue('Related posts','منشورات مشابهة')}}</h3>
            <hr>
            <ul>
                <!-- start loading  -->
                <div v-if="!isloaded2">
                <li>
                <div class="placeholder-glow">
                    <p class="placeholder-glow">
                        <span class="placeholder col-8"></span>
                    </p>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>
                    </p>
                    <p class="my-3 placeholder-glow">
                        <span class="placeholder w-75 py-5"></span>
                    </p>
                </div>
                </li>
                <li>
                <div class="placeholder-glow">
                    <p class="placeholder-glow">
                        <span class="placeholder col-8"></span>
                    </p>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>
                    </p>
                    <p class="my-3 placeholder-glow">
                        <span class="placeholder w-75 py-5"></span>
                    </p>
                </div>
                </li>
                <li>
                <div class="placeholder-glow">
                    <p class="placeholder-glow">
                        <span class="placeholder col-8"></span>
                    </p>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>
                    </p>
                    <p class="my-3 placeholder-glow">
                        <span class="placeholder w-75 py-5"></span>
                    </p>
                </div>
                </li>
                <li>
                <div class="placeholder-glow">
                    <p class="placeholder-glow">
                        <span class="placeholder col-8"></span>
                    </p>
                    <p class="card-text placeholder-glow">
                        <span class="placeholder col-7"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-4"></span>
                        <span class="placeholder col-6"></span>
                        <span class="placeholder col-8"></span>
                    </p>
                    <p class="my-3 placeholder-glow">
                        <span class="placeholder w-75 py-5"></span>
                    </p>
                </div>
                </li>
                </div>
                <!-- end of loading  -->
                <li v-for="relatedPost in relatedPosts" :key="relatedPost.id" v-else :style=" { 'text-align':direction(relatedPost.lg) }">
                <div @click="postLocation(relatedPost.slug)">
                    <h4> {{relatedPost.title}} </h4>
                    <p> {{diplayContent(relatedPost.content)}} </p>
                    <div class="image" v-if="relatedPost.img">
                        <a
                            v-if="isDocument(relatedPost.img)"
                            :href="getImage(relatedPost.img)"
                            target="_blank"
                            download
                            >{{ relatedPost.img }}</a
                        >
                        <img
                            v-else
                            :src="getImage(relatedPost.img)"
                            :alt="relatedPost.title"
                        />
                    </div>
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
    props:['user_id','slug','langue'],
    data(){
        return{
            isloaded:false,
            isloaded2:false,
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
        };
    },
    methods: {
        async copy(slug) {
            try {
                await navigator.clipboard.writeText(window.location.href+"post/" + slug);
                this.$toastr.s("the post is copied");
            } catch($e) {
                this.$toastr.s("cannot copie this post");
            }
        },
        directionstyle(){
            if(this.langue=='ar')
                return 'ltr';
        },
        change_langue(an,ar){
            return this.langue=='ar'? ar : an;
        },
        isDocument(fileName) {
            var ext = fileName.substr(fileName.lastIndexOf(".") + 1);
            if (ext == "pdf" || ext == "docx") return true;
            else return false;
        },
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
                this.comment.content="";
            })
            .catch(err=>console.log(err));
        },
        showPost:function(){
            axios.get('/api/posts/'+this.slug+'/'+this.user_id)
            .then((res) => {
                this.post=res.data;
                this.isloaded=true;
                console.log(this.post.lg);
            })
            .catch(err=>console.log(err));
        },
        related:function(){
            axios.get('/api/related')
            .then((res) => {
                this.relatedPosts=res.data;
                this.isloaded2=true;
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
