<template>
    <div class="col-lg-4">
        <div class="search mr-auto">
            <input @focus="showResult=true" v-model="post_search" class="form-control" placeholder="search ...">
            <button class="btn btn-primary" @click="search_btn">
            <i v-if="!post_search && !showResult" class="fa-solid fa-magnifying-glass"></i>
            <i v-if="post_search || showResult" class="fa-solid fa-xmark"></i>
            </button>
            </div>
        <div class="result" v-if="showResult">
            <ul>
                <li v-for="(post,index) in filtrePosts" :key="post.id" v-if="index<=4" :style="{ 'text-align':arDir(post.lg) }" @click="postLocation(post.slug,post.body)">
                    <h1>{{ post.title }}</h1>
                    <p v-if="post.content">{{diplayContent(post.content)}}</p>
                    <p v-if="post.body">{{diplayContent(post.body)}}</p>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

export default {
    data(){
        return{
            posts:[],
            showResult:false,
            post_search:"",
            questions:[],
        };
    },
    methods: {
        arDir:function(elem){
            return elem=="ar"||elem=='fa' ? 'right' : 'left';
        },
        search_btn(){
            this.post_search="";
            this.showResult=!this.showResult;
        },
        postLocation:function(slug,body){
            if(body)
                window.location.href = "/questions/"+slug;
            else
                window.location.href = "/post/"+slug;

        },
        getPosts:function(){
            axios.get('/api/search')
            .then((res) => {
                this.posts=res.data;
            })
            .catch(err=>console.log(err));
        },
        getQuestions:function(){
            axios.get('/api/questions')
            .then((res) => {
                this.questions=res.data;
                console.log(this.questions);
            })
            .catch(err=>console.log(err));
        },
        diplayContent:function(content){
            var l = content?.length || 0;
            if ( l > 50 ) {
                return content.substring(0,40) + '...'
            } else {
                return content
            }
        },
    },
    mounted() {
        this.getPosts();
        this.getQuestions();
    },
    computed:{
        filtrePosts(){
        var data=this.posts.concat(this.questions);
        var result = data.filter((item) =>
            item.title.toLowerCase().includes(this.post_search.toLowerCase()));
        if(result.length > 0)
            return result;
        result = data.filter((item) =>
        item.content.toLowerCase().includes(this.post_search.toLowerCase()));
        if(result.length > 0)
            return result;
        result = data.filter((item) =>
        item.body.toLowerCase().includes(this.post_search.toLowerCase()));
        return result;
        }
    }
}
</script>
