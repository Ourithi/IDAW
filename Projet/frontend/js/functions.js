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

function getValuesJournalAjax(dateMin, dateMax,id_user){
    var nutriments = ['energie', 'lipides', 'glucides', 'sucre', 'fibres', 'proteines', 'sel'];
    let repas = [];
    $.ajax({
        url: prefix + 'journal.php?date_min=' + dateMin+'&date_max='+dateMax+'&id_user='+id_user,  
        type: 'GET', 
        dataType: "json",
        success: function (data) {
            for(var i=0; i<data.length-1;i++){//on itère sur tous plats de chaque repas, jusqu'à
                //console.log(data[i]);
                let plat_n =data[i];
                //console.log(plat_n);
                //console.log(plat_n["date_repas"]);
                let plat_n1= data[i+1];
                if(plat_n["date_repas"]==plat_n1["date_repas"] &&  plat_n["nom_type"]==plat_n1["nom_type"]){
                    let k =0;
                    while(k<nutriments.length){
                        //console.log(nutriments[i],":",plat_n1[nutriments[i]]);
                        plat_n[nutriments[k]]=(plat_n1[nutriments[k]]*plat_n1["quantite"]+plat_n[nutriments[k]]*plat_n["quantite"])/100; //on calcule l'apport total de nutriment de chaque plat en fct de la quantité
                        k++;
                        
                    }
                    i++;
                }
                else{
                    let k =0;
                    while(k<nutriments.length){
                        //console.log(nutriments[i],":",plat_n1[nutriments[i]]);
                        plat_n[nutriments[k]]=plat_n[nutriments[k]]*plat_n["quantite"]/100; //on calcule l'apport total de nutriment de chaque plat en fct de la quantité
                        k++;
                    }
                    
                }
                delete plat_n["nom_aliment"];
                delete plat_n["quantité"];
                repas.push(plat_n);
                
            }
            //on a maintenant tous les repas (avec leur date et leur type) dans un array
            //console.log(repas);
            defTableJournal(repas);
            return repas;
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log("erreur",status,error);
        }
    });
}

function defTableJournal(repas){
    
    $('#JournalTable').DataTable().clear().destroy();
    $('#JournalTable').DataTable({
        
        responsive: true,
        data: repas,
        dataSrc:'',
        columns: [
            {data:'date_repas'},
            {data:'nom_type'},
            {data:'energie'},
            {data:'lipides'},
            {data:'glucides'},
            {data:'sucre'},
            {data:'fibres'},
            {data:'proteines'},
            {data:'sel'},
            {
            data: null,
            render: function(data, type, row) {
                return '<button onclick="">Voir le repas</button>'
            }
            }   
        ]
    });
}

function login(){
    event.preventDefault();
    var pwd = document.getElementById("password").value;
    var name = document.getElementById("username").value;
    console.log(pwd,name);
    $.ajax({
        url: prefix + 'login.php?name='+name+'&pwd='+pwd,
        type: 'GET', 
        dataType: "json",
        success(user){
            console.log(user);
            $.ajax({
                url: prefixFront+"session.php",
                type: "POST",
                dataType: "json",
                data: user,
                success(response){
                    console.log("session créée");
                    window.location.href = "./profile.php";
                },
                error: function(xhr,status,error){
                    console.log("erreur lors de la création de la session",status,error);
                }
            });
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log("erreur",status,error,xhr);
        }

    });
}

function updateJournal(id_user){
    event.preventDefault();
    var dateMin= document.getElementById("dateMin").value;
    var dateMax= document.getElementById("dateMax").value;
    getValuesJournalAjax(dateMin,dateMax,id_user);
}

function addAlimentInput(){
    event.preventDefault();
    var form= document.getElementById("meal-form");
    var nutriments = ['energie', 'lipides', 'glucides', 'sucre', 'fibres', 'proteines', 'sel','quantite'];
    $("#meal-form").append('<div class="form-group"><label for="nomAliment">Nom de l\'aliment:</label><input type="test" id="nomAliment" name="nom de l\'aliment" required></div>');
    for(var i = 0;i<nutriments.length;i++){
        var htmlString ='<div class="form-group"><label for="'+nutriments[i]+'Repas">'+nutriments[i]+':</label><input type="number" id="'+nutriments[i]+'Repas" name="'+nutriments[i]+'Repas" required></div>';
        $("#meal-form").append(htmlString);
    };
    $("#meal-form").append('<br><br>');
    var hasAliment = document.getElementById("hasAliment").value;
    console.log(hasAliment);
    if(hasAliment ==0){
        console.log("if");
        document.getElementById("hasAliment").value= 1;
        $(".buttonWrapper").append('<button onclick="sendNewRepasAjax(id_user);">Valider</button>');
    }
}

function sendNewRepasAjax(id_user){
    var champs = ['nomAliment','energieRepas', 'lipidesRepas', 'glucidesRepas', 'sucreRepas', 'fibresRepas', 'proteinesRepas', 'selRepas','quantiteRepas'];
    // Get all input elements with the id "sel"
    var values_aliments = [];
    var dateRepas = document.getElementById("dateRepas").value;
    var typeRepas = document.getElementById("typeRepas").value;
    for(var i =0; i<champs.length;i++){ //on crée une liste par champs avec les valeurs pour chaque aliment dedans
        var inputElements = document.querySelectorAll('#'+champs[i]);

        // Create an array to store the values
        var values = [];

        // Loop through the input elements and get their values
        inputElements.forEach(function(input) {
            values.push(input.value);
        });
        values_aliments.push(values);
    }
    console.log("values_aliments: "+values_aliments);
    var dataRepas = {
        date:dateRepas,
        id_user: id_user,
        id_type: typeRepas
    };
    jsonDataRepas=JSON.stringify(dataRepas)

    $.ajax({ //on commence par créer le repas et récupérer l'id
        url: prefix+'repas.php', 
        type: 'POST', // Use the appropriate HTTP method
        data: jsonDataRepas,
        contentType: 'application/json',
        success: function(id_repas) {
            for(var i =0;i<values_aliments[0].length;i++){ // pour chaque aliment (longueur nomAliment=nbr aliments)
                var dataAliment = {
                    nom_aliment:values_aliments[0][i],
                    energie:values_aliments[1][i],
                    lipides: values_aliments[2][i],
                    glucides:values_aliments[3][i],
                    sucre:values_aliments[4][i],
                    fibres:values_aliments[5][i],
                    proteines:values_aliments[6][i],
                    sel:values_aliments[7][i]
                };
                var quantite= values_aliments[8][i];
                jsonDataAliment=JSON.stringify(dataAliment);

                $.ajax({
                    url: prefix+'aliments.php',
                    type:'POST',
                    data:jsonDataAliment,
                    contentType: 'application/json',
                    success: function(id_aliment){
                        console.log(quantite);
                        var dataContenir = {
                            id_repas: id_repas["id_repas"],
                            id_aliment:id_aliment["id_aliment"],
                            quantite:quantite
                        };
                        jsonDataContenir=JSON.stringify(dataContenir);
                        $.ajax({
                            url: prefix+'aliments_repas.php',
                            type:'POST',
                            data: jsonDataContenir,
                            contentType:'application/json',
                            success: function(data){
                                console.log("J'adore quand un plan se déroule sans accroc");
                                var form= document.getElementById("meal-form");
                                form.innerHTML='<div class="form-group"><label for="dateRepas">Date:</label><input type="date" id="dateRepas" name="dateRepas" value="2023-10-30" min="2018-01-01" max="2023-12-31"></div><div class="form-group"><label for="typeRepas">Type de repas:</label><select name="typeRepas" id="typeRepas"><option value="1">Petit-Déjeuner</option><option value="2">Déjeuner</option><option value="3">Goûter</option><option value="4">Dîner</option></select></div>';
                            },
                            error: function(xhr, status, error) {
                                console.log(status,error,xhr,"erreur contenir ");
                            }
            
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(status,error,xhr,"erreur ajout aliment");
                    }
    
                });
            }
            
            
        },
        error: function(xhr, status, error) {
            console.log(status,error,xhr,"erreur création repas");
        }
    });

}