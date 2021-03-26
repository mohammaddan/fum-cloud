<template>
<div class="q-mx-auto q-pa-md" style="max-width: 600px">
  <q-card class="bg-white q-mb-md">
    <q-card-section class="bg-dark text-white text-subtitle1">
      مشخصات کاربری
    </q-card-section>
    <q-card-section class="">
      <q-input class="full-width q-mb-md" dense outlined v-model="name" label="نام و نام خانوادگی"/>
      <q-input class="full-width" dense outlined v-model="tell" label="شماره تلفن"/>
    </q-card-section>
    <q-card-section>
      <q-btn label="ذخیره تغییرات" color="primary" class="full-width" @click="save"/>
    </q-card-section>
  </q-card>

  <q-card class="bg-white q-mb-md">
    <q-card-section class="bg-red text-white text-subtitle1">
      لیست علاقه مندی ها
    </q-card-section>
    <q-card-section class="row q-pa-md ">
      <div v-for="(doctor,index) in doctors" :key="index"
           class="col-6 q-pa-sm">
        <doctor-card :doctor="doctor" :is-add="false" @remove="get_fav"/>
      </div>
    </q-card-section>
  </q-card>
</div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import axios from "axios";

export default {
  name: "Profile",
  data(){
    return{
      name:'',
      tell:'',
      doctors:[],
    }
  },
  components:{
    'doctor-card':()=>import('src/components/doctor-card')
  },
  computed:{
    ...mapGetters('user',['info','user','loggedIn']),
  },
  mounted() {
    this.name=this.info?.name
    this.tell=this.info?.tell
    this.get_fav()
  },
  methods:{
    ...mapActions('user',['updateInfo']),
    get_fav(){
      this.doctors=[]
      axios.get(process.env.USER_API+'/favorite',{
        headers:{token:localStorage.getItem('token')}
      }).then(res=>{
        this.doctors=res.data
      })
    },
    save(){
      axios.put(process.env.USER_API+'/info/'+this.user.id,{
        name:this.name,
        tell:this.tell
      },{headers:{token:localStorage.getItem('token')}}).then(res=>{
        this.updateInfo(res.data)
      })
    }
  },
  watch:{
    loggedIn(){
      this.name=this.info?.name
      this.tell=this.info?.tell
    }
  }
}
</script>

<style scoped>

</style>
