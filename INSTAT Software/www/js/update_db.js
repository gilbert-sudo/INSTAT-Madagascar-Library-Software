async function getUpdatedatabase() {
    return (await fetch("../apply_update.php")).json();
}

document.addEventListener("DOMContentLoaded", async () => {
    let response = [];
    try {
        response = await getUpdatedatabase();
    } catch (e) {
        console.group("Error!");
        console.log(e);
    }
    if (response.state == "finished") {
        console.log("Update finished!");
        document.getElementById("count").innerHTML = "100";
        window.location.href = "../index.php?updates=1";
    } 
    console.log(response);
});
