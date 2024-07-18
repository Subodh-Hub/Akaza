
    let user = document.getElementById("user");
    let anime = document.getElementById("anime");
    let add = document.getElementById("add");

    function openUsers(){
        user.style.display = "block";
        anime.style.display = "none";
        add.style.display = "none";
    }


    function openAnime(){
        user.style.display ="none";
        anime.style.display = "block";
        add.style.display = "none";
    }

    function openAdd(){
        user.style.display = "none";
        anime.style.display = "none";
        add.style.display = "block";
    }


    


