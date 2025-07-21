<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media"  v-for="item in experience">
                        <div class="media-left">
                            <a href="#">
                            <img width="60px;" class="media-object" :src="'../images/experience.png'" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading">{{item.subject}} - {{item.grade}} ({{item.type}})</h5>
                            <small><a href="#" @click="deleteItem(item.id)">Delete</a></small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-inline">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <input class="form-control" v-model="this.subject" type="text" id="subject" placeholder="Experience Subject">
                                        <input class="form-control" v-model="this.grade" type="text" id="grade" placeholder="Experience Grade">
                                        <select class="form-control" v-model="this.type" type="text" id="type">
                                            <option value="Main">Main</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <input type="hidden" name="id" value="">
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="btn btn-primary" @click.prevent="create">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
            axios.get('../experience/teacher/' + this.teacherId).then(response => this.experience = response.data);

        },
        data(){
            return {
                experience: {},
                subject: '',
                grade: '',
                type: ''
            }
        },
        methods:{
            create(){
                axios.post('../experience',{
                    teacher_id: this.teacherId,
                    subject: subject,
                    grade: grade,
                    type: type
                }).then(response => {
                    subject = '';
                    grade = '';
                    type = '';
                    axios.get('../experience/teacher/' + this.teacherId).then(response => this.experience = response.data);
                });
                
            },
            onSubmit(){

            },
            deleteItem(id){
                var i = confirm("Confirm to delete?");
                if(i==true){
                    axios.delete('../experience/' + id).then(response => {
                        axios.get('../experience/teacher/' + this.teacherId).then(response => this.experience = response.data);
                    });
                }
            }
        },
        props: ['teacherId'] 
            
        
    }
</script>
