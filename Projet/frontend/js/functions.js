function getUserAjax(idVal){
    //var formData= {id: idVal};
    //var jsonData = JSON.stringify(formData);
        $.ajax({
            url: prefix + 'user.php?id=' + idVal,  
            type: 'GET', 
            dataType: "json",
            success: function (data) {
                console.log(data);
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.log("erreur",status,error);
            }
        });
    };

function dispUser(idVal){
    $.ajax({
        url: prefix + 'user.php?id=' + idVal,  
        type: 'GET', 
        dataType: "json",
        success: function (user) {
            console.log(user);
            document.getElementById("name").innerHTML = "<strong>Nom:</strong>"+user["name"];
            document.getElementById("taille").innerHTML = "<strong>Taille:</strong>"+user["taille"]+" cm";
            document.getElementById("poids").innerHTML = "<strong>Poids:</strong>"+user["poids"]+" kg";
            document.getElementById("age").innerHTML = "<strong>Age:</strong>"+user["age"]+ " ans";
            document.getElementById("sexe").innerHTML = "<strong>Sexe:</strong>"+user["sexe"];
            return(Array(user["name"]),user["taille"],user["poids"],user["age"],user);
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log("erreur",status,error);
        }
    });
    
}

function activateEdit(){
    document.getElementById("name").innerHTML = "<strong>Nom:</strong><input type=text value ='"+name+"'>";
    document.getElementById("taille").innerHTML = "<strong>Taille:</strong><input type=number value ='"+taille+"'>";
    document.getElementById("poids").innerHTML = "<strong>Poids:</strong><input type=number value ='"+poids+"'>";
    document.getElementById("age").innerHTML = "<strong>Age:</strong><input type=text value ='"+name+"'>";
    document.getElementById("sexe").innerHTML = "<strong>Sexe:</strong>"+user["sexe"];
}