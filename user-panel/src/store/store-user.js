const state={
  user:{},
  loggedIn:false,
  info:{},
};

const mutations={
  login(state,payload){
    state.loggedIn=true
    localStorage.setItem('token', payload["token"])
    state.user=payload
  }
}

const actions={
  login({commit}, payload) {
    commit('login', payload)
  },
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
