<template>
<div class="q-mx-auto q-pa-md" style="max-width: 600px">
  <q-card class="bg-white">
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
      tell:''
    }
  },
  computed:{
    ...mapGetters('user',['info','user','loggedIn']),
  },
  mounted() {
    this.name=this.info?.name
    this.tell=this.info?.tell
  },
  methods:{
    ...mapActions('user',['updateInfo']),
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
