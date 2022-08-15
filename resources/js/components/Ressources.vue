<template>
    <div class="row">
        <div class="col-lg-8">
            <div class="row mx-auto">
                <!-- start loading -->
                <div v-if="!isloaded" class="row mx-auto">
                    <div class="col-lg-3 shadow p-3 m-3 placeholder-glow">
                        <span class="placeholder col-8 my-2"></span>
                        <p class="d-flex justify-content-between">
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-2 bg-primary" ></span>
                            <span class="placeholder col-2 bg-danger"></span>
                        </p>
                    </div>
                    <div class="col-lg-3 shadow p-3 m-3 placeholder-glow">
                        <span class="placeholder col-8 my-2"></span>
                        <p class="d-flex justify-content-between">
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-2 bg-primary" ></span>
                            <span class="placeholder col-2 bg-danger"></span>
                        </p>
                    </div>
                    <div class="col-lg-3 shadow p-3 m-3 placeholder-glow">
                        <span class="placeholder col-8 my-2"></span>
                        <p class="d-flex justify-content-between">
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-2 bg-primary" ></span>
                            <span class="placeholder col-2 bg-danger"></span>
                        </p>
                    </div>
                    <div class="col-lg-3 shadow p-3 m-3 placeholder-glow">
                        <span class="placeholder col-8 my-2"></span>
                        <p class="d-flex justify-content-between">
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-2 bg-primary" ></span>
                            <span class="placeholder col-2 bg-danger"></span>
                        </p>
                    </div>
                    <div class="col-lg-3 shadow p-3 m-3 placeholder-glow">
                        <span class="placeholder col-8 my-2"></span>
                        <p class="d-flex justify-content-between">
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-2 bg-primary" ></span>
                            <span class="placeholder col-2 bg-danger"></span>
                        </p>
                    </div>
                    <div class="col-lg-3 shadow p-3 m-3 placeholder-glow">
                        <span class="placeholder col-8 my-2"></span>
                        <p class="d-flex justify-content-between">
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-2 bg-primary" ></span>
                            <span class="placeholder col-2 bg-danger"></span>
                        </p>
                    </div>
                    <div class="col-lg-3 shadow p-3 m-3 placeholder-glow">
                        <span class="placeholder col-8 my-2"></span>
                        <p class="d-flex justify-content-between">
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-2 bg-primary" ></span>
                            <span class="placeholder col-2 bg-danger"></span>
                        </p>
                    </div>
                    <div class="col-lg-3 shadow p-3 m-3 placeholder-glow">
                        <span class="placeholder col-8 my-2"></span>
                        <p class="d-flex justify-content-between">
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-2 bg-primary" ></span>
                            <span class="placeholder col-2 bg-danger"></span>
                        </p>
                    </div>
                    <div class="col-lg-3 shadow p-3 m-3 placeholder-glow">
                        <span class="placeholder col-8 my-2"></span>
                        <p class="d-flex justify-content-between">
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-2 bg-primary" ></span>
                            <span class="placeholder col-2 bg-danger"></span>
                        </p>
                    </div>
                    <div class="col-lg-3 shadow p-3 m-3 placeholder-glow">
                        <span class="placeholder col-8 my-2"></span>
                        <p class="d-flex justify-content-between">
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-2 bg-primary" ></span>
                            <span class="placeholder col-2 bg-danger"></span>
                        </p>
                    </div>
                    <div class="col-lg-3 shadow p-3 m-3 placeholder-glow">
                        <span class="placeholder col-8 my-2"></span>
                        <p class="d-flex justify-content-between">
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-2 bg-primary" ></span>
                            <span class="placeholder col-2 bg-danger"></span>
                        </p>
                    </div>
                    <div class="col-lg-3 shadow p-3 m-3 placeholder-glow">
                        <span class="placeholder col-8 my-2"></span>
                        <p class="d-flex justify-content-between">
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-2 bg-primary" ></span>
                            <span class="placeholder col-2 bg-danger"></span>
                        </p>
                    </div>
                </div>
                <div class="col-lg-3" v-else v-for="item in data" :key="item.id">
                    <h1>{{ item.name }}</h1>
                    <ul>
                        <li v-for="source_item in item.sources" :key="source_item.id">
                            <a v-if="source_item.lien_site" :href="source_item.lien_site" target="_blank">{{
                                    source_item.title
                            }}
                            </a>
                            <a v-else="source_item.lien_youtub" :href="source_item.lien_youtub" target="_blank">{{
                                    source_item.title
                            }}
                            </a>
                            <a v-if="source_item.lien_site" class="mx-3" :href="source_item.lien_site" target="_blank">
                                <i class="fas fa-globe"></i>
                            </a>
                            <a v-if="source_item.lien_youtub" :href="source_item.lien_youtub" target="_blank">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4" id="sidebar" :style="{ direction: formDir() }">
            <div class="addPost">
                <div v-if="validation" class="alert alert-danger my-2">
                    {{ validation }}
                </div>
                <input type="text" v-model="source.title" class="form-control"  :placeholder="change_langue('Name *','اسم المجموعة')" required />
                <textarea v-model="source.lien1" :placeholder="change_langue('Lien 1','رابط الموقع')" id="body"
                    class="form-control"></textarea>
                <textarea v-model="source.lien2" :placeholder="change_langue('Lien 2','رابط اخر')" id="body"
                    class="form-control"></textarea>
                <div class="mb-3">
                    <label class="form-controll" for="type0">select ressource</label>
                    <select class="form-select" v-model="source.ressource_id">
                        <option :value="0">{{change_langue('Select Collection',"اختر المجموعة")}}</option>
                        <option v-for="ressource in ressources" :key="ressource.id" :value="ressource.id">
                            {{ ressource.name }}
                        </option>
                    </select>
                </div>
                <input type="text" v-if="source.ressource_id==0" v-model="source.ressource_name" class="form-control" :placeholder="change_langue('New Collection','اضافة مجموعة جدبدة')"
                    required />
                <div class="d-grid gap-2">
                    <button class="btn" @click="addSource">{{ change_langue('Add','اضافة') }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['user_id','langue'],
    data() {
        return {
            isloaded: false,
            validation: "",
            source: {
                title: "",
                lien1: "",
                lien2: "",
                ressource_id: 0,
                user_id: this.user_id,
                ressource_name: "",
            },
            ressources: [],
            data: [],
        };
    },
    methods: {
        change_langue(an,ar){
            return this.langue=='ar'? ar : an;
        },
        formDir: function () {
            return this.langue === "ar" ? "rtl" : "ltr";
        },
        addSource() {
            console.log(this.source);
            if (this.source.title == "")
                this.validation = "title of source must be no empty !!";
            else if (this.source.lien1 == "" && this.source.lien2 == "")
                this.validation = "as least one lien must be no empty !!";
            else if (
                this.source.ressource_id === 0 &&
                this.source.ressource_name === ""
            )
                this.validation = "ressource must be not empty !!";
            else {
                console.log(this.source);
                axios
                    .post("/api/source", this.source)
                    .then((res) => {
                        this.$toastr.s(res.data.message);
                        this.getSources();
                        this.getRessources();
                        this.source.title = "";
                        this.source.lien1 = "";
                        this.source.lien2 = "";
                        this.source.ressource_id = 0;
                        this.source.ressource_name = "";
                    })
                    .catch((err) => console.log(err));
            }
        },
        getRessources() {
            axios
                .get("/api/ressources")
                .then((res) => {
                    this.ressources = res.data;
                })
                .catch((err) => console.log(err));
        },
        getSources() {
            axios
                .get("/api/sources")
                .then((res) => {
                    this.data = res.data;
                    this.isloaded=true;
                    // console.log(this.data);
                })
                .catch((err) => console.log(err));
        },
    },
    mounted() {
        this.getRessources();
        this.getSources();
    },
};
</script>
