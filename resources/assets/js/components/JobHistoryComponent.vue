<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media"  v-for="item in jobhistory">
                        <div class="media-left">
                            <a href="#">
                            <img width="60px;" class="media-object" :src="'../images/job.png'" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading"><b>{{item.title}}</b></h5>
                            <p>{{item.company}} for {{item.duration}}</br>
                            <small><a href="#" @click="deleteItem(item.id)">Delete</a></small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-inline">
                                
                                <input class="form-control" v-model="this.title" type="text" id="description" placeholder="Title">
                                <input class="form-control" v-model="this.company" type="text" id="description" placeholder="Company">
                                <input class="form-control" v-model="this.duration" type="text" id="description" placeholder="Duration">
                                <button class="btn btn-primary" @click.prevent="create">Create</button>
                                
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
            axios.get('../jobHistory/teacher/' + this.teacherId).then(response => this.jobhistory = response.data);

        },
        data(){
            return {
                jobhistory: {},
                title: '',
                company: '',
                duration: ''
            }
        },
        methods:{
            create(){
                axios.post('../jobHistory',{
                    teacher_id: this.teacherId,
                    title: title,
                    company: company,
                    duration: duration
                }).then(response => {
                    title = '',
                    company = '',
                    duration = ''
                    axios.get('../jobHistory/teacher/' + this.teacherId).then(response => this.jobhistory = response.data);
                }).catch(function(error){
                    alert('Error occured, invalid input.');
                });
                
            },
            onSubmit(){

            },
            deleteItem(id){
                var i = confirm("Confirm to delete?");
                if(i==true){
                    axios.delete('../jobHistory/' + id).then(response => {
                        axios.get('../jobHistory/teacher/' + this.teacherId).then(response => this.jobhistory = response.data);
                    });
                }
            }
        },
        props: ['teacherId'] 
            
        
    }
</script>
