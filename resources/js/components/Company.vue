<template>
    <div class="container">

                <h1> Add company </h1>
                    <form>
                    <fieldset>

                        <div class="form-group">
                        <label for="exampleInputEmail1">name</label>
                        <input v-model="list.name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter name">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>

                        <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <input  v-model="list.address" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter adress">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                      </fieldset>


                        <button @click.prevent="save" type="submit" class="btn btn-primary">Submit</button>
                        <br>
                        <br>

                    </form>

                <div class="jumbotron col-md-8 offset-2 ">
                    <h2> Companies  </h2>
                    <ul v-for=" company in companyList" :key="company.id">
                        <li> {{ company.name }} - {{ company.address }} </li>

                    </ul>
                </div>


    </div>
</template>

<script>
    export default {
        mounted() {
            this.getCompanies();

        },
        beforeCreate(){
            // alert('this is before creation');
        },


  data(){

      return{

          list:{
          name:'',
          address:'',
        },
        companyList : {},


        errors:{},
    }
  },

    methods:{
    save(){
        axios.post('/api/company',this.$data.list)
        .then((response) => {
                    alert('company listed');
                    console.log(response.data.name)
                    this.$data.list = {} //to clear the company field
                    this.companyList.unshift(response.data);
                }).catch( (error) => {
                    console.log(error);
                    //console.log(error.response.data.error)
                })
        },

        getCompanies(){
            axios.get('/api/company')
            .then( ({data}) => {
                this.companyList = data ;

            }).catch((error) => {
                this.errors = error;
                console.log('no no');
            });
        },
        },
        computed: {


        },
        watch:{

        },



    }
</script>
<style >

</style>

