function ReadMONI(){
    this.toDOMElement = function(exp){
        var wrapper = document.createElement('div');
        $(wrapper).html(exp);
        return wrapper.firstChild;
    }
}

let RM = new ReadMONI;