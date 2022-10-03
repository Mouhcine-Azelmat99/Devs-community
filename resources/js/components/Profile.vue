<template>
    <div class="container">
        <div class="row">
                <div class="col-lg-3" v-if="!isloaded1">
                    <div class="img-circle">
                        <p class="placeholder-glow">
                            <span class="placeholder col-4"></span>
                        </p>
                    </div>
                    <div class="info">
                        <ul>
                            <li>
                                <p class="placeholder-glow">
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="placeholder-glow">
                                    <span class="placeholder col-8"></span>
                                </p>
                            </li>
                            <li>
                                <p class="placeholder-glow">
                                    <span class="placeholder col-6"></span>
                                </p>
                                <p class="placeholder-glow">
                                    <span class="placeholder col-10"></span>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            <div v-else class="col-lg-3">
                <div class="img-circle">
                    {{ letter }}
                </div>
                <div class="info">
                    <ul>
                        <li>
                            <p>{{ change_langue('username','اسم المستخدم') }}</p>
                            <h3>{{ user.username }}</h3>
                        </li>
                        <li>
                            <p>{{ change_langue('Email','جمايل الحساب') }}</p>
                            <h3>{{ user.email }}</h3>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="saved_posts">
                    <h1>{{ change_langue('Saved posts','المنشورات المحفطة') }}</h1>
                    <div class="row">
                        <div v-if="!isloaded2" class="row">
                            <div class="col-4">
                                <p class="placeholder-glow">
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="my-3 placeholder-glow">
                                    <span class="placeholder w-75 py-5"></span>
                                </p>
                            </div>
                            <div class="col-4">
                                <p class="placeholder-glow">
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="my-3 placeholder-glow">
                                    <span class="placeholder w-75 py-5"></span>
                                </p>
                            </div>
                            <div class="col-4">
                                <p class="placeholder-glow">
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="my-3 placeholder-glow">
                                    <span class="placeholder w-75 py-5"></span>
                                </p>
                            </div>
                        </div>
                        <div
                            v-else
                            class="col-4"
                            v-for="post in saved_posts"
                            :key="post.id"
                            :style="{ direction: arDir(post.lg) }"
                        >
                            <div class="head">
                                <h2 @click="showPost(post.slug)">
                                    {{ post.title }}
                                </h2>
                                <button
                                    
                                    @click="deleteSaved(post.id)"
                                >
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <p @click="showPost(post.slug)" v-if="post.content">
                                {{ diplayContent(post.content) }}
                            </p>
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
                                    @click="showPost(post.slug)"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="saved_posts mt-5">
                    <h1>{{ change_langue('My Posts','منشوراتي') }}</h1>
                    <div class="row">
                        <div v-if="!isloaded3" class="row">
                            <div class="col-4">
                                <p class="placeholder-glow">
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="my-3 placeholder-glow">
                                    <span class="placeholder w-75 py-5"></span>
                                </p>
                            </div>
                            <div class="col-4">
                                <p class="placeholder-glow">
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="my-3 placeholder-glow">
                                    <span class="placeholder w-75 py-5"></span>
                                </p>
                            </div>
                            <div class="col-4">
                                <p class="placeholder-glow">
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="my-3 placeholder-glow">
                                    <span class="placeholder w-75 py-5"></span>
                                </p>
                            </div>
                        </div>
                        <div
                            v-else
                            class="col-4"
                            v-for="post in publied_posts"
                            :key="post.id"
                            :style="{ direction: arDir(post.lg) }"
                        >
                            <div class="head">
                                <h2 @click="showPost(post.slug)">
                                    {{ post.title }}
                                </h2>
                                <button
                                    
                                    @click="deletePost(post.id)"
                                >
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <p @click="showPost(post.slug)" v-if="post.content">
                                {{ diplayContent(post.content) }}
                            </p>
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
                                    @click="showPost(post.slug)"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="saved_posts mt-5">
                    <h1>{{ change_langue('My Questions','اسئلتي') }}</h1>
                    <div class="row">
                        <div v-if="!isloaded4" class="row">
                            <div class="col-4">
                                <p class="placeholder-glow">
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="my-3 placeholder-glow">
                                    <span class="placeholder w-75 py-5"></span>
                                </p>
                            </div>
                            <div class="col-4">
                                <p class="placeholder-glow">
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="my-3 placeholder-glow">
                                    <span class="placeholder w-75 py-5"></span>
                                </p>
                            </div>
                            <div class="col-4">
                                <p class="placeholder-glow">
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="card-text placeholder-glow">
                                    <span class="placeholder col-7"></span>
                                    <span class="placeholder col-8"></span>
                                </p>
                                <p class="my-3 placeholder-glow">
                                    <span class="placeholder w-75 py-5"></span>
                                </p>
                            </div>
                        </div>
                        <div
                            v-else
                            class="col-4"
                            v-for="question in questions"
                            :key="question.id"
                            :style="{ direction: arDir(question.lg) }"
                        >
                            <div class="head">
                                <h2 @click="showQuestion(question.slug)">
                                    {{ question.title }}
                                </h2>
                                <button
                                    
                                    @click="deleteQuestion(question.id)"
                                >
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <p
                                @click="showQuestion(question.slug)"
                                v-if="question.body"
                            >
                                {{ diplayContent(question.body) }}
                            </p>
                            <div class="image" v-if="question.img">
                                <a
                                    v-if="isDocument(question.img)"
                                    :href="getImage(question.img)"
                                    target="_blank"
                                    download
                                    >{{ question.img }}</a
                                >
                                <img
                                    v-else
                                    :src="getImage(question.img)"
                                    :alt="question.title"
                                    @click="showPost(question.slug)"
                                />
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
    props: ["user_id",'langue'],
    data() {
        return {
            letter: "",
            user: {},
            saved_posts: [],
            publied_posts: [],
            questions: [],
            isloaded1: false,
            isloaded2: false,
            isloaded3: false,
            isloaded4: false,
        };
    },
    methods: {
        change_langue(an,ar){
            return this.langue=='ar'? ar : an;
        },
        isDocument(fileName) {
            var ext = fileName.substr(fileName.lastIndexOf(".") + 1);
            if (ext == "pdf" || ext == "docx") return true;
            else return false;
        },
        getImage: function (elem) {
            return "/images/" + elem;
        },
        arDir: function (elem) {
            return elem === "ar" || elem == "fa" ? "rtl" : "ltr";
        },
        deletePost(id) {
            axios
                .delete("/api/posts/" + id)
                .then((res) => {
                    this.$toastr.s(res.data.message);
                    this.getPosts();
                    this.getData();
                })
                .catch((err) => console.log(err));
        },
        deleteSaved(id) {
            axios
                .delete("/api/saved/" + id)
                .then((res) => {
                    this.$toastr.s(res.data.message);
                    this.getSaved();
                    this.getData();
                })
                .catch((err) => console.log(err));
        },
        diplayContent: function (content) {
            if (content.length > 50) {
                return content.substring(0, 20) + "...";
            } else {
                return content;
            }
        },
        deleteQuestion(id) {
            axios
                .delete("/api/questions/" + id)
                .then((res) => {
                    this.$toastr.s(res.data.message);
                    this.getQuestions();
                })
                .catch((err) => console.log(err));
        },
        getSaved() {
            axios
                .get("/api/saved/profil/" + this.user_id)
                .then((res) => {
                    this.saved_posts = res.data;
                    this.isloaded2 = true;
                })
                .catch((err) => console.log(err));
        },
        getPosts() {
            axios
                .get("/api/profil/posts/" + this.user_id)
                .then((res) => {
                    this.publied_posts = res.data;
                    this.isloaded3 = true;
                })
                .catch((err) => console.log(err));
        },
        getQuestions() {
            axios
                .get("/api/questions")
                .then((res) => {
                    this.questions = res.data;
                    console.log(this.questions);
                    this.isloaded4 = true;
                })
                .catch((err) => console.log(err));
        },
        showPost: function (slug) {
            window.location.href = "/post/" + slug;
        },
        showQuestion: function (slug) {
            window.location.href = "/questions/" + slug;
        },
        getData() {
            axios
                .get("/api/profile/" + this.user_id)
                .then((res) => {
                    this.user = res.data.user;
                    this.letter = res.data.letters;
                    this.isloaded1 = true;
                })
                .catch((err) => console.log(err));
        },
    },
    mounted() {
        this.getQuestions();
        this.getPosts();
        this.getSaved();
        this.getData();
    },
};
</script>
