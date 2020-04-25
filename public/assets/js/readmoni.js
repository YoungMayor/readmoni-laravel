function ReadMONI(){
    this.toDOMElement = function(exp){
        var wrapper = document.createElement('div');
        $(wrapper).html(exp);
        return wrapper.firstChild;
    }
}

let RM = new ReadMONI;

axios.defaults.headers.common['X-CSRF-Token'] = $("meta[name='csrf-token']").attr("content");

// axios.interceptors.response.use(function(response){
//     return response;
// }, function(error){
//     console.log(error.response)
//     console.log(error.toJSON());
//     return Promise.reject(error);
// });
