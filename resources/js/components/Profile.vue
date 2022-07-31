<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="img-circle">
                    {{ letter }}
                </div>
                <div class="info">
                    <ul>
                        <li>
                            <p>Username</p>
                            <h3>{{ user.username }}</h3>
                        </li>
                        <li>
                            <p>Email</p>
                            <h3>{{ user.email }}</h3>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="saved_posts">
                    <h1>saved posts</h1>
                    <div class="row">
                        <div class="col-4" v-for="post in saved_posts" :key="post.id" :style="{ direction:arDir(post.lg) }">
                            <div class="head">
                                <h2 @click="showPost(post.slug)">{{post.title}}</h2>
                                <button v-if="user_id==post.user_id" @click="deleteSaved(post.id)"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                            <p @click="showPost(post.slug)" v-if="post.content">{{diplayContent(post.content)}} </p>
                            <img @click="showPost(post.slug)" v-if="post.img" :src="getImage(post.img)" :alt="post.title">
                        </div>
                    </div>
                </div>
                <div class="saved_posts mt-5">
                    <h1>Publied posts</h1>
                    <div class="row">
                        <div class="col-4" v-for="post in publied_posts" :key="post.id" :style="{ direction:arDir(post.lg) }">
                            <div class="head">
                                <h2 @click="showPost(post.slug)">{{post.title}}</h2>
                                <button v-if="user_id==post.user_id" @click="deletePost(post.id)"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                            <p @click="showPost(post.slug)" v-if="post.content">{{diplayContent(post.content)}} </p>
                            <img v-if="post.img" :src="getImage(post.img)" :alt="post.title" @click="showPost(post.slug)">
                        </div>
                    </div>
                </div>
                <div class="saved_posts mt-5">
                    <h1>Publied Question</h1>
                    <div class="row">
                        <div class="col-4" v-for="question in questions" :key="question.id" :style="{ direction:arDir(question.lg) }">
                            <div class="head">
                                <h2 @click="showQuestion(question.slug)">{{question.title}}</h2>
                                <button v-if="user_id==question.user_id" @click="deleteQuestion(question.id)"><i class="fa-solid fa-xmark"></i></button>
                            </div>
                            <p @click="showQuestion(question.slug)" v-if="question.body">{{diplayContent(question.body)}} </p>
                            <img v-if="question.img" :src="getImage(question.img)" :alt="question.title" @click="showQuestion(question.slug)">
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
     props:['user_id'],
    data(){
        return{
            letter:'',
            user:{},
            saved_posts:[],
            publied_posts:[],
            questions:[],
        };
    },
    methods: {
        getImage:function(elem){
            return '/images/'+elem;
        },
        arDir:function(elem){
            return elem==="ar" || elem=="fa" ? 'rtl' : 'ltr';
        },
        deletePost(id){
            axios.delete('/api/posts/'+id)
            .then((res) => {
                this.$toastr.s(
                    res.data.message,
                );
                this.getPosts();
                this.getData();
            })
            .catch(err=>console.log(err));
        },
        deleteSaved(id){
            axios.delete('/api/saved/'+id)
            .then((res) => {
                this.$toastr.s(
                    res.data.message,
                );
                this.getSaved();
                this.getData();
            })
            .catch(err=>console.log(err));
        },
        diplayContent:function(content){
            if ( content.length > 50 ) {
                return content.substring(0,20) + '...'
            } else {
                return content
            }
        },
        deleteQuestion(id){
            axios.delete('/api/questions/'+id)
            .then((res) => {
                this.$toastr.s(
                    res.data.message,
                );
                this.getQuestions();
            })
            .catch(err=>console.log(err));
        },
        getSaved(){
            axios.get('/api/saved/profil/'+this.user_id)
            .then((res) => {
                this.saved_posts=res.data;
            })
            .catch(err=>console.log(err));
        },
        getPosts(){
            axios.get('/api/profil/posts/'+this.user_id)
            .then((res) => {
                this.publied_posts=res.data;
            })
            .catch(err=>console.log(err));
        },
        getQuestions(){
            axios.get('/api/questions')
            .then((res) => {
                this.questions=res.data;
            })
            .catch(err=>console.log(err));
        },
        showPost:function(slug){
            window.location.href = "/post/"+slug;
        },
        showQuestion:function(slug){
            window.location.href = "/questions/"+slug;
        },
        getData(){
            axios.get('/api/profile/'+this.user_id)
            .then((res) => {
                this.user=res.data.user;
                this.letter=res.data.letters;
            })
            .catch(err=>console.log(err));
        }
    },
    mounted() {
        this.getQuestions();
        this.getPosts();
        this.getSaved();
        this.getData();
    },

}
</script>
