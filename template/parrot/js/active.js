window.onload=function(){
    var Navid = document.getElementById(window.location.href.split('/').pop().split('.')[0]);
<<<<<<< HEAD

=======

>>>>>>> proges/master
    if(Navid){
        Navid.setAttribute('class','active');
        var father = Navid.parentNode,
            grandFather = father.parentNode;
        grandFather.setAttribute('class','active');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> proges/master
