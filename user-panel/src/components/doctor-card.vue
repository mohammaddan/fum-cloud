<template>
  <q-card class="bg-white" bordered>
    <q-card-section class="text-subtitle2 text-bold">
      {{doctor.name}}
      <q-btn v-if="loggedIn && isAdd" class="absolute-top-right" dense
             flat icon="favorite_border" color="red" @click="addToFavorite(doctor['user_id'])"/>
      <q-btn v-else-if="loggedIn && !isAdd" class="absolute-top-right" dense
             flat icon="clear" color="negative" @click="removeFromFavorite(doctor['user_id'])"/>
    </q-card-section>
    <q-card-section class="q-pt-xs text-caption">
      <div>
        <span class="text-bold">تخصص</span> {{doctor.spec}}
      </div>
      <div>
        <span class="text-bold">مدرک</span> {{doctor.license}}
      </div>
      <div>
        <span class="text-bold">تلفن</span> {{doctor.tell}}
      </div>
      <div>
        <span class="text-bold">آدرس</span> {{doctor.address}}
      </div>
    </q-card-section>
  </q-card>
</template>

<script>
import axios from "axios";
import {mapGetters} from "vuex";

export default {
  name: "doctor-card",
  props:['doctor','isAdd'],
  data(){
    return{

    }
  },
  computed:{
    ...mapGetters('user',['info','user','loggedIn']),
  },
  methods:{
    addToFavorite(doctor_id){
      axios.post(process.env.USER_API+'/favorite',{
        user_id: this.user.id,
        doctor_id :doctor_id
      },{headers:{
          token:localStorage.getItem('token')
        }}).then(res=>{
        this.$q.notify({message:res.data.message})
      })
    },
    removeFromFavorite(doctor_id){
      axios.delete(process.env.USER_API+'/favorite/'+doctor_id,{headers:{
          token:localStorage.getItem('token')
        }}).then(res=>{
          this.$emit('remove')
        // this.$q.notify({message:res.data.message})
      })
    },
  }
}
</script>

<style scoped>

</style>
