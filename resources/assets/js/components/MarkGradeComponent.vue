<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-2" v-for="item in mark_grade">
                            <div class="alert alert-warning">
                            Grade : {{item.grade}} <br> 
                            Low : {{item.low}} <br> 
                            High : {{item.high}} <br> 
                            <a href="#" @click="deleteItem(item.id)"><i class="fa fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <form class="form-inline">
                                
                                <input class="form-control" v-model="this.grade" type="text" id="description" placeholder="Grade">
                                <input class="form-control" v-model="this.low" type="text" id="description" placeholder="Low">
                                <input class="form-control" v-model="this.high" type="text" id="description" placeholder="High">
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
            axios.get('../markGrade').then(response => this.mark_grade = response.data);

        },
        data(){
            return {
                mark_grade: {},
                grade: '',
                low: '',
                high: ''
            }
        },
        methods:{
            create(){
                axios.post('../markGrade',{
                    grade: grade,
                    low: low,
                    high: high
                }).then(response => {
                    grade = '',
                    low = '',
                    high = ''
                    axios.get('../markGrade').then(response => this.mark_grade = response.data);
                });
                
            },
            onSubmit(){

            },
            deleteItem(id){
                var i = confirm("Confirm to delete?");
                if(i==true){
                    axios.delete('../markGrade/' + id).then(response => {
                        axios.get('../markGrade').then(response => this.mark_grade = response.data);
                    });
                }
            }
        },           
    }
</script>
