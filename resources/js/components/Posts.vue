<template>
    <div class="row">
     <div class="col-lg-7 mx-auto" id="content">
        <div v-if="isloading">
        <div class="item" v-for="post in posts" :key="post.id">
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
                <span v-if="!showMore && post.content.length>100">
                    <button @click="showMore=true">
                    Voir plus
                    </button>
                </span>
                <span v-if="showMore && post.content.length>100">
                    <button @click="showMore=false">
                    Voir moins
                    </button>
                </span>
                </p>
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
                    <span>{{ post.comments.length }} Comments</span>
                </button>
                <button @click="savePost(post.id)" :class="{ 'saved':post.saved }" :disabled="post.saved">
                    <i class="fas fa-bookmark"></i>
                    <span>Save</span>
                </button>
            </div>
            <div id="comment" v-if="showComment">
                <ul>
                    <li v-for="comment in post.comments" :key="comment.id">
                        <div class="header-list">
                            <h3>{{ comment.username }}</h3>
                            <p><i class="fas fa-clock"></i> {{comment.created_at | moment("from", "now") }} </p>
                        </div>
                        <p :class="arDir(comment.lg)">{{ comment.content }}</p>
                    </li>
                </ul>
                <div class="form">
                    <textarea   cols="30" v-model="comment.content"  class="form-control" placeholder="Commenter" rows="1" required></textarea>
                    <button type="submit" @click="addComment(post.id)"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
        </div>
     </div>

     <div class="col-lg-3" id="sidebar">
    <div class="addPost">
    <form method="POST" v-on:submit.prevent="formSubmit" enctype="multipart/form-data">
        <div v-if="error" class="alert alert-danger">
            {{error}}
        </div>
        <input type="text" v-model="post_form.title" class="form-control" placeholder="Titre *" required>
        <textarea v-model="post_form.content" placeholder="Content ..." id="body" class="form-control"></textarea>
        <div class="mb-3">
            <select class="form-select" :ref="post_form.category_id">
                <option :disabled="true" selected>Select Category</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }} </option>
            </select>
            <input v-if="post_form.category_id == 0" type="text" v-model="post_form.newCategory" class="form-control" placeholder="New Category">
        </div>
        <input type="text" v-model="post_form.cat" class="form-control" placeholder="#">
        <input type="file" @change="onChange" class="form-control" placeholder="Upload image">
        <div class="d-grid gap-2">
            <button type="submit" class="btn ">Ajouter</button>
        </div>
    </form>
    </div>
    <div class="categories">
        <ul>
            <li v-for="category in categories" :key="category.id">
                <a :href="categoryPosts(category.name)">{{ category.name }}</a>
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
    props:['user_id'],
    data(){
        return{
            posts:[],
            post_form:{
                title:'',
                content:'',
                user_id:this.user_id,
                category_id:0,
                cat:'',
                newCategory:'',
                file:null
            },
            showComment:false,
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
            categories:[],
            showMore:false,
            showContent:false,
            isloading:false,
            error:"",
        };
    },
    methods: {
        getImage:function(elem){
            return '/images/'+elem;
        },
        arDir:function(elem){
            return elem==="ar" ? 'rtl' : 'ltr';
        },
        showPost:function(slug){
            window.location.href = "/post/"+slug;
        },
        categoryPosts:function(category){
            return "/category/posts/"+category;
        },
        addLike:function(id){
            this.save.post_id=id;
            axios.post('/api/like',this.save)
            .then((res) => {
                this.$toastr.s(
                    res.data.message,
                );
                this.getPosts();
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
                this.getPosts();
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
                this.getPosts();
                this.comment.content="";
            })
            .catch(err=>console.log(err));
        },
        onChange(e) {
            this.post_form.file = e.target.files[0];
        },
        validate(){
            if(this.post_form.title.length < 10)
            {
                this.error="title is too short !!!";
            }else if(this.post_form.content.length < 20){
                this.error="content is too short !!!";
            }
            else if(this.post_form.content ==="" && !this.post_form.file){
                this.error="content or file must be not empty !!!";
            }else if(this.post_form.category_id==0 && this.post_form.newCategory ==''){
                this.error="select an category or create new category !!!";
            }
        },
        formSubmit() {
            this.validate();
            if(!this.error){
                let data = new FormData();
                if(this.post_form.file){
                    data.append('file', this.post_form.file);
                }
                if(this.post_form.newCategory!=''){
                    data.append('newCategory', this.post_form.newCategory);
                }
                data.append('content', this.post_form.content);
                data.append('user_id', this.post_form.user_id);
                data.append('cat', this.post_form.cat);
                data.append('title', this.post_form.title);
                data.append('category_id', this.post_form.category_id);
                axios.post('/api/post', data)
                    .then((res) => {
                        this.$toastr.s(
                            res.data.message,
                        );
                        this.post_form.content="";
                        this.post_form.file=null;
                        this.post_form.title="";
                        this.post_form.cat='';
                        this.post_form.category_id=null;
                        this.getPosts();
                        this.getCatgeories();
                    })
                    .catch(function (err) {
                        console.log(err)
                    });
            }
        },
        getPosts:function(){
            axios.get('/api/posts/'+this.user_id)
            .then((res) => {
                this.posts=res.data;
                this.isloading=true;
            })
            .catch(err=>console.log(err));
        },
        getCatgeories:function(){
            axios.get('/api/categories')
            .then((res) => {
                this.categories=res.data;
                console.log(this.categories)
                // this.isloading=true;
            })
            .catch(err=>console.log(err));
        },
        diplayContent:function(content){
            // if ( content.length > 100 ) {
            //     this.showContent=true
            // }
            if(this.showMore)
                return content
            else if(content.length > 100){
                return content.substring(0,150) + '...';
            }
            else
                return content;
        }
    },
    mounted() {
        this.getPosts();
        this.getCatgeories();

    },
}
</script>
