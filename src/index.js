import Vue from 'vue'
import hello from './hello.vue'

new Vue({
  el: '#app',
  mounted : function(){
    console.log('Hello Webpack and Vue !');  
  },
  components: { hello },
  template: '<hello/>'
});