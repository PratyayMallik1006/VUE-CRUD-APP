var app = new Vue({
    el:'#app',
    data: {
        errorMsg: "",
        successMsg: "",
        showAddModal: false,
        showEditModal: false,
        showDeleteModal: false,
        users:[],
        newUser:{name:"",email:"",phone:""},
        currentUser:{}
    },
    mounted: function(){
        this.getAllUsers();
    },
    methods:{
        getAllUsers(){
            axios.get("http://localhost/vue-curd/process.php?action=read").then(function(response){
                if(response.data.error){
                    app.errorMsg=response.data.message;
                }
                else{
                    app.users=response.data.users;
                }
            });
        },
        addUser(){
            var formData = app.toFormData(app.newUser);
            axios.post("http://localhost/vue-curd/process.php?action=create", formData).then(function(response){
                app.newUser={name:"",email:"",phone:""};
                if(response.data.error){
                    app.errorMsg=response.data.message;
                }
                else{
                    app.successMsg=response.data.message;
                    app.getAllUsers();
                }
            });
        },
        updateUser(){
            var formData = app.toFormData(app.newUser);
            axios.post("http://localhost/vue-curd/process.php?action=update", formData).then(function(response){
                app.newUser={name:"",email:"",phone:""};
                if(response.data.error){
                    app.errorMsg=response.data.message;
                }
                else{
                    app.successMsg=response.data.message;
                    app.getAllUsers();
                }
            });
        },
        toFormData(obj){
            var fd = new FormData();
            for(var i in obj){
                fd.append(i,obj[i]);
            }
            return fd;
        },
    }
});