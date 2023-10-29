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
        url: prefix + 'user.php?id_user=' + idVal,  
        type: 'GET', 
        dataType: "json",
        success: function (data) {
            //console.log(data);
            document.getElementById("name").innerHTML = "<strong>Nom:</strong>"+data["NAME"];
            document.getElementById("taille").innerHTML = "<strong>Taille:</strong>"+data["TAILLE"]+" cm";
            document.getElementById("poids").innerHTML = "<strong>Poids:</strong>"+data["POIDS"]+" kg";
            document.getElementById("age").innerHTML = "<strong>Age:</strong>"+data["AGE"]+ " ans";
            document.getElementById("sexe").innerHTML = "<strong>Sexe:</strong>"+data["SEXE"];
            document.getElementById("activité").innerHTML = "<strong>Activité:</strong>"+data["nom_activite"];
            //return(Array(data["NAME"]),data["TAILLE"],data["POIDS"],data["AGE"],data["SEXE"]);
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log("erreur",status,error);
        }
    });
    
}

function activateEditUser(idVal){
    event.preventDefault();
    $.ajax({
        url: prefix + 'user.php?id_user=' + idVal,  
        type: 'GET', 
        dataType: "json",
        success: function (data) {
            console.log(data);
            document.getElementById("name").innerHTML = '<strong>Nom:</strong><input type="text" id="slot_name" name="name" value="'+data["NAME"]+'">';
            document.getElementById("taille").innerHTML = '<strong>Taille:</strong><input type="number" id="slot_taille" name="taille" value="'+data["TAILLE"]+'">cm';
            document.getElementById("poids").innerHTML = '<strong>Poids:</strong><input type="number" id="slot_poids" name="poids" value="'+data["POIDS"]+'">kg';
            document.getElementById("age").innerHTML = '<strong>Age:</strong><input type="number" id="slot_age" name="age" value="'+data["AGE"]+'">ans';
            document.getElementById("activité").innerHTML ='<strong>Activité:</strong><select name="slot_activite" id="slot_activite"><option value="1">Pas ou peu d\'exercice</option><option value="2">1 à 3 fois par semaine</option><option value="3">3 à 5 fois par semaine</option><option value="4">Plus de 5 fois par semaine</option></select>';
            document.getElementById("buttonWrapper").innerHTML='<input type="submit" value="Valider" onclick="sendEditUser('+idVal+')";>'
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log("erreur",status,error);
        }
    });
    
}

function getAlimentsAjax(){
    let aliments = new Array();
    $.ajax({
        url: prefix+'aliments.php',  
        type: 'GET',
        success: function (data) {
            //console.log(data);
            data.forEach(function (aliment){
                aliments.push(aliment);
                //return users;
                
                //$("#studentsTableBody").append(`<tr><td>${user.id}</td><td id="user">${user.name}</td><td id="email">${user.email}</td><td><button onclick="editData(this)">Edit</button><button onclick="delete_row(this)">Delete</button></td><td></td></tr>`)
            });
            console.log(aliments[0]);
            defTable(aliments);
            

        },
        error: function (xhr, status, error) {
            // Handle errors here
        }
    });
};

function defTableAliments(){
    $('#AlimentsTable').DataTable({
        ajax: {
        url: prefix+'aliments.php', 
        dataSrc: ''
        },
        responsive: true,
        columns: [
            {data:'NOM_ALIMENT'},
            {data:'ENERGIE'},
            {data:'LIPIDES'},
            {data:'GLUCIDES'},
            {data:'SUCRE'},
            {data:'FIBRES'},
            {data:'PROTEINES'},
            {data:'SEL'},
            {
            data: null,
            render: function(data, type, row) {
                return '<button onclick="editData(' + data.id + ')">Edit</button>' +
                       '<button id=delRow onclick="delAjax(' + data.id + ');delRow(this)">Delete</button>';
            }
            }   
        ]
    });
}

function sendEditUser(idVal){
    event.preventDefault();
    var name = $('#slot_name').val();
    var taille = $('#slot_taille').val();
    var poids = $('#slot_poids').val();
    var age = $('#slot_age').val();
    var id_activite = $('#slot_activite').val();

    var data = {
        id_user: idVal,
        name: name,
        taille: taille,
        poids: poids,
        age: age,
        id_activite: id_activite
    };
    //console.log(data);
     $.ajax({
        url: prefix+ 'user.php',
        type: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function(response) {
            dispUser(idVal);
            document.getElementById("buttonWrapper").innerHTML='<input type="submit" value="Modifier" onclick="activateEditUser('+idVal+')";>'
            console.log(response);
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('Request failed with status: ' + xhr.status);
        }
    }); 
}

function defTableRepas(){
    
    $('#RepassTable').DataTable({
        ajax: {
        url: prefix+'aliments_repas.php', 
        dataSrc: ''
        },
        responsive: true,
        columns: [
            {data:'NOM_ALIMENT'},
            {data:'ENERGIE'},
            {data:'LIPIDES'},
            {data:'GLUCIDES'},
            {data:'SUCRE'},
            {data:'FIBRES'},
            {data:'PROTEINES'},
            {data:'SEL'},
            {
            data: null,
            render: function(data, type, row) {
                return '<button onclick="editData(' + data.id + ')">Edit</button>' +
                       '<button id=delRow onclick="delAjax(' + data.id + ');delRow(this)">Delete</button>';
            }
            }   
        ]
    });
}

function getRepasAjax(idUser,idRepas){
    //var formData= {id: idVal};
    //var jsonData = JSON.stringify(formData);
        $.ajax({
            url: prefix + 'repas.php?id_repas=' + idRepas+'&id_user='+idUser,  
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


