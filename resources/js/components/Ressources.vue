<template>
    <div class="row">
        <div class="col-lg-8">
            <div class="row mx-auto">
                <div class="col-lg-4" v-for="item in data" :key="item.id">
                        <h1>{{item.name}}</h1>
                        <ul>
                            <li v-for="source_item in item.sources" :key="source_item.id">
                                <a v-if="source_item.lien_site" :href="source_item.lien_site" target="_blank">{{ source_item.title }} </a>
                                <a v-else="source_item.lien_youtub" :href="source_item.lien_youtub" target="_blank">{{ source_item.title }} </a>
                                <a v-if="source_item.lien_site" :href="source_item.lien_site" target="_blank">
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
        <div class="col-lg-4" id="sidebar">
            <div class="addPost">
                <div v-if="validation" class="alert alert-danger my-2">
                    {{ validation }}
                </div>
                <input type="text" v-model="source.title" class="form-control" placeholder="Name *" required>
                <textarea v-model="source.lien1" placeholder="lien website ..." id="body" class="form-control"></textarea>
                <textarea v-model="source.lien2" placeholder="lien youtub or something ..." id="body" class="form-control"></textarea>
                <div class="mb-3">
                    <label class="form-controll" for="type0">select ressource</label>
                    <select class="form-select" :ref="source.ressource_id">
                        <option v-for="ressource in ressources" :key="ressource.id" :value="ressource.id">{{ ressource.name }}</option>
                    </select>
                </div>
                <input type="text" v-model="source.ressource_name"  class="form-control" placeholder="Nouveau ressource" required>
                <div class="d-grid gap-2">
                    <button class="btn " @click="addSource">Ajouter</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data(){
        return{
            validation:"",
            source:{
                title:'',
                lien1:"",
                lien2:"",
                ressource_id:0,
                ressource_name:'',
            },
            ressources:[],
            data:[],
        };
    },
    methods: {
        addSource(){
            if(this.source.title=='')
                this.validation="title of source must be no empty !!";
            else if(this.source.lien1=="" && this.source.lien2=="")
                this.validation="as least one lien must be no empty !!";
            else if( (this.source.ressource_id === 0) && this.source.ressource_name==="")
                this.validation="ressource must be not empty !!";
            else {
                console.log(this.source);
                axios.post('/api/source',this.source)
                .then((res) => {
                    this.$toastr.s(
                        res.data.message,
                    );
                    this.getSources();
                    this.getRessources();
                    this.source.title='';
                    this.source.lien1='';
                    this.source.lien2='';
                    this.source.ressource_id=0;
                    this.source.ressource_name='';
                })
                .catch(err=>console.log(err));
            }
        },
        getRessources(){
            axios.get('/api/ressources')
            .then((res) => {
                this.ressources=res.data;
            })
            .catch(err=>console.log(err));
        },
        getSources(){
            axios.get('/api/sources')
            .then((res) => {
                this.data=res.data;
                // console.log(this.data);
            })
            .catch(err=>console.log(err));
        },
    },
    mounted() {
        this.getRessources();
        this.getSources();
    },

}
</script>
