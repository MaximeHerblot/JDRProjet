
function recoverData(){
    
    data = document.querySelector("#form").children
    list = {}
    j = 0
    for (let i = 0;i < data.length; i++){
        if (typeof data[i].name !== 'undefined') {
            if (data[i].name.slice(-4)=="Data"){
                j++
                id = data[i].id
                value = data[i].value
                list[id] = value
            }
        }
        
    }
    return (list);
}

$("button")[0].onclick = function() {
    // <!-- Appelle de la fonction pour récupérer les données -->
    
    
    list = recoverData()
    $.ajax({
        url:"/creation/characters/requete",
        type:"POST",
        data:list,
    }).done((e)=>{
        $("#form").hidden()
        $("#resultat").show()
        console.log(e.lastname)
    })
}

document.querySelector("h1").className = "active"

