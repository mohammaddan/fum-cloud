<template>
<div class="row q-pa-md q-mx-auto" style="max-width: 1400px">
  <div class="q-pa-sm  col-12">
  <q-card class="bg-white">
    <q-card-section class="bg-dark text-white text-subtitle1">
      فیلتر
    </q-card-section>
    <q-card-section class="row q-gutter-md">
      <q-input v-model="name" dense outlined label="نام پزشک"/>
      <q-input v-model="spec" dense outlined label="تخصص"/>
      <q-input v-model="license" dense outlined label="مدرک"/>
      <q-select v-model="city" dense outlined label="شهر"
                use-input input-debounce="0"
                :options="cities" @filter="cityFilter"/>
      <q-btn color="primary" label="جستجو" @click="get_request"/>
    </q-card-section>
  </q-card>
  </div>
  <div v-for="(doctor,index) in doctors" :key="index"
       class="col-sm-6 col-md-4 col-lg-3 q-pa-sm">
    <doctor-card :doctor="doctor" :is-add="true"/>
<!--  <q-card class="bg-white" bordered>-->
<!--    <q-card-section class="text-subtitle2 text-bold">-->
<!--      {{doctor.name}}-->
<!--      <q-btn v-if="loggedIn" class="absolute-top-right"-->
<!--             flat icon="favorite_border" color="red" @click="addToFavorite(doctor['user_id'])"/>-->
<!--    </q-card-section>-->
<!--    <q-card-section class="q-pt-xs text-caption">-->
<!--      <div>-->
<!--        <span class="text-bold">تخصص</span> {{doctor.spec}}-->
<!--      </div>-->
<!--      <div>-->
<!--        <span class="text-bold">مدرک</span> {{doctor.license}}-->
<!--      </div>-->
<!--      <div>-->
<!--        <span class="text-bold">تلفن</span> {{doctor.tell}}-->
<!--      </div>-->
<!--      <div>-->
<!--        <span class="text-bold">آدرس</span> {{doctor.address}}-->
<!--      </div>-->
<!--    </q-card-section>-->
<!--  </q-card>-->
  </div>
</div>
</template>

<script>
import axios from "axios";
import {mapGetters} from "vuex";

export default {
name: "Doctors",
  data(){
    return{
      doctors:[],
      name:'',
      spec:'',
      license:'',
      city:'',
      cities:[],
    }
  },
  mounted() {
    this.get_request()
  },
  components:{
    'doctor-card':()=>import('src/components/doctor-card')
  },
  computed:{
    ...mapGetters('user',['loggedIn','user'])
  },
  methods:{
    get_request(){
      let params=[]
      if(this.name.trim()) params.push('name='+this.name)
      if(this.spec.trim()) params.push('spec='+this.spec)
      if(this.license.trim()) params.push('license='+this.license)
      if(this.city) params.push('city_id='+this.city.value)
      axios.get(process.env.DOCTOR_API+'/doctors?'+params.join('&')).then(res=>{
        this.doctors=res.data
      })
    },
    cityFilter(val, update){
      if (val === '') {
        update(() => {
          this.cities = []
        })
        return
      }
      update(() => {
        axios.get(process.env.USER_API+'/city?src='+val).then(res=>{
          this.cities=res.data.map(c=>{
            return{value:c.id,label:c.name}
          })
        })
      })
    }
  }
}
</script>

<style scoped>

</style>
