<template>
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ログイン</div>

                <div class="card-body">
                    
                     <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                        <div class="col-md-6">
                            <input 
                                id="email" 
                                type="email" 
                                v-bind:class="{'is-invalid' : error.email}"
                                class="form-control" 
                                name="email" 
                                v-model="email" 
                                required autocomplete="email" autofocus
                                >

                            <span class="invalid-feedback" role="alert" v-if="error.email">
                                <strong>{{ error.message }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>

                            <div class="col-md-6">
                            <input 
                                id="password" 
                                type="password" 
                                class="form-control" 
                                v-bind:class="{ 'is-invalid' : error.password }" 
                                name="password" 
                                required autocomplete="current-password"
                                v-model="password">

                            <span class="invalid-feedback" role="alert" v-if="error.password">
                                    <strong>{{ error.message }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" v-model="isRemember">

                                <label class="form-check-label" for="remember">
                                        ログインを保持する
                                </label>
                            </div>
                        </div>
                    </div>
                     <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" @click="login()">
                                    ログイン
                                </button>

                                <!--
                                <router-link to="/reset_password" class="btn btn-link">パスワードリセット</router-link>
                                -->   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import axios from 'axios';

export default {
   
    data: function(){
        return {
            email: '',
            password: '',
            isRemember: true,
            error: {}
            
        }
    },

    methods: {
        login: function(){
            let self = this;
            console.log(axios.defaults.baseURL);
            console.log("email:" + this.email);
            console.log("passowrd:" + this.password);
            let params = new URLSearchParams();
            params.append("email", this.email)
            params.append("password", this.password);
            axios.post("/login", params)
                .then((res)=>{
                    console.log(res);
                    self.$store.dispatch("loadUser");
                    self.$store.commit("needLogin", false);
                    this.$router.replace("/");
                }).catch((error)=>{
                    //self.error = self.error.response.data;
                    if(error.response.data){
                        //console.log("login error" + JSON.stringify(error));
                        console.log("errors:" + JSON.stringify(error.response.data));
                        let e = error.response.data;
                        
                        let obj = {
                            message: e.message
                        };
                        if(e.errors.email){
                            obj.email = e.errors.email[0];
                        }
                        if(e.errors.password){
                            obj.password = e.errors.password[0];
                        }

                        self.error = obj;
                    }
                    

                })
            
        }
    }
}
</script>