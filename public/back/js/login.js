var app = new Vue ({
    el: '.auth-box-w',
    data: {
        email: {
            value: '',
            error:false,
        },
        password: {
            value: '',
            error:false,
        },
        error : false,
    },
    methods: {
        validateEmail: function (email) {
            let error;
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            if (re.test(email) ) {
                this.email.error = false;
                error = false
            } else {
                this.email.error = true;
                error = true
            }
            return error
        },
        validateForm: function (e){
            //Validate Email
            if(this.email.value == '' || this.email.value == null || this.validateEmail(this.email.value)){
                this.email.error = true
            } else {
                this.email.error = false
            }
            if(this.password.value == '' || this.password.value == null){
                this.password.error = true
            } else {
                this.password.error = false
            }
            if( this.email.error || this.password.error ){
                e.preventDefault();
                this.error = true;
            }
        },
    },
});