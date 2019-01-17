import Vue from 'vue'
import moment from 'moment'
Vue.filter('timeFormat',(arg)=>{
    return moment(arg).format("Do MMM YYYY");
});

Vue.filter('sortlenght',function(text,length,suffix){
    return text.substring(0,length)+suffix
});
