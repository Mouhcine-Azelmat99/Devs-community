<template>
    <div class="row">
        <div class="col-lg-8 mx-auto" id="content">
            <div class="item">
                <div class="header" :style="{ direction: arDir(question.lg) }">
                    <h1>{{ question.title }}</h1>
                    <div>
                        <p class="poster">
                            {{ question.username }}
                        </p>
                        <p class="time">
                            <i class="fas fa-clock"></i>
                            {{ question.created_at | moment("from", "now") }}
                        </p>
                    </div>
                </div>
                <div class="body" :style="{ direction: arDir(question.lg) }">
                    <p>{{ question.body }}</p>
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
                        />
                    </div>
                </div>
                <div class="reponds">
                    <div class=head>
                        <h1>
                            {{change_langue("Discussion","دردشة")}}
                        </h1>
                            <span class="length"> {{ question.solutions.length }} </span>
                        <button @click="copy(question.slug)" class="copy_button">
                            <i class="fas fa-copy"></i>
                            <span> {{change_langue('copy','نسخ')}}</span>
                        </button>
                        </div>
                    <div class="form mb-4">
                        <form
                            v-on:submit.prevent="formSubmit"
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
                    <ul>
                        <li
                            v-for="discusion in question.solutions"
                            :key="discusion.id"
                            :style="{ 'text-align': direction(discusion.lg) }"
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
                       :placeholder="change_langue('Titre *','عنوان السؤال *')"
                        required
                    />
                    <textarea
                        name="body"
                        v-model="question_form.body"
                         :placeholder="change_langue('Content ...','محتوى السؤال ...')"
                        id="body"
                        class="form-control"
                    ></textarea>
                    <input
                        type="file"
                        class="form-control"
                        placeholder="Upload image"
                        @change="changeImage"
                    />
                    <div class="alert alert-info my-2">
                    {{ change_langue('* field is required','* لايجب ان تكون فارغة') }}
                    </div>
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
    props: ["user_id", "slug",'langue'],
    data() {
        return {
            question: {},
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
        };
    },
    methods: {
        async copy(slug) {
            try {
                await navigator.clipboard.writeText(window.location.href+"questions/" + slug);
                this.$toastr.s("the question is copied");
            } catch($e) {
                this.$toastr.s("cannot copie this question");
            }
        },
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
        deleteRepond(id) {
            axios
                .delete("/api/repond/" + id)
                .then((res) => {
                    this.$toastr.s(res.data.message);
                    this.getQuestion();
                })
                .catch((err) => console.log(err));
        },
        getQuestion() {
            axios
                .get("/api/question/" + this.slug)
                .then((res) => {
                    this.question = res.data;
                })
                .catch((err) => console.log(err));
        },
        formSubmit() {
            this.repond.question_id = this.question.id;
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
                    this.getQuestion();
                })
                .catch(function (err) {
                    console.log(err);
                });
        },
        addQuestion() {
            let data = new FormData();
            data.append("file", this.question_form.file);
            data.append("body", this.question_form.body);
            data.append("title", this.question_form.title);
            data.append("user_id", this.question_form.user_id);
            axios
                .post("/api/question", data)
                .then((res) => {
                    this.$toastr.s(res.data.message);
                    this.question_form.body = "";
                    this.question_form.title = "";
                    this.getQuestion();
                })
                .catch(function (err) {
                    console.log(err);
                });
        },
    },
    mounted() {
        this.getQuestion();
    },
};
</script>
