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
                return '<button onclick="activateEditAliment(this,' + data.ID_ALIMENT + ')">Edit</button>' +
                       '<button id=delRow onclick="delAlimentAjax(' + data.ID_ALIMENT + ');delRow(this)">Delete</button>';
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
                return '<button onclick="editData(' + data.id_aliment + ')">Edit</button>' +
                       '<button id=delRow onclick="delAjax(' + data.id_aliment + ');delRow(this)">Delete</button>';
            }
            }   
        ]
    });
}


function delAlimentAjax(idVal){
    var data = {
        id_aliment:idVal
    };
    $.ajax({
        url: prefix + 'aliments.php',
        type: 'DELETE',
        dataType:"json",
        data: JSON.stringify(data),
        success: function(response) {
            console.log("Aliment supprimé")
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('Request failed with status: ' + xhr.status);
        }
    })
}

function delRow(button) {
    let row = button.parentNode.parentNode;
    row.remove();
    };

function activateEditAliment(button,idVal){
    let row = button.parentNode.parentNode;
    var cases = row.children;
    var lastCase = cases[cases.length-1];
    cases = Array.prototype.slice.call(cases, 1, -1); //elements html pour chaque nutriment
    var colonnes = ['energie', 'lipides', 'glucides', 'sucre', 'fibres', 'proteines', 'sel']; 
    var values = []; //valeur de chaque nutriment
    for (var i = 0; i < cases.length; i++) { //on récupère les valeurs de chaque nutriment
        var element = cases[i];
        var value = element.textContent; 
        values.push(value);
    }
    for (var i = 0; i < cases.length; i++) { //on met un champ de modification pré-rempli dans chaque case
        var element = cases[i];
        element.innerHTML= `<td><input type='number' value=${values[i]} class='form-control' id='edit${colonnes[i]}' ></td>`;
    }
    lastCase.innerHTML = `<td><button onclick="sendEditAlimentAjax(this,${idVal})">Valider</button><td>`
}

function sendEditAlimentAjax(button,idVal){
    let row = button.parentNode.parentNode;
    var cases = row.children;
    var lastCase = cases[cases.length-1];
    cases = Array.prototype.slice.call(cases, 1, -1); //elements html pour chaque nutriment
    var colonnes = ['energie', 'lipides', 'glucides', 'sucre', 'fibres', 'proteines', 'sel']; 
    var values = []; //valeur de chaque nutriment
    for (var i = 0; i < cases.length; i++) { //on récupère les valeurs dans les input fields
        var id = `edit${colonnes[i]}`;
        var inputField= document.getElementById(id);
        var value = inputField.value;
        values.push(value);    
    }
    values.push(idVal);
    colonnes.push("id_aliment");

    // Create a JSON object with keys from colonnes and values from values
    var dataObject = {};
    for (var i = 0; i < colonnes.length; i++) { //on crée le JSON a envoyer a l'endpoint
        dataObject[colonnes[i]] = values[i];
    }

    // Convert the JSON object to a JSON string
    var jsonData = JSON.stringify(dataObject);
    console.log("json object", jsonData);
    // Send the JSON data via AJAX
    $.ajax({
        url: prefix+'aliments.php', // Replace with your API endpoint URL
        type: 'PUT', // Use the appropriate HTTP method
        data: jsonData,
        contentType: 'application/json',
        success: function(response) {
            for (var i = 0; i < cases.length; i++) { //on remet le tableau a son état initial
                var element = cases[i];
                element.innerHTML= `<td>${values[i]}</td>`;
            }
            lastCase.innerHTML = '<button onclick="activateEditAliment(this,' + idVal + ')">Edit</button>' +
            '<button id=delRow onclick="delAlimentAjax(' + idVal + ');delRow(this)">Delete</button>'; //on remet les boutons initiaux
        },
        error: function(xhr, status, error) {
            console.log(status,error,xhr);
        }
    });

}

function getValuesJournalAjax(dateMin, dateMax){
    var nutriments = ['energie', 'lipides', 'glucides', 'sucre', 'fibres', 'proteines', 'sel'];
    let repas = [];
    $.ajax({
        url: prefix + 'journal.php?date_min=' + dateMin+'&date_max='+dateMax,  
        type: 'GET', 
        dataType: "json",
        success: function (data) {
            for(var i=0; i<data.length;i++){//on itère sur tous plats de chaque repas, jusqu'à
                //console.log(data[i]);
                let plat_n =data[i];
                let plat_n1= data[i+1];
                if(plat_n["date_repas"]==plat_n1["date_repas"] &&  plat_n["nom_type"]==plat_n1["nom_type"]){
                    for(nutriment in nutriments){
                        plat_n1[nutriment]=(plat_n1[nutriment]*plat_n1["quantite"]+plat_n[nutriment]*plat_n["quantite"])/100; //on calcule l'apport total de nutriment de chaque plat en fct de la quantité
                        
                    }
                }
                else{
                    for(nutriment in nutriments){
                        plat_n[nutriment]=plat_n[nutriment]*plat_n["quantite"]/100;
                        
                    }
                    repas.push(plat_n);
                }
                
            }
            //on a maintenant tous les repas (avec leur date et leur type) dans un array
            console.log(repas);
            //return repas;
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log("erreur",status,error);
        }
    });
}
