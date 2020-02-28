new Vue({
    el: '.checkbox',
    data: {
        checked:false
    },
    methods:{
        close:function(){
            this.checked = true
        }
    }
})