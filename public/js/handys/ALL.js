document.addEventListener("DOMContentLoaded", () => {
    const defaultSrc = document.getElementById("contract").src;

    document.querySelectorAll(".handyModal").forEach(handys => {
        handys.addEventListener("click", () => {
            document.getElementById("myModal").style.display = "block";
            document.getElementById("handyOwner").value = handys.dataset.handy;
            
            fetchData("GET", "image/get/" + handys.dataset.handy).then(data => {
                console.log(data);

                document.getElementById("contract").src += "/" + data.imageName;
            })
        })
    })

    document.getElementById("closeModal").addEventListener("click", () => {
        document.getElementById("myModal").style.display = "none";
        document.getElementById("contract").src = defaultSrc
    })

    function fetchData(method = "POST", url, data = null){
        let response;
        if(data != null){
            response = fetch(url, {
                method: method,
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.head.querySelector("[name~=csrf-token][content]").content
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json());
        } else {
            response = fetch(url, {
                method: method,
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.head.querySelector("[name~=csrf-token][content]").content
                },
            })
            .then(response => response.json())
        }

        return response;
    }    
})