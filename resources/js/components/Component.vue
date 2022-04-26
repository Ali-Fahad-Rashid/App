<template>
    <div class="container"><br><br>
<br><br>

        <div class="row justify-content-center">
   <h4 class="text-danger text-center glow" >Recipe Box</h4>

        </div>
<br><br>


<select class="form-select" multiple aria-label="multiple select example"
 v-model="selected" @change="doSomethingWithChangedValue(selected)">
    <option v-for="item in items" :value="item.id" :key="item.id">  
     {{ item.username }}
    </option>
  </select>
  <br>
<button  @click="$bvModal.show('bv-modal-example')" type="button" class="btn btn-outline-info">Add<i class="bi bi-plus-square"></i></button>

<br><br>


   <h4 class="text-danger text-center glow " >Details</h4>
<br><br>


        <div class="row justify-content-center">
<br><br>
<div class="card text-center">
  <div class="card-header">
   {{ fff.username }}  </div>
  <div class="card-body">
    <h5 class="card-title"> {{ fff.type }}</h5>
    <pre class="card-text">  {{ fff.details }}</pre>
  </div>
  <div class="card-footer text-muted">
<button  @click="$bvModal.show('bv-modal-example2'),editpost()" type="button" class="btn btn-outline-warning">Edit</button>
<button @click="deletePost(fff.id)" type="button" class="btn btn-outline-danger">Delete</button>  </div>
</div>






<!-- insert  -->
<div>

  <b-modal id="bv-modal-example" hide-footer>
    <template #modal-title>
   Add a Recipe

    </template>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Recipe
</label>
  <input required v-model="NewPost.a" type="" class="form-control" id="exampleFormControlInput1" placeholder="">
</div>


<div class="mb-3">
  <label for="exampleFormControlInput2" class="form-label">Ingredients</label>
  <input  required v-model="NewPost.b" type="" class="form-control" id="exampleFormControlInput2" placeholder="">
</div>

<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Directions
</label>
  <textarea  required v-model="NewPost.c" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>



        <button @click="add()" v-b-modal.modal-1 type="button" class="btn btn-outline-info">Add</button>
    <b-button class="btn btn-outline-info" block @click="$bvModal.hide('bv-modal-example')">Close</b-button>
  </b-modal>
</div>

<!-- update  -->
<div>

  <b-modal id="bv-modal-example2" hide-footer>
    <template #modal-title>
   Edit a Recipe

    </template>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Recipe
</label>
  <input required v-model="EditPost.d" type="" class="form-control" id="exampleFormControlInput1" placeholder="">
</div>


<div class="mb-3">
  <label for="exampleFormControlInput2" class="form-label">Ingredients</label>
  <input required  v-model="EditPost.e" type="" class="form-control" id="exampleFormControlInput2" placeholder="">
</div>

<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Directions
</label>
  <textarea required v-model="EditPost.f" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>



<button @click="update(fff.id)" type="button" class="btn btn-outline-warning">Edit</button>
    <b-button class="btn btn-outline-info" block @click="$bvModal.hide('bv-modal-example2')">Close</b-button>
  </b-modal>
</div>



        </div>

    </div>
</template>



<script>
export default {
  data() {
    return {

              NewPost: {

a:'',
b:'',
c:'',
              },
                          EditPost: {

d:'',
e:'',
f:'',
              },

    selected: [],
    fff:[],
      items: [],


    };
  },
  created() {
    this.fetchArticles();
  },

  
  methods: {

          editpost() {

             

      this.EditPost.d = this.fff.username;
      this.EditPost.e = this.fff.type;
      this.EditPost.f = this.fff.details;
    },


    fetchArticles(page_url) {
      let vm = this;
      page_url = page_url || 'http://localhost/App/public/api/post';
      fetch(page_url)
        .then(res => res.json())
        .then(res => {
          this.items = res.data;

   this.fff.username= this.items[0].username ;
       this.fff.type=this.items[0].type ;
        this.fff.details=this.items[0].details; 

        
        })
        .catch(err => console.log(err));
    },


    doSomethingWithChangedValue(ss){
              let vm = this;

vm.items.forEach((value, index) => {
if(ss[0]==value.id){

    vm.fff=value;
    console.log(value);
    console.log(index);
}
});

/* console.log(ss[0]);
for(var i=0; vm.items.length;i++){
    var x =vm.items[i].username;
if(ss[0]==x){
    vm.fff=vm.items[i];


}} */

    },



    deletePost(id) {
      if (confirm('Are You Sure?')) {
        fetch(`http://localhost/App/public/api/post/${id}`, {
          method: 'delete'
        })
          .then(data => {
                       //   this.fff="";

            this.fetchArticles();



  //         this.fff.username= this.items[0].username ;
//this.fff.type=this.items[0].type ;
    //    this.fff.details=this.items[0].details;


          })
          .catch(err => console.log(err));
      }
    },
    add() {
        // Add
        fetch('http://localhost/App/public/api/post', {
          method: 'post',
          body: JSON.stringify(this.NewPost),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(data => {
            this.fetchArticles();
                                  this.fff.username= this.NewPost.a ;
       this.fff.type=this.NewPost.b ;
        this.fff.details=this.NewPost.c;
                        this.$bvModal.hide('bv-modal-example');
                                    this.clearForm();


          })
          .catch(err => console.log(err));
     
    
      
    },

    update(id){

            // Update
        fetch(`http://localhost/App/public/api/update/${id}`, {
          method: 'put',
          body: JSON.stringify(this.EditPost,id),
          headers: {
            'content-type': 'application/json'
          }
        })
          .then(data => {
         //   this.clearForm();
         //   this.fetchArticles();
                                    this.$bvModal.hide('bv-modal-example2');

                 this.fff.username= this.EditPost.d ;
       this.fff.type=this.EditPost.e ;
        this.fff.details=this.EditPost.f;



          })
          .catch(err => console.log(err));

    },

    clearForm() {
      this.NewPost.a = '';
      this.NewPost.b = '';
      this.NewPost.c = '';
    }
  }
};
</script>


<style >
.glow {
  font-size: 40px;
  color: #fff;
  text-align: center;
  -webkit-animation: glow 1s ease-in-out infinite alternate;
  -moz-animation: glow 1s ease-in-out infinite alternate;
  animation: glow 1s ease-in-out infinite alternate;
}

@-webkit-keyframes glow {
  from {
    text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #e60073, 0 0 40px #e60073, 0 0 50px #e60073, 0 0 60px #e60073, 0 0 70px #e60073;
  }
  to {
    text-shadow: 0 0 20px #fff, 0 0 30px #ff4da6, 0 0 40px #ff4da6, 0 0 50px #ff4da6, 0 0 60px #ff4da6, 0 0 70px #ff4da6, 0 0 80px #ff4da6;
  }
}
</style>