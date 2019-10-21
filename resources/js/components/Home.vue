
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <!-- <div class="card-header">Home Component</div> -->

                    <div class="card-body">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col"> name</th>
                        <th scope="col">email</th>
                        <th scope="col">phone</th>
                        <th scope="col">detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="employee in employees" :key="employee.id" >
                        <th scope="row"> {{ employee.name }}</th>
                        <td> {{ employee.email }}</td>
                        <td>{{ employee.phone }}</td>

                        <td>  <a href="#" @click="openDetailModal(employee)">
                             full detail
                        </a></td>
                        </tr>
                    </tbody>
                    </table>
                   </div>

                </div>
            </div>
        </div>

    <!-- modal -->
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#farmModal">
  Launch demo modal
</button> -->


<div class="modal fade" id="farmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <img :src = " this.path + detail.id_image" id="profile" class="img-rounded" alt="picture" />
          <p>address : {{ detail.first_name }}</p> <br>
          <p> last name : {{ detail.surname }}</p> <br>
          <p>address : {{ detail.address }}</p>: <br>


      </div>
      <div class="modal-footer">
        <button type="button" @click="closeModal()" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



    </div>





</template>



<script>
    export default {

        
        mounted() {
            console.log('Home Component mounted.')
            this.getEmployes();
        },


        beforeCreate(){
            // alert('this is before creation');
        },
        data(){
            return{

                employees:{},

            }

        },

        methods:{
            getEmployes(){
                axios.get('api/employee')
				.then(response => {

                    console.log("response"+response.data.data)
                    //  console.log("url"+response.data.data.imageBaseUrl)


				});
            },
        },
        computed: {


        },
        watch:{

        },



    }
</script>
