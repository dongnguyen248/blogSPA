<template>
  <div>
    <sidebar/>
    <navbar/>
    <router-view></router-view>

  </div>
</template>
<script>
import navbar from './navbar';
import sidebar from './sidebar';
export default {
  components:{
    navbar,
    sidebar
  }
}
</script>