<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media"  v-for="item in duties">
                        <div class="media-left">
                            <a href="#">
                            <img width="60px;" class="media-object" :src="'../images/duty.png'" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <p><span style="margin-right:15px; color:#2579A9; font-weight:700;">{{item.created_by.name}}</span><small>{{item.date}}</small><br>
                            <b>{{item.duty}}</b><br>
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
                                        <input class="form-control" v-model="this.duty" type="text" id="duty" placeholder="Duty">
                                    </div>
                                    <div class="col-lg-3">
                                        <input class="form-control" v-model="this.date" type="text" id="dutydatepicker" placeholder="Date">
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
            $('#dutydatepicker').datepicker({
                dateFormat: 'yy-mm-dd'
            });
            console.log('Component mounted.');
            axios.get('../studentduty/student/' + this.studentId).then(response => this.duties = response.data);

        },
        data(){
            return {
                duties: {},
                duty: '',
                date: '',
            }
        },
        methods:{
            create(){
                axios.post('../studentduty',{
                    student_id: this.studentId,
                    duty: duty,
                    date: $('#dutydatepicker').val(),
                }).then(response => {
                    remark = '';
                    date = '';
                    axios.get('../studentduty/student/' + this.studentId).then(response => this.duties = response.data);
                });
                
            },
            onSubmit(){

            },
            deleteItem(id){
                var i = confirm("Confirm to delete?");
                if(i==true){
                    axios.delete('../studentduty/' + id).then(response => {
                        axios.get('../studentduty/student/' + this.studentId).then(response => this.duties = response.data);
                    });
                }
            }
        },
        props: ['studentId'] 
            
        
    }
</script>
