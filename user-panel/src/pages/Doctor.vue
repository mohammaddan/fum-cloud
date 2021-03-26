<template>
<div class="q-mx-auto q-pa-md" style="max-width: 1200px">
  <q-card class="bg-white" bordered>
    <q-card-section class="text-subtitle2 text-bold">
      دکتر {{doctor.name}}
    </q-card-section>
    <q-card-section class="q-pt-xs text-caption row q-gutter-lg">
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
    <q-card-section>
      <q-list class="text-black">
        <div class="text-subtitle2 text-bold">{{new Date().toLocaleDateString('fa-ir')}}</div>

        <q-item v-for="(weekDay,index) in Object.keys(this.workTimes)" :key="index">
          {{dayByNum(weekDay)}}
          <q-chip v-for="(workTime,index) in workTimes[weekDay]" :key="index" @click="getVisitTime(workTime)"
                  text-color="white" icon="bookmarks" color="blue" clickable>
            {{workTime.hour}} - {{workTime.hour+1}}
          </q-chip>
        </q-item>
      </q-list>
    </q-card-section>
    <q-separator size="2"/>
    <q-card-section>
      <div class="text-subtitle2 text-bold">نظرات برای این دکتر</div>
      <q-list>
        <q-item v-for="comment in comments" :key="comment.id">
          {{comment.comment}}
        </q-item>
      </q-list>
      <q-input dense outlined label="نظرتان را درباره این دکتر ثبت کنید" type="textarea" v-model="comment"/>
      <q-btn label="ثبت نظر" class="q-mt-md" color="positive" @click="addComment"/>
    </q-card-section>
  </q-card>
</div>
</template>

<script>
import axios from "axios";
import {mapGetters} from "vuex";

export default {
  name: "Doctor",
  data(){
    return{
      doctor:{},
      workTimes:{},
      comment:'',
      comments:[],
    }
  },
  computed:{
    ...mapGetters('user',['user']),
  },
  mounted() {
    axios.get(process.env.DOCTOR_API+'/doctor/'+this.$route.params.doctorId,{
      headers:{token:localStorage.getItem('token')}
    }).then(res=>{
      let dayOfWeek=(new Date()).getDay()+1
      this.doctor=res.data
      this.doctor["work_times"].forEach(w=>{
        let dw=w["week_day"]-dayOfWeek+7
        if(!this.workTimes.hasOwnProperty(dw)){
          this.workTimes[dw]=[]
        }
        this.workTimes[dw].push({hour:w.hour,capacity:w.capacity,id:w.id,weekDay:w['week_day']})
      })
      this.getComments()
    })
  },
  methods:{
    dayByNum(num){
      num=parseInt(num)%7
      switch (num){
        case 0:return 'شنبه';
        case 1:return 'یکشنبه';
        case 2:return 'دوشنبه';
        case 3:return 'سه شنبه';
        case 4:return 'چهارشنبه';
        case 5:return 'پنجشنبه';
        case 6:return 'جمعه';
      }
    },
    getVisitTime(workTime){
      axios.post(process.env.DOCTOR_API+'/visitTime',{
        doctor_id:this.doctor.id,
        user_id:this.user.id,
        work_time_id:workTime.id,
        plusDay:workTime.weekDay,
        hour:workTime.hour
      },{
        headers:{
        token:localStorage.getItem('token')}
      }).then(res=>{
        let message='زملن ویزیت برای شما در مورخه '+(new Date(res.data.visit_date).toLocaleDateString('fa-ir'))
              +' در ساعت '+res.data.hour+' صادر گردید.';
        this.$q.notify({message:message,color:'positive',position:"center"})
      })
    },
    getComments(){
      axios.get(process.env.USER_API+'/'+this.doctor.id+'/comment',{
        headers:{token:localStorage.getItem('token')}
      }).then(res=>{
        this.comments=res.data
      })
    },
    addComment(){
      if(this.comment.trim()==='') return
      axios.post(process.env.USER_API+'/comment',{
        doctor_id:this.doctor.id,
        comment:this.comment
      },{
        headers:{token:localStorage.getItem('token')}
      }).then(res=>{
        this.getComments()
      })
    }
  }
}
</script>

<style scoped>

</style>
