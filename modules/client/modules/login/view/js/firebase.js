function config(){
    var config = {
        apiKey: Apis.firebase_api,
        authDomain: "vicezon-fw-php.firebaseapp.com",
        databaseURL: "https://vicezon-fw-php.firebaseio.com",
        projectId: "vicezon-fw-php",
        storageBucket: "",
        messagingSenderId: Apis.firebase_id
      };
      firebase.initializeApp(config);
}

function google_login(){
    var provider = new firebase.auth.GoogleAuthProvider();
    provider.addScope('email');

    var authService = firebase.auth();
    
    $('#google_login').on('click', function(){
        authService.signInWithPopup(provider)
        .then(function(result) {
            var datos = result.user.providerData[0];
            $.ajax({
                type: 'POST', 
                url: pretty("?module=login&function=social_login"),
                async:false, 
                data : {datos: datos},
                success: function (data) { 
                    localStorage.setItem('id_token',data);
                    toastr.success("Login con exito","Done");
                    setTimeout(' window.location.href = pretty("?module=home");',1000);
                },
                error: function(){
                    toastr.error("Fallo","Fail");
                    setTimeout(' window.location.href = pretty("?module=login");',1000);
                }
            });
        })
        .catch(function(error) {
            console.log('Se ha encontrado un error:', error);
        });
    })
}

function github_login(){
    var provider = new firebase.auth.GithubAuthProvider();
    var authService = firebase.auth();
    $('#github_login').on('click', function(){
        authService.signInWithPopup(provider)
        .then(function(result) {
            var datos = result.user.providerData[0];
            $.ajax({
                type: 'POST', 
                url: pretty("?module=login&function=social_login"),
                async:false, 
                data : {datos: datos},
                success: function (data) { 
                    localStorage.setItem('id_token',data);
                    toastr.success("Login con exito","Done");
                    setTimeout(' window.location.href = pretty("?module=home");',1000);
                },
                error: function(){
                    toastr.error("Fallo","Fail");
                    setTimeout(' window.location.href = pretty("?module=login");',1000);
                }
            });
        })
        .catch(function(error) {
            console.log('Se ha encontrado un error:', error);
        });
    })
}
function check_auth_state(){
    firebase.auth().onAuthStateChanged(function(user) {
        if (user) { //loggeado
            return true;

        }else{ //not logged
            return false;
        }
    });
}
$(document).ready(function(){
    config();
    google_login();
    github_login();
    check_auth_state();
});