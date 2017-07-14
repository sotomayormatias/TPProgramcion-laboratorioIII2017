var MAIN = (function (DATA) {

    var lib = {};

    /*
    realizar las operaciones usando los metosos map,  reduce y filter y combinaciones entre ellos
    */

    // Retornar una array de strings (el nombre de los usarios de sexo femenino)
    lib.femaleUsers = function () {
        return DATA
        .filter(function (user) {
            return user.gender === 'female';
        })
        .map(function (user) {
            return user.name;
        });
    };

    //   console.log(lib.femaleUsers());

    // Retornar una array de strings (el email de los usarios de sexo masculino)
    lib.maleUsersEmails = function () {
        return DATA
        .filter(function(user){
            return user.gender === 'male';
        })
        .map(function(user){
            return user.email;
        });
    };

    //   console.log(lib.maleUsersEmails());

    // Retornar un array de objetos que solo contengan las claves name, email y age, de todos los usuarios mayores que 'age'
    lib.userOlderThan = function (age) {
        return DATA
        .filter(function(user){
            return user.age > age;
        })
        .map(function(user){
            var mapedUser = {};
            mapedUser.name = user.name;
            mapedUser.email = user.email;
            mapedUser.age = user.age;

            return mapedUser;
        });
    };

    //   console.log(lib.userOlderThan(33));

    // Retornar un objeto que contenga solo el nombre y la edad (name y age) del usuario mas grande.
    lib.olderUser = function () {
        var masGrande = DATA
        .reduce(function(prev, actual, index, array){
            if(prev.age > actual.age){
                return prev;
            }
            else{
                return actual;
            };
        });

        return DATA
        .filter(function(user){
            return user.age === masGrande.age;
        })
        .map(function(user){
            var mapedUserDos = {};
            mapedUserDos.name = user.name;
            mapedUserDos.age = user.age;

            return mapedUserDos;
        })
        ;
    };

      console.log(lib.olderUser());

    // Retornar el promedio de edad de los usuarios (number)
    lib.userAgeAverage = function () {
        var result = DATA
        .map(function(user){
            return user.age;
        })
        .reduce(function(prev, actual, index, array){
            return prev + actual;
        });
        return result / DATA.length;
    };

    // console.log(lib.userAgeAverage());

    // Retornar el promedio de edad de los usuarios hombres (number)
    lib.userMaleAgeAverage = function (age) {
        var result = DATA
        .filter(function(user){
            return user.gender === "male";
        })
        .map(function(user){
            return user.age;
        })
        .reduce(function(prev,actual,index,array){
            return prev + actual;
        });

        var cantHombres = DATA
        .filter(function(user){
            return user.gender === "male";
        });

        return result / cantHombres.length;
    };

    // console.log(lib.userMaleAgeAverage());

    // Retornar el promedio de edad de los usuarios mujeres (number)
    lib.userFemaleAgeAverage = function (age) {
        var result = DATA
        .filter(function(user){
            return user.gender === "female";
        })
        .map(function(user){
            return user.age;
        })
        .reduce(function(prev,actual,index,array){
            return prev + actual;
        });

        var cantHombres = DATA
        .filter(function(user){
            return user.gender === "female";
        });

        return result / cantHombres.length;
    };

    // console.log(lib.userFemaleAgeAverage());

    // Retornar un objeto  de etiquetas (tags)
    // cada property del objeto es el nombre de una etiqueta
    // y el value es la cantidad de usuarios que tienene esa etiqueta
    lib.tagCloud = function (age) {
        //NO LO ENTIENDO
    };

    // console.log(lib.tagCloud());

    return lib;

})(DATA);
