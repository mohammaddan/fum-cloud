<template>
  <q-layout view="lHh Lpr lFf">
    <q-header >
      <q-toolbar>
        <q-btn flat dense round
          icon="menu" aria-label="Menu"
          @click="leftDrawerOpen = !leftDrawerOpen"/>

        <q-toolbar-title shrink>
          پزشک یاب
        </q-toolbar-title>
        <q-input v-model="src" dense rounded outlined>
          <template v-slot:prepend>
            <q-icon name="search" />
          </template>
        </q-input>
        <q-space/>
        <div class="q-mr-lg">
          <q-btn label="ثبت نام/ورود" color="secondary" unelevated @click="loginDialogModal=true"/>
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
        <q-item clickable>
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


export default {
  name: 'MainLayout',
  data () {
    return {
      loginDialogModal:false,
      leftDrawerOpen: false,
      src:''
    }
  },
  components:{
    'login-signup': ()=> import('src/components/login-signup'),
  }
}
</script>
