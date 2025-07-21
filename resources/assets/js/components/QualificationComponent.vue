<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media"  v-for="item in qualification">
                        <div class="media-left">
                            <a href="#">
                            <img width="60px;" class="media-object" :src="'../images/qualification.png'" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h5 class="media-heading">{{item.description}}</h5>
                            <small><a href="#" @click="deleteItem(item.id)">Delete</a></small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <form>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <input class="form-control" v-model="this.description" type="text" id="description" placeholder="Qualification Description">
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
            axios.get('../qualification/teacher/' + this.teacherId).then(response => this.qualification = response.data);

        },
        data(){
            return {
                qualification: {},
                description: ''
            }
        },
        methods:{
            create(){
                axios.post('../qualification',{
                    teacher_id: this.teacherId,
                    description: description,
                }).then(response => {
                    description = '';
                    axios.get('../qualification/teacher/' + this.teacherId).then(response => this.qualification = response.data);
                });
                
            },
            onSubmit(){

            },
            deleteItem(id){
                var i = confirm("Confirm to delete?");
                if(i==true){
                    axios.delete('../qualification/' + id).then(response => {
                        axios.get('../qualification/teacher/' + this.teacherId).then(response => this.qualification = response.data);
                    });
                }
            }
        },
        props: ['teacherId'] 
            
        
    }
</script>
