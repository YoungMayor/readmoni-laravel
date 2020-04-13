function ReadMONI(){
    this.toDOMElement = function(exp){
        var wrapper = document.createElement('div');
        wrapper.innerHTML = exp;
        return wrapper.firstChild;
    }
}

let RM = new ReadMONI;