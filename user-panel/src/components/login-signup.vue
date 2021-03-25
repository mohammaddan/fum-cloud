<template>
<div style="min-width: 400px">
  <q-card v-if="loginForm">
    <q-card-section class="bg-dark text-white flex justify-between q-py-sm">
      <div class="text-subtitle1">ورود به اکانت کاربری</div>
      <q-btn dense flat icon="close" @click="$emit('close')"/>
    </q-card-section>
    <q-card-section class="q-gutter-md q-mt-sm">
      <q-input v-model="username" label="نام کاربری" dense outlined/>
      <q-input v-model="password" label="رمزعبور" type="password" dense outlined/>
    </q-card-section>
    <q-card-section class="q-pt-xs">
      <q-btn flat label="هنوز ثبت نام نکرده اید؟" @click="loginForm=false" color="positive"/>
    </q-card-section>
    <q-card-section class="q-pt-xs flex justify-around">
      <q-btn label="ورود" color="secondary" @click="requestLogin" class="full-width"/>
    </q-card-section>
  </q-card>
  <q-card v-else>
    <q-card-section class="bg-dark text-white flex justify-between q-py-sm">
      <div class="text-subtitle1">ثبت نام</div>
      <q-btn dense flat icon="close" @click="$emit('close')"/>
    </q-card-section>
    <q-card-section class="q-gutter-md q-mt-sm">
      <q-input v-model="username" label="نام کاربری" dense outlined/>
      <q-input v-model="password" label="رمزعبور" type="password" dense outlined/>
    </q-card-section>
    <q-card-section class="q-pt-xs">
      <q-btn flat label="قبلا ثبت نام کرده اید؟" @click="loginForm=true" color="negative"/>
    </q-card-section>
    <q-card-section class="q-pt-xs flex justify-around">
      <q-btn label="ثبت نام" color="primary" @click="requestLogin" class="full-width"/>
    </q-card-section>
  </q-card>
</div>
</template>

<script>
import axios from "axios";
import {mapActions} from 'vuex'

export default {
  name: "login-signup",
  data(){
    return{
      username: '',
      password: '',
      loginForm:true,
    }
  },
  methods:{
    ...mapActions('user',['login']),
    requestLogin(){
      axios.post(process.env.AUTH_API+'/login',{
        username:this.username,
        password:this.password,
        role:'user'
      }).then(res=>{
        if(!res.data.hasOwnProperty('token')){
          this.$q.notify({message:'نام کاربری ویا رمز عبور اشتباه است'})
          return
        }
        this.$emit('close')
        axios.get(process.env.USER_API+'/me',{headers:{'token':res.data.token}}).then(res2=>{
          this.login({
            user:res.data,
            info:res2.data,
          })
        })
        console.log('%cLogged in','style:font-weight:bold;color:green')
      })
    }
  }
}
</script>

<style scoped>

</style>
