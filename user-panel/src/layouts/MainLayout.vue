<template>
  <q-layout view="lHh Lpr lFf" class="bg-grey-2">
    <q-header >
      <q-toolbar>
        <q-btn flat dense round
          icon="menu" aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"/>

        <q-toolbar-title shrink>
          پزشک یاب
        </q-toolbar-title>
        <div class="relative-position">
        <q-input v-model="src" dense rounded outlined @input="searchDoctor">
          <template v-slot:prepend>
            <q-icon name="search" />
          </template>
        </q-input>
          <q-list v-if="src.length>2 && doctors.length" class="absolute-top q-mt-xl bg-grey-2 text-black">
            <q-item v-for="(doctor,index) in doctors" :key="index">
              {{doctor.name +' '+doctor.license+' ' +doctor.spec}}
            </q-item>
          </q-list>
        </div>
        <q-space/>
        <div class="q-mr-lg">
          <q-btn flat v-if="loggedIn" :label="info.name || user.username" icon="assignment_ind" to="/profile"/>
          <q-btn v-else label="ثبت نام/ورود" color="secondary" unelevated @click="loginDialogModal=true"/>
        </div>
      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above bordered
      content-class="bg-grey-1">
      <q-list>
        <q-img src="images/treatment.png" contain/>
        <q-item-label header class="text-subtitle1 text-bold text-grey-8">
          پنل بیماران
        </q-item-label>
        <q-item clickable to="/doctors">
          مشاهده لیست پزشکان
        </q-item>
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>

    <q-dialog v-model="loginDialogModal">
      <login-signup @close="loginDialogModal=false"/>
    </q-dialog>
  </q-layout>
</template>

<script>
import {mapActions, mapGetters} from 'vuex'
import axios from "axios";

export default {
  name: 'MainLayout',
  data () {
    return {
      loginDialogModal:false,
      leftDrawerOpen: false,
      src:'',
      doctors:[],
    }
  },
  components:{
    'login-signup': ()=> import('src/components/login-signup'),
  },
  computed:{
    ...mapGetters('user',['loggedIn','user','info'])
  },
  mounted() {
    if(localStorage.getItem('token')){
      axios.get(process.env.AUTH_API+'/check',{headers:{
          token:localStorage.getItem('token')
        }
      }).then(res=>{
        if(!res.data.hasOwnProperty('token')) return
        axios.get(process.env.USER_API+'/me',{headers:{'token':res.data.token}}).then(res2=>{
          this.login({
            user:res.data,
            info:res2.data
          })
        })
        console.log('%cLogged in','style:font-weight:bold;color:green')
      }).catch(()=>{})
    }
  },
  methods:{
    ...mapActions('user',['login']),
    searchDoctor(){
      if(this.src.length<3) return
      axios.get(process.env.DOCTOR_API+'/doctors?src='+this.src).then(res=>{
        this.doctors=res.data
      })
    }
  }
}
</script>
