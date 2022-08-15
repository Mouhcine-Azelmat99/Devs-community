<template>
    <div class="row">
        <div class="col-lg-8 mx-auto" id="content">
            <!-- start loading  -->
            <div v-if="!isloaded">
                <div class="item">
                    <div>
                        <!-- <span class="placeholder col-6"></span> -->
                        <p
                            class="d-flex justify-content-between placeholder-glow"
                        >
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
                    <div
                        class="d-flex justify-content-between placeholder-glow"
                    >
                        <a
                            href="#"
                            tabindex="-1"
                            class="btn disabled placeholder col-2 mr-3"
                        ></a>
                        <a
                            href="#"
                            tabindex="-1"
                            class="btn disabled placeholder col-2 mr-3"
                        ></a>
                        <a
                            href="#"
                            tabindex="-1"
                            class="btn disabled placeholder col-2 mr-3"
                        ></a>
                    </div>
                </div>
                <div class="item">
                    <div>
                        <!-- <span class="placeholder col-6"></span> -->
                        <p
                            class="d-flex justify-content-between placeholder-glow"
                        >
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
                    <div
                        class="d-flex justify-content-between placeholder-glow"
                    >
                        <a
                            href="#"
                            tabindex="-1"
                            class="btn disabled placeholder col-2 mr-3"
                        ></a>
                        <a
                            href="#"
                            tabindex="-1"
                            class="btn disabled placeholder col-2 mr-3"
                        ></a>
                        <a
                            href="#"
                            tabindex="-1"
                            class="btn disabled placeholder col-2 mr-3"
                        ></a>
                    </div>
                </div>
                <div class="item">
                    <div>
                        <!-- <span class="placeholder col-6"></span> -->
                        <p
                            class="d-flex justify-content-between placeholder-glow"
                        >
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
                    <div
                        class="d-flex justify-content-between placeholder-glow"
                    >
                        <a
                            href="#"
                            tabindex="-1"
                            class="btn disabled placeholder col-2 mr-3"
                        ></a>
                        <a
                            href="#"
                            tabindex="-1"
                            class="btn disabled placeholder col-2 mr-3"
                        ></a>
                        <a
                            href="#"
                            tabindex="-1"
                            class="btn disabled placeholder col-2 mr-3"
                        ></a>
                    </div>
                </div>
            </div>
            <!-- end of loading  -->
            <div v-else>
                <div
                    class="item"
                    v-for="question in questions"
                    :key="question.id"
                >
                    <div
                        class="header"
                        :style="{ direction: arDir(question.lg) }"
                    >
                        <h1 @click="showQuestion(question.slug)">
                            {{ question.title }}
                        </h1>
                        <div class="head-right">
                            <div
                                @click="showQuestion(question.slug)"
                                :class="{ 'mx-3': marginLeft(question.lg) }"
                            >
                                <p class="poster">
                                    {{ question.username }}
                                </p>
                                <p class="time">
                                    <i class="fas fa-clock"></i>
                                    {{
                                        question.created_at
                                            | moment("from", "now")
                                    }}
                                </p>
                            </div>
                            <button
                                v-if="user_id == question.user_id"
                                @click="deleteQuestion(question.id)"
                            >
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                    <div
                        class="body"
                        :style="{ direction: arDir(question.lg) }"
                    >
                        <p>{{ question.body }}</p>
                        <div class="image" v-if="question.img">
                            <a
                                v-if="isDocument(question.img)"
                                :href="getImage(question.img)" target="_blank"
                                download
                                >{{ question.img }}</a
                            >
                            <img
                                v-else
                                :src="getImage(question.img)"
                                :alt="question.title"
                            />
                        </div>
                    </div>
                    <div class="reponds">
                        <h1 @click="afficheDisscusions = !afficheDisscusions">
                            {{change_langue("Discussion","دردشة")}}
                            <span> {{ question.solutions.length }} </span>
                            <p v-if="!afficheDisscusions"><i class="fa-solid fa-angle-down"></i></p>
                            <p v-else><i class="fa-solid fa-angle-up"></i></p>
                        </h1>
                        <div class="form mb-4">
                            <form
                                v-on:submit.prevent="formSubmit(question.id)"
                                enctype="multipart/form-data"
                                method="POST"
                            >
                                <textarea
                                    v-model="repond.content"
                                    cols="30"
                                    class="form-control py-3"
                                    :placeholder="change_langue('Reponds','اجابة')"
                                    rows="1"
                                ></textarea>
                                <label for="file"
                                    ><i class="fas fa-image"></i
                                ></label>
                                <input
                                    type="file"
                                    id="file"
                                    placeholder="image"
                                    @change="onChange"
                                />
                                <button type="submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </form>
                        </div>
                        <ul v-if="afficheDisscusions">
                            <li
                                v-for="discusion in question.solutions"
                                :key="discusion.id"
                                :style="{
                                    'text-align': direction(discusion.lg),
                                }"
                            >
                                <div class="header-list">
                                    <h3>{{ discusion.username }}</h3>
                                    <div class="head-right">
                                        <p>
                                            <i class="fas fa-clock"></i>
                                            {{
                                                discusion.created_at
                                                    | moment("from", "now")
                                            }}
                                        </p>
                                        <button
                                            v-if="user_id == discusion.user_id"
                                            @click="deleteRepond(discusion.id)"
                                        >
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                </div>
                                <p>{{ discusion.content }}</p>
                                <img
                                    v-if="discusion.img"
                                    :src="getImage(discusion.img)"
                                    :alt="discusion.username"
                                />
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4" id="sidebar">
            <div class="addPost">
                <form
                    v-on:submit.prevent="addQuestion"
                    enctype="multipart/form-data"
                    method="POST"
                >
                    <input
                        type="text"
                        v-model="question_form.title"
                        class="form-control"
                         :placeholder="change_langue('Titre *','العنوان *')" required
                    />
                    <textarea
                        name="body"
                        v-model="question_form.body"
                        :placeholder="change_langue('Content ...','المحتوى ...')"
                        id="body"
                        class="form-control"
                    ></textarea>
                    <input
                        type="file"
                        class="form-control"
                        placeholder="Upload image"
                        @change="changeImage"
                    />
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn">{{ change_langue('Add','نشر') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["user_id",'langue'],
    data() {
        return {
            isloaded: false,
            questions: [],
            repond: {
                content: "",
                file: null,
                question_id: null,
                user_id: this.user_id,
            },
            question_form: {
                title: "",
                body: "",
                file: null,
                user_id: this.user_id,
            },
            afficheDisscusions: false,
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
        getImage(elem) {
            return "/images/" + elem;
        },
        arDir(elem) {
            return elem === "ar" ? "rtl" : "ltr";
        },
        marginLeft(elem) {
            return elem === "ar";
        },
        direction: function (elem) {
            if (elem === "ar" || elem === "fa") return "right";
            else return "left";
        },
        onChange(e) {
            this.repond.file = e.target.files[0];
        },
        changeImage(e) {
            this.question_form.file = e.target.files[0];
        },
        showQuestion: function (slug) {
            window.location.href = "/questions/" + slug;
        },
        deleteRepond(id) {
            axios
                .delete("/api/repond/" + id)
                .then((res) => {
                    this.$toastr.s(res.data.message);
                    this.getQuestions();
                })
                .catch((err) => console.log(err));
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
        getQuestions() {
            axios
                .get("/api/questions")
                .then((res) => {
                    this.questions = res.data;
                    this.isloaded=true;
                })
                .catch((err) => console.log(err));
        },
        addQuestion() {
            let data = new FormData();
            if (this.question_form.file) {
                data.append("file", this.question_form.file);
            }
            data.append("body", this.question_form.body);
            data.append("title", this.question_form.title);
            data.append("user_id", this.question_form.user_id);
            axios
                .post("/api/question", data)
                .then((res) => {
                    this.$toastr.s(res.data.message);
                    this.question_form.body = "";
                    this.question_form.title = "";
                    this.getQuestions();
                })
                .catch(function (err) {
                    console.log(err);
                });
        },
        formSubmit(id) {
            this.repond.question_id = id;
            let data = new FormData();
            data.append("file", this.repond.file);
            data.append("content", this.repond.content);
            data.append("user_id", this.repond.user_id);
            data.append("question_id", this.repond.question_id);
            axios
                .post("/api/repond", data)
                .then((res) => {
                    this.$toastr.s(res.data.message);
                    this.repond.content = "";
                    this.repond.file = "";
                    this.getQuestions();
                })
                .catch(function (err) {
                    console.log(err);
                });
        },
    },
    mounted() {
        this.getQuestions();
    },
};
</script>
