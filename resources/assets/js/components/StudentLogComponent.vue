<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    

                    <div class="media"  v-for="item in log">
                        <div class="media-left">
                            <a href="#">
                            <img width="60px;" class="media-object" :src="'../images/log.png'" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <p><span style="margin-right:15px; color:#2579A9; font-weight:700;">{{item.created_by.name}}</span><small>{{item.date}}</small><br>
                            <b>{{item.remark}}</b><br>
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
                                    <div class="col-lg-7">
                                        <input class="form-control" v-model="this.remark" type="text" id="remark" placeholder="Remark">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="form-control" v-model="this.date" type="text" id="datepicker" placeholder="Date">
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
            var vm = this;
            $('#datepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            });
            console.log('Component mounted.');
            axios.get('../studentlog/student/' + this.studentId).then(response => this.log = response.data);

        },
        data(){
            return {
                log: {},
                remark: '',
                date: '',
            }
        },
        methods:{
            create(){
                axios.post('../studentlog',{
                    student_id: this.studentId,
                    remark: remark,
                    date: $('#datepicker').val(),
                }).then(response => {
                    remark = '';
                    date = '';
                    axios.get('../studentlog/student/' + this.studentId).then(response => this.log = response.data);
                });
                
            },
            onSubmit(){

            },
            deleteItem(id){
                var i = confirm("Confirm to delete?");
                if(i==true){
                    axios.delete('../studentlog/' + id).then(response => {
                        axios.get('../studentlog/student/' + this.studentId).then(response => this.log = response.data);
                    });
                }
            }
        },
        props: ['studentId'] 
            
        
    }
</script>
