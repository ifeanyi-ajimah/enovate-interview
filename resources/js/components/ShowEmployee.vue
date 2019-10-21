<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <table class="table table-hover">
                            <thead>
                                    <tr>
                                    <th scope="col">No</th>
                                    <th scope="col"> Name</th>
                                    <th scope="col"> Email </th>
                                    <th scope="col"> Phone</th>
                                    <th scope="col"> View </th>
                                    <th scope="col"> Edit </th>
                                    <th scope="col"> Delete </th>
                                    </tr>
                            </thead>
                            <tbody>
                                    <tr v-for="employ in employees " :key="employ.id">
                                    <th scope="row">
                                    <img :src=" '/img/photos/' + employ.photo" class="rounded-circle" alt="picture" />  </th>
                                    <td>{{ employ.name }}</td>
                                    <td>{{ employ.email }}</td>
                                    <td>{{ employ.phone }}</td>
                                    <td> <a href="#" @click="viewDetail(employ)"> View</a></td>
                                    <td> <a href="#" @click="editEmployee(employ)"> Edit</a></td>
                                    <td> <a href="" @click.prevent="deleteEmployee(employ.id)"> Delete</a></td>
                                    </tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>

                <!-- modal -->
                                            <!-- Detail Modal -->
                            <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> Detail</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img :src=" '/img/photos/' + detail.photo" class="rounded-circle" alt="picture" />
                                    <p>NAME : {{ detail.name }}</p>
                                    <p>EMAIL : {{ detail.email }}</p>
                                    <p>PHONE : {{ detail.phone }}</p>
                                    <p> COMPANY NAME:  {{ detail.company }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" @click="closeDetailModal" data-dismiss="modal">Close</button>

                                </div>
                                </div>
                            </div>
                            </div>

                                               <!-- Edit Modal -->
                            <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form action="">
                                <div class="modal-body">

                                        <div class="form-group">
                                        <label for="exampleInputEmail1">NAME  </label>
                                        <input  type="email" v-model="editedEmployee.name"   class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                        <small id="emailHelp" class="form-text text-muted">.</small>
                                        </div>

                                        <div class="form-group">
                                        <label for="exampleInputEmail1">EMAIL  </label>
                                        <input  type="email" v-model="editedEmployee.email"   class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                        <small id="emailHelp" class="form-text text-muted">.</small>
                                        </div>

                                        <div class="form-group">
                                        <label for="exampleInputEmail1">PHONE </label>
                                        <input  type="email" v-model="editedEmployee.phone"   class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="">
                                        <small id="emailHelp" class="form-text text-muted">.</small>
                                        </div>

                                        <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <input  id="photo"  @change="editImage" ref="file" type="file" class="form-control-file" aria-describedby="fileHelp">
                                        </div>

                                        <div class="form-group">
                                        <label for="exampleSelect1"> Company </label>
                                        <select  class="form-control" id="exampleSelect1">
                                        <option v-for="company in companies" :key="company.id" :value="company.id" >{{ company.name }}</option>
                                        </select>
                                        </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" @click="closeEditMode" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" @click="updateEmployee(editedEmployee.id)" class="btn btn-primary">Save changes</button>
                                </div>
                                </form>
                                </div>

                            </div>
                            </div>


    </div>
</template>

<script>
    export default {

        props: ['employees'],

        mounted() {
            this.getCompany();
        },

        data(){
            return{
            detail : {},
            editedEmployee: {},
            path : '/img/photos/',
            companies : {},
            }
    },

    methods: {

        viewDetail(empl){
            $('#viewModal').modal('show');
            this.detail = empl
        },
        closeDetailModal(){
            this.detail = {},
            $('#viewModal').modal('hide');
        },
        editEmployee(edEmploy){

            $('#EditModal').modal('show');
            this.editedEmployee = edEmploy
        },

        closeEditMode(){
            this.editedEmployee = {},
            $('#EditModal').modal('hide');
        },

        getCompany(){
                axios.get('/api/company')
				.then(({data}) => {
                    console.log(data)
                    //  console.log("url"+response.data.data.imageBaseUrl)
                    this.companies = data
                })
                .catch((error)=> {
                    console.log(error.response.data.error)
                })
            },
            editImage(){

            },

            updateEmployee(toUpdate){

        axios.put(`/api/employee/${toUpdate}`,this.editedEmployee)
        .then(({data}) => {
                    //this.users = response.data
                    console.log(data)

                    this.$data.list = {};

                    alert('data saved');
                    this.allEmployees.unshift(data);

                })
                .catch((error)=> {
                    console.log(error);
                })
        },

        deleteEmployee(toDelete)
        {
            var result = confirm('Sure Want to delete?');
            if(result){
                console.log('yes')
                axios.delete('/api/employee/' + toDelete)
                .then( (response) => {
                   // getEmployee()
                    alert('deleted');
                }).catch((error) => {
                    console.log(error)
            })
            }else{
                console.log('noo');
            }
        },
        getEmployee()
        {
            axios.get('/api/employee')
				.then(({data}) => {
                    console.log(data)
                    //  console.log("url"+response.data.data.imageBaseUrl)
                    this.employees = data

                })
                .catch((error)=> {
                    console.log(error.response.data.error)
                })
        },




    }

    }
</script>
