const state={
  user:{},
  loggedIn:false,
  info:{},
};

const mutations={
  login(state,payload){
    state.loggedIn=true
    localStorage.setItem('token', payload.user.token)
    state.user=payload.user
    state.info=payload.info
  },
  updateInfo(state,info){
    state.info=info
  }
}

const actions={
  login({commit}, payload) {
    commit('login', payload)
  },
  updateInfo({commit},info){
    commit('updateInfo', info)
  }
}

const getters={
  loggedIn: ()=> state.loggedIn,
  user: ()=> state.user,
  info: ()=> state.info,
}

export default {
  namespaced:true,
  state,
  getters,
  actions,
  mutations
}
