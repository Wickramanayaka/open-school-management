<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
            <div class="panel-heading">
                User Role
            </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul v-for="item in role">
                                <li>{{item.name}} <a v-show="item.id!='1'" href="#" @click="deleteItem(item.id)"><i class="fa fa-trash"></i> Delete</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <form>
                                <div class="row">
                                    <div class="col-lg-10">
                                        <input class="form-control" v-model="this.name" type="text" id="name" placeholder="Role Name">
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
            axios.get('../role').then(response => this.role = response.data);

        },
        data(){
            return {
                role: {},
                name: ''
            }
        },
        methods:{
            create(){
                axios.post('../role',{
                    name: name,
                }).then(response => {
                    name = '';
                    axios.get('../role').then(response => this.role = response.data);
                });
                
            },
            onSubmit(){

            },
            deleteItem(id){
                var i = confirm("Confirm to delete?");
                if(i==true){
                    axios.delete('../role/' + id).then(response => {
                        axios.get('../role').then(response => this.role = response.data);
                    });
                }
            }
        },
    }
</script>
