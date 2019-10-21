<template>
    <div class="container">
                <h1> ADD EMPLOYEE </h1>

                         <button class="btn btn-primary float-right" > VIEW EMPLOYEES </button>

                        <form>

                        <div class="form-group">
                        <label for="exampleInputEmail1">name </label>
                        <input v-model="list.name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">  </small>
                        </div>

                        <div class="form-group">
                        <label for="exampleInputEmail1">email </label>
                        <input v-model="list.email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">.</small>
                        </div>

                        <div class="form-group">
                        <label for="exampleInputPassword1">Phone</label>
                        <input v-model="list.phone" type="text" class="form-control" id="exampleInputPassword1" placeholder="Phone">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input  id="photo"  @change="updatePicture" ref="file" type="file" class="form-control-file" aria-describedby="fileHelp">
                        </div>

                        <div class="form-group">
                        <label for="exampleSelect1"> Company </label>
                        <select v-model="list.company_id" class="form-control" id="exampleSelect1">

                            <option v-for="company in companies" :key="company.id" :value="company.id" >{{ company.name }}</option>

                        </select>
                        </div>


                        <button @click.prevent="save" type="submit" class="btn btn-primary">Submit</button>
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
                         <button class="btn btn-primary pull-right" > VIEW EMPLOYEES </button>


                    </form>
                       <br> <br> <br> <br>
                    <ShowEmployee :employees= "allEmployees" >  </ShowEmployee>

    </div>
</template>


<script>


     import ShowEmployee from './ShowEmployee.vue'

    export default {
        components:{ ShowEmployee },

        mounted() {
            console.log('Home Component mounted.')
            this.getCompany();
            this.getEmployees();
        },
        beforeCreate(){
            // alert('this is before creation');
        },

        data(){

      return{
          list:{
          name:'',
          email:'',
          phone:'',
          company_id: '',
          photo:'',
        },
        companies:{},

        errors:{},

        allEmployees: {},
    }
  },

        methods:{

    save(){
        // let formData = new formData();
        // formData = this.$data.list;
        // formData

        axios.post('/api/employee',this.$data.list)
        .then(({data}) => {
                    //this.users = response.data
                    // console.log(data)

                    this.$data.list = {};

                    alert('data saved');
                    this.allEmployees.unshift(data);

                })
                .catch((error)=> {
                    console.log(error);
                })
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

            getEmployees(){
            axios.get('/api/employee')
            .then( ({data}) => {
                this.allEmployees = data ;

            }).catch((error) => {


            });
        },

            // updatePicture(){
            //     this.list.photo  = this.$refs.file.files[0];

            // },



            updatePicture(e){

                let file = e.target.files[0];
                //console.log(file);
                let reader = new FileReader();
                if(file['size'] < 2111775 ){

                reader.onloadend = (file) => {
                //console.log('RESULT', reader.result)
                this.list.photo = reader.result;
                }
                //console.log(reader.readAsDataURL(file));
                reader.readAsDataURL(file);

                }else {
                    alert('file too big');
                }

            },





        },
        computed: {


        },

        computed: {


        },
        watch:{

        },



    }
</script>
