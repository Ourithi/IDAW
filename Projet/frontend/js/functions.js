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
            console.log(data);
            document.getElementById("name").innerHTML = "<strong>Nom:</strong>"+data["NAME"];
            document.getElementById("taille").innerHTML = "<strong>Taille:</strong>"+data["TAILLE"]+" cm";
            document.getElementById("poids").innerHTML = "<strong>Poids:</strong>"+data["POIDS"]+" kg";
            document.getElementById("age").innerHTML = "<strong>Age:</strong>"+data["AGE"]+ " ans";
            document.getElementById("sexe").innerHTML = "<strong>Sexe:</strong>"+data["SEXE"];
            document.getElementById("activité").innerHTML = "<strong>Activité:</strong>"+data["NOM_ACTIVITE"];
            //return(Array(data["NAME"]),data["TAILLE"],data["POIDS"],data["AGE"],data["SEXE"]);
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log("erreur",status,error);
        }
    });
    
}

function activateEdit(){
    $.ajax({
        url: prefix + 'user.php?id_user=' + idVal,  
        type: 'GET', 
        dataType: "json",
        success: function (data) {
            console.log(data);
            document.getElementById("name").innerHTML = '<strong>Nom:</strong><input type="text" id="name" name="name" value="'+data["NAME"]+'">';
            document.getElementById("taille").innerHTML = '<strong>Taille:</strong><input type="number" id="taille" name="taille" value="'+data["TAILLE"]+'">cm';
            document.getElementById("poids").innerHTML = '<strong>Poids:</strong><input type="number" id="poids" name="poids" value="'+data["POIDS"]+'">kg';
            document.getElementById("age").innerHTML = '<strong>Age:</strong>"<input type="number" id="age" name="age" value="'+data["AGE"]+'"';
            //document.getElementById("sexe").innerHTML = "<strong>Sexe:</strong>"+data["SEXE"];
            document.getElementById("activité").innerHTML = "<strong>Activité:</strong>"+data["NOM_ACTIVITE"];
            //return(Array(data["NAME"]),data["TAILLE"],data["POIDS"],data["AGE"],data["SEXE"]);
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

function defTable(){
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